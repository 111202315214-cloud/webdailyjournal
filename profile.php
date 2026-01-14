<?php
include "koneksi.php";

// 1. AMBIL USERNAME DARI SESSION (Penting!)
$username = $_SESSION['username'];

// 2. LOGIC PROSES SIMPAN
if (isset($_POST['simpan'])) {
    $password = $_POST['password'];
    $foto_lama = $_POST['foto_lama'];
    $nama_foto = $_FILES['foto']['name'];
    $foto_final = '';

    // Proses Upload
    if ($nama_foto != '') {
        include "uploadfoto.php";
        $cek_upload = uploadfoto($_FILES["foto"]);
        if ($cek_upload['status']) {
            $foto_final = $cek_upload['message']; 
            if ($foto_lama != '' && file_exists("img/" . $foto_lama)) {
                unlink("img/" . $foto_lama);
            }
        } else {
            echo "<script>alert('Gagal: " . $cek_upload['message'] . "');</script>";
            $foto_final = $foto_lama;
        }
    } else {
        $foto_final = $foto_lama;
    }

    // Update Database
    if ($password != '') {
        $pass_md5 = md5($password);
        $stmt = $conn->prepare("UPDATE user SET password=?, foto=? WHERE username=?");
        $stmt->bind_param("sss", $pass_md5, $foto_final, $username);
    } else {
        $stmt = $conn->prepare("UPDATE user SET foto=? WHERE username=?");
        $stmt->bind_param("ss", $foto_final, $username);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Simpan profil sukses!'); document.location='admin.php?page=profile';</script>";
    }
}

// 3. AMBIL DATA USER UNTUK DITAMPILKAN (Biar variabel $data dikenal)
$query = $conn->prepare("SELECT * FROM user WHERE username = ?");
$query->bind_param("s", $username);
$query->execute();
$hasil = $query->get_result();
$data = $hasil->fetch_assoc();
?>

<div class="container mt-1">
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label fw-bold">Username</label>
            <input type="text" class="form-control bg-light" name="username" value="<?= $data['username'] ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Ganti Password</label>
            <input type="password" class="form-control" name="password" placeholder="Tuliskan Password Baru Jika Ingin Mengganti Password Saja">
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Ganti Foto Profil</label>
            <input type="file" class="form-control" name="foto">
            <input type="hidden" name="foto_lama" value="<?= $data['foto'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold d-block">Foto Profil Saat Ini</label>
            <?php
            if (!empty($data['foto']) && file_exists("img/" . $data['foto'])) {
                echo '<img src="img/' . $data['foto'] . '" width="150" class="img-thumbnail rounded shadow-sm d-block">';
            } else {
                echo '<div class="text-muted p-3 border rounded bg-light" style="width: 150px; text-align: center;">';
                echo '<i class="bi bi-person-fill display-4"></i><br><small>Kosong</small></div>';
            }
            ?>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary px-4 shadow-sm">simpan</button>
    </form>
</div>
<?php
include "koneksi.php";
include "uploadfoto.php";

// Hapus Data
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '') {
        unlink("img/" . $gambar);
    }

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    echo "<script>alert('Hapus berhasil'); document.location='admin.php?page=gallery';</script>";
}

if (isset($_POST['simpan'])) {
    $deskripsi = $_POST['deskripsi'];
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];

    if ($nama_gambar != '') {
        $cek_upload = uploadfoto($_FILES["gambar"]);
        if ($cek_upload['status']) { 
            $gambar = $cek_upload['message']; 
        } else {
            // KALAU GAGAL UPLOAD, KITA KASIH TAU ERRORNYA APA
            echo "<script>alert('Gagal Upload: " . $cek_upload['message'] . "'); document.location='admin.php?page=gallery';</script>";
            die;
        }
    }

    if (isset($_POST['id']) && $_POST['id'] != '') {
        $id = $_POST['id'];
        if ($nama_gambar == '') { $gambar = $_POST['gambar_lama']; } 
        else { if($_POST['gambar_lama'] != '') unlink("img/" . $_POST['gambar_lama']); }
        $stmt = $conn->prepare("UPDATE gallery SET deskripsi=?, gambar=?, tanggal=?, username=? WHERE id=?");
        $stmt->bind_param("ssssi", $deskripsi, $gambar, $tanggal, $username, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO gallery (deskripsi, gambar, tanggal, username) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $deskripsi, $gambar, $tanggal, $username);
    }
    $stmt->execute();
    echo "<script>document.location='admin.php?page=gallery';</script>";
}
?>

<div class="container">
    <div class="d-flex justify-content-between my-3">
          <button type="button" class="btn btn-secondary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahG">
            <i class="bi bi-plus-lg"></i> Tambah Gallery
        </button>
        <input type="text" id="search_gallery" placeholder="Search..." class="form-control w-25">
    </div>

    <div id="gallery_data"></div>

    <div class="modal fade" id="modalTambahG" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-header"><h5 class="modal-title">Tambah Gallery</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                    <div class="modal-body">
                        <div class="mb-3"><label>Deskripsi</label><textarea class="form-control" name="deskripsi" required></textarea></div>
                        <div class="mb-3"><label>Gambar</label><input type="file" class="form-control" name="gambar" required></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    load_data();
    function load_data(){
        var search = $("#search_gallery").val();
        $.ajax({
            method: "POST",
            url: "gallery_data.php",
            data: { search: search },
            success: function(data){ $('#gallery_data').html(data); }
        });
    }
    $("#search_gallery").on('keyup', function(){ load_data(); });
});
</script>
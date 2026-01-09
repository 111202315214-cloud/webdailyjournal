<?php
include "koneksi.php";
include "uploadfoto.php";

// LOGIKA PROSES DATA (CREATE, UPDATE, DELETE)
// Logika Hapus Data
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];
    if ($gambar != '') { unlink("img/" . $gambar); }

    $stmt = $conn->prepare("DELETE FROM articel WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Hapus data sukses'); document.location='admin.php?page=article';</script>";
    }
    $stmt->close();
}

// Logika Simpan (Tambah & Update)
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];

    if ($nama_gambar != '') {
        $cek_upload = uploadfoto($_FILES["gambar"]);
        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];
        } else {
            echo "<script>alert('" . $cek_upload['message'] . "'); document.location='admin.php?page=article';</script>";
            die;
        }
    }

    if (isset($_POST['id']) && $_POST['id'] != '') {
        $id = $_POST['id'];
        if ($nama_gambar == '') {
            $gambar = $_POST['gambar_lama'];
        } else {
            unlink("img/" . $_POST['gambar_lama']);
        }
        $stmt = $conn->prepare("UPDATE articel SET judul=?, isi=?, gambar=?, tanggal=?, username=? WHERE id=?");
        $stmt->bind_param("sssssi", $judul, $isi, $gambar, $tanggal, $username, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO articel (judul,isi,gambar,tanggal,username) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $judul, $isi, $gambar, $tanggal, $username);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Simpan data sukses'); document.location='admin.php?page=article';</script>";
    }
    $stmt->close();
}
?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-light">article</h2>
    </div>

    <div class="d-flex justify-content-between mb-3">
        <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg"></i> Tambah Article
        </button>
        <input type="text" id="search" placeholder="Search..." class="form-control" style="width: 250px;">
    </div>

    <div id="article_data"></div>

    <div class="modal fade" id="modalTambah" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3"><label>Judul</label><input type="text" class="form-control" name="judul" required></div>
                        <div class="mb-3"><label>Isi</label><textarea class="form-control" name="isi" rows="5" required></textarea></div>
                        <div class="mb-3"><label>Gambar</label><input type="file" class="form-control" name="gambar"></div>
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
    function load_data(hlm){
        var search = $("#search").val();
        $.ajax({
            method: "POST",
            url: "article_data.php",
            data: { search: search, hlm: hlm },
            success: function(data){
                $('#article_data').html(data);
            }
        });
    }
    $("#search").on('keyup', function(){
        load_data();
    });
});
</script>


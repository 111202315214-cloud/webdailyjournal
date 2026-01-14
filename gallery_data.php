<?php
include "koneksi.php";
$search = isset($_POST['search']) ? $_POST['search'] : '';

$sql = "SELECT * FROM gallery WHERE judul LIKE ? OR deskripsi LIKE ? ORDER BY tanggal DESC";
$stmt = $conn->prepare($sql);
$keyword = "%$search%";
$stmt->bind_param("ss", $keyword, $keyword);
$stmt->execute();
$hasil = $stmt->get_result();
$no = 1;

$rows = [];
while ($row = $hasil->fetch_assoc()) {
    $rows[] = $row;
}
?>

<div class="table-responsive">
    <table class="table table-hover align-middle border">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th class="w-50">Deskripsi</th>
                <th class="w-50">Gambar</th>
                <th class="w-25">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row) { 
                $tampil_text = !empty($row["deskripsi"]) ? $row["deskripsi"] : $row["judul"];
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <strong><?= $tampil_text ?></strong><br>
                    <small class="text-muted d-block mt-1">pada: <?= $row["tanggal"] ?></small>
                    <small class="text-muted d-block">Oleh: <?= $row["username"] ?></small>
                </td>
                <td>
                    <?php if ($row["gambar"] != '' && file_exists('img/' . $row["gambar"])) { ?>
                        <img src="img/<?= $row["gambar"] ?>" class="img-fluid shadow-sm" style="width: 100%; max-width: 400px; display: block; margin: 0 auto; object-fit: contain;">
                    <?php } ?>
                </td>
                <td class="text-center">
                    <button class="btn badge rounded-pill text-bg-success border-0" data-bs-toggle="modal" data-bs-target="#modalEditG<?= $row["id"] ?>">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn badge rounded-pill text-bg-danger border-0" data-bs-toggle="modal" data-bs-target="#modalHapusG<?= $row["id"] ?>">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php foreach ($rows as $row) { 
    $tampil_text = !empty($row["deskripsi"]) ? $row["deskripsi"] : $row["judul"];
?>
    <div class="modal fade" id="modalEditG<?= $row["id"] ?>" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Gallery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-start">
                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                        <input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="4" required><?= $tampil_text ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ganti Gambar</label>
                            <input type="file" class="form-control" name="gambar">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalHapusG<?= $row["id"] ?>" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header"><h5 class="modal-title">Konfirmasi Hapus</h5></div>
                    <div class="modal-body text-center">
                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                        <input type="hidden" name="gambar" value="<?= $row["gambar"] ?>">
                        <p>Yakin ingin menghapus gallery ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
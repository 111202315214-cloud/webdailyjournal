<?php
include "koneksi.php";
$search = isset($_POST['search']) ? $_POST['search'] : '';

$sql = "SELECT * FROM articel WHERE judul LIKE ? OR isi LIKE ? ORDER BY tanggal DESC";
$stmt = $conn->prepare($sql);
$keyword = "%$search%";
$stmt->bind_param("ss", $keyword, $keyword);
$stmt->execute();
$hasil = $stmt->get_result();
$no = 1;
?>

<div class="table-responsive">
    <table class="table table-hover align-middle border">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th class="w-25">Judul</th>
                <th class="w-50">Isi</th>
                <th class="w-50">Gambar</th>
                <th class="w-25">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $hasil->fetch_assoc()) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <strong><?= $row["judul"] ?></strong><br>
                    <small class="text-muted">pada: <?= $row["tanggal"] ?></small>
                </td>
                <td><?= $row["isi"] ?></td>
                <td>
                    <?php if ($row["gambar"] != '' && file_exists('img/' . $row["gambar"])) { ?>
                        <img src="img/<?= $row["gambar"] ?>" class="img-fluid" alt="Gambar Artikel">
                    <?php } ?>
                </td>
                <td class="text-center">
                    <button class="btn badge rounded-pill text-bg-success border-0" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn badge rounded-pill text-bg-danger border-0" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>

            <div class="modal fade" id="modalEdit<?= $row["id"] ?>" data-bs-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Article</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-start">
                                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                <input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">
                                <div class="mb-3">
                                    <label class="form-label">Judul</label>
                                    <input type="text" class="form-control" name="judul" value="<?= $row["judul"] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Isi</label>
                                    <textarea class="form-control" name="isi" rows="5" required><?= $row["isi"] ?></textarea>
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

            <div class="modal fade" id="modalHapus<?= $row["id"] ?>" data-bs-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content text-dark">
                        <form method="post">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                            </div>
                            <div class="modal-body text-center">
                                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                <input type="hidden" name="gambar" value="<?= $row["gambar"] ?>">
                                <p>Yakin ingin menghapus artikel "<strong><?= $row["judul"] ?></strong>"?</p>
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
        </tbody>
    </table>
</div>
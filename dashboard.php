<?php
$sql1 = "SELECT * FROM articel";
$hasil1 = $conn->query($sql1);
$jumlah_article = ($hasil1) ? $hasil1->num_rows : 0;

$sql_g = "SELECT id FROM gallery";
$res_g = $conn->query($sql_g);
$jumlah_gallery = ($res_g) ? $res_g->num_rows : 0;

// Ambil data user untuk foto profil
$username = $_SESSION['username'];
$query_user = $conn->prepare("SELECT foto FROM user WHERE username = ?");
$query_user->bind_param("s", $username);
$query_user->execute();
$data_user = $query_user->get_result()->fetch_assoc();

$foto_profil = (!empty($data_user['foto']) && file_exists("img/" . $data_user['foto'])) 
               ? "img/" . $data_user['foto'] 
               : "https://via.placeholder.com/200";
?>

<div class="container text-center mt-4">
    <div class="mb-4">
        <h3 class="display-6 mt-2">Selamat Datang,</h3>
        <h1 class="display-4 fw-bold text-primary"><?= $_SESSION['username'] ?></h1>
    </div>

    <div class="mb-5 d-flex justify-content-center">
        <div style="width: 200px; height: 200px; overflow: hidden;" class="rounded-circle shadow border border-3 border-primary">
            <img src="<?= $foto_profil ?>" class="w-100 h-100" style="object-fit: cover;">
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center pt-2">
        <div class="col">
            <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="p-3">
                            <h5 class="card-title m-0"><i class="bi bi-newspaper"></i> Article</h5> 
                        </div>
                        <div class="p-3">
                            <span class="badge rounded-pill text-bg-primary fs-2"><?php echo $jumlah_article; ?></span>
                        </div> 
                    </div>
                </div>
            </div>
        </div> 

        <div class="col">
            <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="p-3">
                            <h5 class="card-title m-0"><i class="bi bi-camera"></i> Gallery</h5> 
                        </div>
                        <div class="p-3">
                            <span class="badge rounded-pill text-bg-primary fs-2"><?php echo $jumlah_gallery; ?></span>
                        </div> 
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
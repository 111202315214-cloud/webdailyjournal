<?php
//menyertakan code dari file koneksi
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
    <style>
        body { font-family: sans-serif; }

        /* === THEME SYSTEM (TARUH DI SINI) === */
        .dark-theme {
            background-color: #121212 !important;
            color: #ffffff !important;
        }

        .dark-theme .navbar,
        .dark-theme .card,
        .dark-theme .footer-section {
            background-color: #1e1e1e !important;
            color: white !important;
        }

        .dark-theme .card-text,
        .dark-theme .card-title,
        .dark-theme .nav-link,
        .dark-theme .footer-text {
            color: white !important;
        }

        .dark-theme .accordion-button {
            background-color: #1e1e1e !important;
            color: white !important;
        }

        .dark-theme .accordion-body {
            background-color: #242424 !important;
            color: white !important;
        }

        .dark-theme .hero-section {
            background-color: #333 !important;
        }

        /* === FIX SCHEDULE === */
        .dark-theme table td {
            background-color: #1e1e1e !important;
            color: white !important;
        }

        .dark-theme table h2,
        .dark-theme table h3,
        .dark-theme table p {
            color: white !important;
        }
         .schedule-box {
          background-color: #f0f0f0;
         }

          .dark-theme .schedule-box {
          background-color: #1e1e1e !important;
          color: white !important;
        }
    </style>
</head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Daily Journal</title>
    <link rel="icon" href="iconic.jpg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: sans-serif; 
        }
        .navbar-brand {
            font-weight: bold;
        }
        .hero-section {
            background-color: #99d8f8; 
            padding: 80px 0;
        }
        .hero-content {
            padding-right: 30px; /
        }
        .hero-title {
            font-size: 3.5rem; 
            font-weight: bold;
            line-height: 1.2;
            margin-bottom: 20px;
        }
        .hero-description {
            font-size: 1.25rem;
            color: #555555;
            line-height: 1.6;
        }
        .hero-image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 8px; 
        }
        .footer-section {
            background-color: #f8f9fa; 
            padding: 40px 0;
            margin-top: 30px; 
        }
        .social-icons a {
            color: #333;
            margin: 0 10px;
            font-size: 1.8rem;
            transition: color 0.3s ease;
        }
        .social-icons a:hover {
            color: #007bff; 
        }
        .footer-text {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 15px;
        }
        /* Penyesuaian untuk gambar kedua */
        .image-banner {
            max-height: 400px; 
            overflow: hidden; 
        }
        .image-banner img {
            width: 100%;
            height: auto;
            display: block; 
            object-fit: cover; 
        }
        /* THEME SYSTEM */
        .dark-theme {
    background-color: #121212 !important;
    color: #ffffff !important;
        }

         .dark-theme .navbar,
         .dark-theme .card,
         .dark-theme .footer-section {
          background-color: #1e1e1e !important;
          color: white !important;
        }

         .dark-theme .card-text,
         .dark-theme .card-title,
         .dark-theme .nav-link,
         .dark-theme .footer-text {
          color: white !important;
        }

         .dark-theme .accordion-button {
          background-color: #1e1e1e !important;
          color: white !important;
        }

         .dark-theme .accordion-body {
          background-color: #242424 !important;
          color: white !important;
        }

         .dark-theme .hero-section {
          background-color: #333 !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm">
        <div class="container-fluid container">
            <a class="navbar-brand" href="#">My Daily Journal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="article.php">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Gallery</a>
                    <li class="nav-item">
                    <a class="nav-link" href="schedule.php">Schedule</a>
                     </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutme.php">About me</a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link" href="login.php" target="_blank">Login</a>
                    </li>
                     </li>
                     <li class="nav-item ms-3">
                 <button id="lightBtn" class="btn btn-light btn-sm">
                     <i class="bi bi-brightness-high"></i> Light
                     </button>
                     </li>
                      <li class="nav-item ms-2">
                 <button id="darkBtn" class="btn btn-dark btn-sm">
                      <i class="bi bi-moon-stars"></i> Dark
                 </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-12 mb-4 mb-lg-0">
                    <div class="hero-content">
                        <h1 class="hero-title">Create Memories, Save Memories, Everyday</h1>
                        <p class="hero-description">Mencatat semua kegiatan sehari-hari yang ada tanpa terkecuali</p>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="hero-image-container text-center text-lg-start">
                        <img src="University of Toronto - Myhal Centre for Engineering Innovation & Entrepreneurship - Education Snapshots.jpg" 
                        alt="Journal Illustration" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="articel" class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold display-5 mb-5">article</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
          <?php
$sql = "SELECT * FROM articel ORDER BY tanggal DESC";
$hasil = $conn->query($sql);

while($row = $hasil->fetch_assoc()) {
?>
    <div class="col">
        <div class="card h-100 shadow-sm">
            <img src="img/<?= $row["gambar"] ?>" class="card-img-top" alt="<?= $row["judul"] ?>" />
            
            <div class="card-body">
                <h5 class="card-title fw-bold"><?= $row["judul"] ?></h5>
                
                <p class="card-text">
                    <?= $row["isi"] ?>
                </p>
            </div>
            
            <div class="card-footer">
                <small class="text-body-secondary">
                    Terakhir diperbarui: <?= $row["tanggal"] ?>
                </small>
            </div>
        </div>
    </div>
<?php
            } // Penutup while
            ?>
        </div> </div> </section> ``

   <section>         
    <div class="col">
        <div class="card h-100 shadow-sm">
            
    <div class="col">
        <div class="card h-100 shadow-sm">
            </div>
        </div>
    </div>
</section>

    <section class="image-banner">
    </section>

    <footer class="footer-section text-center">
        <div class="container">
            <div class="social-icons mb-3">
                <a href="#" class="text-decoration-none"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-decoration-none"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-decoration-none"><i class="bi bi-whatsapp"></i></a>
            </div>
            <p class="footer-text">Aliza Izet Bighoviq © 2023</p>
        </div>
    </footer>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

 <center>
        <h1>Schedule</h1>
    </center>

    <table width="90%" border="0" align="center" cellpadding="20" cellspacing="20">
        <tr>
            <td class="schedule-box" width="25%">
                <center>
                    <h2>&#x1F4DA;</h2> <h3>Membaca</h3>
                    <p>Menambah wawasan setiap pagi sebelum beraktivitas.</p>
                </center>
            </td>
             <td class="schedule-box" width="25%">
                <center>
                    <h2>&#x270D;</h2> <h3>Menulis</h3>
                    <p>Mencatat setiap pengalaman harian di jurnal pribadi.</p>
                </center>
            </td>
            <td class="schedule-box" width="25%">
                <center>
                    <h2>&#x1F465;</h2> <h3>Diskusi</h3>
                    <p>Bertukar ide dengan teman dalam kelompok belajar.</p>
                </center>
            </td>
            <td class="schedule-box" width="25%">
                <center>
                    <h2>&#x1F6B2;</h2> <h3>Olahraga</h3>
                    <p>Menjaga kesehatan dengan bersepeda sore hari.</p>
                </center>
            </td>
        </tr>

        <tr>
            <td colspan="2" class="schedule-box schedule-center" valign="top">
                <center>
                    <h2>&#x1F3AC;</h2> <h3>Movie</h3>
                    <p>Menonton film yang bagus di bioskop.</p>
                </center>
            </td>
            <td colspan="2" class="schedule-box schedule-center" valign="top">
                <center>
                    <h2>&#x1F6CD;</h2> <h3>Belanja</h3>
                    <p>Membeli kebutuhan bulanan di supermarket.</p>
                </center>
            </td>
        </tr>
    </table>
</body>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Sederhana</title>
</head>

</html>
  <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Universitas Dian Nuswantoro (2023 - 2025)
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the first item’s accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element.
         These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. 
         It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        SMA IT Miftahul Huda Al-Faqih (2020 - 2022)
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the second item’s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. 
        These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. 
        It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Pondok Pesantren Darussalam Gontor (2017 - 2020)
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the third item’s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. 
        These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. 
        It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
</div>
    </section>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;
    const darkBtn = document.getElementById("darkBtn");
    const lightBtn = document.getElementById("lightBtn");

    if (darkBtn) {
        darkBtn.addEventListener("click", () => {
            body.classList.add("dark-theme");
        });
    }

    if (lightBtn) {
        lightBtn.addEventListener("click", () => {
            body.classList.remove("dark-theme");
        });
    }
});
</script>



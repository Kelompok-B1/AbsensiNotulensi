<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sistem Absensi dan Notulensi</title>
  <link rel="icon" type="image/x-icon" href="../view/assets/favicon.ico" />
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Bocor - v2.2.1
  * Template URL: https://bootstrapmade.com/bocor-bootstrap-template-nice-animation/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="index.php">Home</a></li>
          <li class="drop-down"><a href="">Login as</a>
            <ul>
              <li>
                  <a  data-toggle="modal" data-target="#exampleModalPegawai">
                    Pegawai
                  </a>
            </li>

                <li>
                  <a  data-toggle="modal" data-target="#exampleModalMahasiswa">
                    Mahasiswa
                  </a>
            </li>
            </ul>
          </li>
        </ul>
      </nav><!-- .nav-menu -->

      <!-- Button trigger modal -->


<!-- Modal Login Pegawai -->
<div class="modal fade" id="exampleModalPegawai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login Pegawai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="../view/proses_login_pegawai.php">
          <div class="form-group">
              <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Username" required autofocus>
          </div>
          <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
          </div>
          <a href= "index.php" button type="submit" name="login" class="btn btn-info" style="width:49%;">Home</button></a>
          <button type="submit" name="login" class="btn btn-success" style="width:49%;">Login</button>
          <?php 
              if(isset($_GET['pesan'])){
                  if($_GET['pesan'] == "gagal"){
                      echo"
                      <script>alert('Login gagal! Username dan Password Salah!')</script>
                      ";
                  }else if($_GET['pesan'] == "logout"){
                      echo " <script>alert('Anda Telah Berhasil Logout')</script>";
                  }else if($_GET['pesan'] == "belum_login"){
                  echo " <script>alert('Silahkan Login Terlebih Dahulu Untuk Masuk Ke Halaman Pegawai')</script>";
              }
          }
      ?>
  </form>
      </div>
      
    </div>
  </div>
</div>
<!-- Close Modal Login Pegawai-->

<!-- Modal Login Mahasiswa -->
<div class="modal fade" id="exampleModalMahasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="../view/proses_login_mahasiswa.php">
                    <div class="form-group">
                            <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Username" required autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                            <a href= "index.php" button type="submit" name="login" class="btn btn-info" style="width:49%;">Home</button></a>
                            <button type="submit" name="login" class="btn btn-success" style="width:49%;">Login</button>
                            <?php 
                                if(isset($_GET['pesan'])){
                                    if($_GET['pesan'] == "gagal"){
                                        echo"
                                        <script>alert('Login gagal! Username dan Password Salah!')</script>
                                        ";
                                    }else if($_GET['pesan'] == "logout"){
                                        echo " <script>alert('Anda Telah Berhasil Logout')</script>";
                                    }else if($_GET['pesan'] == "belum_login"){
                                    echo " <script>alert('Silahkan Login Terlebih Dahulu Untuk Masuk Ke Halaman Mahasiswa')</script>";
                                }
                            }
                ?>
                    </form>
        
      </div>
     
    </div>
  </div>
</div>
<!-- Close Modal Login mahasiswa-->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">

    <div class="container">
      <div class="row d-flex align-items-center"">
      <div class=" col-lg-6 py-5 py-lg-0 order-2 order-lg-1" data-aos="fade-right">
        <h1>Sistem Pencatatan Data Absensi dan Notulensi</h1>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left">
        <img src="assets/img/hero-img.png" class="img-fluid" alt="">
      </div>
    </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Footer ======= -->
    <footer id="footer">

      <div class="footer-top">
  
        <div class="container" data-aos="fade-up">
  
          <div class="row  justify-content-center">
            <div class="col-lg-6">
              <h3>Politeknik Negeri Bandung<h3>
             
            </div>
          </div>
  
          <div class="social-links">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
          </div>
  
        </div>
      </div>
      
  
      <div class="container footer-bottom clearfix">
        <div class="copyright">
          &copy; Copyright <strong><span>|2021</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bocor-bootstrap-template-nice-animation/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
    </footer><!-- End Footer -->
  
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  
    <!-- Vendor JS Files -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="assets/vendor/venobox/venobox.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
  
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
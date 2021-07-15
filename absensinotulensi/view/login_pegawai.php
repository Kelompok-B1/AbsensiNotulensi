<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Absensi dan Notulensi</title>
    <link rel="icon" type="image/x-icon" href="../view/assets/favicon.ico" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h4 class="card-title text-center">Login Pegawai</h4><p>
         
              <div class="form-label-group">
         
                <form method="POST" action="proses_login_pegawai.php">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Username" required autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <a href= "../MainFrame/index.html" button type="submit" name="login" class="btn btn-warning" style="width:49%;">Back</button></a>
                        <button type="submit" name="login" class="btn btn-primary" style="width:49%;">Login</button>
                        <?php 
                            if(isset($_GET['pesan'])){
                                if($_GET['pesan'] == "gagal"){
                                    echo"
                                    <script>alert('Login gagal! Username dan Password Salah!')</script>;
                                    ";
                                }else if($_GET['pesan'] == "logout"){
                                    echo " <script>alert('Anda Telah Berhasil Logout')</script>;";
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
    </div>
  </div>
</body>



<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        
   </head>

<style>
  .pilihlogin{
    width: 500px;
    height: 250px;
    margin-left :500px;
    margin-top: 280px;
  
    outline-style:solid;
    outline-color:blue;
  }
 .form-group{
    width:300px;
    margin-left:auto;
    margin-right:auto;
}
button {
    width:300px;
    margin-left:100px;
}
</style>
<body>
    <div class="pilihlogin">
      <br>
         <h4 align="center"> Login Mahasiswa </h4>
         <form method="POST" action="proses_login_mahasiswa.php">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Masukkan Username">
               </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Masukkan Password">
           
            </div>
    
                <button type="submit" name="login" class="btn btn-primary">Login</button>
                <?php 
                    if(isset($_GET['pesan'])){
                        if($_GET['pesan'] == "gagal"){
                            echo"
                            <script>alert('Login gagal! Username dan Password Salah!')</script>;
                            ";
                        }else if($_GET['pesan'] == "logout"){
                            echo " <script>alert('Anda Telah Berhasil Logout')</script>;";
                        }else if($_GET['pesan'] == "belum_login"){
                        echo " <script>alert('Silahkan Login Terlebih Dahulu Untuk Masuk Ke Halaman Mahasiswa')</script>";
                    }
                }
	?>
        </form>
        
    </div>

</body>
</html>





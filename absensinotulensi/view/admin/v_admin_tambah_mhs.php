<?php 
   if(isset($_POST['submit'])){
      require '../../model/connect.php';
      $insertOneResult = $collection->mahasiswa->insertOne([
          'nim' => $_POST['nim'],
          'nama_mhs' => $_POST['nama'],
          'jk' => $_POST['jk'],
          'kode_kelas' => $_POST['kode_kelas'],
          'no_telp' => $_POST['no_telp'],
          'alamat' => (object)array('kampung' => $_POST['kampung'],'no_rumah' => $_POST['no_rumah'],
                      'rt' => $_POST['rt'],'rw' => $_POST['rw'],'desa' => $_POST['desa'],
                      'kode_pos' => $_POST['kode_pos'],'kecamatan' => $_POST['kecamatan'],
                      'kabupaten_kota' => $_POST['kabupaten_kota'],'provinsi' => $_POST['provinsi'],),
          'email' => $_POST['email'],
          'akun' => (object)array('username' => $_POST['nim'],'password' => $_POST['password'])


      ]);
    
      header("Location: v_admin_tampil_mhs.php");
   }
?>

<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Tambah Data Mahasiswa</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        
   </head>
   <body>
      <div class="container">
         <br>
         <CENTER><h1>Tambah Data Mahasiswa</h1></CENTER>
         <form method="POST">
            <div class="form-group">
               <input type="text" class="form-control" name="nim" required="" placeholder="Nomor Induk Mahasiswa"><br>
               <input type="text" class="form-control" name="nama" required="" placeholder="Nama Lengkap"><br>
               <input type="text" class="form-control" name="password" required="" placeholder="Password"><br>
               <input type="text" class="form-control" name="jk" required="" placeholder="Jenis Kelamin"><br>
               <input type="text" class="form-control" name="kode_kelas" required="" placeholder="Kode Kelas"><br>
               <input type="text" class="form-control" name="no_telp"  placeholder="Nomor Telepon"><br>
               <input type="text" class="form-control" name="kampung"  placeholder="Alamat Rumah"><br>
               <input type="text" class="form-control" name="no_rumah" required="" placeholder="Nomor Rumah"><br>
               <input type="text" class="form-control" name="rt" required="" placeholder="RT"><br>
               <input type="text" class="form-control" name="rw" required="" placeholder="RW"><br>
               <input type="text" class="form-control" name="desa" required="" placeholder="Desa/Kelurahan"><br>
               <input type="text" class="form-control" name="kode_pos" required="" placeholder="Kode Pos"><br>
               <input type="text" class="form-control" name="kecamatan" required="" placeholder="Kecamatan"><br>
               <input type="text" class="form-control" name="kabupaten_kota" required="" placeholder="Kabupaten/Kota"><br>
               <input type="text" class="form-control" name="provinsi" required="" placeholder="Provinsi"><br>  
               <input type="text" class="form-control" name="email" required="" placeholder="email"><br>
               <a href="v_admin_tampil_mhs.php" class="btn btn-primary">Kembali</a>
               <button type="submit" name="submit" class="btn btn-success">Tambah</button>
            </div>
         </form>
      </div>
   </body>
</html>
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
          'email' => $_POST['email']


      ]);
    
      header("Location: v_admin_tampil_mhs.php");
   }
?>


<html>
   <head>
      <title></title>
    
   </head>
   <body>
      <div class="container">
         <br>
         <CENTER><h1>Tambah Data Mahasiswa</h1></CENTER>
         <a href="v_admin_tampil_mhs.php" class="btn btn-primary">Kembali</a>
         <form method="POST">
            <div class="form-group">
               <strong>NIM:</strong>
               <input type="text" class="form-control" name="nim" required="" placeholder="xxxxxxxxx"><br>

               <strong>Nama Mahasiswa:</strong>
               <input type="text" class="form-control" name="nama" required="" placeholder="xxxxxxxxx"><br>

               <strong>JK:</strong>
               <input type="text" class="form-control" name="jk" required="" placeholder="xxxxxxxxx"><br>

               <strong>Kode Kelas:</strong>
               <input type="text" class="form-control" name="kode_kelas" required="" placeholder="xxxxxxxxx"><br>

               <strong>No Telp:</strong>
               <input type="text" class="form-control" name="no_telp"  placeholder="xxxxxxxxx"><br>

               <strong>Kampung:</strong>
               <input type="text" class="form-control" name="kampung"  placeholder="xxxxxxxxx"><br>
               
               <strong>No Rumah:</strong>
               <input type="text" class="form-control" name="no_rumah" required="" placeholder="xxxxxxxxx"><br>

               <strong>RT:</strong>
               <input type="text" class="form-control" name="rt" required="" placeholder="xxxxxxxxx"><br>

               <strong>RW:</strong>
               <input type="text" class="form-control" name="rw" required="" placeholder="xxxxxxxxx"><br>

               <strong>Desa:</strong>
               <input type="text" class="form-control" name="desa" required="" placeholder="xxxxxxxxx"><br>
               
               <strong>Kode Pos:</strong>
               <input type="text" class="form-control" name="kode_pos" required="" placeholder="xxxxxxxxx"><br>

               <strong>Kecamatan:</strong>
               <input type="text" class="form-control" name="kecamatan" required="" placeholder="xxxxxxxxx"><br>

               <strong>Kabupaten/Kota:</strong>
               <input type="text" class="form-control" name="kabupaten_kota" required="" placeholder="xxxxxxxxx"><br>

               <strong>Provinsi:</strong>
               <input type="text" class="form-control" name="provinsi" required="" placeholder="xxxxxxxxx"><br>  

               <strong>Email:</strong>
               <input type="text" class="form-control" name="email" required="" placeholder="xxxxxxxxx"><br>
               <button type="submit" name="submit" class="btn btn-success">Tambah</button>
            </div>
         </form>
      </div>
   </body>
</html>
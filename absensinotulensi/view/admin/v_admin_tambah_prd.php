<?php 
   if(isset($_POST['submit'])){
      require '../../model/connect.php';
      $insertOneResult = $collection->prodi->insertOne([
          'kode_prodi' => $_POST['kode_prodi'],
          'nama_prodi' => $_POST['nama_prodi'],
          'kode_jurusan' => $_POST['kode_jurusan'],


      ]);
    
      header("Location: v_admin_tampil_prd.php");
   }
?>


<html>
   <head>
      <title></title>
    
   </head>
   <body>
      <div class="container">
         <br>
         <CENTER><h1>Tambah Data Prodi</h1></CENTER>
         <a href="v_admin_tampil_mhs.php" class="btn btn-primary">Kembali</a>
         <form method="POST">
            <div class="form-group">
               <strong>Kode Prodi:</strong>
               <input type="text" class="form-control" name="kode_prodi" required="" placeholder="xxxxxxxxx"><br>

               <strong>Nama Prodi:</strong>
               <input type="text" class="form-control" name="nama_prodi" required="" placeholder="xxxxxxxxx"><br>
                
               <strong>Kode Jurusan:</strong>
               <input type="text" class="form-control" name="kode_jurusan" required="" placeholder="xxxxxxxxx"><br>
               
               <button type="submit" name="submit" class="btn btn-success">Tambah</button>
            </div>
         </form>
      </div>
   </body>
</html>
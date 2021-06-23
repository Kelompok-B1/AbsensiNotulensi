<?php 
   if(isset($_POST['submit'])){
      require '../../model/connect.php';
      $insertOneResult = $collection->jurusan->insertOne([
          'kode_jurusan' => $_POST['kode_jurusan'],
          'nama_jurusan' => $_POST['nama_jurusan']
        


      ]);
    
      header("Location: v_admin_tampil_jrs.php");
   }
?>


<html>
   <head>
      <title></title>
    
   </head>
   <body>
      <div class="container">
         <br>
         <CENTER><h1>Tambah Data Jurusan</h1></CENTER>
         <a href="v_admin_tampil_mhs.php" class="btn btn-primary">Kembali</a>
         <form method="POST">
            <div class="form-group">
               <strong>Kode Jurusan:</strong>
               <input type="text" class="form-control" name="kode_jurusan" required="" placeholder="xxxxxxxxx"><br>

               <strong>Nama Jurusan:</strong>
               <input type="text" class="form-control" name="nama_jurusan" required="" placeholder="xxxxxxxxx"><br>

               
               <button type="submit" name="submit" class="btn btn-success">Tambah</button>
            </div>
         </form>
      </div>
   </body>
</html>
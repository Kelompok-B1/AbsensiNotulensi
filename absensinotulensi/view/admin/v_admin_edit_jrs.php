<?php 
  require '../../model/connect.php';  

  if (isset($_GET['id'])) {
    $jurusan = $collection->jurusan->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
   }
 
   if(isset($_POST['submit'])){
    $has_errors =false; 
try {$collection->jurusan->updateOne(
       ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
       ['$set' =>['kode_jurusan' => $_POST['kode_jurusan'],'nama_jurusan' => $_POST['nama_jurusan']]]       
   

   );}
   catch (exception $e){
    $has_errors =true; 
  
   }
   
  

   if ($has_errors==false){
    
      echo"
      <script>
        window.alert('Data JurusanBerhasil Diupdate ! Anda Akan Diarahkan Ke Halaman Data Jurusan');
        window.location.href='v_admin_tampil_jrs.php';
        </script>";

       
     
      
      
     }else if($has_errors!==false){
      echo"
      <script>
        window.alert('Data Jurusan Tidak Berhasil Diupdate ! Anda Akan Diarahkan Ke Halaman Data Edit Jurusan');
        window.location.href='v_admin_edit_jrs.php';
        </script>";

         }
}



?>


<html>
   <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Ubah Data Jurusan</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        
   </head>
   <body>
      <div class="container" style="margin-left:500px;margin-top:150px;">
         <br>
         <div class="title" style="margin-left:60px;">
            <h2>Ubah Data Jurusan</h2>
        </div>
         
         <form method="POST">
            <div class="form-group col-md-4" >
               <strong>Kode Jurusan</strong>
               <input type="text" class="form-control" value="<?php  echo  $jurusan->kode_jurusan;?>"  name="kode_jurusan" readonly><br>

               <strong>Nama Jurusan</strong>
               <input type="text" class="form-control" value="<?php  echo  $jurusan->nama_jurusan;?>" name="nama_jurusan" required="" placeholder=""><br>
               <a href="v_admin_tampil_jrs.php" class="btn btn-primary">Kembali</a>
               <button type="submit" name="submit" class="btn btn-success">Ubah</button>
            </div>
         </form>
      </div>
   </body>
</html>
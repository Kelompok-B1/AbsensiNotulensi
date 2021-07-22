<?php 
  require '../../model/connect.php';  
error_reporting(0);
  if (isset($_GET['id'])) {
    $matakuliah = $collection->matakuliah->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
   }
 
   if(isset($_POST['submit'])){
    $has_errors =false; 
try{$collection->matakuliah->updateOne(
       ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
       ['$set' =>['kode_mk' => $_POST['kode_mk'],'nama_mk' => $_POST['nama_mk'],
       
       
       ]]       
 
   );}
   catch(exception $e){

      $has_errors =true; 
   }
   if ($has_errors==false){
    
      echo"
      <script>
        window.alert('Data Mata Kuliah  Berhasil Diupdate ! Anda Akan Diarahkan Ke Halaman Data Mata Kuliah');
        window.location.href='v_admin_tampil_mkl.php';
        </script>";

       
     
      
      
     }else if($has_errors!==false){
      echo"
      <script>
        window.alert('Data Mata Kuliah Tidak Berhasil Diupdate ! Mohon Cek Kembali Pengisian Form Pastikan Tidak Ada Data Duplikat');
        window.location.href='v_admin_edit_mkl.php';
        </script>";

         }
}
?>


<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Ubah Data Mata Kuliah</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        
   </head>
   <body>
      <div class="container" style="margin-left:500px;margin-top:150px;">
         <br>
         <div class="header" style="margin-left:100px;">
            <h2>Ubah Data Mata Kuliah</h2>
         </div>
        
      
         <form method="POST">
            <div class="form-group col-md-5">
               <strong>Kode Mata Kuliah:</strong>
               <input type="text" class="form-control" value="<?php  echo  $matakuliah->kode_mk;?>"  name="kode_mk" readonly><br>

               <strong>Nama Mata Kuliah:</strong>
               <input type="text" class="form-control" value="<?php  echo  $matakuliah->nama_mk;?>" name="nama_mk" required="" placeholder=""><br>
               <a href="v_admin_tampil_mkl.php" class="btn btn-primary">Kembali</a>
                <button type="submit" name="submit" class="btn btn-success">Ubah</button>
            </div>
         </form>
      </div>
       <!-- Custom JavaScript -->
       
   </body>
</html>
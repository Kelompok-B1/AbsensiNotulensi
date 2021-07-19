<?php 
  require '../../model/connect.php';  
  require '../../vendor/autoload.php';
  if (isset($_GET['id'])) {
    $prodi = $collection->prodi->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
   }
 
   if(isset($_POST['submit'])){
    $has_errors =false;  
try { $collection->prodi->updateOne(
       ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
       ['$set' =>['kode_prodi' => $_POST['kode_prodi'],'nama_prodi' => $_POST['nama_prodi'],'kode_jurusan' => $_POST['kode_jurusan']]]       
    
   );}
   catch(exception $e){

      $has_errors =true; 
   }
   if ($has_errors==false){
    
      echo"
      <script>
        window.alert('Data Prodi Berhasil Diupdate ! Anda Akan Diarahkan Ke Halaman Data Prodi');
        window.location.href='v_admin_tampil_prd.php';
        </script>";

      
     }else if($has_errors!==false){
      echo"
      <script>
        window.alert('Data Prodi  Tidak Berhasil Diupdate ! Mohon Cek Kembali Pengisian Form Pastikan Tidak Ada Data Duplikat');
        window.location.href='v_admin_edit_prd.php';
        </script>";

         }
}
?>


<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Ubah Data Prodi</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        
   </head>
   <body>
      <div class="container" style="margin-left:500px;margin-top:150px;">
         <br>
         <div class="header" style="margin-left:120px;">
         <h2>Ubah Data Prodi</h2>
         </div>
     
       
         <form method="POST">
            <div class="form-group col-md-5" >
               <strong>Kode Prodi:</strong>
               <input type="text" class="form-control" value="<?php  echo  $prodi->kode_prodi;?>"  name="kode_prodi" readonly><br>

               <strong>Nama Prodi:</strong>
               <input type="text" class="form-control" value="<?php  echo  $prodi->nama_prodi;?>" name="nama_prodi" required="" placeholder=""><br>

               <strong>Kode Jurusan:</strong>
               <select name="kode_jurusan" class ="form-control" required>
                    <option value="" disabled selected><?php  echo  $prodi->kode_jurusan;?></option>
                    <?php
                    $jurusan = $collection ->jurusan->find([]);
                    foreach($jurusan as $jrs){
                        echo "<option value='$jrs->kode_jurusan'>$jrs->kode_jurusan - $jrs->nama_jurusan</option>";

                    }
                    ?>
              </select>
              <br>
               <a href="v_admin_tampil_jrs.php" class="btn btn-primary">Kembali</a>
               <button type="submit" name="submit" class="btn btn-success">Ubah</button>
            </div>
         </form>
      </div>
   </body>
</html>
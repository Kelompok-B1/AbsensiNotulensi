<?php 
  require '../../model/connect.php';  

  if (isset($_GET['id'])) {
    $kelas = $collection->kelas->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
   }
 
   if(isset($_POST['submit'])){
    $has_errors =false;   

try{$collection->kelas->updateOne(
       ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
       ['$set' =>['kode_kelas' => $_POST['kode_kelas'],'nama_kelas' => $_POST['nama_kelas'],'kode_prodi' => $_POST['kode_prodi']]]       
   

   );}
   catch(exception $e){

      $has_errors =true; 
   }
   if ($has_errors==false){
    
      echo"
      <script>
        window.alert('Data Kelas Berhasil Diupdate ! Anda Akan Diarahkan Ke Halaman Data Kelas');
        window.location.href='v_admin_tampil_kls.php';
        </script>";

       
     
      
      
     }else if($has_errors!==false){
      echo"
      <script>
        window.alert('Data Kelas Tidak Berhasil Diupdate ! Mohon Cek Kembali Pengisian Form Pastikan Tidak Ada Data Duplikat');
        window.location.href='v_admin_edit_kls.php';
        </script>";

         }
}
?>


<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Ubah Data Kelas</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        
   </head>
   <body>
      <div class="container" style="margin-left:500px;margin-top:150px;">
         <br>
        <div class="header" style="margin-left:130px;">
           <h2>Ubah Data Kelas</h2>
         </div> 
        
         
         <form method="POST">
            <div class="form-group col-md-5">
               <strong>Kode Kelas:</strong>
               <input type="text" class="form-control" value="<?php  echo  $kelas->kode_kelas;?>"  name="kode_kelas" readonly><br>

               <strong>Nama Kelasi:</strong>
               <input type="text" class="form-control" value="<?php  echo  $kelas->nama_kelas;?>" name="nama_kelas" required="" placeholder=""><br>

               <strong>Kode Prodi:</strong>
               <select name="kode_prodi" class ="form-control" required>
                    <option value="" disabled selected><?php  echo  $kelas->kode_prodi;?></option>
                    <?php
                    $prodi = $collection ->prodi->find([]);
                    foreach($prodi as $prd){
                        echo "<option value='$prd->kode_prodi'>$prd->kode_prodi - $prd->nama_prodi</option>";

                    }
                    ?>
              </select><br>
              <a href="v_admin_tampil_kls.php" class="btn btn-primary">Kembali</a>
               <button type="submit" name="submit" class="btn btn-success">Ubah</button>
            </div>
         </form>
      </div>
   </body>
</html>
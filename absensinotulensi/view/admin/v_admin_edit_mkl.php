<?php 
  require '../../model/connect.php';  
error_reporting(0);
  if (isset($_GET['id'])) {
    $matakuliah = $collection->matakuliah->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
   }
 
   if(isset($_POST['submit'])){
      $nip = array();
      for ($i = 0; $i < $_POST['nip']; $i++){
        if($_POST['nip'][$i]){ 
            array_push($nip,$_POST['nip'][$i]);
        }else{
         break;
         }
       }
    $collection->matakuliah->updateOne(
       ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
       ['$set' =>['kode_mk' => $_POST['kode_mk'],'nama_mk' => $_POST['nama_mk'],
       
       'nip' => $nip
       ]]       
       
       /*['nim' => $_POST['nim'],
       'nama_mhs' => $_POST['nama'],
       'jk' => $_POST['jk'],
       'kode_kelas' => $_POST['kode_kelas'],
       'no_telp' => $_POST['no_telp'],
       'alamat' => (object)array('kampung' => $_POST['kampung'],'no_rumah' => $_POST['no_rumah'],
                   'rt' => $_POST['rt'],'rw' => $_POST['rw'],'desa' => $_POST['desa'],
                   'kode_pos' => $_POST['kode_pos'],'kecamatan' => $_POST['kecamatan'],
                   'kabupaten_kota' => $_POST['kabupaten_kota'],'provinsi' => $_POST['provinsi'],),
       'email' => $_POST['email']]*/


   );
 
   header("Location: v_admin_tampil_mkl.php");
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
      <div class="container">
         <br>
         <CENTER><h1>Ubah Data Mata Kuliah</h1></CENTER>
         <a href="v_admin_tampil_mkl.php" class="btn btn-primary">Kembali</a>
         <form method="POST">
            <div class="form-group">
               <strong>Kode Mata Kuliah:</strong>
               <input type="text" class="form-control" value="<?php  echo  $matakuliah->kode_mk;?>"  name="kode_mk" readonly><br>

               <strong>Nama Mata Kuliah:</strong>
               <input type="text" class="form-control" value="<?php  echo  $matakuliah->nama_mk;?>" name="nama_mk" required="" placeholder=""><br>
              
                <button type="submit" name="submit" class="btn btn-success">Ubah</button>
            </div>
         </form>
      </div>
       <!-- Custom JavaScript -->
       
   </body>
</html>
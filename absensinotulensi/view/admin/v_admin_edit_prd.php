<?php 
  require '../../model/connect.php';  
  require '../../vendor/autoload.php';
  if (isset($_GET['id'])) {
    $prodi = $collection->prodi->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
   }
 
   if(isset($_POST['submit'])){
      
    $collection->prodi->updateOne(
       ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
       ['$set' =>['kode_prodi' => $_POST['kode_prodi'],'nama_prodi' => $_POST['nama_prodi'],'kode_jurusan' => $_POST['kode_jurusan']]]       
       
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
 
   header("Location: v_admin_tampil_prd.php");
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
      <div class="container">
         <br>
         <CENTER><h1>Ubah Data Prodi</h1></CENTER>
         <a href="v_admin_tampil_jrs.php" class="btn btn-primary">Kembali</a>
         <form method="POST">
            <div class="form-group">
               <strong>Kode Prodi:</strong>
               <input type="text" class="form-control" value="<?php  echo  $prodi->kode_prodi;?>"  name="kode_prodi" readonly><br>

               <strong>Nama Prodi:</strong>
               <input type="text" class="form-control" value="<?php  echo  $prodi->nama_prodi;?>" name="nama_prodi" required="" placeholder=""><br>

               <strong>Kode Jurusan:</strong>
               <input type="text" class="form-control" value="<?php  echo  $prodi->kode_jurusan;?>" name="kode_jurusan" required="" placeholder=""><br>

               <button type="submit" name="submit" class="btn btn-success">Ubah</button>
            </div>
         </form>
      </div>
   </body>
</html>
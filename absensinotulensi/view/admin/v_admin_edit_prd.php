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
      <title></title>
    
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
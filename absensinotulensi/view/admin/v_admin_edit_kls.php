<?php 
  require '../../model/connect.php';  

  if (isset($_GET['id'])) {
    $kelas = $collection->kelas->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
   }
 
   if(isset($_POST['submit'])){
      
    $collection->kelas->updateOne(
       ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
       ['$set' =>['kode_kelas' => $_POST['kode_kelas'],'nama_kelas' => $_POST['nama_kelas'],'kode_prodi' => $_POST['kode_prodi']]]       
       
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
 
   header("Location: v_admin_tampil_kls.php");
}
?>


<html>
   <head>
      <title></title>
    
   </head>
   <body>
      <div class="container">
         <br>
         <CENTER><h1>Ubah Data Kelas</h1></CENTER>
         <a href="v_admin_tampil_kls.php" class="btn btn-primary">Kembali</a>
         <form method="POST">
            <div class="form-group">
               <strong>Kode Kelas:</strong>
               <input type="text" class="form-control" value="<?php  echo  $kelas->kode_kelas;?>"  name="kode_kelas" required="" placeholder=""><br>

               <strong>Nama Kelasi:</strong>
               <input type="text" class="form-control" value="<?php  echo  $kelas->nama_kelas;?>" name="nama_kelas" required="" placeholder=""><br>

               <strong>Kode Prodi:</strong>
               <input type="text" class="form-control" value="<?php  echo  $kelas->kode_prodi;?>" name="kode_prodi" required="" placeholder=""><br>

               <button type="submit" name="submit" class="btn btn-success">Ubah</button>
            </div>
         </form>
      </div>
   </body>
</html>
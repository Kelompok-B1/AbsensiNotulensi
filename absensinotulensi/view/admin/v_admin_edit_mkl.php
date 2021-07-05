<?php 
  require '../../model/connect.php';  

  if (isset($_GET['id'])) {
    $matakuliah = $collection->matakuliah->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
   }
 
   if(isset($_POST['submit'])){
      
    $collection->matakuliah->updateOne(
       ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
       ['$set' =>['kode_mk' => $_POST['kode_mk'],'nama_mk' => $_POST['nama_mk'],
       
       'nip' => array( $_POST['nip1'],$_POST['nip2'])
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
      <title></title>
    
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

               <strong>NIP 1 :</strong>
               <input type="text" class="form-control" name="nip1" value= "<?php  echo  $matakuliah->nip[0];?>"><br>
               
               <strong>NIP 2 :</strong>
               <input type="text" class="form-control" name="nip2"  value= "<?php  echo  $matakuliah->nip[1];?>"><br>
               <button type="submit" name="submit" class="btn btn-success">Ubah</button>
            </div>
         </form>
      </div>
   </body>
</html>
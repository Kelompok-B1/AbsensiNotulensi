<?php 
  require '../../model/connect.php';  

  if (isset($_GET['id'])) {
    $mahasiswa = $collection->mahasiswa->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
   }
 
   if(isset($_POST['submit'])){
      
    $collection->mahasiswa->updateOne(
       ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
       ['$set' =>['nim' => $_POST['nim'],'nama_mhs' => $_POST['nama'],'jk' => $_POST['jk'],
       'kode_kelas' => $_POST['kode_kelas'],'no_telp' => $_POST['no_telp'],
       
       'alamat' => (object)array('kampung' => $_POST['kampung'],'no_rumah' => $_POST['no_rumah'],
       'rt' => $_POST['rt'],'rw' => $_POST['rw'],'desa' => $_POST['desa'],
       'kode_pos' => $_POST['kode_pos'],'kecamatan' => $_POST['kecamatan'],
       'kabupaten_kota' => $_POST['kabupaten_kota'],'provinsi' => $_POST['provinsi'],),

       'email' => $_POST['email'],]]
       
       
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
 
   header("Location: v_admin_tampil_mhs.php");
}
?>


<html>
   <head>
      <title></title>
    
   </head>
   <body>
      <div class="container">
         <br>
         <CENTER><h1>Tambah Data Mahasiswa</h1></CENTER>
         <a href="v_admin_tampil_mhs.php" class="btn btn-primary">Kembali</a>
         <form method="POST">
            <div class="form-group">
               <strong>NIM:</strong>
               <input type="text" class="form-control" value="<?php  echo  $mahasiswa->nim;?>"  name="nim" required="" placeholder=""><br>

               <strong>Nama Mahasiswa:</strong>
               <input type="text" class="form-control" value="<?php  echo  $mahasiswa->nama_mhs;?>" name="nama" required="" placeholder=""><br>

               <strong>JK:</strong>
               <input type="text" class="form-control" value="<?php  echo  $mahasiswa->jk;?>" name="jk" required="" placeholder=""><br>

               <strong>Kode Kelas:</strong>
               <input type="text" class="form-control" value="<?php  echo  $mahasiswa->kode_kelas;?>" name="kode_kelas" required="" placeholder=""><br>

               <strong>No Telp:</strong>
               <input type="text" class="form-control" value="<?php  echo  $mahasiswa->no_telp;?>" name="no_telp"  placeholder=""><br>

               <strong>Kampung:</strong>
               <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->kampung;?>" name="kampung"  placeholder=""><br>
               
               <strong>No Rumah:</strong>
               <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->no_rumah;?>" name="no_rumah" required="" placeholder=""><br>

               <strong>RT:</strong>
               <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->rt;?>" name="rt" required="" placeholder=""><br>

               <strong>RW:</strong>
               <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->rw;?>" name="rw" required="" placeholder=""><br>

               <strong>Desa:</strong>
               <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->desa;?>" name="desa" required="" placeholder=""><br>
               
               <strong>Kode Pos:</strong>
               <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->kode_pos;?>" name="kode_pos" required="" placeholder=""><br>

               <strong>Kecamatan:</strong>
               <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->kecamatan;?>" name="kecamatan" required="" placeholder=""><br>

               <strong>Kabupaten/Kota:</strong>
               <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->kabupaten_kota;?>" name="kabupaten_kota" required="" placeholder="xxxxxxxxx"><br>

               <strong>Provinsi:</strong>
               <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->provinsi;?>" name="provinsi" required="" placeholder="xxxxxxxxx"><br>  

               <strong>Email:</strong>
               <input type="text" class="form-control" value="<?php  echo  $mahasiswa->email;?>" name="email" required="" placeholder="xxxxxxxxx"><br>
               <button type="submit" name="submit" class="btn btn-success">Ubah</button>
            </div>
         </form>
      </div>
   </body>
</html>
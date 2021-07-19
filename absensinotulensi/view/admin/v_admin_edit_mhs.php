<?php 
  require '../../model/connect.php';  

  if (isset($_GET['id'])) {
    $mahasiswa = $collection->mahasiswa->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
   }
 
   if(isset($_POST['submit'])){
    $has_errors =false; 
   try{ $collection->mahasiswa->updateOne(
       ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
       ['$set' =>['nim' => $_POST['nim'],'nama_mhs' => $_POST['nama_mhs'],'jk' => $_POST['jk'],
       'kode_kelas' => $_POST['kode_kelas'],'no_telp' => $_POST['no_telp'],
       
       'alamat' => (object)array('kampung' => $_POST['kampung'],'no_rumah' => $_POST['no_rumah'],
       'rt' => $_POST['rt'],'rw' => $_POST['rw'],'desa' => $_POST['desa'],
       'kode_pos' => $_POST['kode_pos'],'kecamatan' => $_POST['kecamatan'],
       'kabupaten_kota' => $_POST['kabupaten_kota'],'provinsi' => $_POST['provinsi'],),
       'akun' => (object)array('username' => $_POST['nim'],'password' => $_POST['password']),
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


   );}
   catch(exception $e){

      $has_errors =true; 
   }
   if ($has_errors==false){
    
      echo"
      <script>
        window.alert('Data Mahasiswa Berhasil Diupdate ! Anda Akan Diarahkan Ke Halaman Data Mahasiswa');
        window.location.href='v_admin_tampil_mhs.php';
        </script>";

       
     
      
      
     }else if($has_errors!==false){
      echo"
      <script>
        window.alert('Data Mahasiswa  Tidak Berhasil Diupdate ! Mohon Cek Kembali Pengisian Form Pastikan Tidak Ada Data Duplikat');
        window.location.href='v_admin_edit_mhs.php';
        </script>";

         }

   
}
?>


<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Ubah  Data Mahasiswa</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        
   </head>
   <body>
      <div class="container">
         <br>
         <CENTER><h1>Ubah Data Mahasiswa</h1></CENTER>
         
         <form method="POST">

               <div class="form-group">
                  <strong>NIM</strong>
                  <input type="text" class="form-control" value="<?php  echo  $mahasiswa->nim;?>"  name="nim" readonly><br>
               </div>

               <div class="form-group">
                  <strong>Nama Mahasiswa</strong>
                  <input type="text" class="form-control" value="<?php  echo  $mahasiswa->nama_mhs;?>" name="nama_mhs" required="" placeholder="Nama Mahasiswa"><br>
               </div>

               <div class="form-group"> 
                  <strong>Password</strong>
                  <input type="text" class="form-control" value="<?php  echo  $mahasiswa->akun->password;?>" name="password" required="" placeholder=""><br>
               </div>

               <strong>Jenis Kelamin</strong>
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="jk" id="exampleRadios1" value="L"<?php if($mahasiswa->jk=='L'){ echo 'checked';}?> >
                        <label class="form-check-label" for="exampleRadios1">
                        Laki - Laki
                        </label>
               </div>

               <div class="form-check">
                  <input class="form-check-input" type="radio" name="jk" id="exampleRadios2" value="P" <?php if($mahasiswa->jk=='P'){ echo 'checked';}?> >
                     <label class="form-check-label" for="exampleRadios2">
                     Perempuan
                     </label>
               </div>

               <div class="form-group">
                  <strong>No Telepon</strong>
                  <input type="text" class="form-control" value="<?php  echo  $mahasiswa->no_telp;?>" name="no_telp"  placeholder="No Telepon"><br>
               </div>

               <strong>Alamat</strong>

         <div class="form-row">
              <div class="form-group col-md-4">
                <strong>Kampung:</strong>
                <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->kampung;?>" name="kampung"  placeholder=""><br>
              </div>

              <div class="form-group col-md-3">
                <strong>No Rumah:</strong>
                <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->no_rumah;?>" name="no_rumah" required="" placeholder=""><br>
              </div>

              <div class="form-group col-md-1">
                <strong>RT:</strong>
                <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->rt;?>" name="rt" required="" placeholder=""><br>
              </div>

              <div class="form-group col-md-1">
                <strong>RW:</strong>
                <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->rw;?>" name="rw" required="" placeholder=""><br>
            </div>

              <div class="form-group col-md-3">
                <strong>Desa:</strong>
                <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->desa;?>" name="desa" required="" placeholder=""><br>
              </div>

              <div class="form-group col-md-3"> 
                  <strong>Kode Pos:</strong>
                  <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->kode_pos;?>" name="kode_pos" required="" placeholder=""><br>
              </div>

              <div class="form-group col-md-3">
                <strong>Kecamatan:</strong>
                <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->kecamatan;?>" name="kecamatan" required="" placeholder=""><br>
              </div>    

              <div class="form-group col-md-3">
                <strong>Kabupaten/Kota:</strong>
                <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->kabupaten_kota;?>" name="kabupaten_kota" required="" placeholder="xxxxxxxxx"><br>
              </div>

              <div class="form-group col-md-3"> 
                  <strong>Provinsi:</strong>
                  <input type="text" class="form-control" value="<?php  echo  $mahasiswa->alamat->provinsi;?>" name="provinsi" required="" placeholder="xxxxxxxxx"><br>  
              </div> 
        </div>

        <strong>Kelas</strong>
                        <select name="kode_kelas" class="form-control" required>
                                    <option value="<?php  echo  $mahasiswa->kode_kelas;?>" disabled selected><?php  echo  $mahasiswa->kode_kelas;?> </option>
                                    <?php
                                          $kelas= $collection->kelas->aggregate([
                                        
                                        
                                            ['$lookup'=>(object)array(
                                                'from'=> "prodi",
                                                'localField'=> "kode_prodi",    
                                                'foreignField'=> "kode_prodi",  
                                                'as'=> "ProdiMahasiswa"
                                            )],
                                        
                                            ['$replaceRoot'=>(object)array('newRoot'=>(object)array('$mergeObjects'=>array((object)
                                            array('$arrayElemAt'=>array('$ProdiMahasiswa',0)),'$$ROOT')))],
                                            
                                           
                                            ['$project'=>(object)array('{ProdiMahasiswa}'=>0)],
                                        
 
                                            ]);

                                          foreach($kelas as $kls){
                                              echo "<option value='$kls->kode_kelas'>$kls->kode_kelas - $kls->nama_kelas - $kls->nama_prodi</option>";
                                          }
                                    ?>
                                </select>
                        
 
                 
               <strong>Email:</strong>
               <input type="text" class="form-control" value="<?php  echo  $mahasiswa->email;?>" name="email" required="" placeholder="xxxxxxxxx"><br>
              
               <a href="v_admin_tampil_mhs.php" class="btn btn-primary">Kembali</a>
               <button type="submit" name="submit" class="btn btn-success">Ubah</button>
          
         </form>
      </div>
   </body>
</html>
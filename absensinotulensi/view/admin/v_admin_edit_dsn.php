<?php 
  require '../../model/connect.php';  
error_reporting(0);
  if (isset($_GET['id'])) {
    $dosen = $collection->pegawai->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
   }
 
   if(isset($_POST['submit'])){
      $kdk = array();
      for ($i = 0; $i < $_POST['kode_kelas']; $i++){
        if($_POST['kode_kelas'][$i]){ 
            array_push($kdk,$_POST['kode_kelas'][$i]);
        }else{
         break;
         }
       }

       $kmk = array();
       for ($i = 0; $i < $_POST['kode_mk']; $i++){
         if($_POST['kode_mk'][$i]){ 
             array_push($kmk,$_POST['kode_mk'][$i]);
         }else{
          break;
          }
        }
    
    $has_errors =false;

try{$collection->pegawai->updateOne(
       ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
       ['$set' =>['nip' => $_POST['nip'],'nama_pgw' => $_POST['nama_pgw'],'jk' => $_POST['jk'],
       'no_telp' => $_POST['no_telp'],
       
       'alamat' => (object)array('kampung' => $_POST['kampung'],'no_rumah' => $_POST['no_rumah'],
       'rt' => $_POST['rt'],'rw' => $_POST['rw'],'desa' => $_POST['desa'],
       'kode_pos' => $_POST['kode_pos'],'kecamatan' => $_POST['kecamatan'],
       'kabupaten_kota' => $_POST['kabupaten_kota'],'provinsi' => $_POST['provinsi'],),

       kode_kelas => $kdk,
       kode_mk => $kmk,
       'akun' => (object)array('username' => $_POST['nip'],'password' => $_POST['password']),
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
      window.alert('Data Dosen Berhasil Diupdate ! Anda Akan Diarahkan Ke Halaman Data Dosen');
      window.location.href='v_admin_tampil_pgw.php';
      </script>";

     
   
    
    
   }else if($has_errors!==false){
    echo"
    <script>
      window.alert('Data Dosen Tidak Berhasil Diupdate ! Mohon Cek Kembali Pengisian Form Pastikan Tidak Ada Data Duplikat');
      window.location.href='v_admin_edit_dsn.php';
      </script>";

       }
}
?>


<html>
   <head>
   <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Ubah Data Dosen</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
       
   </head>
   <body>
      <div class="container">
         <br>
         <h2>Ubah Data Dosen</h2>
         
         <form method="POST">
            <div class="form-group">
               <strong>NIP </strong>
               <input type="text" class="form-control" value="<?php  echo  $dosen->nip;?>"  name="nip" readonly><br>
            </div>

          <strong>Akun</strong>
           <div class="form-row"> 
              <div class="form-group col-md-6">
                <strong>Nama Dosen</strong>
                <input type="text" class="form-control" value="<?php  echo  $dosen->nama_pgw;?>" name="nama_pgw" required="" placeholder=""><br>
              </div>
                
              <div class="form-group col-md-6">
                <strong>Password</strong>
                <input type="text" class="form-control" value="<?php  echo  $dosen->akun->password;?>" name="password" required="" placeholder=""><br>
              </div>
          </div>
          
          <strong>Jenis Kelamin</strong>
          <div class="form-check">
              <input class="form-check-input" type="radio" name="jk" id="exampleRadios1" value="L"<?php if($dosen->jk=='L'){ echo 'checked';}?> >
                  <label class="form-check-label" for="exampleRadios1">
                  Laki - Laki
                  </label>
         </div>

         <div class="form-check">
              <input class="form-check-input" type="radio" name="jk" id="exampleRadios2" value="P" <?php if($dosen->jk=='P'){ echo 'checked';}?> >
                <label class="form-check-label" for="exampleRadios2">
                Perempuan
               </label>
         </div>

          <div class="form-group">
            <strong>No Telp:</strong>
            <input type="text" class="form-control" value="<?php  echo  $dosen->no_telp;?>" name="no_telp"  placeholder=""><br>
         </div>

         <strong>Alamat</strong>

         <div class="form-row">
              <div class="form-group col-md-4">
                <strong>Kampung:</strong>
                <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->kampung;?>" name="kampung"  placeholder=""><br>
              </div>

              <div class="form-group col-md-3">
                <strong>No Rumah:</strong>
                <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->no_rumah;?>" name="no_rumah" required="" placeholder=""><br>
              </div>

              <div class="form-group col-md-1">
                <strong>RT:</strong>
                <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->rt;?>" name="rt" required="" placeholder=""><br>
              </div>

              <div class="form-group col-md-1">
                <strong>RW:</strong>
                <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->rw;?>" name="rw" required="" placeholder=""><br>
            </div>

              <div class="form-group col-md-3">
                <strong>Desa:</strong>
                <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->desa;?>" name="desa" required="" placeholder=""><br>
              </div>

              <div class="form-group col-md-3"> 
                  <strong>Kode Pos:</strong>
                  <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->kode_pos;?>" name="kode_pos" required="" placeholder=""><br>
              </div>

              <div class="form-group col-md-3">
                <strong>Kecamatan:</strong>
                <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->kecamatan;?>" name="kecamatan" required="" placeholder=""><br>
              </div>    

              <div class="form-group col-md-3">
                <strong>Kabupaten/Kota:</strong>
                <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->kabupaten_kota;?>" name="kabupaten_kota" required="" placeholder="xxxxxxxxx"><br>
              </div>

              <div class="form-group col-md-3"> 
                  <strong>Provinsi:</strong>
                  <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->provinsi;?>" name="provinsi" required="" placeholder="xxxxxxxxx"><br>  
              </div> 
        </div>
          <div class="form-group">
            <strong>Email:</strong>
            <input type="text" class="form-control" value="<?php  echo  $dosen->email;?>" name="email" required="" placeholder="xxxxxxxxx"><br>
          </div>

               
          
          <strong>Kelas</strong>

          <table id="form-body">
                                    <tr id="add_select"> 
                                    
                                        <td>
                                            <select name="kode_kelas[]" class="form-control" required>
                                                <option value="<?php  echo  $dosen->kode_kelas[0];?>"  selected> <?php  echo  $dosen->kode_kelas[0];?></option>
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
                                        </td>
                                       
                                    
                                    </tr>

                                    <?php
                                    for ($i = 1; $i < 10; $i++) {
                                      if ($dosen->kode_kelas[$i]==null) {
                                      break;
                                      }
                                    
                                    echo "
                                    <tr> 
                                    
                                    <td>
                                        <select name='kode_kelas[]' class='form-control' required>
                                            <option value='".$dosen->kode_kelas[$i]."'  selected>  ".$dosen->kode_kelas[$i]."</option>
                                           
                                      ";
                                      ?>
                                      <?php
                                      $kelas= $collection->kelas->aggregate([
                                    
                                    
                                        ['$lookup'=>(object)array(
                                            'from'=> 'prodi',
                                            'localField'=> 'kode_prodi',    
                                            'foreignField'=> 'kode_prodi',  
                                            'as'=> 'ProdiMahasiswa'
                                        )],
                                    
                                        ['$replaceRoot'=>(object)array('newRoot'=>(object)array('$mergeObjects'=>array((object)
                                        array('$arrayElemAt'=>array('$ProdiMahasiswa',0)),'$$ROOT')))],
                                        
                                       
                                        ['$project'=>(object)array('{ProdiMahasiswa}'=>0)],
                                    

                                        ]);
                                      
                                      ?>
                                      <?php
                                      foreach($kelas as $kls){
                                          echo "<option value='$kls->kode_kelas'>$kls->kode_kelas - $kls->nama_kelas - $kls->nama_prodi</option>";
                                      }
                                      ?>
                                        </select>
                                    </td>
                                    <td>
                                       <button type='button' class='btn btn-danger' onclick='del_form(this)'>Hapus</button>
                                   </td>
                                </tr>
                                    
                                 <?php   

                                    }
                                    ?>
                            </table>               
                


          <div class="form-group">
               <strong> Mata Kuliah</strong>
                <table id="form-body2">
                                    <tr id="add_select2"> 
                                    
                                        <td>
                                            <select name="kode_mk[]" class="form-control" required>
                                                <option value="<?php  echo  $dosen->kode_mk[0];?>"  selected> <?php  echo  $dosen->kode_mk[0];?></option>
                                                <?php
                                          $matakuliah= $collection->matakuliah->find();

                                          foreach($matakuliah as $mkl){
                                              echo "<option value='$mkl->kode_mk'>$mkl->kode_mk - $mkl->nama_mk </option>";
                                          }
                                    ?>
                                            </select>
                                        </td>
                                       
                                    
                                    </tr>

                                    <?php
                                    for ($i = 1; $i < 10; $i++) {
                                      if ($dosen->kode_mk[$i]==null) {
                                      break;
                                      }
                                    
                                    echo "
                                    <tr> 
                                    
                                    <td>
                                        <select name='kode_ml[]' class='form-control' required>
                                            <option value='".$dosen->kode_mk[$i]."'  selected>  ".$dosen->kode_mk[$i]."</option>
                                           
                                      ";
                                      ?>
                                      <?php
                                      $matakuliah= $collection->matakuliah->find();
                                      
                                      ?>
                                      <?php
                                      foreach($matakuliah as $mkl){
                                        echo "<option value='$mkl->kode_mk'>$mkl->kode_mk - $mkl->nama_mk </option>";
                                    }
                                      ?>
                                        </select>
                                    </td>
                                    <td>
                                       <button type='button' class='btn btn-danger' onclick='del_form(this)'>Hapus</button>
                                   </td>
                                </tr>
                                    
                                 <?php   

                                    }
                                    ?>
                            </table>   
            </div>
            
            <div class="form-group">
                <div class="btn-group" style="margin-right:680px;">
                  <button style="margin-right:20px;" type="button" onclick="add_form()"  class="btn btn-primary">Tambah Kelas</button>
                  <button type="button" onclick="add_form2()"   class="btn btn-info">Tambah Mata Kuliah</button>
               </div>                     
              <a align href="v_admin_tampil_pgw.php" class="btn btn-primary" style="margin-right:20px;">Kembali</a>
              <button type="submit" name="submit" class="btn btn-success">Ubah</button>
            </div>    
               
         </form>
      </div>

     
      <script type="text/javascript">
        function add_form()
        {
            var html = '';
 
            html += '<tr>';
           // html += '<td><input type="text" class="form-control" name="kode_kelas[]" placeholder="Kode Kelas"></td>';
           html += document.getElementById("add_select").innerHTML  
            html += '<td><button type="button" class="btn btn-danger" onclick="del_form(this)">Hapus</button></td>';
            html += '</tr>';
 
            $('#form-body').append(html);
        }
 
        function del_form(id)
        {
            id.closest('tr').remove();
        }

        function add_form2()
        {
            var html = '';
 
            html += '<tr>';
            //html += '<td><input type="text" class="form-control" name="kode_mk[]" placeholder="Kode Mata Kuliah"></td>';
            html += document.getElementById("add_select2").innerHTML  
            html += '<td><button type="button" class="btn btn-danger" onclick="del_form2(this)">Hapus</button></td>';
            html += '</tr>';
 
            $('#form-body2').append(html);
        }
 
        function del_form2(id)
        {
            id.closest('tr').remove();
        }
    </script>
   </body>
</html>
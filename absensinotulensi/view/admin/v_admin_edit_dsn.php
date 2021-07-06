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
    $collection->pegawai->updateOne(
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


   );
 
   header("Location: v_admin_tampil_pgw.php");
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
         <CENTER><h1>Ubah Data Dosen</h1></CENTER>
         <a href="v_admin_tampil_pgw.php" class="btn btn-primary">Kembali</a>
         <form method="POST">
            <div class="form-group">
               <strong>NIP :</strong>
               <input type="text" class="form-control" value="<?php  echo  $dosen->nip;?>"  name="nip" readonly><br>

               <strong>Nama Dosen:</strong>
               <input type="text" class="form-control" value="<?php  echo  $dosen->nama_pgw;?>" name="nama_pgw" required="" placeholder=""><br>

               <strong>Password:</strong>
               <input type="text" class="form-control" value="<?php  echo  $dosen->akun->password;?>" name="password" required="" placeholder=""><br>

               <strong>JK:</strong>
               <input type="text" class="form-control" value="<?php  echo  $dosen->jk;?>" name="jk" required="" placeholder=""><br>

               <strong>No Telp:</strong>
               <input type="text" class="form-control" value="<?php  echo  $dosen->no_telp;?>" name="no_telp"  placeholder=""><br>

               <strong>Kampung:</strong>
               <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->kampung;?>" name="kampung"  placeholder=""><br>
               
               <strong>No Rumah:</strong>
               <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->no_rumah;?>" name="no_rumah" required="" placeholder=""><br>

               <strong>RT:</strong>
               <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->rt;?>" name="rt" required="" placeholder=""><br>

               <strong>RW:</strong>
               <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->rw;?>" name="rw" required="" placeholder=""><br>

               <strong>Desa:</strong>
               <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->desa;?>" name="desa" required="" placeholder=""><br>
               
               <strong>Kode Pos:</strong>
               <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->kode_pos;?>" name="kode_pos" required="" placeholder=""><br>

               <strong>Kecamatan:</strong>
               <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->kecamatan;?>" name="kecamatan" required="" placeholder=""><br>

               <strong>Kabupaten/Kota:</strong>
               <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->kabupaten_kota;?>" name="kabupaten_kota" required="" placeholder="xxxxxxxxx"><br>

               <strong>Provinsi:</strong>
               <input type="text" class="form-control" value="<?php  echo  $dosen->alamat->provinsi;?>" name="provinsi" required="" placeholder="xxxxxxxxx"><br>  

               <strong>Email:</strong>
               <input type="text" class="form-control" value="<?php  echo  $dosen->email;?>" name="email" required="" placeholder="xxxxxxxxx"><br>
               
               <strong>Kode Kelas:</strong>
               <table id="form-body">
                     <tr>
                            <td>
                                <input type="text" class="form-control"  value="<?php  echo  $dosen->kode_kelas[0];?>"name="kode_kelas[]" placeholder="Kode Kelas">
                            </td>
                            
                            <td>
                            <button type="button" onclick="add_form()" class="btn btn-success">Tambah Kode Kelas</button>
                            </td>
                   </tr>
               <?php 
               
               for ($i = 1; $i < 10; $i++) {
                  if ($dosen->kode_kelas[$i]==null) {
                  break;
                  }
                 

                  echo "<tr>
                  <td>
                      <input type='text' class='form-control' value=".$dosen->kode_kelas[$i]." name='kode_kelas[]' placeholder='Kode Kelas'>
                  </td>
                  
                  <td>
                  <button type='button' class='btn btn-danger' onclick='del_form(this)'>Hapus</button>
                  </td>
              </tr>";
                }
               
               ?>
                </table>  
               
               
               <strong>Kode Mata Kuliah:</strong>
               <table id="form-body2">
                     <tr>
                            <td>
                                <input type="text" class="form-control"  value="<?php  echo  $dosen->kode_mk[0];?>"name="kode_mk[]" placeholder="Kode Mata Kuliah">
                            </td>
                            
                            <td>
                            <button type="button" onclick="add_form2()" class="btn btn-success">Tambah Kode Mata Kuliah</button>
                            </td>
                   </tr>
               <?php 
               
               for ($i = 1; $i < 10; $i++) {
                  if ($dosen->kode_mk[$i]==null) {
                  break;
                  }
                

                  echo "<tr>
                  <td>
                      <input type='text' class='form-control' value=".$dosen->kode_mk[$i]." name='kode_mk[]' placeholder='Kode Mata Kuliah'>
                  </td>
                  
                  <td>
                  <button type='button' class='btn btn-danger' onclick='del_form2(this)'>Hapus</button>
                  </td>
              </tr>";
                }
               
               ?>
                </table>  
               <button type="submit" name="submit" class="btn btn-success">Ubah</button>
            </div>
         </form>
      </div>

     
      <script type="text/javascript">
        function add_form()
        {
            var html = '';
 
            html += '<tr>';
            html += '<td><input type="text" class="form-control" name="kode_kelas[]" placeholder="Kode Kelas"></td>';
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
            html += '<td><input type="text" class="form-control" name="kode_mk[]" placeholder="Kode Mata Kuliah"></td>';
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
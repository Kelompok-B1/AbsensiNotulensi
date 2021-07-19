<?php 
   require '../../model/connect.php';
   require '../../vendor/autoload.php';
   #kode otomatsi untuk pegawai
   $sequence_id_pegawai = $collection ->pegawai->find([],['limit'=>1,'sort'=>['nip'=>-1]]);

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

     
        
      $insertOneResult = $collection->pegawai->insertOne([
          'nip' => $_POST['nip'],
          'nama_pgw' => $_POST['nama_pgw'],
          'jk' => $_POST['jk'],
          'no_telp' => $_POST['no_telp'],
          'nama_pgw' => $_POST['nama_pgw'],
          'alamat' => (object)array('kampung' => $_POST['kampung'],'no_rumah' => $_POST['no_rumah'],
                        'rt' => $_POST['rt'],'rw' => $_POST['rw'],'desa' => $_POST['desa'],
                        'kode_pos' => $_POST['kode_pos'],'kecamatan' => $_POST['kecamatan'],
                         'kabupaten_kota' => $_POST['kabupaten_kota'],'provinsi' => $_POST['provinsi'],),
          'jabatan' => 'D',
          kode_kelas =>$kdk,
          kode_mk => $kmk,
          'email' => $_POST['email'],
          'akun' => (object)array('username' => $_POST['nip'],'password' => $_POST['password'])

      ]);
    
      header("Location: v_admin_tampil_pgw.php");
   }
?>


<html>
   <head>
       <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Tambah Data Dosen</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        
   </head>
   <body>
      <div class="container">
         <br>
         <CENTER><h1>Tambah Data Dosen</h1></CENTER>
         <a href="v_admin_tampil_pgw.php" class="btn btn-primary">Kembali</a>
         <form method="POST">
            <div class="form-group">
               <strong>NIP:</strong>
               <input type="text" class="form-control"
               value="<?php 
                     foreach ($sequence_id_pegawai as $sidpg){
                        $sidpgw = $sidpg->nip;
                        $urutan = (int) substr($sidpgw,3,4);
                        $urutan++;
                        $huruf ="PGW";
                        $sidpgw = $huruf . sprintf("%04s", $urutan);
                        echo $sidpgw;
                      }
               ?>"
                name="nip" readonly><br>

               <strong>Nama Dosen:</strong>
               <input type="text" class="form-control" name="nama_pgw" required="" placeholder="xxxxxxxxx"><br>
               
               <strong>Password:</strong>
               <input type="text" class="form-control" name="password" required="" placeholder="xxxxxxxxx"><br>

               <strong>JK:</strong>
               <input type="text" class="form-control" name="jk" required="" placeholder="xxxxxxxxx"><br>

               <strong>No Telp:</strong>
               <input type="text" class="form-control" name="no_telp"  placeholder="xxxxxxxxx"><br>

               <strong>Kampung:</strong>
               <input type="text" class="form-control" name="kampung"  placeholder="xxxxxxxxx"><br>
               
               <strong>No Rumah:</strong>
               <input type="text" class="form-control" name="no_rumah" required="" placeholder="xxxxxxxxx"><br>

               <strong>RT:</strong>
               <input type="text" class="form-control" name="rt" required="" placeholder="xxxxxxxxx"><br>

               <strong>RW:</strong>
               <input type="text" class="form-control" name="rw" required="" placeholder="xxxxxxxxx"><br>

               <strong>Desa:</strong>
               <input type="text" class="form-control" name="desa" required="" placeholder="xxxxxxxxx"><br>
               
               <strong>Kode Pos:</strong>
               <input type="text" class="form-control" name="kode_pos" required="" placeholder="xxxxxxxxx"><br>

               <strong>Kecamatan:</strong>
               <input type="text" class="form-control" name="kecamatan" required="" placeholder="xxxxxxxxx"><br>

               <strong>Kabupaten/Kota:</strong>
               <input type="text" class="form-control" name="kabupaten_kota" required="" placeholder="xxxxxxxxx"><br>

               <strong>Provinsi:</strong>
               <input type="text" class="form-control" name="provinsi" required="" placeholder="xxxxxxxxx"><br>  

               <strong>Email:</strong>
               <input type="text" class="form-control" name="email" required="" placeholder="xxxxxxxxx"><br>
               
               
               <strong>Kode Kelas:</strong>
               <table id="form-body">
                        <tr>
                            <td>
                                <select name="kode_kelas[]" iclass="form-control" required>
                                    <option value="" disabled selected> Pilih Kode Kelas</option>
                                    <?php
                                          $kelas = $collection ->kelas->find([]);

                                          foreach($kelas as $kls){
                                              echo "<option value='$kls->kode_kelas'>$kls->kode_kelas - $kls->nama_kelas</option>";
                                          }
                                    ?>
                                </select>
                            </td>
                            
                            <td>
                            <button type="button" onclick="add_form()" class="btn btn-success">Tambah Kode Kelas</button>
                            </td>
                        </tr>
                </table>        
               
                <strong>Kode Jurusan:</strong>
                 <select name="kode_jurusan" class ="form-control" required>
                  <option value="" disabled selected>Pilih Jurusan </option>
                   <?php
                                $jurusan = $collection ->jurusan->find([]);
                                foreach($jurusan as $jrs){
                                    echo "<option value='$jrs->kode_jurusan'>$jrs->kode_jurusan - $jrs->nama_jurusan</option>";

                                }
                                ?>
                                </select>

                <strong>Kode Mata Kuliah:</strong>
               <table id="form-body2">
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="kode_mk[]" placeholder=" Kode Mata Kuliah">
                            </td>
                            
                            <td>
                            <button type="button" onclick="add_form2()" class="btn btn-success">Tambah Kode Mata Kuliah</button>
                            </td>
                        </tr>
                </table>         
               <button type="submit" name="submit" class="btn btn-success">Tambah</button>
                      
            </div>
         </form>

         
      </div>
      <!-- Custom JavaScript -->
    <script type="text/javascript">
        function add_form()
        {
            var html = '';
 
            html += '<tr>';
            html += '<td><input type="text" class="form-control" name="kode_kelas[]" placeholder="Kode Kelas "></td>';
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
            html += '<td><input type="text" class="form-control" name="kode_mk[]" placeholder="Kode Mata Kuliah "></td>';
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
<?php 
   require '../../model/connect.php';
   require '../../vendor/autoload.php';
   #kode otomatsi untuk pegawai
   $sequence_id_pegawai = $collection ->pegawai->find([],['limit'=>1,'sort'=>['nip'=>-1]]);

   if(isset($_POST['submit'])){
      
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
          'jabatan' => 'A',
          'email' => $_POST['email'],
          'akun' => (object)array('username' => $_POST['nip'],'password' => $_POST['password'])
      ]);
    
      header("Location: v_admin_tampil_pgw.php");
   }
?>


<html>
   <head>
      <title></title>
    
   </head>
   <body>
      <div class="container">
         <br>
         <CENTER><h1>Tambah Data Admin</h1></CENTER>
         <a href="v_admin_tampil_pgw.php" class="btn btn-primary">Kembali</a>
         <form method="POST">
            <div class="form-group">
               <strong>NIP:</strong>
               <input type="text" class="form-control" name="nip"
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
                readonly><br>

               <strong>Nama Admin:</strong>
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
               

               
                
                <button type="submit" name="submit" class="btn btn-success">Tambah</button>
            </div>
         </form>
      </div>
   </body>
</html>
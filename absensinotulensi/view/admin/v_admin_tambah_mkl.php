<?php 
   require '../../model/connect.php';
   require '../../vendor/autoload.php';
   #kode otomatsi untuk matakuliah
   $sequence_id_matakuliah = $collection ->matakuliah->find([],['limit'=>1,'sort'=>['kode_mk'=>-1]]);
   if(isset($_POST['submit'])){
      
      $insertOneResult = $collection->matakuliah->insertOne([
          'kode_mk' => $_POST['kode_mk'],
          'nama_mk' => $_POST['nama_mk'],
          'nip' => array($_POST['nip1'],$_POST['nip2']),


      ]);
    
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
         <CENTER><h1>Tambah Data Mata Kuliah</h1></CENTER>
         <a href="v_admin_tampil_mkl.php" class="btn btn-primary">Kembali</a>
         <form method="POST">
            <div class="form-group">
               <strong>Kode Mata Kuliah:</strong>
               <input type="text" class="form-control"
               value="<?php 
                     foreach ($sequence_id_matakuliah as $sidmk){
                        $sidmkl = $sidmk->kode_mk;
                        $urutan = (int) substr($sidmkl,3,4);
                        $urutan++;
                        $huruf ="KMK";
                        $sidmkl = $huruf . sprintf("%04s", $urutan);
                        echo $sidmkl;
                      }
               ?>"
               
               name="kode_mk" readonly><br>

               <strong>Nama Mata Kuliah:</strong>
               <input type="text" class="form-control" name="nama_mk" required="" placeholder="xxxxxxxxx"><br>
                
               <strong>NIP 1 :</strong>
               <input type="text" class="form-control" name="nip1" value= " "><br>
               
               <strong>NIP 1 :</strong>
               <input type="text" class="form-control" name="nip2"  value= " "><br>
               
               <button type="submit" name="submit" class="btn btn-success">Tambah</button>
            </div>
         </form>
      </div>
   </body>
</html>
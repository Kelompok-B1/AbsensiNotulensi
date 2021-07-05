<?php 

   require '../../model/connect.php';
   require '../../vendor/autoload.php';
   #kode otomatis untuk prodi
   $sequence_id_prodi = $collection ->prodi->find([],['limit'=>1,'sort'=>['kode_prodi'=>-1]]);
   if(isset($_POST['submit'])){
     
      $insertOneResult = $collection->prodi->insertOne([
          'kode_prodi' => $_POST['kode_prodi'],
          'nama_prodi' => $_POST['nama_prodi'],
          'kode_jurusan' => $_POST['kode_jurusan'],


      ]);
    
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
         <CENTER><h1>Tambah Data Prodi</h1></CENTER>
         <a href="v_admin_tampil_mhs.php" class="btn btn-primary">Kembali</a>
         <form method="POST">
            <div class="form-group">
               <strong>Kode Prodi:</strong>
               <input type="text" 
               value="<?php 
                     foreach ($sequence_id_prodi as $sidp){
                        $sidprd = $sidp->kode_prodi;
                        $urutan = (int) substr($sidprd,3,4);
                        $urutan++;
                        $huruf ="KDP";
                        $sidprd = $huruf . sprintf("%04s", $urutan);
                        echo $sidprd;
                      }
               ?>"
                class="form-control" name="kode_prodi" required="" readonly><br>

               <strong>Nama Prodi:</strong>
               <input type="text" class="form-control" name="nama_prodi" required="" placeholder="xxxxxxxxx"><br>
                
               <strong>Kode Jurusan:</strong>
               <input type="text" class="form-control" name="kode_jurusan" required="" placeholder="xxxxxxxxx"><br>
               
               <button type="submit" name="submit" class="btn btn-success">Tambah</button>
            </div>
         </form>
      </div>
   </body>
</html>
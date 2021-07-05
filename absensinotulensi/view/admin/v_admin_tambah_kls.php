<?php 
     require '../../model/connect.php';  
     require '../../vendor/autoload.php';
   #kode otomatis untuk kelas
   $sequence_id_kelas = $collection ->kelas->find([],['limit'=>1,'sort'=>['kode_kelas'=>-1]]);
   if(isset($_POST['submit'])){
     
      $insertOneResult = $collection->kelas->insertOne([
          'kode_kelas' => $_POST['kode_kelas'],
          'nama_kelas' => $_POST['nama_kelas'],
          'kode_prodi' => $_POST['kode_prodi'],


      ]);
    
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
         <CENTER><h1>Tambah Data Kelas</h1></CENTER>
         <a href="v_admin_tampil_kls.php" class="btn btn-primary">Kembali</a>
         <form method="POST">
            <div class="form-group">
               <strong>Kode Kelas:</strong>
               <input type="text" class="form-control" 
               value="<?php 
                     foreach ($sequence_id_kelas as $sidk){
                        $sidkls = $sidk->kode_kelas;
                        $urutan = (int) substr($sidkls,3,4);
                        $urutan++;
                        $huruf ="KDK";
                        $sidkls = $huruf . sprintf("%04s", $urutan);
                        echo $sidkls;
                      }
               ?>"
               name="kode_kelas" readonly><br>

               <strong>Nama Kelas:</strong>
               <input type="text" class="form-control" name="nama_kelas" required="" placeholder="xxxxxxxxx"><br>
                
               <strong>Kode Prodi:</strong>
               <input type="text" class="form-control" name="kode_prodi" required="" placeholder="xxxxxxxxx"><br>
               
               <button type="submit" name="submit" class="btn btn-success">Tambah</button>
            </div>
         </form>
      </div>
   </body>
</html>
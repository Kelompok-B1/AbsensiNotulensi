<?php 
   #kode otomatis untuk jurusan
   require '../../vendor/autoload.php';
   require '../../model/connect.php';
  # $sequence_id_jurusan = $collection->jurusan->find([])->sort(array('kode_jurusan'=>1));
  # -1 MAX , 1 MIN
  #$sequence_id_jurusan = $collection ->jurusan->find([],['limit'=>1,'sort'=>['kode_jurusan'=>-1]]);
  $sequence_id_jurusan = $collection ->jurusan->find([],['limit'=>1,'sort'=>['kode_jurusan'=>-1]]);
 


   if(isset($_POST['submit'])){
      
      $insertOneResult = $collection->jurusan->insertOne([
          'kode_jurusan' => $_POST['kode_jurusan'],
          'nama_jurusan' => $_POST['nama_jurusan']
        


      ]);
    
      header("Location: v_admin_tampil_jrs.php");
   }
?>


<html>
   <head>
      <title></title>
    
   </head>
   <body>
      <div class="container">
         <br>
         <CENTER><h1>Tambah Data Jurusan</h1></CENTER>
         <a href="v_admin_tampil_mhs.php" class="btn btn-primary">Kembali</a>
         <form method="POST">
            <div class="form-group">
               <strong>Kode Jurusan:</strong>
               <input type="text" 
               value="<?php 
                     foreach ($sequence_id_jurusan as $sidj){
                        $sidjrsn = $sidj->kode_jurusan;
                        $urutan = (int) substr($sidjrsn,3,4);
                        $urutan++;
                        $huruf ="KDJ";
                        $sidjrsn = $huruf . sprintf("%04s", $urutan);
                        echo $sidjrsn;
                      }
               ?>" 
               
               class="form-control" name="kode_jurusan" readonly><br>

               <strong>Nama Jurusan:</strong>
               <input type="text" class="form-control" name="nama_jurusan" required="" placeholder="xxxxxxxxx"><br>

               
               <button type="submit" name="submit" class="btn btn-success">Tambah</button>
            </div>
         </form>
      </div>
   </body>
</html>
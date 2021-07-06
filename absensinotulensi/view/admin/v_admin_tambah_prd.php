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
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Tambah Data Prodi</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        
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
<?php require_once('header.php'); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
<a href="v_admin_tampil_mkl.php" class="btn btn-primary">Kembali</a>
<?php 
   require '../../model/connect.php';
   require '../../vendor/autoload.php';
   #kode otomatsi untuk matakuliah
   $sequence_id_matakuliah = $collection ->matakuliah->find([],['limit'=>1,'sort'=>['kode_mk'=>-1]]);
   if(isset($_POST['submit'])){
      
      $insertOneResult = $collection->matakuliah->insertOne([
          'kode_mk' => $_POST['kode_mk'],
          'nama_mk' => $_POST['nama_mk'],
      ]);
    
      header("Location: v_admin_tampil_mkl.php");
   }
?>


<html>
<head>
       <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Tambah Data Mata Kuliah</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        
   </head>
   <body>
      <div class="container">
         <br>
         <CENTER><h1>Tambah Data Mata Kuliah</h1></CENTER>
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

               <input type="text" class="form-control" name="nama_mk" required="" placeholder="Nama Mata Kuliah"><br>
                
               <button type="submit" name="submit" class="btn btn-success">Tambah</button>
            </div>
         </form>
      </div>
       <!-- Custom JavaScript -->
         
   </body>
</html>
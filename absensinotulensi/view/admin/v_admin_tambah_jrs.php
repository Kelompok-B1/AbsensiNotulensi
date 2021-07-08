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
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Tambah Data Jurusan</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        
   </head>
   <body>
      <div class="container">
         <br>
         <CENTER><h1>Tambah Data Jurusan</h1></CENTER>
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
               <input type="text" class="form-control" name="nama_jurusan" required="" placeholder="Nama Jurusan"><br>
               <a href="v_admin_tampil_mhs.php" class="btn btn-primary">Kembali</a>
               <button type="submit" name="submit" class="btn btn-success">Tambah</button>
            </div>
         </form>
      </div>
   </body>
</html>
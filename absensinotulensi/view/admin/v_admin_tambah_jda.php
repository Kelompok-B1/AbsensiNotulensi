<?php 
  require '../../model/connect.php';  
  require '../../vendor/autoload.php';  
  #kode otomatsi untuk jadwal absensi
  $sequence_id_jadwal = $collection ->jadwal_absensi->find([],['limit'=>1,'sort'=>['kode_jadwal_absensi'=>-1]]);

   if(isset($_POST['submit'])){

    $intJam = intval($_POST['jam']);
    $intMenit = intval($_POST['menit']);
    $intDetik = intval($_POST['detik']);
    $intHari = intval($_POST['hari']);
    $intBulan = intval($_POST['bulan']);
    $intTahun = intval($_POST['tahun']);
    $insertOneResult = $collection->jadwal_absensi->insertOne([
       
        'kode_jadwal_absensi' => $_POST['kode_jadwal_absensi'],
        'kode_mk' => $_POST['kode_mk'],
        'kode_kelas' => $_POST['kode_kelas'],
     
        'periode'=>(object)array('waktu'=>(object)array('jam'=>$intJam,'menit'=>$intMenit,'detik' => $intDetik)
                            ,'tanggal'=>(object)array('hari' =>$intHari,'bulan' => $intBulan,'tahun' => $intTahun))
       
        


    ]);

    header("Location: v_admin_tampil_jda.php");
}
?>


<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Tambah Data Jadwal Absensi</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        
   </head>
   <body>
      <div class="container">
         <br>
         <CENTER><h1>Tambah Data Jadwal Absensi</h1></CENTER>
         <a href="v_admin_tampil_jda.php" class="btn btn-primary">Kembali</a>
         <form method="POST">
            <div class="form-group">
               <strong>Kode Jadwal Absensi:</strong>
               <input type="text" class="form-control"
               value="<?php 
                     foreach ($sequence_id_jadwal as $sidjd){
                        $sidjdw = $sidjd->kode_jadwal_absensi;
                        $urutan = (int) substr($sidjdw,3,4);
                        $urutan++;
                        $huruf ="KJA";
                        $sidjdw = $huruf . sprintf("%04s", $urutan);
                        echo $sidjdw;
                      }
               ?>" 
                
                 name="kode_jadwal_absensi" readonly><br>

               <strong>Kode Mata Kuliah:</strong>
               <input type="text" class="form-control" value="" name="kode_mk" required="" placeholder=""><br>

               <strong>Kode Kelas:</strong>
               <input type="text" class="form-control" value="" name="kode_kelas" required="" placeholder=""><br>
               
               <strong>Jam:</strong>
               <input type="number" class="form-control" value="" name="jam" required="" placeholder=""><br>
               
               <strong>Menit:</strong>
               <input type="number" class="form-control" value="" name="menit" required="" placeholder=""><br>
               
               <strong>Detik:</strong>
               <input type="number" class="form-control" value="" name="detik" required="" placeholder=""><br>

               <strong>Hari:</strong>
               <input type="number" class="form-control" value="" name="hari" required="" placeholder=""><br>
               
               <strong>Bulan:</strong>
               <input type="number" class="form-control" value="" name="bulan" required="" placeholder=""><br>

               <strong>Tahun:</strong>
               <input type="number" class="form-control" value="" name="tahun" required="" placeholder=""><br>

               <button type="number" name="submit" class="btn btn-success">Tambah</button>
            </div>
         </form>
      </div>
   </body>
</html>
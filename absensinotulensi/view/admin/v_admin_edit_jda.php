<?php 
  require '../../model/connect.php';  
 
  if (isset($_GET['id'])) {
    $jadwal_absensi = $collection->jadwal_absensi->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
   
   }
   
   if(isset($_POST['submit'])){
    $intJam = intval($_POST['jam']);
    $intMenit = intval($_POST['menit']);
    $intDetik = intval($_POST['detik']);
    $intHari = intval($_POST['hari']);
    $intBulan = intval($_POST['bulan']);
    $intTahun = intval($_POST['tahun']);
    
    $collection->jadwal_absensi->updateOne(
       ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
       ['$set' =>['kode_jadwal_absensi' => $_POST['kode_jadwal_absensi'],'kode_mk' => $_POST['kode_mk']
       ,'kode_kelas' => $_POST['kode_kelas'],

       'periode'=>(object)array('waktu'=>(object)array('jam'=>$intJam,'menit'=>$intMenit,'detik' => $intDetik)
       ,'tanggal'=>(object)array('hari' =>$intHari,'bulan' => $intBulan,'tahun' => $intTahun))
       ]]       
       
       /*['nim' => $_POST['nim'],
       'nama_mhs' => $_POST['nama'],
       'jk' => $_POST['jk'],
       'kode_kelas' => $_POST['kode_kelas'],
       'no_telp' => $_POST['no_telp'],
       'alamat' => (object)array('kampung' => $_POST['kampung'],'no_rumah' => $_POST['no_rumah'],
                   'rt' => $_POST['rt'],'rw' => $_POST['rw'],'desa' => $_POST['desa'],
                   'kode_pos' => $_POST['kode_pos'],'kecamatan' => $_POST['kecamatan'],
                   'kabupaten_kota' => $_POST['kabupaten_kota'],'provinsi' => $_POST['provinsi'],),
       'email' => $_POST['email']]*/


   );
 
   header("Location: v_admin_tampil_jda.php");
}
?>


<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Ubah Data Jadwal Absensi</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        
   </head>
   <body>
      <div class="container">
         <br>
         <CENTER><h1>Ubah Data Jadwal Absensi</h1></CENTER>
         <a href="v_admin_tampil_jda.php" class="btn btn-primary">Kembali</a>
         <form method="POST">
            <div class="form-group">
               <strong>Kode Jadwal Absensi:</strong>
               <input type="text" class="form-control" value="<?php  echo  $jadwal_absensi->kode_jadwal_absensi;?>"  name="kode_jadwal_absensi" readonly><br>

               <strong>Kode Mata Kuliah:</strong>
               <input type="text" class="form-control" value="<?php  echo  $jadwal_absensi->kode_mk;?>" name="kode_mk" required="" placeholder=""><br>

               <strong>Kode Kelas:</strong>
               <input type="text" class="form-control" value="<?php  echo  $jadwal_absensi->kode_kelas;?>" name="kode_kelas" required="" placeholder=""><br>
               
               <strong>Jam:</strong>
               <input type="number" class="form-control" value="<?php  echo  $jadwal_absensi->periode->waktu->jam;?>" name="jam" required="" placeholder=""><br>
               
               <strong>Menit:</strong>
               <input type="number" class="form-control" value="<?php  echo  $jadwal_absensi->periode->waktu->menit;?>" name="menit" required="" placeholder=""><br>
               
               <strong>Detik:</strong>
               <input type="number" class="form-control" value="<?php  echo  $jadwal_absensi->periode->waktu->detik;?>" name="detik" required="" placeholder=""><br>

               <strong>Hari:</strong>
               <input type="number" class="form-control" value="<?php  echo  $jadwal_absensi->periode->tanggal->hari;?>" name="hari" required="" placeholder=""><br>
               
               <strong>Bulan:</strong>
               <input type="number" class="form-control" value="<?php  echo  $jadwal_absensi->periode->tanggal->bulan;?>" name="bulan" required="" placeholder=""><br>

               <strong>Tahun:</strong>
               <input type="number" class="form-control" value="<?php  echo $jadwal_absensi->periode->tanggal->tahun;?>" name="tahun" required="" placeholder=""><br>

               <button type="number" name="submit" class="btn btn-success">Ubah</button>


            </div>
         </form>
      </div>
   </body>
</html>
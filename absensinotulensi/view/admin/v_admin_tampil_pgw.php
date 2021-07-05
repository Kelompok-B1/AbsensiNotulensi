<?php 

require '../../vendor/autoload.php';
require '../../model/connect.php';
$nodsn = 1;
$noadm = 1;
error_reporting(0);
?>

<html>
    <head></head>
    <body>
    <a href="v_admin_tambah_dsn.php">Add New Data Dosen</a><br/>
    <table border="1">
    <h1>Data Dosen</h1>
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama Dosen</th>
            <th>JK</th>
            <th>No Telp</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>Kode Kelas</th>
            <th>Kode Mata Kuliah</th>
            <th>Aksi</th>

        </tr>
     
    <?php 
        
       # $arai = $collection ->inventory->aggregate({$project=>{colors=>{$size=>array('$colors')}}});
        
        $dosen = $collection ->pegawai->find(['jabatan'=>'D']);

        
        foreach ($dosen as $dsn){
            echo "<tr>";
            echo "<td>".$nodsn."</td>";
            echo "<td>".$dsn->nip."</td>";
            echo "<td>".$dsn->nama_pgw."</td>";
            echo "<td>".$dsn->jk."</td>";
            echo "<td>".$dsn->no_telp."</td>";
            echo "<td>".$dsn->alamat->kampung." ".$dsn->alamat->no_rumah."</td>";
            echo "<td>".$dsn->email."</td>";
            echo "<td>"; 
            for ($kdk = 0; $kdk < 10; $kdk++) {
                if ($dsn->kode_kelas[$kdk]==null) {
                break;
                }
                echo $dsn->kode_kelas[$kdk]." ";
              }
           echo "</td>";

           echo "<td>"; 
            for ($x = 0; $x < 10; $x++) {
                if ($dsn->kode_mk[$x]==null) {
               break;
                }
                echo $dsn->kode_mk[$x]." ";
              }
           echo "</td>";

         
            echo "<td><a href='v_admin_edit_dsn.php?id=".$dsn->_id."' >Edit</a> | 
                <a href='v_admin_delete_dsn.php?id=".$dsn->_id."' >Delete</a></td>";
            echo "</tr>";
       
            $nodsn +=1;
            
        }

     
    ?>

    </table>

    <br>
    <a href="v_admin_tambah_adm.php">Add New Data Admin</a><br/>    
    <table border="1">
    <h1>Data Admin</h1>
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama Dosen</th>
            <th>JK</th>
            <th>No Telp</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    
    <?php 
        
       # $arai = $collection ->inventory->aggregate({$project=>{colors=>{$size=>array('$colors')}}});
        
        $dosen = $collection ->pegawai->find(['jabatan'=>'A']);

        
        foreach ($dosen as $dsn){
            echo "<tr>";
            echo "<td>".$noadm."</td>";
            echo "<td>".$dsn->nip."</td>";
            echo "<td>".$dsn->nama_pgw."</td>";
            echo "<td>".$dsn->jk."</td>";
            echo "<td>".$dsn->no_telp."</td>";
            echo "<td>".$dsn->alamat->kampung." ".$dsn->alamat->no_rumah."</td>";
            echo "<td>".$dsn->email."</td>";
        
         
            echo "<td><a href='v_admin_edit_adm.php?id=".$dsn->_id."' >Edit</a> | 
                <a href='v_admin_delete_adm.php?id=".$dsn->_id."' >Delete</a></td>";
            echo "</tr>";
       
            $noadm +=1;
            
        }

     
    ?>

    </table>
    <a href="v_admin.php">Kembali</a><br/>
    </body>
</html>
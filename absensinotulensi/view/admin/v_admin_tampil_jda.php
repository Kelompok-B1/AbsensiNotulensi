<?php 
require '../../vendor/autoload.php';
require '../../model/connect.php';
$no = 1;
?>

<html>
    <head></head>
    <body>
    <a href="v_admin_tambah_jda.php">Add New Data</a><br/><br/>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Kode Jadwal Absensi</th>
            <th>Kode Mata Kuliah</th>
            <th>Kode Kelas</th>
            <th>Periode </th>
            <th>Aksi </th>
        </tr>
    
    <?php 
        
       # $arai = $collection ->inventory->aggregate({$project=>{colors=>{$size=>array('$colors')}}});
        
        $jadwal  = $collection ->jadwal_absensi->find([]);

        foreach ($jadwal as $jda){
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td>".$jda->kode_jadwal_absensi."</td>";
            echo "<td>".$jda->kode_mk."</td>";
            echo "<td>".$jda->kode_kelas."</td>";
            echo "<td>".$jda->periode->waktu->jam.":".$jda->periode->waktu->menit.
            ":".$jda->periode->waktu->detik." ".$jda->periode->tanggal->hari."-"
            .$jda->periode->tanggal->bulan."-".$jda->periode->tanggal->tahun."
            </td>";
           
           
            echo "<td><a href='v_admin_edit_jda.php?id=".$jda->_id."' >Edit</a> | 
                <a href='v_admin_delete_jda.php?id=".$jda->_id."' >Delete</a></td>";
            echo "</tr>";
        
            $no +=1;
            
        }

      

     
    ?>
    <?php
      
    ?>
    </table>
    <a href="v_admin.php">Back</a><br/><br/>
    </body>
</html>
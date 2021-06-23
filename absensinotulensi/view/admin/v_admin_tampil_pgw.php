<?php 
require '../../vendor/autoload.php';
require '../../model/connect.php';
$no = 1;
?>

<html>
    <head></head>
    <body>
    <a href="v_admin_tambah_pgw.php">Add New Data</a><br/><br/>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Kode Kelas</th>
            <th>Nama Prodi</th>
            <th>Kode Prodi</th>
            <th>Aksi</th>
        </tr>
    
    <?php 
        
       # $arai = $collection ->inventory->aggregate({$project=>{colors=>{$size=>array('$colors')}}});
        
        $kelas = $collection ->kelas->find([]);

        foreach ($kelas as $kls){
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td>".$kls->kode_kelas."</td>";
            echo "<td>".$kls->nama_kelas."</td>";
            echo "<td>".$kls->kode_prodi."</td>";
            echo "<td><a href='v_admin_edit_kls.php?id=".$kls->_id."' >Edit</a> | 
                <a href='v_admin_delete_kls.php?id=".$kls->_id."' >Delete</a></td>";
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
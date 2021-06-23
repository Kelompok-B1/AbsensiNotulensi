<?php 
require '../../vendor/autoload.php';
require '../../model/connect.php';
$no = 1;
?>

<html>
    <head></head>
    <body>
    <a href="v_admin_tambah_mkl.php">Add New Data</a><br/><br/>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Kode Mata Kuliah</th>
            <th>Nama Mata Kuliah</th>
            <th>NIP</th>
            <th>Aksi</th>
        </tr>
    
    <?php 
        
       # $arai = $collection ->inventory->aggregate({$project=>{colors=>{$size=>array('$colors')}}});
        
        $matakuliah = $collection ->matakuliah->find([]);

        foreach ($matakuliah as $mkl){
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td>".$mkl->kode_mk."</td>";
            echo "<td>".$mkl->nama_mk."</td>";
            echo "<td>".$mkl->nip[0].", ".$mkl->nip[1]."</td>";
            echo "<td><a href='v_admin_edit_mkl.php?id=".$mkl->_id."' >Edit</a> | 
                <a href='v_admin_delete_mkl.php?id=".$mkl->_id."' >Delete</a></td>";
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
<?php 
require '../../vendor/autoload.php';
require '../../model/connect.php';
$no = 1;
?>

<html>
    <head></head>
    <body>
    <a href="v_admin_tambah_jrs.php">Add New Data</a><br/><br/>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Kode Jurusan</th>
            <th>Nama Jurusan</th>
            <th>Aksi</th>
        </tr>
    
    <?php 
        
       # $arai = $collection ->inventory->aggregate({$project=>{colors=>{$size=>array('$colors')}}});
        
        $jurusan = $collection ->jurusan->find([]);
         
        foreach ($jurusan as $jrs){
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td>".$jrs->kode_jurusan."</td>";
            echo "<td>".$jrs->nama_jurusan."</td>";
            echo "<td><a href='v_admin_edit_jrs.php?id=".$jrs->_id."' >Edit</a> | 
                <a href='v_admin_delete_jrs.php?id=".$jrs->_id."' >Delete</a></td>";
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
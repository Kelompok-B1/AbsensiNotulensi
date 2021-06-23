<?php 
require '../../vendor/autoload.php';
require '../../model/connect.php';
$no = 1;
?>

<html>
    <head></head>
    <body>
    <a href="v_admin_tambah_mhs.php">Add New Data</a><br/><br/>
    <table border="1">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>JK</th>
            <th>Kode Kelas</th>
            <th>No Telp</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    
    <?php 
        
       # $arai = $collection ->inventory->aggregate({$project=>{colors=>{$size=>array('$colors')}}});
        
        $mahasiswa = $collection ->mahasiswa->find([]);

        foreach ($mahasiswa as $mhs){
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td>".$mhs->nim."</td>";
            echo "<td>".$mhs->nama_mhs."</td>";
            echo "<td>".$mhs->jk."</td>";
            echo "<td>".$mhs->kode_kelas."</td>";
            echo "<td>".$mhs->no_telp."</td>";
            echo "<td>".$mhs->alamat->kampung." ".$mhs->alamat->no_rumah."</td>";
            
            echo "<td>".$mhs->email."</td>";
           echo "<td><a href='v_admin_edit_mhs.php?id=".$mhs->_id."' >Edit</a> | 
                <a href='v_admin_delete_mhs.php?id=".$mhs->_id."' >Delete</a></td>";
            echo "</tr>";
            
            $no +=1;
            
        }

     
    ?>
    <?php
      
    ?>
    </table>
    </body>
</html>
<?php 
require '../../vendor/autoload.php';
require '../../model/connect.php';
$no = 1;
?>

<html>
    <head></head>
    <body>
    <a href="v_admin_tambah_prd.php">Add New Data</a><br/><br/>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Kode Prodi</th>
            <th>Nama Prodi</th>
            <th>Nama Jurusan</th>
            <th>Aksi</th>
        </tr>
    
    <?php 
        
       # $arai = $collection ->inventory->aggregate({$project=>{colors=>{$size=>array('$colors')}}});
       
     $prodi1= $collection->prodi->aggregate([
        ['$lookup'=>(object)array(
                    'from'=> "jurusan",
                    'localField'=> "kode_jurusan",    
                    'foreignField'=> "kode_jurusan",  
                    'as'=> "ProdiJurusan"
        )],
        ['$replaceRoot'=>(object)array('newRoot'=>(object)array('$mergeObjects'=>array((object)
        array('$arrayElemAt'=>array('$jurusanProdi',0)),'$$ROOT')))],
       ['$project'=>(object)array('jurusanProdi'=>0)]
        ]);
        //$prodi = $collection ->prodi->find([]);

        foreach ($prodi1 as $prd){
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td>".$prd->kode_prodi."</td>";
            echo "<td>".$prd->nama_prodi."</td>";
            echo "<td>".$prd->nama_jurusan."</td>";
            echo "<td><a href='v_admin_edit_prd.php?id=".$prd->_id."' >Edit</a> | 
                <a href='v_admin_delete_prd.php?id=".$prd->_id."' >Delete</a></td>";
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
<?php 
require '../../vendor/autoload.php';
require '../../model/connect.php';
$no = 1;
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    </head>
    <?php require_once('header.php'); ?>
    <div class="container">
        <form class = "post-list">
            <input type = "hidden" value = "" />
        </form>
        <h3 align=center><b>Data Kelas</b></h3><br>
        <a href="v_admin.php" type = "submit" class = "btn btn-primary post_search_submit">Kembali</a>
        <a href="v_admin_tambah_kls.php" type="submit" name="submit" class="btn btn-success">Tambah Data Baru</a><br/><br/>
    <body>
    <div class="container">
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <th>No</th>
                <th>Kode Kelas</th>
                <th>Nama Kelas</th>
                <th>Nama Prodi</th>
                <th>Aksi</th>
            </thead>
            <tbody> 
            <?php 
        
       # $arai = $collection ->inventory->aggregate({$project=>{colors=>{$size=>array('$colors')}}});
       $kelas1= $collection->kelas->aggregate([
        ['$lookup'=>(object)array(
                    'from'=> "prodi",
                    'localField'=> "kode_prodi",    
                    'foreignField'=> "kode_prodi",  
                    'as'=> "KelasProdi"
        )],
        ['$replaceRoot'=>(object)array('newRoot'=>(object)array('$mergeObjects'=>array((object)
        array('$arrayElemAt'=>array('$KelasProdi',0)),'$$ROOT')))],
       ['$project'=>(object)array('KelasProdi'=>0)]
        ]); 

        //$kelas = $collection ->kelas->find([]);

        foreach ($kelas1 as $kls){
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td>".$kls->kode_kelas."</td>";
            echo "<td>".$kls->nama_kelas."</td>";
            echo "<td>".$kls->nama_prodi."</td>";
            echo "<td><a href='v_admin_edit_kls.php?id=".$kls->_id."' >Edit</a> | 
                <a href='v_admin_delete_kls.php?id=".$kls->_id."' >Delete</a></td>";
            echo "</tr>";
            
            $no +=1;
            
        }

     
    ?>
     </tbody>
                <tbody class = "pagination-container"></tbody>
            </table>
            <div class = "pagination-nav"></div>
        </div>

        <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );

        </script>
    </body>
</html>
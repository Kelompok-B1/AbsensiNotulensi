<?php 
require '../../vendor/autoload.php';
require '../../model/connect.php';
$no = 1;

error_reporting(0);
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
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php
        $tanggal= mktime(date("m"),date("d"),date("Y"));

        echo "Tanggal: ".date("Y-m-d", $tanggal) ;
        date_default_timezone_set('Asia/Jakarta');
        $jam=date("H:i:s");
        echo " Jam: ".$jam ."\n";

    ?> 
    <div class="container">
        <form class = "post-list">
            <input type = "hidden" value = "" />
        </form>
        <h3 align=center><b>Data Mata Kuliah</b></h3><br>
        <a href="v_admin.php" type = "submit" class = "btn btn-primary post_search_submit">Kembali</a>
        <a href="v_admin_tambah_mkl.php" type="submit" name="submit" class="btn btn-success">Tambah Data Baru</a><br/><br/>
 
    <body>
    <div class="container">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <th>No</th>
                    <th>Kode Mata Kuliah</th>
                    <th>Nama Mata Kuliah</th>
                    <th>Aksi</th>
                </thead>
            <tbody>
    
    <?php 
        
       # $arai = $collection ->inventory->aggregate({$project=>{colors=>{$size=>array('$colors')}}});
        
        $matakuliah = $collection ->matakuliah->find([]);

        foreach ($matakuliah as $mkl){
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td>".$mkl->kode_mk."</td>";
            echo "<td>".$mkl->nama_mk."</td>";

            echo "<td><a href='v_admin_edit_mkl.php?id=".$mkl->_id."' >Edit</a> | 
                <a href='v_admin_delete_mkl.php?id=".$mkl->_id."' >Delete</a></td>";
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
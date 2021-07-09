<?php 

require '../../vendor/autoload.php';
require '../../model/connect.php';
$nodsn = 1;
$noadm = 1;
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
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="v_admin.php" type = "submit" class = "btn btn-primary post_search_submit">Kembali</a>
    <div class="container">
        <form class = "post-list">
            <input type = "hidden" value = "" />
        </form>
        <h3 align=center><b>Data Dosen</b></h3><br>
        <a href="v_admin_tambah_dsn.php" type="submit" name="submit" class="btn btn-success">Tambah Data Baru</a><br/><br/>
        <body>
        <br>
        <div class="container">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Dosen</th>
                    <th>JK</th>
                    <th>No Telp</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Nama Kelas</th>
                    <th>Kode Mata Kuliah</th>
                    <th>Aksi</th>
                </thead>
            </tbody>
            <?php 
        
       # $arai = $collection ->inventory->aggregate({$project=>{colors=>{$size=>array('$colors')}}});
        
       $dosen1= $collection->pegawai->aggregate([
        ['$lookup'=>(object)array(
                    'from'=> "kelas",
                    'localField'=> "kode_kelas",    
                    'foreignField'=> "kode_kelas",  
                    'as'=> "PegawaiKelas"
        )],

        ['$lookup'=>(object)array(
                    'from'=> "matakuliah",
                    'localField'=> "kode_mk",    
                    'foreignField'=> "kode_mk",  
                    'as'=> "PegawaiMatkul"
        )],
        
       ['$match'=>(object)array('jabatan'=>'D')],
        ]); 

       
       //$dosen1 = $collection ->pegawai->find(['jabatan'=>'D']);

        
        foreach ($dosen1 as $dsn){
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
                echo $dsn->PegawaiKelas[$kdk]->nama_kelas."<br>";
              }
           echo "</td>";

           echo "<td>"; 
            for ($x = 0; $x < 10; $x++) {
                if ($dsn->kode_mk[$x]==null) {
               break;
                }
                echo $dsn->PegawaiMatkul[$x]->nama_mk."<br>";
              }
           echo "</td>";

         
            echo "<td><a href='v_admin_edit_dsn.php?id=".$dsn->_id."' >Edit</a> | 
                <a href='v_admin_delete_dsn.php?id=".$dsn->_id."' >Delete</a></td>";
            echo "</tr>";
       
            $nodsn +=1;
            
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
    </table>

    <div class="container">
        <form class = "post-list">
            <input type = "hidden" value = "" />
        </form>
        <h3 align=center><b>Data Admin</b></h3><br>
        <a href="v_admin_tambah_adm.php" type="submit" name="submit" class="btn btn-success">Tambah Data Baru</a><br/><br/>

        <body>
        <br>
        <div class="container">
            <table id="example" class="table table-striped table-bordered">
                <thead>
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
        
       $dosen= $collection->pegawai->aggregate([
        ['$match'=>(object)array('jabatan'=>'A')],
        ]); 
        
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

    </table>
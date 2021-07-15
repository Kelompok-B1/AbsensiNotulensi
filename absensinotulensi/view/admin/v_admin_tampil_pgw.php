<?php 

require '../../vendor/autoload.php';
require '../../model/connect.php';
$nodsn = 1;
$noadm = 1;
error_reporting(0);
?>
<?php
  //memulai session yang disimpan pada browser
  session_start();
  if($_SESSION['status_login']!="sudah_login"){
    header("location:../login_pegawai.php?pesan=belum_login");
}
    
  //cek apakah sesuai status sudah login? kalau belum akan kembali ke form login

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Sistem Absensi dan Notulensi</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />

        <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <?php require_once('sidebar.php'); ?>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['nama'];?></a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="../logout_pegawai.php">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="container">
                <form class = "post-list">
                    <input type = "hidden" value = "" />
                </form><br>
                <a href="v_admin.php" type = "submit" class = "btn btn-primary post_search_submit"><i class="fa fa-reply"></i> Kembali Ke Beranda</a>
                <p><h3 align=center><b>Data Dosen</b></h3><br>
                
                <a href="v_admin_tambah_dsn.php" type="submit" name="submit" class="btn btn-success"  ><i class="fa fa-plus"></i> Tambah Data Baru</a><br/><br/>
                </div>
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
                <tbody>
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

         
            echo "<td><a href='v_admin_edit_dsn.php?id=".$dsn->_id."'class='btn btn-info' >
            <i class='fa fa-pencil'></i> Edit</a> 
                <a href='v_admin_delete_dsn.php?id=".$dsn->_id."' class='btn btn-danger'> <i class='fa fa-trash'></i> Delete</a></td>";
            echo "</tr>";
       
            $nodsn +=1;
            
        }
            ?>
            </tbody>
               
        </table>
       
        
        <br>
        <h3 align=center><b>Data Admin</b></h3>
        <a href="v_admin_tambah_adm.php" type="submit" name="submit" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data Baru</a><br/><br/>

     
        <br>
   
            <table id="example2" class="table table-striped table-bordered">
                <thead>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Admin</th>
                    <th>JK</th>
                    <th>No Telp</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Aksi</th>
               </thead>
               <tbody>
     
    
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
        
         
            echo "<td><a href='v_admin_edit_adm.php?id=".$dsn->_id."'class='btn btn-info' >
            <i class='fa fa-pencil'></i> Edit</a> 
                <a href='v_admin_delete_adm.php?id=".$dsn->_id."'class='btn btn-danger'> <i class='fa fa-trash'></i> Delete</a></td>";
            echo "</tr>";
       
            $noadm +=1;
            
        }

     
        ?>

            </tbody>
        </table>
          
   </div>

        <script>
          
        $(document).ready(function() {
            $('#example').DataTable();
        } );

   
        $(document).ready(function() {
            $('#example2').DataTable();
        } );

        </script>
        </div>
    </div>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
        <?php require_once('footer.php'); ?>
    </body> 
</html>
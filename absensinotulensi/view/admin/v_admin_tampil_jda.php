<?php 
require '../../vendor/autoload.php';
require '../../model/connect.php';
$no = 1;
?>
<?php
  //memulai session yang disimpan pada browser
  session_start();
  if($_SESSION['status_login']!="sudah_login"){
    header("location:../../MainFrame/index.php?pesan=belum_login");
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
                                        <a class="dropdown-item" href="../logout.php">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="container">
                    <form class = "post-list">
                        <input type = "hidden" value = "" />
                    </form>
                    <br><a href="v_admin.php" type = "submit" class = "btn btn-primary post_search_submit"><i class="fa fa-reply"></i> Kembali Ke Beranda</a>
                    <p><h3 align=center><b>Data Jadwal Absensi</b></h3><br>
                    
                    <a href="v_admin_tambah_jda.php" type="submit" name="submit" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data Baru</a><br/><br/>
                    <br>
                    <div class="container">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Kode Jadwal Absensi</th>
                                <th>Kode Mata Kuliah</th>
                                <th>Kode Kelas</th>
                                <th>Periode </th>
                                <th>Aksi </th>
                            </thead>
                        <tbody>
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
                            
                            
                                echo "<td><a href='v_admin_edit_jda.php?id=".$jda->_id."'class='btn btn-info' >
                                <i class='fa fa-pencil'></i> Edit</a> 
                                    <a href='v_admin_delete_jda.php?id=".$jda->_id."'class='btn btn-danger'> <i class='fa fa-trash'></i> Delete</a></td>";
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
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
        <?php require_once('footer.php'); ?>
    </body>
</html>
                            
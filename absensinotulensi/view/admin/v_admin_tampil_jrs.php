<?php 
require '../../vendor/autoload.php';
require '../../model/connect.php';
$no = 1;
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
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">Absensi dan Notulensi</div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="v_admin_tampil_jrs.php">Data Jurusan</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="v_admin_tampil_prd.php">Data Prodi</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="v_admin_tampil_kls.php">Data Kelas</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="v_admin_tampil_mkl.php">Data Mata Kuliah</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="v_admin_tampil_pgw.php">Data Pegawai</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="v_admin_tampil_mhs.php">Data Mahasiswa</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="v_admin_tampil_jda.php">Jadwal Absensi</a>

                </div>
            </div>
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
                </form>
                <br> <a href="v_admin.php" type = "submit" class = "btn btn-primary post_search_submit">Beranda</a>
                <p><h3 align=center><b>Data Jurusan</b></h3><br>
               
                <a href="v_admin_tambah_jrs.php" type="submit" name="submit" class="btn btn-success"  >Tambah Data Baru</a><br/><br/>
                </div>
                <div class="container">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <th>No</th>
                        <th>Kode Jurusan</th>
                        <th>Nama Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

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
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
        <?php require_once('footer.php'); ?>
    </body>
</html>
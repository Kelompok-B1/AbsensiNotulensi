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
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
                    </form>
                    <br><a href="v_admin.php" type = "submit" class = "btn btn-primary post_search_submit"><i class="fa fa-reply"></i> Kembali Ke Beranda</a>
                    <p><h3 align=center><b>Data Kelas</b></h3><br>
                    
                    <button  type="button"  class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data Baru</button><br/><br/>
                    </div>

                    <!-- Modal Tambah Prodi -->
                <?php 
               
                    require '../../vendor/autoload.php';
                    require '../../model/connect.php';
                    #kode otomatis untuk kelas
                    $sequence_id_kelas = $collection ->kelas->find([],['limit'=>1,'sort'=>['kode_kelas'=>-1]]);
                    if(isset($_POST['submit'])){
                        $has_errors =false;
                    try {$insertOneResult = $collection->kelas->insertOne([
                        'kode_kelas' => $_POST['kode_kelas'],
                        'nama_kelas' => $_POST['nama_kelas'],
                        'kode_prodi' => $_POST['kode_prodi']
              
                  
                  
                        ]);}
                    catch (exception $e){
                        $has_errors =true;
                    }

                    if ($has_errors==false){
                        echo"
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                           <b>Data Kelas Berhasil Ditambahkan</b>
                           <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                           <span aria-hidden='true'>&times;</span>
                         </button>
                        </div>
                         
                       
                        ";
                        
                       }else if($has_errors!==false){
                        echo"
                        <div class='alert alert-danger'alert-dismissible fade show' role='alert'>
                            <b>Data Kelas Tidak Berhasil Ditambahkan</b>.Mohon Cek Kembali Pengisian Data Agar Tidak Ada Yang Duplikat</a>.
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                        </div>
                        ";
                           }
                           $sequence_id_kelas = $collection ->kelas->find([],['limit'=>1,'sort'=>['kode_kelas'=>-1]]);
                   
                
                    }
                    ?>

                
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kelas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <form method="POST">
                                <div class="form-group">
                                <strong>Kode Kelas:</strong>
                                <input type="text" class="form-control" 
                                value="<?php 
                                        foreach ($sequence_id_kelas as $sidk){
                                            $sidkls = $sidk->kode_kelas;
                                            $urutan = (int) substr($sidkls,3,4);
                                            $urutan++;
                                            $huruf ="KDK";
                                            $sidkls = $huruf . sprintf("%04s", $urutan);
                                            echo $sidkls;
                                        }
                                ?>"
                                name="kode_kelas" readonly><br>

                                <strong>Nama Kelas:</strong>
                                <input type="text" class="form-control" name="nama_kelas" required="" placeholder="Nama Kelas"><br>
                                 
                                <strong>Kode Prodi:</strong>
                                <select name="kode_prodi" class ="form-control" required>
                                    <option value="" disabled selected>Pilih Prodi </option>
                                    <?php
                                    $prodi = $collection ->prodi->find([]);
                                    foreach($prodi as $prd){
                                        echo "<option value='$prd->kode_prodi'>$prd->kode_prodi - $prd->nama_prodi</option>";

                                    }
                                    ?>
                                </select> 
                                </div>
 
                    </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          
                                            <button type="submit" name="submit" class="btn btn-success">Tambah</button>
                                    </div>
                             </form>
                                        </div>
                                    </div>
                                    </div>
                <!-- Close Modal Tambah PRodi -->

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
                                echo "<td><a href='v_admin_edit_kls.php?id=".$kls->_id."'class='btn btn-info' >
                                <i class='fa fa-pencil'></i> Edit</a>   
                                    <a href='v_admin_delete_kls.php?id=".$kls->_id."' class='btn btn-danger'> <i class='fa fa-trash'></i> Delete</a></td>";
                                echo "</tr>";
                                
                                $no +=1;
                                
                            }
                            ?>
                        </tbody>
                    
                    </table>
           
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
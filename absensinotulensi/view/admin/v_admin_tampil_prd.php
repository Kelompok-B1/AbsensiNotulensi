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
                                        <a class="dropdown-item" href="../logout.php">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Modal Tambah Prodi -->
                <?php 
                    #kode otomatis untuk prodi
                    require '../../vendor/autoload.php';
                    require '../../model/connect.php';
                    #kode otomatis untuk prodi
                    $sequence_id_prodi = $collection ->prodi->find([],['limit'=>1,'sort'=>['kode_prodi'=>-1]]);
                    if(isset($_POST['submit'])){
                        $has_errors =false;
                    try {$insertOneResult = $collection->prodi->insertOne([
                            'kode_prodi' => $_POST['kode_prodi'],
                            'nama_prodi' => $_POST['nama_prodi'],
                            'kode_jurusan' => $_POST['kode_jurusan'],
                  
                  
                        ]);}
                    catch (exception $e){
                        $has_errors =true;
                    }

                    if ($has_errors==false){
                        echo"
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                           <b>Data Prodi Berhasil Ditambahkan</b>
                           <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                           <span aria-hidden='true'>&times;</span>
                         </button>
                        </div>
                         
                       
                        ";
                        
                       }else if($has_errors!==false){
                        echo"
                        <div class='alert alert-danger'alert-dismissible fade show' role='alert'>
                            <b>Data Prodi Tidak Berhasil Ditambahkan</b>.Mohon Cek Kembali Pengisian Data Agar Tidak Ada Yang Duplikat</a>.
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                        </div>
                        ";
                           }
                           $sequence_id_prodi = $collection ->prodi->find([],['limit'=>1,'sort'=>['kode_prodi'=>-1]]);
                
                    }
                    ?>

                
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Prodi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <form method="POST">
                                <div class="form-group">
                                <strong>Kode Prodi:</strong>
                                <input type="text" 
                                value="<?php 
                                        foreach ($sequence_id_prodi as $sidp){
                                            $sidprd = $sidp->kode_prodi;
                                            $urutan = (int) substr($sidprd,3,4);
                                            $urutan++;
                                            $huruf ="KDP";
                                            $sidprd = $huruf . sprintf("%04s", $urutan);
                                            echo $sidprd;
                                        }
                                ?>"       
                                class="form-control" name="kode_prodi" readonly><br>

                                <strong>Nama  Prodi:</strong>
                                <input type="text" class="form-control" name="nama_prodi" required="" placeholder="Nama Prodi"><br>
                                 
                                <strong>Kode Jurusan:</strong>
                                <select name="kode_jurusan" class ="form-control" required>
                                <option value="" disabled selected>Pilih Jurusan </option>
                                <?php
                                $jurusan = $collection ->jurusan->find([]);
                                foreach($jurusan as $jrs){
                                    echo "<option value='$jrs->kode_jurusan'>$jrs->kode_jurusan - $jrs->nama_jurusan</option>";

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
                  
                  <br><a href="v_admin.php" type = "submit" class = "btn btn-primary post_search_submit"><i class="fa fa-reply"></i> Kembali Ke Beranda</a>
                  <p><h3 align="center"><b>Data Program Studi</b></h3><br>
                  
                  <button  type="button"  class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data Baru</button>
                  <a href="v_admin_cetak_prd.php" ><button type="button" class="btn btn-warning"> <i class="fa fa-print"></i> Cetak Data</button></a> <br>   
          
                  <br>
                  </div>
                
                  <div class="container">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Kode Prodi</th>
                                <th>Nama Prodi</th>
                                <th>Nama Jurusan</th>
                                <th>Aksi</th>
                            </thead>
                        <tbody>
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
                            array('$arrayElemAt'=>array('$ProdiJurusan',0)),'$$ROOT')))],
                        ['$project'=>(object)array('{ProdiJurusan}'=>0)]
                            ]);
                            //$prodi = $collection ->prodi->find([]);

                            foreach ($prodi1 as $prd){
                                echo "<tr>";
                                echo "<td>".$no."</td>";
                                echo "<td>".$prd->kode_prodi."</td>";
                                echo "<td>".$prd->nama_prodi."</td>";
                                echo "<td>".$prd->nama_jurusan."</td>";
                                echo "<td><a href='v_admin_edit_prd.php?id=".$prd->_id."' class='btn btn-info' >
                                <i class='fa fa-pencil'></i> Edit</a> 
                                    <a href='v_admin_delete_prd.php?id=".$prd->_id."' class='btn btn-danger'> <i class='fa fa-trash'></i> Delete</a></td>";
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
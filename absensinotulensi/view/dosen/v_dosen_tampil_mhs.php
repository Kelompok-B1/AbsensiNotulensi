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


             <!-- Modal Tambah Mahasiswa -->
        <?php 
                    
                    require '../../vendor/autoload.php';
                    require '../../model/connect.php';
                    #kode otomatsi untuk pegawai
                    $sequence_id_pegawai = $collection ->pegawai->find([],['limit'=>1,'sort'=>['nip'=>-1]]);

                    if(isset($_POST['submit'])){
                 
                         
                         $has_errors = false;   

                         try{$insertOneResult = $collection->mahasiswa->insertOne([
                            'nim' => $_POST['nim'],
                            'nama_mhs' => $_POST['nama'],
                            'jk' => $_POST['jk'],
                            'kode_kelas' => $_POST['kode_kelas'],
                            'no_telp' => $_POST['no_telp'],
                            'alamat' => (object)array('kampung' => $_POST['kampung'],'no_rumah' => $_POST['no_rumah'],
                                        'rt' => $_POST['rt'],'rw' => $_POST['rw'],'desa' => $_POST['desa'],
                                        'kode_pos' => $_POST['kode_pos'],'kecamatan' => $_POST['kecamatan'],
                                        'kabupaten_kota' => $_POST['kabupaten_kota'],'provinsi' => $_POST['provinsi'],),
                            'email' => $_POST['email'],
                            'akun' => (object)array('username' => $_POST['nim'],'password' => $_POST['password'])
                        ]);;}

                        catch (exception $e){
                            $has_errors = true;   
                        }

                    if ($has_errors==false){
                        echo"
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                           <b>Data Mahasiswa Berhasil Ditambahkan</b>
                           <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                           <span aria-hidden='true'>&times;</span>
                         </button>
                        </div>
                         
                       
                        ";
                        
                       }else if($has_errors!==false){
                        echo"
                        <div class='alert alert-danger'alert-dismissible fade show' role='alert'>
                            <b>Data Mahasiswa Tidak Berhasil Ditambahkan</b>.Mohon Cek Kembali Pengisian Data Agar Tidak Ada Yang Duplikat</a>.
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                        </div>
                        ";
                           }
                           #kode otomatsi untuk pegawai
                           $sequence_id_pegawai = $collection ->pegawai->find([],['limit'=>1,'sort'=>['nip'=>-1]]);

                    }
                    ?>

                
                <div class="modal fade bd-example-modal-lg" id="exampleModalDosen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form method="POST">
                        <div class="form-group">
                            <strong>NIM</strong>
                            <input type="text" class="form-control" name="nim" required="" placeholder="Nomor Induk Mahasiswa"><br>
        
                         </div>
                        <div class="form-row">          
                            <div class="form-group col-md-6">
                                <strong>Nama Mahasiswa</strong>
                                <input type="text" class="form-control" name="nama" required="" placeholder="Nama Mahasiswa">
                            </div>

                            <div class="form-group col-md-6">
                                <strong>Password</strong>
                                <input type="text" class="form-control" name="password" required="" placeholder="Password">

                            </div>    
                        </div> 

                        <strong>Jenis Kelamin</strong>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jk" id="exampleRadios1" value="L" >
                            <label class="form-check-label" for="exampleRadios1">
                                Laki - Laki
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="jk" id="exampleRadios2" value="P">
                            <label class="form-check-label" for="exampleRadios2">
                                Perempuan
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label >No Telepon </label>
                            <input type="text" class="form-control" name="no_telp"  placeholder="No Telepon"><br>
                        </div>   
                         
                        <strong>Alamat</strong>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control" name="kampung"  placeholder="Nama Kampung / Komplek"><br>
                            </div>
                            
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control" name="no_rumah"  placeholder="No Rumah"><br>
                            </div>  

                            <div class="form-group col-md-1">
                                <input type="text" class="form-control" name="rt"  placeholder="RT"><br>
                            </div>  

                            <div class="form-group col-md-1">
                                <input type="text" class="form-control" name="rw"  placeholder="RW"><br>
                            </div> 

                            <div class="form-group col-md-3">
                                <input type="text" class="form-control" name="desa"  placeholder="Nama Desa"><br>
                            </div>  
                            
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control" name="kode_pos"  placeholder="Kode Pos"><br>
                            </div> 

                            <div class="form-group col-md-3">
                                <input type="text" class="form-control" name="kecamatan"  placeholder="Kecamatan"><br>
                            </div> 

                            <div class="form-group col-md-3">
                                <input type="text" class="form-control" name="kabupaten_kota"  placeholder="Kabupaten/Kota"><br>
                            </div> 

                            <div class="form-group col-md-3">
                                <input type="text" class="form-control" name="provinsi"  placeholder="Provinsi"><br>
                            </div> 

                        </div>
                        
                        <strong>Email</strong>
                        <input type="text" class="form-control" name="email" required="" placeholder="Email"><br>
                        
                        <strong>Kelas</strong>
                        <select name="kode_kelas" class="form-control" required>
                                    <option value="" disabled selected> Pilih Kelas</option>
                                    <?php
                                          $kelas= $collection->kelas->aggregate([
                                        
                                        
                                            ['$lookup'=>(object)array(
                                                'from'=> "prodi",
                                                'localField'=> "kode_prodi",    
                                                'foreignField'=> "kode_prodi",  
                                                'as'=> "ProdiMahasiswa"
                                            )],
                                        
                                            ['$replaceRoot'=>(object)array('newRoot'=>(object)array('$mergeObjects'=>array((object)
                                            array('$arrayElemAt'=>array('$ProdiMahasiswa',0)),'$$ROOT')))],
                                            
                                           
                                            ['$project'=>(object)array('{ProdiMahasiswa}'=>0)],
                                        
 
                                            ]);

                                          foreach($kelas as $kls){
                                              echo "<option value='$kls->kode_kelas'>$kls->kode_kelas - $kls->nama_kelas - $kls->nama_prodi</option>";
                                          }
                                    ?>
                                </select>
                        
 
                    </div>
                                    <div class="modal-footer">
                                      
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                             <button type="submit" name="submit" class="btn btn-success">Tambah</button>
                                    </div>
                             </form>
                                        </div>
                                    </div>
                                    </div>
                <!-- Close Modal Tambah Mahasiswa -->

                <div class="container">
                <form class = "post-list">
                    <input type = "hidden" value = "" />
                </form>
                <br>
                <a href="v_dosen.php" type = "submit" class = "btn btn-primary post_search_submit"><i class="fa fa-reply"></i> Kembali Ke Beranda</a>
                <p><h3 align=center><b>Data Mahasiswa</b></h3><br>
                
                    </div>
                
        <div class="container">
            <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th id = "no" class = "active" >No.</th>
                    <th id = "nim" class = "active">NIM</th>
                    <th id = "nama" class = "active">Nama</th>
                    <th id = "jk" class = "active">Jenis Kelamin</th>
                    <th id = "kode_kelas" class = "active">Kode Kelas</th>
                    <th id = "no_telp" class = "active">No.Telepon</th>
                    <th id = "alamat" class = "active">Alamat</th>
                    <th id = "email" class = "active">Email</th>
              
                </tr>
            </thead>
            <?php
             error_reporting(0);
           
    
           
            /*$mahasiswa = $collection ->mahasiswa->aggregate([
                ['$match'=>array('kode_kelas'=>$_SESSION['kode_kelas'][0])]
                
            
            ]);*/
            
            $mahasiswa = $collection->mahasiswa->find(array('$or' => array(
                
                array("kode_kelas" => $_SESSION['kode_kelas'][0]),
                array("kode_kelas" => $_SESSION['kode_kelas'][1]),
                array("kode_kelas" => $_SESSION['kode_kelas'][2]),
                array("kode_kelas" => $_SESSION['kode_kelas'][3]),
              
              )));

         ?>
        <?php
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
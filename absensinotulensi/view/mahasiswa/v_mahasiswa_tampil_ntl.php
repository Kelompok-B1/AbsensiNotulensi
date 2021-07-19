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
                
                <br> <a href="v_mahasiswa.php" type = "submit" class = "btn btn-primary post_search_submit"><i class="fa fa-reply"></i> Kembali Ke Beranda</a>
                <h4 align=center><b>Data Notulensi <?php echo $_SESSION['nama_kelas']."-".$_SESSION['nama_prodi'];?></b></h4><br>
               
               <button type="button"  class="btn btn-success" data-toggle="modal" data-target="#exampleModal" ><i class="fa fa-plus"></i> Tambah Data Baru</button><br/><br/>
                
          
   

                <!-- Modal Tambah Jurusan -->
                    <?php 
                    #kode otomatis untuk jurusan
                    require '../../vendor/autoload.php';
                    require '../../model/connect.php';
                    # $sequence_id_jurusan = $collection->jurusan->find([])->sort(array('kode_jurusan'=>1));
                    # -1 MAX , 1 MIN
                    #$sequence_id_jurusan = $collection ->jurusan->find([],['limit'=>1,'sort'=>['kode_jurusan'=>-1]]);
                    $sequence_id_notulensi = $collection->notulensi->find([],['limit'=>1,'sort'=>['kode_notulensi'=>-1]]);
                    if(isset($_POST['submit'])){
                        date_default_timezone_set('Asia/Jakarta');

                        $intJam = intval(date("H"));
                        $intMenit = intval(date("i"));
                        $intDetik = intval(date("s"));
                        $intHari = intval(date("d"));
                        $intBulan = intval(date("m"));
                        $intTahun = intval(date("Y"));
                        $has_errors = false; 
                    try{$insertOneResult = $collection->notulensi->insertOne([
                        'kode_notulensi' => $_POST['kode_notulensi'],
                        'kode_mk' => $_POST['kode_mk'],
                        'kode_kelas' => $_SESSION['kode_kelas'],
                        'diupload_oleh' => $_SESSION['nim'],
                        'judul_notulensi' => $_POST['judul_notulensi'],
                        'url_docs' => $_POST['url_docs'],
              
                        'periode'=>(object)array('waktu'=>(object)array('jam'=>$intJam,'menit'=>$intMenit,'detik' => $intDetik)
                        ,'tanggal'=>(object)array('hari' =>$intHari,'bulan' => $intBulan,'tahun' => $intTahun))
              
              
                    ]);}
                    catch (exception $e){
                        $has_errors =true;
                    }

                    if ($has_errors==false){
                        echo"
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                           <b>Data Notulensi Berhasil Ditambahkan</b>
                           <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                           <span aria-hidden='true'>&times;</span>
                         </button>
                        </div>
                         
                       
                        ";
                        
                       }else if($has_errors!==false){
                        echo"
                        <div class='alert alert-danger' role='alert'>
                            <b>Data Notulensi Tidak Berhasil Ditambahkan</b>.Mohon Cek Kembali Pengisian Data Agar Tidak Ada Yang Duplikat</a>.
                        </div>
                        ";
                           }
                    $sequence_id_notulensi = $collection->notulensi->find([],['limit'=>1,'sort'=>['kode_notulensi'=>-1]]);
                
                    }
                    ?>

                
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Notulensi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <form method="POST">
                                <div class="form-group">
                                <strong>Kode Notulensi</strong>
                                    <input type="text" 
                                    value="<?php 
                                            foreach ($sequence_id_notulensi as $sidn){
                                                $sidntl = $sidn->kode_notulensi;
                                                $urutan = (int) substr($sidntl,3,4);
                                                $urutan++;
                                                $huruf ="KDN";
                                                $sidntl = $huruf . sprintf("%04s", $urutan);
                                                echo $sidntl;
                                            }
                                    ?>"       
                                    class="form-control" name="kode_notulensi" readonly><br>
                                    <strong>Mata Kuliah</strong>
                                    <select name="kode_mk" required class="form-control">
                                            <option value="" disabled selected>Pilih Mata Kuliah </option>
                                            <?php
                                            $matakuliah = $collection ->matakuliah->find([]);
                                            foreach($matakuliah as $mkl){
                                                echo "<option value='$mkl->kode_mk'>$mkl->kode_mk - $mkl->nama_mk</option>";

                                            }
                                            ?>
                                    </select> 
                                    
                                <strong>Judul Notulensi</strong>
                                <input type="text" class="form-control" name="judul_notulensi" required="" placeholder="Judul Notulensi">
                                

                                <strong>Tautan  Notulensi</strong>
                                <input type="text" class="form-control" name="url_docs" required="" placeholder="Tautan Notulensi"><br>

                                
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
                <!-- Close Modal Tambah Jurusan -->

                </div>
                
                <div class="container">
                    
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <th>No</th>
                            <th>Kode Notulensi</th>
                            <th>Kode MK</th>
                            <th>Nama MK</th>
                            <th>Diupload Oleh</th>
                            <th>Judul Notulensi</th>
                            <th>Tautan Notulensi</th>
                            <th>Periode</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php 
                            
                            $notulensi= $collection->notulensi->aggregate([
                                ['$lookup'=>(object)array(
                                            'from'=> "mahasiswa",
                                            'localField'=> "diupload_oleh",    
                                            'foreignField'=> "nim",  
                                            'as'=> "NotulensiMahasiswa"
                                )],
            
                                ['$lookup'=>(object)array(
                                    'from'=> "kelas",
                                    'localField'=> "kode_kelas",    
                                    'foreignField'=> "kode_kelas",  
                                    'as'=> "NotulensiKelas"
                                )], 
                                
                                ['$lookup'=>(object)array(
                                    'from'=> "matakuliah",
                                    'localField'=> "kode_mk",    
                                    'foreignField'=> "kode_mk",  
                                    'as'=> "NotulensiMatakuliah"
                                )],
            
                                ['$replaceRoot'=>(object)array('newRoot'=>(object)array('$mergeObjects'=>array((object)
                                array('$arrayElemAt'=>array('$NotulensiMahasiswa',0)),'$$ROOT')))],
            
                                ['$replaceRoot'=>(object)array('newRoot'=>(object)array('$mergeObjects'=>array((object)
                                array('$arrayElemAt'=>array('$NotulensiKelas',0)),'$$ROOT')))],
            
                                ['$replaceRoot'=>(object)array('newRoot'=>(object)array('$mergeObjects'=>array((object)
                                array('$arrayElemAt'=>array('$NotulensiMatakuliah',0)),'$$ROOT')))],
                                
                                ['$project'=>(object)array('{NotulensiMahasiswa}'=>0)],
                                ['$project'=>(object)array('{NotulensiKelas}'=>0)],
                                ['$project'=>(object)array('{NotulensiMatakuliah}'=>0)],
            
                                ['$match'=>(object)array('kode_kelas'=>$_SESSION['kode_kelas'])],
            
                           
                                ]);
                            # $arai = $collection ->inventory->aggregate({$project=>{colors=>{$size=>array('$colors')}}});
                                  #$notulensi = $collection ->notulensi->find([]);
                            
                            foreach ($notulensi as $ntl){
                                echo "<tr>";
                                echo "<td>".$no."</td>";
                                echo "<td>".$ntl->kode_notulensi."</td>";
                                echo "<td>".$ntl->kode_mk."</td>";
                                echo "<td>".$ntl->nama_mk."</td>";
                                echo "<td>".$ntl->nama_mhs."</td>";
                                echo "<td>".$ntl->judul_notulensi."</td>";
                                echo "<td> <a href='$ntl->url_docs' target='_blank'>Klik Disini</a></td>";
                                echo "<td>".$ntl->periode->waktu->jam.":".$ntl->periode->waktu->menit.
                                ":".$ntl->periode->waktu->detik." ".$ntl->periode->tanggal->hari."-"
                                .$ntl->periode->tanggal->bulan."-".$ntl->periode->tanggal->tahun."
                                </td>";
                               
                               
                                
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
        
      <?php require_once('footer.php'); ?>
    </body>
</html>
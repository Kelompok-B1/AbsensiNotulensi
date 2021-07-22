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
        <title>Sistem Absensi dan absensi</title>
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
     <!-- CSS -->
        <style>
        #my_camera{
        width: 320px;
        height: 240px;
        border: 1px solid black;
        }
        </style>   
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
                
                <br> <a href="v_mahasiswa.php" type = "submit" class = "btn btn-primary post_search_submit"><i class="fa fa-reply"></i> Kembali Ke Beranda</a>
                <h4 align=center><b>Data Absensi <?php echo $_SESSION['nama'];?></b></h4><br>
                <a href="v_dosen_cetak_abs.php" ><button type="button" class="btn btn-warning"> <i class="fa fa-print"></i> Cetak Data</button></a> <br>   
                <br>


                <!-- Modal Tambah Jurusan -->
                    
                
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data absensi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <form method="POST">
                                <div class="form-group">
                                <strong>Kode Absensi</strong>
                                    <input type="text" 
                                    value="<?php 
                                            foreach ($sequence_id_absensi as $sidabs){
                                                $sidabs = $sidabs->kode_absensi;
                                                $urutan = (int) substr($sidabs,3,4);
                                                $urutan++;
                                                $huruf ="KDA";
                                                $sidabs = $huruf . sprintf("%04s", $urutan);
                                                echo $sidabs;
                                            }
                                    ?>"       
                                    class="form-control" name="kode_absensi" readonly><br>
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

                                    <strong>Nama Dosen</strong>
                                    <select name="nip" required class="form-control">
                                            <option value="" disabled selected>Pilih Dosen </option>
                                            <?php
                                            $dosen = $collection ->pegawai->find(['jabatan'=>'D']);
                                            foreach($dosen as $dsn){
                                                echo "<option value='$dsn->nip'>$dsn->nip - $dsn->nama_pgw</option>";

                                            }
                                            ?>
                                    </select> 
                                    <br>

                                    <strong>Ambil Foto</strong>
                                    <div id="my_camera">
                                    
                                    </div>
                                     <br>           
                                    <input type=button class="btn btn-info" value="Take Snapshot" onClick="take_snapshot()">
                                    <br>
                                    <strong>Hasil Foto</strong>  
                                    <div id="results" >
                                              
                                    </div>

                                
                                
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
                            <th>Kode Absensi</th>
                            <th>NIM</th>
                            <th>Kode MK</th>
                            <th>Kode kelas</th>
                       
                            <th>Foto</th>  
                            <th>Periode</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php 
                            
                            $absensi= $collection->absensi->find(['data_absen.nip'=>$_SESSION['nip']]);
                            # $arai = $collection ->inventory->aggregate({$project=>{colors=>{$size=>array('$colors')}}});
                                  #$notulensi = $collection ->notulensi->find([]);
                            
                            foreach ($absensi as $abs){
                                echo "<tr>";
                                echo "<td>".$no."</td>";
                                echo "<td>".$abs->kode_absensi."</td>";
                                echo "<td>".$abs->data_absen->nim."</td>";
                                echo "<td>".$abs->data_absen->kode_mk."</td>";
                                echo "<td>".$abs->data_absen->nip."</td>";
                                echo "<td><img src='../mahasiswa/images/selfie/".$abs->url_foto."'></td>";
                                echo "<td>".$abs->periode->waktu->jam.":".$abs->periode->waktu->menit.
                                ":".$abs->periode->waktu->detik." ".$abs->periode->tanggal->hari."-"
                                .$abs->periode->tanggal->bulan."-".$abs->periode->tanggal->tahun."
                                </td>";
                               
                                if($abs->status==1){
                                    echo "<td> Hadir </td>";
                                }else{
                                    echo "<td> Tidak Hadir </td>";
                                }

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

        <!-- Script -->
        <script type="text/javascript" src="webcam.min.js"></script>

        <!-- Code to handle taking the snapshot and displaying it locally -->
        <script language="JavaScript">

        // Configure a few settings and attach camera
        Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
        });
        Webcam.attach( '#my_camera' );
        function take_snapshot() {

        // take snapshot and get image data
        Webcam.snap( function(data_uri) {
            Webcam.upload( data_uri, 'v_mahasiswa_tampil_abs.php', function(code, text,Name) {
                            document.getElementById('results').innerHTML = 
                            '' + 
                    '<img src="' + data_uri + '"style=" width: 300px;"><br>';
                    
        } );
        
        
        } );
        }

        </script>

            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        
      <?php require_once('footer.php'); ?>
    </body>
</html>
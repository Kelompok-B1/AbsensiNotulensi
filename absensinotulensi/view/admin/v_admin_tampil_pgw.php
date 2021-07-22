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

        <!-- Modal Tambah Dosen -->
        <?php 
                    
                    require '../../vendor/autoload.php';
                    require '../../model/connect.php';
                    #kode otomatsi untuk pegawai
                    $sequence_id_pegawai = $collection ->pegawai->find([],['limit'=>1,'sort'=>['nip'=>-1]]);

                    if(isset($_POST['submit'])){
                        $kdk = array();
                        for ($i = 0; $i < $_POST['kode_kelas']; $i++){
                          if($_POST['kode_kelas'][$i]){ 
                              array_push($kdk,$_POST['kode_kelas'][$i]);
                          }else{
                           break;
                           }
                         }
                  
                         $kmk = array();
                        for ($i = 0; $i < $_POST['kode_mk']; $i++){
                          if($_POST['kode_mk'][$i]){ 
                              array_push($kmk,$_POST['kode_mk'][$i]);
                          }else{
                           break;
                           }
                         }
                         
                         $has_errors = false;   

                         try{$insertOneResult = $collection->pegawai->insertOne([
                            'nip' => $_POST['nip'],
                            'nama_pgw' => $_POST['nama_pgw'],
                            'jk' => $_POST['jk'],
                            'no_telp' => $_POST['no_telp'],
                            'nama_pgw' => $_POST['nama_pgw'],
                            'alamat' => (object)array('kampung' => $_POST['kampung'],'no_rumah' => $_POST['no_rumah'],
                                          'rt' => $_POST['rt'],'rw' => $_POST['rw'],'desa' => $_POST['desa'],
                                          'kode_pos' => $_POST['kode_pos'],'kecamatan' => $_POST['kecamatan'],
                                           'kabupaten_kota' => $_POST['kabupaten_kota'],'provinsi' => $_POST['provinsi'],),
                            'jabatan' => 'D',
                            kode_kelas =>$kdk,
                            kode_mk => $kmk,
                            'email' => $_POST['email'],
                            'akun' => (object)array('username' => $_POST['nip'],'password' => $_POST['password'])
                  
                        ]);}

                        catch (exception $e){
                            $has_errors = true;   
                        }

                    if ($has_errors==false){
                        echo"
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                           <b>Data Dosen Berhasil Ditambahkan</b>
                           <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                           <span aria-hidden='true'>&times;</span>
                         </button>
                        </div>
                         
                       
                        ";
                        
                       }else if($has_errors!==false){
                        echo"
                        <div class='alert alert-danger'alert-dismissible fade show' role='alert'>
                            <b>Data Dosen Tidak Berhasil Ditambahkan</b>.Mohon Cek Kembali Pengisian Data Agar Tidak Ada Yang Duplikat</a>.
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Dosen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form method="POST">
                        <div class="form-group">
                            <strong>NIP</strong>
                            <input type="text" class="form-control"
                             value="<?php 
                                foreach ($sequence_id_pegawai as $sidpg){
                                    $sidpgw = $sidpg->nip;
                                    $urutan = (int) substr($sidpgw,3,4);
                                    $urutan++;
                                    $huruf ="PGW";
                                    $sidpgw = $huruf . sprintf("%04s", $urutan);
                                    echo $sidpgw;
                                 }
                                    ?>"
                                        name="nip" readonly>

                         </div>
                        <div class="form-row">          
                            <div class="form-group col-md-6">
                                <strong>Nama Dosen</strong>
                                <input type="text" class="form-control" name="nama_pgw" required="" placeholder="Nama Dosen">
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
                        
                        
                        <strong> Kelas</strong>
                        <table id="form-body">
                                    <tr id="add_select"> 
                                    
                                        <td>
                                            <select name="kode_kelas[]" class="form-control" required>
                                                <option value="" disabled selected> Pilih  Kelas</option>
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
                                        </td>
                                        
                                    
                                    </tr>
                            </table>        
               
               <strong> Mata Kuliah</strong>
               <table id="form-body2">
                        <tr id="add_select2">
                            <td>
                                <select name="kode_mk[]" class="form-control" required>
                                    <option value="" disabled selected> Pilih  Mata Kuliah</option>
                                    <?php
                                          $matakuliah = $collection ->matakuliah->find([]);

                                          foreach($matakuliah as $mkl){
                                              echo "<option value='$mkl->kode_mk'>$mkl->kode_mk - $mkl->nama_mk</option>";
                                          }
                                    ?>
                                </select>
                            </td>
                                
                        </tr>
                </table>         
                               
 
                    </div>
                                    <div class="modal-footer">
                                         <div class="btn-group" style="margin-right:310px;">
                                             <button type="button" onclick="add_form()"  class="btn btn-primary">Tambah Kelas</button>
                                                &nbsp
                                             <button type="button" onclick="add_form2()"   class="btn btn-info">Tambah Mata Kuliah</button>
                                        </div>
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                             <button type="submit" name="submit" class="btn btn-success">Tambah</button>
                                    </div>
                             </form>
                                        </div>
                                    </div>
                                    </div>
                <!-- Close Modal Tambah Dosen -->
                
                
        <!-- Modal Tambah Admin -->
        <?php 
                    
                    require '../../vendor/autoload.php';
                    require '../../model/connect.php';
                    #kode otomatsi untuk pegawai
                    $sequence_id_pegawai = $collection ->pegawai->find([],['limit'=>1,'sort'=>['nip'=>-1]]);

                    if(isset($_POST['submitAdmin'])){
                       
                         
                         $has_errors = false;   

                         try{$insertOneResult = $collection->pegawai->insertOne([
                            'nip' => $_POST['nip'],
                            'nama_pgw' => $_POST['nama_pgw'],
                            'jk' => $_POST['jk'],
                            'no_telp' => $_POST['no_telp'],
                            'nama_pgw' => $_POST['nama_pgw'],
                            'alamat' => (object)array('kampung' => $_POST['kampung'],'no_rumah' => $_POST['no_rumah'],
                                          'rt' => $_POST['rt'],'rw' => $_POST['rw'],'desa' => $_POST['desa'],
                                          'kode_pos' => $_POST['kode_pos'],'kecamatan' => $_POST['kecamatan'],
                                           'kabupaten_kota' => $_POST['kabupaten_kota'],'provinsi' => $_POST['provinsi'],),
                            'jabatan' => 'A',
                            'email' => $_POST['email'],
                            'akun' => (object)array('username' => $_POST['nip'],'password' => $_POST['password'])
                  
                        ]);}

                        catch (exception $e){
                            $has_errors = true;   
                        }

                    if ($has_errors==false){
                        echo"
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                           <b>Data Admin Berhasil Ditambahkan</b>
                           <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                           <span aria-hidden='true'>&times;</span>
                         </button>
                        </div>
                         
                       
                        ";
                        
                       }else if($has_errors!==false){
                        echo"
                        <div class='alert alert-danger'alert-dismissible fade show' role='alert'>
                            <b>Data Admin Tidak Berhasil Ditambahkan</b>.Mohon Cek Kembali Pengisian Data Agar Tidak Ada Yang Duplikat</a>.
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

                
                <div class="modal fade bd-example-modal-lg" id="exampleModalAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form method="POST">
                        <div class="form-group">
                            <strong>NIP</strong>
                            <input type="text" class="form-control"
                             value="<?php 
                                foreach ($sequence_id_pegawai as $sidpg){
                                    $sidpgw = $sidpg->nip;
                                    $urutan = (int) substr($sidpgw,3,4);
                                    $urutan++;
                                    $huruf ="PGW";
                                    $sidpgw = $huruf . sprintf("%04s", $urutan);
                                    echo $sidpgw;
                                 }
                                    ?>"
                                        name="nip" readonly>

                         </div>
                        <div class="form-row">          
                            <div class="form-group col-md-6">
                                <strong>Nama Admin</strong>
                                <input type="text" class="form-control" name="nama_pgw" required="" placeholder="Nama Admin">
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
                        
                        
                        
                               
 
                    </div>
                                    <div class="modal-footer">
                                         
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                             <button type="submit" name="submitAdmin" class="btn btn-success">Tambah</button>
                                    </div>
                             </form>
                                        </div>
                                    </div>
                                    </div>
                <!-- Close Modal Tambah Admin -->

                <div class="container">
                <form class = "post-list">
                    <input type = "hidden" value = "" />
                </form><br>
                <a href="v_admin.php" type = "submit" class = "btn btn-primary post_search_submit"><i class="fa fa-reply"></i> Kembali Ke Beranda</a>
                <p><h3 align=center><b>Data Dosen</b></h3><br>
                
                <button  type="button"  class="btn btn-success" data-toggle="modal" data-target="#exampleModalDosen"><i class="fa fa-plus"></i> Tambah Data Baru</button>

                <a href="v_admin_cetak_dsn.php" ><button type="button" class="btn btn-warning"> <i class="fa fa-print"></i> Cetak Data</button></a> <br><br>
          
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
                    <th>Kode Kelas</th>
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
                echo $dsn->PegawaiKelas[$kdk]->kode_kelas."<br>";
              }
           echo "</td>";

           echo "<td>"; 
            for ($x = 0; $x < 10; $x++) {
                if ($dsn->kode_mk[$x]==null) {
               break;
                }
                echo $dsn->PegawaiMatkul[$x]->kode_mk."<br>";
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
        <button  type="button"  class="btn btn-success" data-toggle="modal" data-target="#exampleModalAdmin"><i class="fa fa-plus"></i> Tambah Data Baru</button>
        <a href="v_admin_cetak_adm.php" ><button type="button" class="btn btn-warning"> <i class="fa fa-print"></i> Cetak Data</button></a> <br><br>
                
     
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

<script type="text/javascript">
        function add_form()
        {
            var html = '';
 
            html += '<tr>';
            //html += '<td><input type="text" class="form-control"name="kode_kelas[]" placeholder="Kode Kelas "></td>';
            html += document.getElementById("add_select").innerHTML 
            html += '<td><button type="button" class="btn btn-danger" onclick="del_form(this)">Hapus</button></td>';
            html += '</tr>';
 
            $('#form-body').append(html);
        }
 
        function del_form(id)
        {
            id.closest('tr').remove();
        }

        function add_form2()
        {
            var html = '';
 
            html += '<tr>';
            //html += '<td><input type="text" class="form-control" name="kode_mk[]" placeholder="Kode Mata Kuliah "></td>';
            html += document.getElementById("add_select2").innerHTML 
            html += '<td><button type="button" class="btn btn-danger" onclick="del_form2(this)">Hapus</button></td>';
            html += '</tr>';
 
            $('#form-body2').append(html);
        }
 
        function del_form2(id)
        {
            id.closest('tr').remove();
        }
    </script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
        <?php require_once('footer.php'); ?>
    </body> 
</html>
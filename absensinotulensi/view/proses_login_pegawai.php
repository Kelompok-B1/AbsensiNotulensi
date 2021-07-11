<?php 
session_start();
require '../vendor/autoload.php';
require '..//model/connect.php';


$username = $_POST['username'];
$password = $_POST['password'];
 
/*$mhs= $collection->mahasiswa->aggregate([
    ['$match'=>(object)array('akun' => (object)array('username' => $username,'password' =>$password))]
    ]); 
*/
 
$pegawai  = $collection->pegawai->find(['akun' => (object)array('username' => $username,'password' => $password)]);

foreach ($pegawai as $pgw) {
    $_SESSION['nama']=$pgw->nama_pgw;
    $_SESSION['nip']=$pgw->nip;
    $_SESSION['jabatan']=$pgw->jabatan;
    $_SESSION['status_login'] = "sudah_login";
    $storedUsername = $pgw->akun->username;
    $storedPassword = $pgw->akun->password;

    
    }  
    
    if($username !== $storedUsername && $password !== $storedPassword){
        header("Location:login_pegawai.php?pesan=gagal");

    }else if($username == $storedUsername && $password == $storedPassword && $_SESSION['jabatan']=='D'){ 
    
        echo "<script>
        window.alert('Anda Behasil Login ! Anda Akan Diarahkan Ke Halaman Dosen');
        window.location.href='dosen/v_dosen.php';
        </script>";

    }else if($username == $storedUsername && $password == $storedPassword && $_SESSION['jabatan']=='A'){ 
    
            echo "<script>
            window.alert('Anda Behasil Login ! Anda Akan Diarahkan Ke Halaman Admin');
            window.location.href='admin/v_admin.php';
            </script>";
        
        }
   


?>


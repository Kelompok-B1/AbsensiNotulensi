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
 
$mahasiswa  = $collection->mahasiswa->find(['akun' => (object)array('username' => $username,'password' => $password)]);

foreach ($mahasiswa as $mhs) {
    $_SESSION['nama']=$mhs->nama_mhs;
    $_SESSION['nim']=$mhs->nim;
    $_SESSION['status_login'] = "sudah_login";
    $storedUsername = $mhs->akun->username;
    $storedPassword = $mhs->akun->password;

    
    }  
    
    if($username !== $storedUsername && $password !== $storedPassword){
        header("Location:login_mahasiswa.php?pesan=gagal");
    }
    else if($username == $storedUsername && $password == $storedPassword){ 
    
        echo "<script>
        window.alert('Anda Behasil Login ! Anda Akan Diarahkan Ke Halaman Mahasiswa');
        window.location.href='mahasiswa/v_mahasiswa.php';
        </script>";
        //header('Location:mahasiswa/v_mahasiswa.php');  window.location.href='mahasiswa/v_mahasiswa.php';
        
        }
        
    
   


?>


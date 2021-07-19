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
 
$mahasiswa= $collection->mahasiswa->aggregate([
    ['$lookup'=>(object)array(
                'from'=> "kelas",
                'localField'=> "kode_kelas",    
                'foreignField'=> "kode_kelas",  
                'as'=> "KelasMahasiswa"
    )],

    

    ['$replaceRoot'=>(object)array('newRoot'=>(object)array('$mergeObjects'=>array((object)
    array('$arrayElemAt'=>array('$KelasMahasiswa',0)),'$$ROOT')))],

    ['$project'=>(object)array('{KelasMahasiswa}'=>0)],

    ['$lookup'=>(object)array(
        'from'=> "prodi",
        'localField'=> "kode_prodi",    
        'foreignField'=> "kode_prodi",  
        'as'=> "ProdiMahasiswa"
    )],

    ['$replaceRoot'=>(object)array('newRoot'=>(object)array('$mergeObjects'=>array((object)
    array('$arrayElemAt'=>array('$ProdiMahasiswa',0)),'$$ROOT')))],
    
   
    ['$project'=>(object)array('{ProdiMahasiswa}'=>0)],

    ['$match'=>array('akun' => (object)array('username' => $username,'password' => $password))],


    ]);
foreach ($mahasiswa as $mhs) {
    $_SESSION['nama']=$mhs->nama_mhs;
    $_SESSION['nim']=$mhs->nim;
    $_SESSION['status_login'] = "sudah_login";
    $_SESSION['kode_kelas'] =$mhs->kode_kelas;
    $_SESSION['nama_kelas'] =$mhs->nama_kelas;
    $_SESSION['nama_prodi'] =$mhs->nama_prodi;
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


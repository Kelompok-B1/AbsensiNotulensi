<?php
 //require 'v_mahasiswa_tampil_absensi.php';
 require '../../vendor/autoload.php';
 require '../../model/connect.php';

//set random name for the image, used time() for uniqueness
//require_once('db.php'); 
$filename = 'andika.jpg';
$filepath = 'images/selfie/';
$dir = $filepath.$filename;
if(!is_dir($filepath))
	mkdir($filepath);
if(isset($_FILES['webcam'])){	
	move_uploaded_file($_FILES['webcam']['tmp_name'], $filepath.$filename);
	
}
if(isset($_POST['submit'])){
    $insertOneResult = $collection->absensi->insertOne([
    'url_photo' => 'andika'
    ]);


    if ($insertOneResult){
        echo "<script>
        alert('There are no fields to generate a report');
        window.location.href='v_mahasiswa.php';

        
        </script>";
        
    }
 }

?>

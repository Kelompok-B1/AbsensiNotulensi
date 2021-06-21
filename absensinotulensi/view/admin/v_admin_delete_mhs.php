<?php

require '../../model/connect.php';

$collection->mahasiswa->deleteOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);

header("Location: v_admin_tampil_mhs.php");


?>
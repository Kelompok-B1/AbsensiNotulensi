<?php

require '../../model/connect.php';

$collection->jadwal_absensi->deleteOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);

header("Location: v_admin_tampil_jda.php");


?>
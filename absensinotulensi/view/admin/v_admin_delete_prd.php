<?php

require '../../model/connect.php';

$collection->prodi->deleteOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);

header("Location: v_admin_tampil_prd.php");


?>
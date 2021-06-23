<?php

require '../../model/connect.php';

$collection->jurusan->deleteOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);

header("Location: v_admin_tampil_jrs.php");


?>
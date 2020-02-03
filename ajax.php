<?php
require 'db.php';
$start = $_GET['start'];
$end = $_GET['end'];
$sql = "SELECT * FROM Supply WHERE (created_at BETWEEN '" . $start . "' AND '" . $end ."')";
$supplies = query($db, $sql);
echo json_encode($supplies);
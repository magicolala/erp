<?php
require_once './db.php';
$last_connect = date('Y-m-d H:i:s');
$id = $_SESSION['auth']->id;
$sql = "UPDATE User SET last_connect = ? WHERE id = ?";
$q = $db->prepare($sql);
$q->execute(array($last_connect, $id));
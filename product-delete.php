<?php
require_once './db.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if ($id) {
    $sql = "UPDATE Product SET deleted = true WHERE id = ?";
    $q = $db->prepare($sql);
    $q->execute(array($id));
    logBDD($db, 'deleted', "Product");
    header("Location: products.php");
} else {
    die('Echec product delete');
}
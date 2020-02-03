<?php
require_once './db.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if ($id) {
    $sql = "UPDATE Category SET deleted = true WHERE id = ?";
    $q = $db->prepare($sql);
    $q->execute(array($id));
    logBDD($db, 'deleted', "Category");
    header("Location: categories.php");
} else {
    die('Echec category delete');
}
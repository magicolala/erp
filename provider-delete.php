<?php
require_once './db.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if ($id) {
    $sql = "UPDATE Provider SET deleted = true WHERE id = ?";
    $q = $db->prepare($sql);
    $q->execute(array($id));
    logBDD($db, 'deleted', "Provider");
    header("Location: providers.php");
} else {
    die('Echec fournisseur delete');
}
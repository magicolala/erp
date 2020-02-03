<?php
require_once './db.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if ($id) {
    $sql = "UPDATE Invoice SET deleted = true WHERE id = ?";
    $q = $db->prepare($sql);
    $q->execute(array($id));
    logBDD($db, 'deleted', "Invoice");
    header("Location: invoices.php");
} else {
    die('Echec facture delete');
}
<?php
require_once './db.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if ($id) {
    $sql = "UPDATE Quotation SET deleted = true WHERE id = ?";
    $q = $db->prepare($sql);
    $q->execute(array($id));
    logBDD($db, 'deleted', "Quotation");
    header("Location: quotations.php");
} else {
    die('Echec devis delete');
}
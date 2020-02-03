<?php
require_once './db.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $reference = htmlentities(trim($_POST['reference']));
    $client_id = htmlentities(trim($_POST['client_id']));
    $total = htmlentities(trim($_POST['totalHT']));
//    $created_at = date("Y-m-d H:i:s");
//    $status = 'created';
    $user_id = 1;
    $sql = "UPDATE Quotation SET reference = ?, client_id = ?, totalHT = ? WHERE id = ?";
    $q = $db->prepare($sql);
    $q->execute(array($reference, $client_id, $total, $id));
    logBDD($db, 'updated', "Quotation");
    header("Location: quotations.php");
}
else {
    die('Echec Devis update');
}
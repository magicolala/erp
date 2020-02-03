<?php
require_once './db.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

$quotation = query($db, 'SELECT * FROM Quotation WHERE id='. $id)[0];
$quotation = query($db, 'SELECT * FROM Quotation WHERE id='. $id)[0];

$quotationDetails = query($db, 'SELECT * FROM DetailsQuotation WHERE quotation_id =' . $quotation->id);

$client_id = $quotation->client_id;
$reference = 'INVOICE'.date('ymdHis');
$created_at = date('Y-m-d H:i:s');
$status = 'created';
$total = $quotation->totalHT;
$user_id = $_SESSION['auth']->id;
$sql = "INSERT INTO Invoice (reference, client_id, totalHT, created_at, status, user_id) values(?, ?, ?, ?, ?, ?)";
$q = $db->prepare($sql);
$q->execute(array($reference, $client_id, $total, $created_at, $status, $user_id));
logBDD($db, 'created', "Invoice");
header("Location: invoices.php");


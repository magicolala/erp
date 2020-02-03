<?php
require_once './db.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $name = htmlentities(trim($_POST['name']));
    $code_iso = htmlentities(trim($_POST['code_iso']));
    $sql = "UPDATE Provider SET name = ?, code_iso = ? WHERE id = ?";
    $q = $db->prepare($sql);
    $q->execute(array($name, $code_iso, $id));
    logBDD($db, 'updated', "Provider");
    header("Location: providers.php");
}
else {
    die('Echec fournisseur update');
}
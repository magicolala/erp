<?php
require_once './db.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $firstname = htmlentities(trim($_POST['firstname']));
    $lastanme = htmlentities(trim($_POST['lastname']));
    $iso = htmlentities(trim($_POST['code_iso']));
    $email = htmlentities(trim($_POST['email']));
    $siret = htmlentities(trim($_POST['siret']));
    $adresse = htmlentities(trim($_POST['adresse']));
    $sold = htmlentities(trim($_POST['sold']));
    $sql = "UPDATE Client SET firstname = ?, lastname = ?, code_iso = ?, email = ?, siret = ?, adresse = ?, sold = ? WHERE id = ?";
    $q = $db->prepare($sql);
    $q->execute(array($firstname, $lastanme, $iso, $email, $siret, $adresse, $sold, $id));
    logBDD($db, 'updated', "Client");
    header("Location: clients.php");
}
else {
    die('Echec client update');
}
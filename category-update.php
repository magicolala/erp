<?php
require_once './db.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $name = htmlentities(trim($_POST['name']));
    $sql = "UPDATE Category SET name = ? WHERE id = ?";
    $q = $db->prepare($sql);
    $q->execute(array($name, $id));
    logBDD($db, 'updated', "Category");
    header("Location: categories.php");
}
else {
    die('Echec category update');
}
<?php
require_once './db.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $barcode = htmlentities(trim($_POST['barcode']));
    $reference = htmlentities(trim($_POST['reference']));
    $id_category = htmlentities(trim($_POST['category']));
    $stock = htmlentities(trim($_POST['stock']));
    $purchase_price = htmlentities(trim($_POST['purchase_price']));
    $price_HT = htmlentities(trim($_POST['price_HT']));
    if (!empty($_POST['image'])) {
        $image = htmlentities(trim($_POST['image']));
    } else {
        $image = NULL;
    }
    $min_stock = htmlentities(trim($_POST['stock_min']));
    $sql = "UPDATE Product SET barcode = ?, reference = ?, id_category = ?, stock = ?, purchase_price = ?, price_HT = ?, image = ?, min_item_product = ? WHERE id = ?";
    $q = $db->prepare($sql);
    $q->execute(array($barcode, $reference, $id_category, $stock, $purchase_price, $price_HT, $image, $min_stock, $id));
    logBDD($db, 'updated', "Product");
    header("Location: products.php");
}
else {
    die('Echec produit update');
}
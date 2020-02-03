<?php
//require_once 'db.php';
////Product
////for ($i = 0; $i < 30; $i++) {
////    $barcode = '123456798' .$i ;
////    $reference = 'Product' . $i;
////    $id_category = random_int(0,2);
////    $stock = random_int(0, 20);
////    $purchase_price = random_int(5, 200);
////    $price_HT = random_int(5, 200);
////    $min_stock = random_int(1,5);
////    $sql = "INSERT INTO Product (barcode, reference, id_category, stock, purchase_price, price_HT, image, min_item_product) values(?, ?, ?, ?, ?, ?, ?, ?)";
////    $q = $db->prepare($sql);
////    $q->execute(array($barcode, $reference, $id_category, $stock, $purchase_price, $price_HT, null, $min_stock));
////}
//
////Clients
////for ($i = 0; $i < 20; $i++) {
////    $firstname = 'Prenom'.$i;
////    $lastanme = 'Nom'.$i;
////    $iso = $isoo[random_int(0,3)];
////    $email = $firstname . '.' . $lastanme . '@gmail.com';
////    $siret = '12345678910'.$i;
////    $adresse = $i . 'rue Voltaire Paris';
////    $sold = random_int(-200, 3000);
////    $sql = "INSERT INTO Client (firstname, lastname, code_iso, email, siret, adresse, sold) values(?, ?, ?, ?, ?, ?, ?)";
////    $q = $db->prepare($sql);
////    $q->execute(array($firstname, $lastanme, $iso, $email, $siret, $adresse, $sold));
////}
//
//// Quotation
//for ($i = 0; $i < 1; $i++) {
//    $client_id = random_int(64, 103);
//    $timestamp = mt_rand(1548759525 * 1000, time());
//    $created_at = date("d-M-Y H:i:s", $timestamp);
//    $status = 'created';
//    $id_users = array(1,2,4,5);
//    $user_id = $id_users[random_int(0,3)];
//    $total = random_int(20,2000);
//
//    $reference = 'DEVIS' . date('ymdHi') . $i;
//
//    $sql = "INSERT INTO Quotation (reference, client_id, totalHT, created_at, status, user_id) values(?, ?, ?, ?, ?, ?)";
//    $q = $db->prepare($sql);
//    $q->execute(array($reference, $client_id, $total, $created_at, $status, $user_id));
//    $quotationId = $db->lastInsertId();
//    for ($i = 0; $i <= 5; $i++) {
//        $amount = random_int(20, 200);
//        $price = random_int(20, 200);
//        $product_id = random_int(55,84);
//        $sql = "INSERT INTO DetailsQuotation (quotation_id, product_id, amount, price) values(?, ?, ?, ?)";
//        $q = $db->prepare($sql);
//        $q->execute(array($quotationId, $product_id, $amount, $price));
//    }
//}
//
//
//

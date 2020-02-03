<?php
require_once './db.php';
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
    $sql = "INSERT INTO Product (barcode, reference, id_category, stock, purchase_price, price_HT, image, min_item_product) values(?, ?, ?, ?, ?, ?, ?, ?)";
    $q = $db->prepare($sql);
    $q->execute(array($barcode, $reference, $id_category, $stock, $purchase_price, $price_HT, $image, $min_stock));
    $product_id = $db->lastInsertId();
    logBDD($db, 'created', "Product");
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_GET['barcode'])) {
        header("Location: supply-add.php?id_product=".$product_id);
    } else {
        header("Location: products.php");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET)) {
    $code_bar = $_GET['barcode'];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Ajouter un produit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <?php include "partials/header-link.php" ?>

</head>

<body>

<!-- Begin page -->
<div id="wrapper">

    <!-- Topbar Start -->
    <?php include('topbar.php') ?>
    <!-- end Topbar -->

    <!-- ========== Left Sidebar Start ========== -->
    <?php include('sidebar.php') ?>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Produits</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Ajouter</a></li>
                                </ol>
                            </div>
                            <h4 class="page-title">Ajouter un produit</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Ajouter un produit</h4>
                            <form class="form-horizontal" method="POST">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="productRef">Réference du produit <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="productRef"
                                               placeholder="Référence du produit" required name="reference">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="category">Catégorie <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <?php
                                            $categories = query($db,'SELECT * FROM Category WHERE deleted IS NOT true');
                                        ?>
                                        <select name="category" id="category" class="form-control" required>
                                            <option value="" disabled selected>Sélectionnez une catégorie</option>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= $category->id ?>"><?= $category->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="stock">Stock <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="number" name="stock" id="stock" class="form-control" placeholder="Stock" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="purchase_price" >Prix d'achat <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="number" name="purchase_price" id="purchase_price" class="form-control" placeholder="Prix d'achat" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="price_HT">Prix de vente <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="number" name="price_HT" id="price_HT" class="form-control" placeholder="Prix de vente" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="stock_min">Minimum de stock <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="number" name="stock_min" id="stock_min" class="form-control" placeholder="Minimum de stock" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="image">Image</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="image" id="image" class="form-control" placeholder="Image">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="codebar">Code barre <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="codebar"
                                               placeholder="Code barre du produit" required name="barcode" value="<?php if (isset($code_bar)) echo $code_bar; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="offset-sm-2"></div>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-success">Créer</button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- end card-box -->
                    </div><!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <?php include('footer.php') ?>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="right-bar-toggle float-right">
            <i class="mdi mdi-close"></i>
        </a>
        <h5 class="m-0 text-white">Settings</h5>
    </div>
    <div class="slimscroll-menu">
        <!-- User box -->
        <div class="user-box">
            <div class="user-img">
                <img src="assets/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme"
                     class="rounded-circle img-fluid">
                <a href="javascript:void(0);" class="user-edit"><i class="mdi mdi-pencil"></i></a>
            </div>

            <h5><a href="javascript: void(0);">Agnes Kennedy</a></h5>
            <p class="text-muted mb-0"><small>Admin Head</small></p>
        </div>

        <!-- Settings -->
        <hr class="mt-0"/>
        <h5 class="pl-3">Basic Settings</h5>
        <hr class="mb-0"/>


        <div class="p-3">
            <div class="checkbox checkbox-primary mb-2">
                <input id="checkbox1" type="checkbox" checked>
                <label for="checkbox1">
                    Notifications
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-2">
                <input id="checkbox2" type="checkbox" checked>
                <label for="checkbox2">
                    API Access
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-2">
                <input id="checkbox3" type="checkbox">
                <label for="checkbox3">
                    Auto Updates
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-2">
                <input id="checkbox4" type="checkbox" checked>
                <label for="checkbox4">
                    Online Status
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-0">
                <input id="checkbox5" type="checkbox" checked>
                <label for="checkbox5">
                    Auto Payout
                </label>
            </div>
        </div>

        <!-- Timeline -->
        <hr class="mt-0"/>
        <h5 class="pl-3 pr-3">Messages <span class="float-right badge badge-pill badge-danger">25</span></h5>
        <hr class="mb-0"/>
        <div class="p-3">
            <div class="inbox-widget">
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="assets/images/users/avatar-1.jpg" class="rounded-circle"
                                                     alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Chadengle</a></p>
                    <p class="inbox-item-text">Hey! there I'm available...</p>
                    <p class="inbox-item-date">13:40 PM</p>
                </div>
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="assets/images/users/avatar-2.jpg" class="rounded-circle"
                                                     alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Tomaslau</a></p>
                    <p class="inbox-item-text">I've finished it! See you so...</p>
                    <p class="inbox-item-date">13:34 PM</p>
                </div>
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="assets/images/users/avatar-3.jpg" class="rounded-circle"
                                                     alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Stillnotdavid</a></p>
                    <p class="inbox-item-text">This theme is awesome!</p>
                    <p class="inbox-item-date">13:17 PM</p>
                </div>

                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="assets/images/users/avatar-4.jpg" class="rounded-circle"
                                                     alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Kurafire</a></p>
                    <p class="inbox-item-text">Nice to meet you</p>
                    <p class="inbox-item-date">12:20 PM</p>

                </div>
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="assets/images/users/avatar-5.jpg" class="rounded-circle"
                                                     alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Shahedk</a></p>
                    <p class="inbox-item-text">Hey! there I'm available...</p>
                    <p class="inbox-item-date">10:15 AM</p>

                </div>
            </div> <!-- end inbox-widget -->
        </div> <!-- end .p-3-->

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
<?php include "partials/scripts.php"; ?>

</body>
</html>
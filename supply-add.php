<?php
$display = 0;
$noSupply = true;
require_once ('db.php');

if ($_SERVER["REQUEST_METHOD"] == 'GET' && !empty($_GET['id_product'])) {
    $product = query($db, 'SELECT * FROM Product WHERE id = '. $_GET['id_product'])[0];
    $display = 1;
    $supplies = query($db, 'SELECT * FROM Supply WHERE product_id ='. $product->id);
    $code_bar = $product->barcode;
    if (empty($supplies)) {
        $noSupply = true;
        $providers = query($db, 'SELECT * FROM Provider WHERE deleted IS NOT true');
    } else {
        $noSupply = false;
        $supply = $supplies[count($supplies) - 1];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['product'])) {
    $code_bar = htmlentities(trim($_POST['product']));
    $product = query($db, 'SELECT * FROM Product WHERE deleted IS NOT true AND barcode = '. $code_bar);
    $providers = query($db, 'SELECT * FROM Provider WHERE deleted IS NOT true');
    logBDD($db, 'created', "Supply");

    if (!$product) {
        $display = 2;
    } else {
        $product = $product[0];
        $display = 1;
        $supplies = query($db, 'SELECT * FROM Supply WHERE deleted IS NOT true AND product_id ='. $product->id);

        if (empty($supplies)) {
            $noSupply = true;
        } else {
            $noSupply = false;
            $supply = $supplies[count($supplies) - 1];
            $date = new Datetime($supply->created_at);
            $date = $date->format('Y-m-d');
            $now = new DateTime();
            $now = $now->format('Y-m-d');
            $warning = false;
            if ($date == $now) {
                $warning = true;
            }
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == 'POST' && !empty($_POST['amount'])) {
    $amount = htmlentities(trim($_POST['amount']));
    $amount_provider = htmlentities(trim($_POST['purchasePrice']));
    $provider_id = htmlentities(trim($_POST['provider_id']));
    $product_ref = htmlentities(trim($_POST['reference']));
    $product = query($db, 'SELECT * FROM Product WHERE reference = '. $product_ref)[0];
    $price = $product->price_HT;
    $date = date('Y-m-d H:i:s');
    $sql = "INSERT INTO Supply (in_stock, amount_provider, id_provider, price, created_at, product_id) values(?, ?, ?, ?, ?, ?)";
    $q = $db->prepare($sql);
    $q->execute(array($amount, $amount_provider, $provider_id, $price, $date, $product->id));
    header('location: supplies.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Ajouter une entrée de stock</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php include "partials/header-link.php"; ?>
</head>

<body>

<!-- Begin page -->
<div id="wrapper">

    <!-- Topbar Start -->
    <?php include ('topbar.php') ?>
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
                                    <li class="breadcrumb-item active">Ajouter entrée de stock</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Ajouter une entrée de stock</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Ajouter une entrée de stock</h4>

                            <form class="form-horizontal" method="POST" action="supply-add.php">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="product">Code barre</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="product" class="form-control" id="product" placeholder="Code barre du produit" required <?php if ($display == 1) echo 'value=' . $product->barcode ?>>
                                        <?php
                                            if ($display == 2) {
                                                echo '<small class="text-danger">Le produit n\'existe pas</small><br>';
                                                echo '<a href="product-add.php?barcode=' . $code_bar . '" class="btn btn-success mt-2">Ajouter ce produit</a>';
                                            }
                                        ?>
                                        <button type="submit" class="btn btn-success" style="display: none;"></button>
                                    </div>
                                </div>
<!--                                <div class="row">-->
<!--                                    <div class="offset-sm-2"></div>-->
<!--                                    <div class="col-sm-6">-->
<!--                                        <button type="submit" class="btn btn-success">Créer</button>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </form>

                            <?php if ($display== 1) :?>
                                <?php if ($noSupply == false): ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-box">

                                                <div class="table-responsive" >
                                                    <table class="table mb-0">
                                                        <?php
                                                        if ($warning) echo '<caption class="text-danger">Attention une entrée de stock à déjà été enregistrer pour ce produit aujourd\'hui</caption>';
                                                        ?>
                                                        <thead class="thead-light">
                                                        <tr>
                                                            <th>Nom du produit</th>
                                                            <th>Ancien prix d'achat</th>
                                                            <th>Quantité minimal</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td><?= $product->reference ?></td>
                                                            <td><?= $supply->amount_provider ?></td>
                                                            <td><?= $product->min_item_product ?></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div> <!-- end card-box -->
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-box">

                                            <form class="form-horizontal" method="POST" action="supply-add.php">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="reference">Reference</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" readonly="" name="reference" class="form-control" value="<?= $product->reference; ?>" id="reference">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="amount">Quantité</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Saisir la quantité">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="purchasePrice">Prix d'achat</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" id="purchasePrice" name="purchasePrice" placeholder="Saisir le prix d'achat">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="provider">Fournisseur</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" name="provider_id" id="provider">
                                                            <option value="" selected disabled>Veuillez choisir un fournisseur</option>
                                                            <?php foreach ($providers as $provider) :?>
                                                                <option value="<?= $provider->id;?>" <?php if (!$noSupply && $supply->id_provider == $provider->id) echo 'selected' ?> ><?= $provider->name;?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="offset-sm-2"></div>
                                                    <div class="col-sm-10">
                                                        <button type="submit" class="btn btn-success">Ajouter l'entrée de stock</button>
                                                    </div>

                                                </div>
                                            </form>

                                        </div> <!-- end card-box -->
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                            <?php endif;?>

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
<?php include "partials/right-sidebar.php"; ?>
<!-- /Right-bar -->

<?php include 'partials/scripts.php' ?>
<script>
<?php if ($display == 0):  ?>
    $('#product').focus();
<?php elseif ($display == 1): ?>
    $('#amount').focus();
<?php endif; ?>
</script>
</body>
</html>
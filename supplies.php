<?php
require_once './db.php';
$supplies = query($db, 'SELECT * FROM Supply WHERE deleted IS NOT true');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Entrée de stock</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <?php include "partials/header-link.php"; ?>
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
                <div class="row">
                    <div class="col-12">

                    </div>
                </div>
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Entrée de stock</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript: void(0);">Liste des entrées de stock</a></li>
                                </ol>
                            </div>
                            <h4 class="page-title">Stock</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <h4 class="header-title float-left">Stock</h4>
                                    <a href="supply-add.php" class="btn btn-success waves-effect waves-light float-right">
                                        <span>Ajouter</span>&nbsp;&nbsp;<i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <table id="datatable-buttons"
                                   class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Produit</th>
                                    <th>Prix</th>
                                    <th>Fournisseur</th>
                                    <th>Stock</th>
                                    <th>Montant fournisseur</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($supplies as $supply):
                                    $product = query($db, 'SELECT * FROM Product WHERE id =' . $supply->product_id)[0];
                                    $provider = query($db, 'SELECT * FROM Provider WHERE id =' . $supply->id_provider)[0];
                                ?>
                                    <tr>
                                        <td><?= $supply->id ?></td>
                                        <td><?= $product->reference ?></td>
                                        <td><?= $supply->price ?></td>
                                        <td><?= $provider->name ?></td>
                                        <td><?= $supply->in_stock ?></td>
                                        <td><?= $supply->amount_provider ?></td>
                                        <td><?= $supply->created_at ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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


<?php include "partials/right-sidebar.php" ?>

<?php include "partials/scripts.php"; ?>

</body>
</html>
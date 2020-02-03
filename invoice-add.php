<?php
require_once ('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $reference = htmlentities(trim($_POST['reference']));
    $client_id = htmlentities(trim($_POST['client_id']));
    $total = htmlentities(trim($_POST['totalHT']));
    $created_at = date("Y-m-d H:i:s");
    $status = 'created';
    $user_id = 1;
    $sql = "INSERT INTO Invoice (reference, client_id, totalHT, created_at, status, user_id) values(?, ?, ?, ?, ?, ?)";
    $q = $db->prepare($sql);
    $q->execute(array($reference, $client_id, $total, $created_at, $status, $user_id));
    logBDD($db, 'created', "Invoice");
    header("Location: invoices.php");
}
$clients = query($db, 'SELECT * FROM Client WHERE deleted IS NOT true');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Ajouter une facture</title>
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Facture</a></li>
                                    <li class="breadcrumb-item active">Ajouter</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Ajouter une facture</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Ajouter une facture</h4>

                            <form class="form-horizontal" method="POST" action="invoice-add.php">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="reference">Reference</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="reference" class="form-control" id="reference" placeholder="Reference" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="client_id">Client</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" id="client_id" name="client_id" required>
                                            <option value="" selected disabled>Sélectionnez un client</option>
                                            <?php foreach ($clients as $client): ?>
                                                <option value="<?= $client->id ?>"><?= $client->firstname ?>&nbsp;<?= $client->lastname ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="totalHT">Total</label>
                                    <div class="col-sm-6">
                                        <input type="number" name="totalHT" class="form-control" id="totalHT" placeholder="Total" required>
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
<?php include "partials/right-sidebar.php"; ?>
<!-- /Right-bar -->

<?php include 'partials/scripts.php' ?>

</body>
</html>
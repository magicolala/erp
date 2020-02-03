<?php
require_once './db.php';
$invoices = query($db, 'SELECT * FROM Invoice WHERE deleted IS NOT true');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Liste des factures</title>
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Factures</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript: void(0);">Liste des factures</a></li>
                                </ol>
                            </div>
                            <h4 class="page-title">Factures</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <h4 class="header-title float-left">Factures</h4>
                                    <a href="invoice-add.php" class="btn btn-success waves-effect waves-light float-right">
                                        <span>Ajouter</span>&nbsp;&nbsp;<i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Client</th>
                                    <th>Reference</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>total</th>
                                    <th>Administrateur</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($invoices as $invoice): ?>
                                    <tr>
                                        <td><?= $invoice->id ?></td>
                                        <td><?= $invoice->client_id ?></td>
                                        <td><?= $invoice->reference ?></td>
                                        <td><?= $invoice->created_at ?></td>
                                        <td><?= $invoice->status ?></td>
                                        <td><?= $invoice->totalHT ?></td>
                                        <td><?= getUserName($db, $invoice->user_id) ?></td>
                                        <td class="text-center">
                                            <a href="invoice-edit.php?id=<?= $invoice->id ?>" class="btn btn-info">Modifier&nbsp;&nbsp;<i class="fas fa-edit"></i></a>
                                            <a href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir supprimer ?')) document.location.href='invoice-delete.php?id=<?= $invoice->id ?>'"
                                               class="btn btn-danger">Supprimer&nbsp;&nbsp;<i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
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
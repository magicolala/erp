<?php
require_once './db.php';
$quotations = query($db, 'SELECT * FROM Quotation WHERE deleted IS NOT true');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Liste des devis</title>
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Devis</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript: void(0);">Liste des devis</a></li>
                                </ol>
                            </div>
                            <h4 class="page-title">Devis</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <h4 class="header-title float-left">Devis</h4>
                                    <a href="quotation-add.php" class="btn btn-success waves-effect waves-light float-right">
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
                                <?php foreach ($quotations as $quotation): ?>
                                    <tr>
                                        <td><?= $quotation->id ?></td>
                                        <td><?= $quotation->client_id ?></td>
                                        <td><?= $quotation->reference ?></td>
                                        <td><?= $quotation->created_at ?></td>
                                        <td><?= $quotation->status ?></td>
                                        <td><?= $quotation->totalHT ?></td>
                                        <td><?= getUserName($db, $quotation->user_id) ?></td>
                                        <td class="text-center">
                                            <a href="quotationToInvoice.php?id=<?= $quotation->id ?>" class="btn btn-primary">Transformer en facture&nbsp;&nbsp;<i class="fas fa-file-invoice-dollar"></i>
                                            </a>
                                            <a href="quotation-edit.php?id=<?= $quotation->id ?>" class="btn btn-info">Modifier&nbsp;&nbsp;<i class="fas fa-edit"></i></a>
                                            <a href="javascript:if(confirm('&Ecirc;tes-vous sûr de vouloir supprimer ?')) document.location.href='quotation-delete.php?id=<?= $quotation->id ?>'"
                                               class="btn btn-danger">Supprimer&nbsp;&nbsp;<i
                                                        class="fas fa-trash-alt"></i></a>
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
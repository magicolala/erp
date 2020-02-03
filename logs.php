<?php
require_once './db.php';
$logs = query($db, 'SELECT * FROM Log');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Liste des actions</title>
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Actions</a></li>
                                    <li class="breadcrumb-item active"><a href="javascript: void(0);">Liste des
                                            actions</a></li>
                                    <!--                                            <li class="breadcrumb-item active">Data Tables</li>-->
                                </ol>
                            </div>
                            <h4 class="page-title">Actions</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <h4 class="header-title float-left">Actions</h4>
                                </div>
                            </div>
                            <table id="datatable-buttons"
                                   class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Date</th>
                                    <th>Utilisateur</th>
                                    <th>Action</th>
                                    <th>Element</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($logs as $log):
                                    $user = query($db, 'SELECT * FROM User WHERE id =' . $log->user_id)[0];
                                ?>
                                    <tr>
                                        <td><?= $log->id ?></td>
                                        <td><?= $log->created_at ?></td>
                                        <td><a href="user-show-actions.php?id=<?= $user->id ?>"><?= $user->firstname ?> <?= $user->lastname ?></a></td>
                                        <td><span class="badge badge-pill <?php backgroundLogs($log); ?>"><?= $log->action ?></span></td>
                                        <td><?= $log->tablee ?></td>
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
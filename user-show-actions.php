<?php
require_once 'db.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if (null == $id) {
    header("location: users.php");
} else {
    $sql = "SELECT * FROM User where id = " . $id;
    $user = query($db, $sql)[0];
    $logs = query($db, "SELECT * FROM Log WHERE user_id=".$id);
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Action de l'utilisateur</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <?php include "partials/header-link.php"; ?>
        <link rel="stylesheet"
              href="bower_components/chartist/dist/chartist.min.css">
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Utilisateurs</a></li>
                                            <li class="breadcrumb-item active"><a href="javascript: void(0);">Actions</a></li>
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
                                            <h4 class="header-title float-left">Liste des actions de <?= $user->firstname ?>&nbsp;<?= $user->lastname ?></h4>
<!--                                            <a href="user-add.php" class="btn btn-success waves-effect waves-light float-right"> <span>Ajouter</span>&nbsp;&nbsp;<i class="fas fa-plus"></i> </a>-->
                                        </div>
                                    </div>
                                    <div class="ct-chart ct-perfect-fourth"></div>
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

        <?php include "partials/right-sidebar.php"; ?>

        <?php include "partials/scripts.php"; ?>
        <!-- Site content goes here !-->
        <script src="bower_components/chartist/dist/chartist.min.js"></script>
        <script type="text/javascript">
            <?php
                $datas = [];
                foreach ($logs as $log) {
                    $date = new DateTime($log->created_at);
                    $dateFormat = $date->format('d-m-Y');
                    if (!isset($datas[$dateFormat])) {
                        $datas[$dateFormat] = 1;
                    } else {
                        $datas[$dateFormat] = $datas[$dateFormat] + 1;
                    }
                }
                $labels = [];
                $series = [];
                foreach ($datas as $key => $value) {
                    $labels[] = $key;
                    $series[] = $value;
                }
            ?>
            const data = {
                // A labels array that can contain any sort of values
                labels: <?= json_encode($labels); ?>,
                // Our series array that contains series objects or in this case series data arrays
                series: [
                    <?= json_encode($series); ?>
                ]
            };

            // Create a new line chart object where as first parameter we pass in a selector
            // that is resolving to our chart container element. The Second parameter
            // is the actual data object.
            new Chartist.Line('.ct-chart', data);
        </script>
    </body>
</html>
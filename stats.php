<?php
require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Stats</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <?php include "partials/header-link.php"; ?>
    <link rel="stylesheet" href="bower_components/chartist/dist/chartist.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Statistiques entrée de stock</a></li>
                                    <!--                                            <li class="breadcrumb-item active">Data Tables</li>-->
                                </ol>
                            </div>
                            <h4 class="page-title">Statistiques entrée de stock</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <h4 class="header-title float-left">Statistiques entrée de stock</h4>
                                    <!--                                            <a href="user-add.php" class="btn btn-success waves-effect waves-light float-right"> <span>Ajouter</span>&nbsp;&nbsp;<i class="fas fa-plus"></i> </a>-->
                                </div>
                            </div>
                            <label for="dates">Tranche de date</label>
                            <input id="dates" type="text" name="daterange" value="01/01/2020 - 12/31/2020" class="form-control"/>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(function () {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function (start, end, label) {
            $.ajax({
                type: "POST",
                url: "ajax.php?start=" + start.format('YYYY-MM-DD') + "&end=" + end.format('YYYY-MM-DD'),
                data: {action: 'test'},
                dataType: 'JSON',
                success: function (response) {
                    let label = [];
                    let series = [];
                    if (Array.isArray(response)) {
                        response.forEach(function (index)
                        {
                            label.push(index.created_at);
                            series.push(index.in_stock);
                        })
                    }
                    const data = {
                        // A labels array that can contain any sort of values
                        labels: label,
                        // Our series array that contains series objects or in this case series data arrays
                        series: [
                            series
                        ]
                    };

                    // Create a new line chart object where as first parameter we pass in a selector
                    // that is resolving to our chart container element. The Second parameter
                    // is the actual data object.
                    new Chartist.Line('.ct-chart', data);
                }
            });
        });
    });
</script>
</body>
</html>
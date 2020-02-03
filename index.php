<?php
require_once 'db.php';
$clients = query($db, 'SELECT * FROM Client WHERE deleted IS NOT true');
$colors = ['red', 'green', 'orange', 'blue', 'yellow', "grey"];

$products = query($db, 'SELECT * FROM Product WHERE deleted IS NOT true');

function getCategoryName($db, $product) {
    $category = query($db, 'SELECT name FROM Category WHERE id='. $product->id_category)[0];

    return $category->name;
}

$dataas = [];
foreach ($products as $product) {
    $categoryName = getCategoryName($db, $product);
    if (!isset($dataas[$categoryName])) {
        $dataas[$categoryName] = 1;
    } else {
        $dataas[$categoryName] = $dataas[$categoryName] + 1;
    }
}

$label = array();
$series = array();
foreach ($dataas as $key => $value) {
    $label[] = $key;
    $series[] = $value;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php include('partials/header-link.php')?>
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Greeva</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Dashboard</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-4">

                        <div class="card-box">
                            <div class="dropdown float-right">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>
                            <h4 class="header-title">Daily Sales</h4>
                            <p class="text-muted">March 26 - April 01</p>
                            <div class="mb-3 mt-4">
                                <div class="float-right d-none d-xl-block">
                                    <img src="assets/images/cards/visa.png" alt="user-card" height="28" />
                                    <img src="assets/images/cards/master.png" alt="user-card" height="28" />
                                    <img src="assets/images/cards/american-express.png" alt="user-card" height="28" />
                                </div>
                                <h2 class="font-weight-light">$8,459.56</h2>
                            </div>
                            <div class="chartjs-chart dash-sales-chart">
                                <canvas id="sales-chart"></canvas>
                            </div>
                        </div><!-- end card-box-->

                        <div class="card-box widget-chart-one gradient-success bx-shadow-lg">
                            <div class="float-left" dir="ltr">
                                <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                       data-fgColor="#ffffff" data-bgcolor="rgba(255,255,255,0.2)" value="49" data-skin="tron" data-angleOffset="180"
                                       data-readOnly=true data-thickness=".1"/>
                            </div>
                            <div class="widget-chart-one-content text-right">
                                <p class="text-white mb-0 mt-2">Statistics</p>
                                <h3 class="text-white">$714</h3>
                            </div>
                        </div> <!-- end card-box-->

                    </div> <!-- end col -->

                    <div class="col-xl-4">
                        <div class="card-box">
                            <div class="dropdown float-right">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>
                            <h4 class="header-title mb-3">Statistics</h4>
                            <div class="row text-center">
                                <div class="col-sm-4 mb-3">
                                    <h3 class="font-weight-light">4,335</h3>
                                    <p class="text-muted text-overflow">Total Sales</p>
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <h3 class="font-weight-light">874</h3>
                                    <p class="text-muted text-overflow">Open Compaign</p>
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <h3 class="font-weight-light">2,548</h3>
                                    <p class="text-muted text-overflow">Total Sales</p>
                                </div>
                            </div>
                            <div class="chartjs-chart high-performing-product">
                                <canvas id="high-performing-product"></canvas>
                            </div>
                        </div> <!-- end card-box-->
                    </div> <!-- end col -->

                    <div class="col-xl-4">
                        <div class="card-box">
                            <div class="dropdown float-right">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>
                            <h4 class="header-title mb-3">Total Revenue</h4>
                            <div class="row text-center">
                                <div class="col-6 mb-3">
                                    <h3 class="font-weight-light">8,459</h3>
                                    <p class="text-muted text-overflow">Total Sales</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <h3 class="font-weight-light">584</h3>
                                    <p class="text-muted text-overflow">Open Compaign</p>
                                </div>
                            </div>
                            <div class="chartjs-chart conversion-chart">
                                <canvas id="conversion-chart"></canvas>
                            </div>
                        </div>  <!-- end card-box-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-xl-3">
                        <div class="card-box">
                            <div class="dropdown float-right">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>
                            <h4 class="header-title mb-4">Nombre de produit par catégorie</h4>
<!--                            <div class="my-4">-->
<!--                                <h2 class="font-weight-normal mb-2">$6,584.22 <i class="mdi mdi-arrow-up text-success"></i></h2>-->
<!--                                <p class="text-muted">March 26 - April 01</p>-->
<!--                            </div>-->

                            <div class="mb-3 chartjs-chart dash-doughnut">
                                <canvas id="doughnut"></canvas>
                            </div>

                            <div>
                                <?php $i =0;
                                foreach ($dataas as $key => $value): ?>
                                    <p><i class="mdi mdi-stop-circle-outline" style="color: <?= $colors[$i]; ?>"></i> <?= $key ?> <span class="float-right font-weight-normal"><?= $value ?></span></p>
                                <?php $i++; endforeach; ?>
                            </div>
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->

                    <div class="col-xl-6">
                        <div class="card-box">
                            <div class="dropdown float-right">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>
                            <h4 class="header-title mb-4">Transaction History</h4>


                            <div class="table-responsive">
                                <table class="table table-centered table-hover mb-0" id="datatable">
                                    <thead>
                                    <tr>
                                        <th class="border-top-0">Name</th>
                                        <th class="border-top-0">Card</th>
                                        <th class="border-top-0">Date</th>
                                        <th class="border-top-0">Amount</th>
                                        <th class="border-top-0">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-2.jpg" alt="user-pic" class="rounded-circle avatar-sm bx-shadow-lg" />
                                            <span class="ml-2">Imelda J. Stanberry</span>
                                        </td>
                                        <td>
                                            <img src="assets/images/cards/visa.png" alt="user-card" height="24" />
                                            <span class="ml-2">**** 3256</span>
                                        </td>
                                        <td>27.03.2018</td>
                                        <td>$345.98</td>
                                        <td><span class="badge badge-pill badge-danger">Failed</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-3.jpg" alt="user-pic" class="rounded-circle avatar-sm bx-shadow-lg" />
                                            <span class="ml-2">Francisca S. Lobb</span>
                                        </td>
                                        <td>
                                            <img src="assets/images/cards/master.png" alt="user-card" height="24" />
                                            <span class="ml-2">**** 8451</span>
                                        </td>
                                        <td>28.03.2018</td>
                                        <td>$1,250</td>
                                        <td><span class="badge badge-pill badge-success">Paid</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-1.jpg" alt="user-pic" class="rounded-circle avatar-sm bx-shadow-lg" />
                                            <span class="ml-2">James A. Wert</span>
                                        </td>
                                        <td>
                                            <img src="assets/images/cards/amazon.png" alt="user-card" height="24" />
                                            <span class="ml-2">**** 2258</span>
                                        </td>
                                        <td>28.03.2018</td>
                                        <td>$145</td>
                                        <td><span class="badge badge-pill badge-success">Paid</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-4.jpg" alt="user-pic" class="rounded-circle avatar-sm bx-shadow-lg" />
                                            <span class="ml-2">Dolores J. Pooley</span>
                                        </td>
                                        <td>
                                            <img src="assets/images/cards/american-express.png" alt="user-card" height="24" />
                                            <span class="ml-2">**** 6950</span>
                                        </td>
                                        <td>29.03.2018</td>
                                        <td>$2,005.89</td>
                                        <td><span class="badge badge-pill badge-danger">Failed</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-5.jpg" alt="user-pic" class="rounded-circle avatar-sm bx-shadow-lg" />
                                            <span class="ml-2">Karen I. McCluskey</span>
                                        </td>
                                        <td>
                                            <img src="assets/images/cards/discover.png" alt="user-card" height="24" />
                                            <span class="ml-2">**** 0021</span>
                                        </td>
                                        <td>31.03.2018</td>
                                        <td>$24.95</td>
                                        <td><span class="badge badge-pill badge-success">Paid</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-6.jpg" alt="user-pic" class="rounded-circle avatar-sm bx-shadow-lg" />
                                            <span class="ml-2">Kenneth J. Melendez</span>
                                        </td>
                                        <td>
                                            <img src="assets/images/cards/visa.png" alt="user-card" height="24" />
                                            <span class="ml-2">**** 2840</span>
                                        </td>
                                        <td>27.03.2018</td>
                                        <td>$345.98</td>
                                        <td><span class="badge badge-pill badge-success">Paid</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-7.jpg" alt="user-pic" class="rounded-circle avatar-sm bx-shadow-lg" />
                                            <span class="ml-2">Sandra M. Nicholas</span>
                                        </td>
                                        <td>
                                            <img src="assets/images/cards/master.png" alt="user-card" height="24" />
                                            <span class="ml-2">**** 2015</span>
                                        </td>
                                        <td>28.03.2018</td>
                                        <td>$1,250</td>
                                        <td><span class="badge badge-pill badge-danger">Failed</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-8.jpg" alt="user-pic" class="rounded-circle avatar-sm bx-shadow-lg" />
                                            <span class="ml-2">Ronald S. Taylor</span>
                                        </td>
                                        <td>
                                            <img src="assets/images/cards/amazon.png" alt="user-card" height="24" />
                                            <span class="ml-2">**** 0325</span>
                                        </td>
                                        <td>28.03.2018</td>
                                        <td>$145</td>
                                        <td><span class="badge badge-pill badge-success">Paid</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-9.jpg" alt="user-pic" class="rounded-circle avatar-sm bx-shadow-lg" />
                                            <span class="ml-2">Beatrice L. Iacovelli</span>
                                        </td>
                                        <td>
                                            <img src="assets/images/cards/discover.png" alt="user-card" height="24" />
                                            <span class="ml-2">**** 9058</span>
                                        </td>
                                        <td>29.03.2018</td>
                                        <td>$6,542.32</td>
                                        <td><span class="badge badge-pill badge-success">Paid</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-10.jpg" alt="user-pic" class="rounded-circle avatar-sm bx-shadow-lg" />
                                            <span class="ml-2">Sylvia H. Parker</span>
                                        </td>
                                        <td>
                                            <img src="assets/images/cards/discover.png" alt="user-card" height="24" />
                                            <span class="ml-2">**** 2577</span>
                                        </td>
                                        <td>31.03.2018</td>
                                        <td>$24.95</td>
                                        <td><span class="badge badge-pill badge-danger">Failed</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div> <!-- end card-box-->
                    </div> <!-- end col-->

                    <div class="col-xl-3">
                        <div class="card-box gradient-danger bx-shadow-lg pb-0">
                            <h4 class="header-title text-white">Daily Sales</h4>
                            <p class=" text-white">March 26 - April 01</p>
                            <div class="mb-3 mt-4">
                                <h2 class="font-weight-light  text-white">$3,558.48</h2>
                            </div>

                            <div class="pull-in">
                                <canvas id="lineChart" height="115"></canvas>
                            </div>
                        </div> <!-- end card-box-->

                        <div class="card-box">
                            <div class="media">
                                <img class="mr-3 rounded-circle bx-shadow-lg" src="assets/images/users/avatar-4.jpg" alt="Generic placeholder image" height="80">
                                <div class="media-body">
                                    <h5 class="mt-0">Louis P. Wheeler</h5>
                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, at, tempus viverra turpis.
                                </div>
                            </div>
                            <a href="" class="btn btn-info btn-block mt-3">Follow</a>
                        </div> <!-- end card-box-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-8">
                        <div class="card-box">
                            <div class="dropdown float-right">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>
                            <h4 class="header-title mb-4">Provenance des clients</h4>
                            <div class="row">
                                <div class="col-md-8">
                                    <div id="regions_div" style="width: 100%; height: 500px;"></div>

                                </div> <!-- end col -->
                                <?php
                                $datas = [];
                                foreach ($clients as $client) {
                                    $country = $client->code_iso;
                                    if (!isset($datas[$country])) {
                                        $datas[$country] = 1;
                                    } else {
                                        $datas[$country] = $datas[$country] + 1;
                                    }
                                }
                                $total = count($clients);
                                ?>
                                <div class="col-md-4">
                                    <?php
                                    $i = 0;
                                    arsort($datas);
                                    foreach ($datas as $key => $value):
                                        if ($i < 5):
                                    ?>
                                        <h5 class="mb-1 mt-0"><?= $value ?> <small class="text-muted ml-2"><?= $key ?></small></h5>
                                        <div class="progress-w-percent">
                                            <span class="progress-value font-weight-bold"><?= number_format($value/$total * 100); ?>% </span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar" role="progressbar" style="width: <?= $value/$total * 100 ?>%; background-color: <?= $colors[$i] ?>;" aria-valuenow="<?= $value/$total * 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <?php $i++; endif; ?>
                                    <?php endforeach; ?>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div>  <!-- end card-box-->
                    </div> <!-- end col -->

                    <div class="col-xl-4">
                        <div class="card-box">
                            <div class="dropdown float-right">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-horizontal"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Download</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                </div>
                            </div>
                            <h4 class="header-title mb-4">Data Uses</h4>

                            <div class="row text-center">
                                <div class="col-6 mb-3">
                                    <h3 class="font-weight-light"> <i class="mdi mdi-cloud-download text-info"></i> 79%</h3>
                                    <p class="text-muted text-overflow">Downloads</p>
                                </div> <!-- end col -->
                                <div class="col-6 mb-3">
                                    <h3 class="font-weight-light"> <i class="mdi mdi-cloud-upload text-danger"></i> 23%</h3>
                                    <p class="text-muted text-overflow">Uploads</p>
                                </div> <!-- end col -->
                            </div> <!-- end row-->

                            <div class="chartjs-chart datauses-area">
                                <canvas id="datauses-area-1"></canvas>
                            </div>
                        </div> <!-- end card-box-->
                    </div> <!-- end col-->

                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 text-center">
                        2018 - 2019 &copy; Greeva theme by <a href="">Coderthemes</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

<?php include "partials/right-sidebar.php"; ?>

<!-- Vendor js -->
<script src="assets/js/vendor.min.js"></script>

<!-- KNOB JS -->
<script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>
<!-- Chart JS -->
<script src="assets/libs/chart-js/Chart.bundle.min.js"></script>

<!-- Jvector map -->
<script src="assets/libs/jqvmap/jquery.vmap.min.js"></script>
<script src="assets/libs/jqvmap/jquery.vmap.usa.js"></script>

<!-- Datatable js -->
<script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
<script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>

<!-- Dashboard Init JS -->
<!--<script src="assets/js/pages/dashboard.init.js"></script>-->

<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.full.js" integrity="sha256-+49Zxn9NYfksw58v6GXqKOaNAw5NidI7LQ3A3MRNoMM=" crossorigin="anonymous"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages':['geochart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
    });
    google.charts.setOnLoadCallback(drawRegionsMap);

    function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable([
            ['Country', 'Popularity'],
            <?php  foreach ($datas as $key => $value): ?>
            ['<?= $key ?>', <?= $value ?>],
            <?php endforeach ?>
        ]);

        var options = {
            colorAxis: {
                colors: ['red', 'green', 'orange', 'blue', 'yellow', "grey", 'black'],
                values: [0, 1, 2, 3, 4, 5, 6]
            },
            legend: 'none'
        };

        for (var i = 0; i < data.getNumberOfRows(); i++) {
            var countryValue = data.getValue(i, 1);
            data.setValue(i, 1, i);
            data.setFormattedValue(i, 1, countryValue + '%');
        }

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
    }
</script>
<script>
    !function (l) {
        "use strict";
        var o = function () {
            this.$body = l("body"), this.charts = []
        };
        o.prototype.respChart = function (a, r, e, t) {
            var n = Chart.controllers.line.prototype.draw;
            Chart.controllers.line.prototype.draw = function () {
                n.apply(this, arguments);
                var o = this.chart.chart.ctx, a = o.stroke;
                o.stroke = function () {
                    o.save(), o.shadowColor = "#aaa", o.shadowBlur = 10, o.shadowOffsetX = 0, o.shadowOffsetY = 4, a.apply(this, arguments), o.restore()
                }
            };
            var i = a.get(0).getContext("2d"), s = l(a).parent();
            return function () {
                var o;
                switch (a.attr("width", l(s).width()), r) {
                    case"Line":
                        o = new Chart(i, {type: "line", data: e, options: t});
                        break;
                    case"Doughnut":
                        o = new Chart(i, {type: "doughnut", data: e, options: t});
                        break;
                    case"Pie":
                        o = new Chart(i, {type: "pie", data: e, options: t});
                        break;
                    case"Bar":
                        o = new Chart(i, {type: "bar", data: e, options: t});
                        break;
                    case"Radar":
                        o = new Chart(i, {type: "radar", data: e, options: t});
                        break;
                    case"PolarArea":
                        o = new Chart(i, {data: e, type: "polarArea", options: t})
                }
                return o
            }()
        }, o.prototype.initCharts = function () {
            var o = [], a = document.getElementById("sales-chart").getContext("2d").createLinearGradient(500, 0, 100, 0);
            a.addColorStop(0, "#0acf97"), a.addColorStop(1, "#02a8b5");
            var r = {
                labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"],
                datasets: [{
                    label: "Sales",
                    fill: !0,
                    backgroundColor: "rgba(2, 168, 181, 0.1)",
                    borderColor: a,
                    pointBorderColor: a,
                    pointBackgroundColor: a,
                    pointHoverBackgroundColor: a,
                    pointHoverBorderColor: a,
                    data: [18, 41, 86, 49, 20, 65, 64, 86, 49, 30, 45, 25]
                }]
            };
            o.push(this.respChart(l("#sales-chart"), "Line", r, {
                maintainAspectRatio: !1,
                responsive: !0,
                legend: {display: !1},
                animation: {easing: "easeInOutBack"},
                scales: {
                    yAxes: [{
                        display: !1,
                        ticks: {
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold",
                            beginAtZero: !0,
                            maxTicksLimit: 5,
                            padding: 0
                        },
                        gridLines: {drawTicks: !1, display: !1}
                    }],
                    xAxes: [{
                        display: !1,
                        gridLines: {zeroLineColor: "transparent"},
                        ticks: {padding: 0, fontColor: "rgba(0,0,0,0.5)", fontStyle: "bold"}
                    }]
                }
            }));
            o.push(this.respChart(l("#high-performing-product"), "Bar", {
                labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15"],
                datasets: [{
                    label: "Sales Analytics",
                    backgroundColor: "#fa5c7c",
                    borderColor: "#fa5c7c",
                    borderWidth: 1,
                    hoverBackgroundColor: "#fa5c7c",
                    hoverBorderColor: "#fa5c7c",
                    data: [65, 59, 80, 81, 56, 89, 40, 32, 65, 59, 80, 81, 56, 89, 40, 32, 65, 59, 80, 81, 56, 89, 40, 32, 65, 59, 80, 81, 56, 89, 40]
                }]
            }, {
                maintainAspectRatio: !1,
                legend: {display: !1},
                scales: {
                    yAxes: [{gridLines: {display: !1}, ticks: {max: 100, min: 20, stepSize: 20}}],
                    xAxes: [{barPercentage: .2, gridLines: {color: "rgba(0,0,0,0.03)"}}]
                }
            }));
            var e = document.getElementById("conversion-chart").getContext("2d").createLinearGradient(0, 300, 0, 100);
            e.addColorStop(0, "#02a8b5"), e.addColorStop(1, "#0acf97");
            var t = {
                labels: ["", "", "", "", "", "", "", ""],
                datasets: [{
                    label: "Conversion Funnels",
                    fill: !0,
                    backgroundColor: e,
                    borderColor: e,
                    pointBorderColor: e,
                    pointBackgroundColor: e,
                    pointHoverBackgroundColor: "transparent",
                    pointHoverBorderColor: "transparent",
                    data: [28, 34, 46, 76, 60, 62, 26, 14]
                }]
            };
            o.push(this.respChart(l("#conversion-chart"), "Line", t, {
                maintainAspectRatio: !1,
                legend: {display: !1},
                animation: {easing: "easeInOutBack"},
                elements: {point: {radius: 0, hitRadius: 10, hoverRadius: 5}},
                tooltips: {enabled: !1},
                scales: {
                    yAxes: [{display: !1, ticks: {suggestedMin: 0}}],
                    xAxes: [{
                        scaleShowLabels: !1,
                        gridLines: {zeroLineColor: "transparent", color: "rgba(0,0,0,0.03)"},
                        ticks: {padding: -28, fontColor: "#dee2e6", fontStyle: "bold"}
                    }]
                }
            }));
            r = {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September"],
                datasets: [{
                    label: "Sales Analytics",
                    fill: !0,
                    backgroundColor: "rgba(255,255,255,0.2)",
                    borderColor: "#fff",
                    borderCapStyle: "butt",
                    borderDash: [],
                    borderDashOffset: 0,
                    pointBorderColor: "#fff",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 1,
                    pointRadius: 1,
                    pointHitRadius: 5,
                    data: [65, 59, 80, 81, 56, 55, 40, 35, 30]
                }]
            };
            o.push(this.respChart(l("#lineChart"), "Line", r, {
                maintainAspectRatio: !1,
                legend: {display: !1},
                animation: {easing: "easeInOutBack"},
                scales: {
                    yAxes: [{
                        display: !1,
                        ticks: {
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold",
                            beginAtZero: !0,
                            maxTicksLimit: 10,
                            padding: 0
                        },
                        gridLines: {drawTicks: !1, display: !1}
                    }],
                    xAxes: [{
                        display: !1,
                        gridLines: {zeroLineColor: "transparent"},
                        ticks: {padding: -20, fontColor: "rgba(0,0,0,0.5)", fontStyle: "bold"}
                    }]
                }
            }));
            o.push(this.respChart(l("#doughnut"), "Doughnut", {

                labels: <?= json_encode($label) ?>,
                datasets: [{
                    data: <?= json_encode($series) ?>,
                    backgroundColor: <?= json_encode($colors) ?>,
                    borderColor: "transparent",
                    borderWidth: "3"
                }]
            }, {maintainAspectRatio: !1, cutoutPercentage: 80, legend: {display: !1}}));
            return o.push(this.respChart(l("#datauses-area-1"), "Line", {
                labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09"],
                datasets: [{
                    label: "Downloads",
                    fill: !0,
                    backgroundColor: "rgba(57, 175, 209, 0.2)",
                    borderColor: "#39afd1",
                    borderWidth: 2,
                    lineTension: 0,
                    pointBorderWidth: 2,
                    pointBackgroundColor: "#fff",
                    pointBorderColor: "#39afd1",
                    pointRadius: 3,
                    pointHitRadius: 3,
                    data: [65, 59, 80, 81, 56, 55, 40, 35, 30]
                }, {
                    label: "Uploads",
                    fill: !0,
                    backgroundColor: "rgba(254, 104, 105, 0.2)",
                    borderColor: "#fe6869",
                    borderWidth: 2,
                    lineTension: 0,
                    pointBorderWidth: 2,
                    pointBackgroundColor: "#fff",
                    pointBorderColor: "#fe6869",
                    pointRadius: 3,
                    pointHitRadius: 3,
                    data: [22, 28, 42, 38, 12, 22, 18, 9, 3]
                }]
            }, {
                maintainAspectRatio: !1,
                legend: {display: !1},
                animation: {easing: "easeInOutBack"},
                plugins: {filler: {propagate: !1}},
                scales: {
                    yAxes: [{
                        display: !1,
                        ticks: {fontColor: "rgba(0,0,0,0.5)", fontStyle: "bold", beginAtZero: !0, padding: 0},
                        gridLines: {drawTicks: !1, display: !1}
                    }],
                    xAxes: [{
                        display: !0,
                        gridLines: {zeroLineColor: "transparent"},
                        ticks: {padding: 5, fontColor: "rgba(0,0,0,0.5)", fontStyle: "bold"}
                    }]
                }
            })), o
        }, o.prototype.init = function () {
            l("#datatable").DataTable({pageLength: 5, searching: !1, lengthChange: !1}), l("#usa").vectorMap({
                map: "usa_en",
                enableZoom: !0,
                showTooltip: !0,
                selectedColor: null,
                hoverColor: null,
                backgroundColor: "#fff",
                color: "#f2f5f7",
                borderColor: "#bcbfc7",
                colors: {mo: "#02c0ce", fl: "#02c0ce", or: "#02c0ce"},
                onRegionClick: function (o, a, r) {
                    o.preventDefault()
                }
            });
            var a = this;
            a.charts = this.initCharts(), l(window).on("resize", function (o) {
                l.each(a.charts, function (o, a) {
                    try {
                        a.destroy()
                    } catch (o) {
                        console.log(o)
                    }
                }), a.charts = a.initCharts()
            })
        }, l.Dashboard = new o, l.Dashboard.Constructor = o
    }(window.jQuery), function (o) {
        "use strict";
        window.jQuery.Dashboard.init()
    }();</script>
<!-- App js -->
<script src="assets/js/app.min.js"></script>

</body>
</html>
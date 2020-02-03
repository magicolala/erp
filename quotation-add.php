<?php
require_once('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $client_id = htmlentities(trim($_POST['client_id']));
    $created_at = date("Y-m-d H:i:s");
    $status = 'created';
    $user_id = $_SESSION['auth']->id;
    $total = 0;

    for ($i = 0; $i < (int)$_POST['number']; $i++) {
        $total += (int)$_POST['qte'.$i] * (int)$_POST['price'.$i];
    }

    $reference = 'DEVIS' . date('ymdHi');

    $sql = "INSERT INTO Quotation (reference, client_id, totalHT, created_at, status, user_id) values(?, ?, ?, ?, ?, ?)";
    $q = $db->prepare($sql);
    $q->execute(array($reference, $client_id, $total, $created_at, $status, $user_id));
    $quotationId = $db->lastInsertId();
    for ($i = 0; $i <= (int)$_POST['number']; $i++) {
        $amount = $_POST['qte'.$i];
        $price = $_POST['price'.$i];
        $product_id = $_POST['product'.$i];
        $sql = "INSERT INTO DetailsQuotation (quotation_id, product_id, amount, price) values(?, ?, ?, ?)";
        $q = $db->prepare($sql);
        $q->execute(array($quotationId, $product_id, $amount, $price));
    }
    logBDD($db, 'created', "Quotation");
    header("Location: quotations.php");
}
$products = query($db, 'SELECT * FROM Product WHERE deleted IS NOT true');
$clients = query($db, 'SELECT * FROM Client WHERE deleted IS NOT true');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Ajouter un devis</title>
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
    <?php include 'topbar.php' ?>
    <!-- end Topbar -->

    <!-- ========== Left Sidebar Start ========== -->
    <?php include "sidebar.php"; ?>
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Devis</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Ajouter</a></li>
                                </ol>
                            </div>
                            <h4 class="page-title">Devis</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- Basic Form Wizard -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="header-title">Devis</h4>
                            <div class="pull-in">
                                <form id="basic-form" method="POST">
                                    <div>
                                        <h3>Client</h3>
                                        <section>
                                            <div class="form-group clearfix">
                                                <label class="col-form-label" for="client_id">Client</label>
                                                <div class="">
                                                    <select class="form-control" id="client_id" name="client_id"
                                                            required>
                                                        <option value="" selected disabled>Sélectionnez un client
                                                        </option>
                                                        <?php foreach ($clients as $client): ?>
                                                            <option value="<?= $client->id ?>"><?= $client->firstname ?>
                                                                &nbsp;<?= $client->lastname ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </section>
                                        <h3>Produit</h3>
                                        <section>
                                            <div class="form-group clearfix" id="containerProducts">
                                                <div class="row">
                                                    <label class="control-label col-md-4" for="productsId">Produits
                                                        *</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control" multiple id="productsId"
                                                                name="productsId" style="width: 100%">
                                                            <?php
                                                            foreach ($products as $product) {
                                                                echo '<option value="' . $product->id . '" data-id="' . $product->id . '">' . $product->reference . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group clearfix" id="containerProducts">
                                                <table id="datatable-buttons"
                                                       class="table table-striped table-bordered dt-responsive nowrap">
                                                    <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Produit</th>
                                                        <th>Quantité</th>
                                                        <th>Prix</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="row-prod">

                                                    </tbody>
                                                </table>
                                            </div>

                                        </section>
                                        <h3>Prix total</h3>
                                        <section>
                                            <div class="form-group clearfix">
                                                <div class="col-lg-12">
                                                    <ul class="list-unstyled w-list">
                                                        <li><b>First Name :</b> Jonathan</li>
                                                        <li><b>Last Name :</b> Smith</li>
                                                        <li><b>Emial:</b> jonathan@smith.com</li>
                                                        <li><b>Address:</b> 123 Your City, Cityname.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </form>
                            </div> <!-- end .pull-in-->

                        </div> <!-- end card-box -->
                    </div> <!-- end col -->
                </div>
                <!-- End row -->

            </div> <!-- container-fluid -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <?php include "footer.php"; ?>
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

<!--Form Wizard-->
<script src="assets/libs/jquery-steps/jquery.steps.min.js"></script>

<!-- Init js-->
<script src="assets/js/pages/form-wizard.init.js"></script>

<!-- select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.full.js"
        integrity="sha256-+49Zxn9NYfksw58v6GXqKOaNAw5NidI7LQ3A3MRNoMM=" crossorigin="anonymous"></script>
<!-- App js -->
<script src="assets/js/app.min.js"></script>
<script>

    $(document).ready(function () {
        let listProducts = <?= json_encode($products) ?>;
        console.log(listProducts);

        $('#productsId').on('select2:select', function (e) {
            html = '';
            const idProducts = [];
            $("#productsId :selected").each(function (index) {
                idProducts.push($(this).val());
                html += '<tr>';
                html += '<td>'+ $(this).val() +'</td>';
                html += '<td>'+ $(this).text() +'</td>';
                html += '<td><input type="number" name="qte' + index + '" class="form-control" /></td>';
                html += '<td><input type="number" name="price' + index + '" class="form-control" /> <input type="hidden" name="product' + index + '" class="form-control" value="'+ $(this).val() +'"/><input type="hidden" name="number" class="form-control" value="'+ index +'"/></td>';
                html += '</tr>';
            });

            $('#row-prod').html(html);

        });
    });
</script>
</body>
</html>
<?php
require_once ('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $title = htmlentities(trim($_POST['title']));
    $serialize = serialize($_POST['pages']);
    $sql = "INSERT INTO PrTypes (title, pages) values(?, ?)";
    $q = $db->prepare($sql);
    $q->execute(array($title, $serialize));
    logBDD($db, 'created', "PrTypes");
    header("Location: users.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Ajouter un type de privilège</title>
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Privilèges</a></li>
                                    <li class="breadcrumb-item active">Ajouter</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Ajouter un privilège</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Ajouter un type de privilège</h4>

                            <form class="form-horizontal" method="POST" action="privileges.php">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="title">Titre</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Titre" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pages[]" class="col-sm-2 col-form-label">Pages</label>
                                    <div class="col-sm-6">
                                        <select name="pages[]" id="pages[]" multiple class="form-control">
                                            <option value="" disabled>Sélectionnez les pages</option>
                                            <?php foreach ($pages as $key => $value): ?>
                                                <option value="<?= $key ?>"><?= $value[0] ?></option>
                                            <?php endforeach; ?>
                                        </select>
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
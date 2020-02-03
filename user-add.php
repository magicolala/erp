<?php
require_once('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $firstname = htmlentities(trim($_POST['firstname']));
    $lastname = htmlentities(trim($_POST['lastname']));
    $email = htmlentities(trim($_POST['email']));
    $privileges = htmlentities(trim($_POST['privileges']));
    $prType = htmlentities(trim($_POST['privileges']));
    if ($prType == 'custom') {
        $prType = null;
    }
    $pagees = serialize($_POST['pages']);
    $password = password_hash($_POST['password'], PASSWORD_ARGON2I);
    $account_status = 'created';
    $sql = "INSERT INTO User (firstname, lastname, email, privileges, password, account_status, PrType_id, pages) values(?, ?, ?, ?, ?, ?, ?, ?)";
    $q = $db->prepare($sql);
    $q->execute(array($firstname, $lastname, $email, $privileges, $password, $account_status, $prType, $pagees));
    logBDD($db, 'created', "User");
    header("Location: users.php");
}
$roles = query($db, 'SELECT * FROM PrTypes');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Ajouter un utilisateur</title>
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

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Utilisateur</a></li>
                                    <li class="breadcrumb-item active">Ajouter</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Ajouter un utilisateur</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Ajouter un utilisateur</h4>

                            <form class="form-horizontal" method="POST" action="user-add.php">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="firstname">Prénom</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="firstname" class="form-control" id="firstname"
                                               placeholder="Prénom" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="lastname">Nom</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="lastname" name="lastname"
                                               placeholder="Nom" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" class="form-control" id="email" name="email"
                                               placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="privileges">Role</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" id="privileges" name="privileges" required>
                                            <option value="" selected disabled>Selectionnez un rôle</option>
                                            <option value="custom">Personalisé</option>
                                            <?php foreach ($roles as $role): ?>
                                                <option value="<?= $role->id ?>"><?= $role->title ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" id="pages">
                                    <label class="col-sm-2 col-form-label" for="pages">Pages</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" id="pages" name="pages[]" multiple required>
                                            <option value="" disabled>Selectionnez des pages</option>
                                            <?php foreach ($pages as $key => $value): ?>
                                                <option value="<?= $key ?>"><?= $value[0] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="password">Mot de passe</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="password" id="password" name="password"
                                               placeholder="Mot de passe" required>
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
<script>
    $(document).ready(function () {
        $('#pages').hide();
        $('#privileges').on('select2:select', function () {
            $('#privileges :selected').each(function () {
                if ($(this).val() == 'custom') {
                    $('#pages').show();
                } else {
                    $('#pages').hide();
                }
            });
        });
    });
</script>
</body>
</html>
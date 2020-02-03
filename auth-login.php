<?php
$not_log = true;
require_once 'db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $user = query($db, 'SELECT * FROM User WHERE (email = :email)',['email' => $_POST['email']])[0];

    if ($user && password_verify($_POST['password'], $user->password)) {
        $_SESSION['auth'] = $user;
        $sql = "UPDATE User SET last_connexion = ? WHERE id = ?";
        $q = $db->prepare($sql);
        $date = date('Y-m-d H:i');
        $q->execute(array($date, $user->id));

        if ($user->PrType_id) {
            $prType = query($db, 'SELECT * FROM PrTypes WHERE id =' . $user->PrType_id);
            $pagees = unserialize($prType->pages);
            header('Location: ' . $pages[$pagees[0]][1]);
        } elseif ($user->pages) {
            $pagees = unserialize($user->pages);
            header('Location: ' . $pages[$pagees[0]][1]);
        } else {
            header('Location: index.php');
        }
        exit();
    } else {
        die('Identifiant ou mot de passe incorrecte');
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Se connecter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <?php include "partials/header-link.php"; ?>
</head>

<body class="authentication-bg authentication-bg-pattern d-flex align-items-center">

<div class="home-btn d-none d-sm-block">
    <a href="index.php"><i class="fas fa-home h2 text-white"></i></a>
</div>

<div class="account-pages w-100 mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">

                    <div class="card-body p-4">

                        <div class="text-center mb-4">
                            <a href="index.php">
                                <span><img src="assets/images/logo-dark.png" alt="" height="28"></span>
                            </a>
                        </div>

                        <form action="auth-login.php" method="POST" class="pt-2">

                            <div class="form-group mb-3">
                                <label for="emailaddress">Email</label>
                                <input class="form-control" type="email" id="emailaddress" required=""
                                       placeholder="Votre email" name="email">
                            </div>

                            <div class="form-group mb-3">
<!--                                <a href="auth-recoverpassword.html" class="text-muted float-right"><small>Forgot your-->
<!--                                    password?</small></a>-->
                                <label for="password">Mot de passe</label>
                                <input class="form-control" type="password" required="" id="password"
                                       placeholder="Mot de passe" name="password">
                            </div>

<!--                            <div class="custom-control custom-checkbox mb-3">-->
<!--                                <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>-->
<!--                                <label class="custom-control-label" for="checkbox-signin">Remember me</label>-->
<!--                            </div>-->

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-success btn-block" type="submit"> Se connecter</button>
                            </div>

                        </form>

<!--                        <div class="row mt-3">-->
<!--                            <div class="col-12 text-center">-->
<!--                                <p class="text-muted mb-0">Don't have an account? <a href="auth-register.php"-->
<!--                                                                                     class="text-dark ml-1"><b>Sign-->
<!--                                    Up</b></a></p>-->
<!--                            </div>-->
<!--                        </div>-->
                        <!-- end row -->

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<!-- Vendor js -->
<script src="assets/js/vendor.min.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>

</body>
</html>
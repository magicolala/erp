<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <span class="pro-user-name ml-1">
                    <?= $_SESSION['auth']->firstname; ?>&nbsp;<?= $_SESSION['auth']->lastname[0] ?> <i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-item noti-title">
                    <h6 class="m-0">
                        Welcome !
                    </h6>
                </div>

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="auth-logout.php" class="dropdown-item notify-item">
                    <i class="dripicons-power"></i>
                    <span>Logout</span>
                </a>

            </div>
        </li>

        <li class="dropdown notification-list">
            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                <i class="fe-settings noti-icon"></i>
            </a>
        </li>

    </ul>

    <ul class="list-unstyled menu-left mb-0">
        <li class="float-left">
            <a href="index.php" class="logo">
                <span class="logo-lg">
                    <img src="assets/images/logo-light.png" alt="" height="22">
                </span>
                <span class="logo-sm">
                    <img src="assets/images/logo-sm.png" alt="" height="24">
                </span>
            </a>
        </li>
        <li class="float-left">
            <a class="button-menu-mobile navbar-toggle">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
        </li>
<!--        <li class="app-search d-none d-md-block">-->
<!--            <form>-->
<!--                <input type="text" placeholder="Search..." class="form-control">-->
<!--                <button type="submit" class="sr-only"></button>-->
<!--            </form>-->
<!--        </li>-->
    </ul>
</div>
<?php
session_start();
unset($_SESSION['auth']);
header('Location: auth-login.php');
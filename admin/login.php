<?php

// error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// session
session_start();

// autoLoader
include("../includes/autoLoader.php");

use Login\Submit;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $adminEmail = htmlspecialchars($_POST["adminEmail"]);
    $adminPwd = htmlspecialchars($_POST["adminPwd"]);

    $login = new Submit($adminEmail, $adminPwd);
    $login->login();

    unset($adminEmail, $adminPwd, $login);
}

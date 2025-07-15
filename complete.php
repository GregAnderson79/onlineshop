<?php

// error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// session
session_start();

// autoLoader
include("includes/autoLoader.php");

unset($_SESSION["cartItems"]);
unset($_SESSION["cartTotal"]);
unset($_SESSION["cartQty"]);
session_destroy();

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Shopping Cart</title>
<link href="styles.css" rel="stylesheet">
<script language="JavaScript" SRC="scripts.js"></script>
</head>
<body>

<?php

include("includes/header.php");

include("includes/mobNav.php");

include("includes/dktNav.php");

?>

<main>
    <section id="page_header">
        <h1>Order complete</h1>
    </section>
    <section id="order_complete">
        <p class="white_para">Thank you for your order</p>
    </section>
</main>
<?php

// error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// session
session_start();

// autoLoader
include("includes/autoLoader.php");

use Cart\Items\GetItems;
use Cart\Add\AddItem;
use Cart\Delete\DeleteRow;
use Cart\Delivery\GetPrice;

// get errors
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET["error"]);
} else {
    $error = null;
}

// get page function
if (isset($_GET['action'])) {
    $action = htmlspecialchars($_GET["action"]);
} else {
    $action = null;
}

// delete row from cart
if ($action == "delRow") {
    if (isset($_GET['rowID']))  {
        $rowID = htmlspecialchars($_GET['rowID']);
        $delete = new DeleteRow($rowID);
        $delete->delete();
        unset($rowID, $delete);
    }
}

// add item to cart
if ($action == "add") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fields = $_POST;
        if ($fields) {
            array_map('htmlspecialchars', $fields);
            $add = new AddItem($fields);
            $add->addRow();
            unset($fields, $add);
        }
    }
}

// update cart
function updateCart() {
    $items = $_SESSION["cartItems"];
    $cartTotal = 0;
    $cartQty = 0;
    foreach($items as $i) {
        $price = floatval($i['itemPrice']);
        $quantity = intval($i['quantity']);
        $cartTotal += ($price * $quantity);
        $cartQty += $quantity;
    }
    $_SESSION["cartTotal"] = $cartTotal;
    $_SESSION["cartQty"] = $cartQty;
    unset($price, $quantity, $cartTotal, $cartQty);
}
updateCart();

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
        <h1>Shopping Cart</h1>
    </section>
    <section id="cart_items">
<?php
        // errors
        if ($error == 1) {
            echo "<div class=\"error_msg\">Error: Item not found<span></span></div>";
        }

        // cart items
        $items = new GetItems;
        $items->createList();
?>
    </section>
    <section id="cart_totals">
        <div class="cart_totals_right">
<?php
            // sub-total
            if (isset($_SESSION["cartTotal"])) {
                $subTotal = $_SESSION["cartTotal"];
            } else {
                $subTotal = 0;
            }
            echo "<p>Sub-total: £" . number_format($subTotal, 2) . "</p>";

            // delivery
            $delPrice = new GetPrice();
            $delivery = $delPrice->returnPrice();
            if (!isset($delivery)) {
                $delivery = 0;
            }
            echo "<p>Delivery: £" . number_format($delivery, 2) . "</p>";

            // total
            if ($subTotal > 0) {
                $total = $subTotal + $delivery;
            } else {
                $total = 0;
            }
            echo "<p><b>Total: £" . number_format($total, 2) . "</b></p>";
?>
        </div>
    </section>
    <section id="cart_btn">
<?php
            if ($total > 0) {
                echo "<div class=\"form_btn\"><a class=\"nav_blue\" href=\"checkout.php\">Proceed to Checkout</a></div>";
            } else {
                echo "<div class=\"form_btn\"><span class=\"blue_disabled\">Proceed to Checkout</span></div>";
            }
            unset($subTotal, $delivery, $total);
?>
    </section>
</main>

</body>
</html>
<?php

// error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// session
session_start();

// autoLoader
include("includes/autoLoader.php");

use Checkout\Submit;

// get errors
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET["error"]);
} else {
    $error = null;
}

if (!isset($_SESSION["cartItems"]) || $_SESSION["cartItems"] == 0) {
    header("location: /shop/");
}

// form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST["firstName"]);
    $lastName = htmlspecialchars($_POST["lastName"]);
    $email = htmlspecialchars($_POST["email"]);
    $tel = htmlspecialchars($_POST["tel"]);
    $address1 = htmlspecialchars($_POST["address1"]);
    $address2 = htmlspecialchars($_POST["address2"]);
    $towncity = htmlspecialchars($_POST["towncity"]);
    $county = htmlspecialchars($_POST["county"]);
    $postcode = htmlspecialchars($_POST["postcode"]);

    $checkout = new Submit($firstName, $lastName, $email, $tel, $address1, $address2, $towncity, $county, $postcode);
    $checkout->processCheckout();
}

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Checkout</title>
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
        <h1>Checkout</h1>
    </section>
    <section id="checkout">
        <div class="shop_form">
            <form method="post" action="checkout.php">
<?php
                // errors
                if ($error == 1) {
                    echo "<div class=\"error_msg\">Error: Enter your first name<span></span></div>";
                } else if ($error == 2) {
                    echo "<div class=\"error_msg\">Error: Enter your last name<span></span></div>";
                } else if ($error == 3) {
                    echo "<div class=\"error_msg\">Error: Enter a valid email address<span></span></div>";
                } else if ($error == 4) {
                    echo "<div class=\"error_msg\">Error: Enter a valid telephone number<span></span></div>";
                } else if ($error == 5) {
                    echo "<div class=\"error_msg\">Error: Enter the first line of your address<span></span></div>";
                } else if ($error == 6) {
                    echo "<div class=\"error_msg\">Error: Enter your town or city<span></span></div>";
                } else if ($error == 7) {
                    echo "<div class=\"error_msg\">Error: Enter your postcode<span></span></div>";
                }

                // first name
                echo "<p><label for=\"firstName\">First name</label><span><input type=\"text\" name=\"firstName\" id=\"firstName\" value=\"";
                if (isset($_SESSION["firstName"])) {
                    echo $_SESSION["firstName"];
                    unset($_SESSION["firstName"]);
                } else if (isset($firstName)) {
                    echo $firstName;
                    unset($firstName);
                }
                echo "\"></span></p>";

                // last name
                echo "<p><label for=\"lastName\">Last name</label><span><input type=\"text\" name=\"lastName\" id=\"lastName\" value=\"";
                if (isset($_SESSION["lastName"])) {
                    echo $_SESSION["lastName"];
                    unset($_SESSION["lastName"]);
                } else if (isset($lastName)) {
                    echo $lastName;
                    unset($lastName);
                }
                echo "\"></span></p>";

                // email
                echo "<p><label for=\"email\">Email</label><span><input type=\"text\" name=\"email\" id=\"email\" value=\"";
                if (isset($_SESSION["email"])) {
                    echo $_SESSION["email"];
                    unset($_SESSION["email"]);
                } else if (isset($email)) {
                    echo $email;
                    unset($email);
                }
                echo "\"></span></p>";

                // telephone number
                echo "<p><label for=\"tel\">Telephone number</label><span><input type=\"text\" name=\"tel\" id=\"tel\" style=\"width:120px\" value=\"";
                if (isset($_SESSION["tel"])) {
                    echo $_SESSION["tel"];
                    unset($_SESSION["tel"]);
                } else if (isset($tel)) {
                    echo $tel;
                    unset($tel);
                }
                echo "\"></span></p>";

                // address line 1
                echo "<p><label for=\"address1\">Address line 1</label><span><input type=\"text\" name=\"address1\" id=\"address1\" value=\"";
                if (isset($_SESSION["address1"])) {
                    echo $_SESSION["address1"];
                    unset($_SESSION["address1"]);
                } else if (isset($address1)) {
                    echo $address1;
                    unset($address1);
                }
                echo "\"></span></p>";

                // address line 2
                echo "<p><label for=\"address2\">Address line 2</label><span><input type=\"text\" name=\"address2\" id=\"address2\" value=\"";
                if (isset($_SESSION["address2"])) {
                    echo $_SESSION["address2"];
                    unset($_SESSION["address2"]);
                } else if (isset($address2)) {
                    echo $address2;
                    unset($address2);
                }
                echo "\"></span></p>";

                // town/city
                echo "<p><label for=\"towncity\">Town/City</label><span><input type=\"text\" name=\"towncity\" id=\"towncity\" value=\"";
                if (isset($_SESSION["towncity"])) {
                    echo $_SESSION["towncity"];
                    unset($_SESSION["towncity"]);
                } else if (isset($towncity)) {
                    echo $towncity;
                    unset($towncity);
                }
                echo "\"></span></p>";

                // county
                echo "<p><label for=\"county\">County</label><span><input type=\"text\" name=\"county\" id=\"county\" style=\"width:200px\" value=\"";
                if (isset($_SESSION["county"])) {
                    echo $_SESSION["county"];
                    unset($_SESSION["county"]);
                } else if (isset($county)) {
                    echo $county;
                    unset($county);
                }
                echo "\"></span></p>";

                // postcode
                echo "<p><label for=\"postcode\">Postcode</label><span><input type=\"text\" name=\"postcode\" id=\"postcode\" style=\"width:80px\" value=\"";
                if (isset($_SESSION["postcode"])) {
                    echo $_SESSION["postcode"];
                    unset($_SESSION["postcode"]);
                } else if (isset($postcode)) {
                    echo $postcode;
                    unset($postcode);
                }
                echo "\"></span></p>";
?>
                <div class="form_btn"><button class="btn_blue">Proceed to payment</button></div>
            </form>
        </div>
    </section>
</main>
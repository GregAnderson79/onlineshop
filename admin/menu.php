<?php

// error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// session
session_start();
if (!isset($_SESSION["loggedInAdmin"])) {
    header("location: index.php");
}

// get page function
if (isset($_GET['action'])) {
    $action = htmlspecialchars($_GET["action"]);
} else {
    $action = null;
}

// get errors
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET["error"]);
} else {
    $error = null;
}

// page URL
function pageURL($adjust,$append) {
    $pageURL = $_SERVER['PHP_SELF'];
    if ($adjust) {
        if (isset($_GET["open"])) {
            $pageURL .= "?open=" . htmlspecialchars($_GET["open"]);
            if ($append) {
                $pageURL .= "&";
            }
        } else {
            if ($append) {
                $pageURL .= "?";
            }
        }
    } else {
        $pageURL .= "?" . $_SERVER['QUERY_STRING'];
        if ($append) {
            $pageURL .= "&";
        }
    }
    return $pageURL;
}

// logout
if ($action === "logout") {
    unset($_SESSION["loggedInAdmin"]);
    unset($_SESSION["loggedInID"]);
    unset($_SESSION["loggedInUserName"]);
    session_destroy();
        
    header("location: index.php");
}


// autoLoader
include("../includes/autoLoader.php");
   
// Submit, update, delete categories
include("includes/catProcess.php");

// Update category order
include("includes/catOrderProcess.php");

// Submit, update, delete categories
include("includes/itemProcess.php");

// Upload, delete item images, set images to main
include("includes/itemImgProcess.php");

// Submit, update, delete options
include("includes/optionProcess.php");

// Submit, update, delete option values
include("includes/optValProcess.php");

// Add, delete item-option associations
include("includes/itemOptAssoc.php");

// Add, delete item-option value associations
include("includes/itemOptValAssoc.php");

// Submit, update, delete admins
include("includes/adminProcess.php");

// Submit, update PayPal email
include("includes/paypalEmailProcess.php");

// Submit, update delivery price
include("includes/deliveryPriceProcess.php");  

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Menu - Shop Admin</title>
<link href="styles.css" rel="stylesheet">
<script language="JavaScript" SRC="scripts.js"></script>
</head>
<body>

<header>
    <a href="javascript:OPEN_MN()" class="hdr_mob_nav" aria-label="Open mobile main category > sub category navigation">
        <span></span><span></span><span></span>
    </a>
    <div class="hdr_title"><a href="menu.php">Shop Admin</a></div>
    <div class="hdr_name"><?php echo $_SESSION["loggedInUserName"]; ?></div>
    <div class="hdr_initials">
<?php
        $nameArray = explode(" ", $_SESSION["loggedInUserName"]);
        $initials = null;
        foreach ($nameArray as $i) {
            $initials .= $i[0];
        }
        echo $initials;
        unset($nameArray, $initials, $i);
?>
    </div>
    <a class="nav_blue" href="<?php echo pageURL(true,true) ?>action=logout" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
</header>

<?php

// mobile Nav
include("includes/mobileNav.php");

?>

<main>
    <section id="mainCats">
<?php
        // main category menu
        include("includes/columnMainCats.php");
?>
    </section>
<?php
    // if open...
    if (isset($_GET["open"])) {
        // sub category menu
        echo "<section id=\"subCats\">\n";
            include("includes/columnSubCats.php");
        echo "</section>\n";
        // item menu
        echo "<section id=\"items\">\n";
            include("includes/columnItems.php");
        echo "</section>\n";
    }
?>
    <section id="options">
<?php
        // options menu
        include("includes/columnOptions.php");
?>
    </section>
    <section id="manage">
<?php
        // Site management menu
        include("includes/columnManage.php");
?>
    </section>
</main>

<?php

// Add or edit category forms
include("includes/catForms.php");

// Update category order forms
include("includes/catOrder.php");

// Add or edit item forms
include("includes/itemForms.php");

// Add or edit item forms
include("includes/itemImgForm.php");

// Add or edit option forms
include("includes/optionForms.php");

// Add or edit option value forms
include("includes/optValForms.php");

// Links to add, delete option and option value associations
include("includes/itemOptAssocForms.php");

// Add or edit admin accounts
include("includes/adminForms.php");

// Add or edit PayPal email form
include("includes/paypalEmailForm.php");

// Add or edit delivery price form
include("includes/deliveryPriceForm.php");

// Orders
include("includes/orders.php");

unset($action, $error, $pageURL);
?>
</body>
</html>

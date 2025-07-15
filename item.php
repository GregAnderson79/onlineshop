<?php

// error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// session
session_start();

// get errors
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET["error"]);
} else {
    $error = null;
}

// autoLoader
include("includes/autoLoader.php");

use Item\GetItem\GetData;
use Item\Breadcrumbs\GetLinks as Breadcrumbs;
use Item\Gallery\GetImages;
use Item\Options\Associations\GetOptions;

// get item id
if (isset($_GET['itemID'])) {
    $itemID = htmlspecialchars($_GET["itemID"]);
} else {
    $itemID = null;
}

if (isset($itemID)) {
    $item = new GetData($itemID);
    $itemData = $item->returnItem();
    if ($itemData) {
        $itemName = $itemData['itemName'];
        $itemPrice = $itemData['itemPrice'];
        $itemDesc1 = $itemData['itemDesc1'];
        $itemDesc2 = $itemData['itemDesc2'];
        $itemDesc3 = $itemData['itemDesc3'];
        $itemStock = $itemData['itemStock'];
        $catID = $itemData['catID'];
        $itemStatus = $itemData['itemStatus'];
        if ($itemStatus != "active") {
            $itemID = null;
        }
    } else {
        $itemID = null;
    }
} else {
    $itemID = null;
}

if ($itemID == null) {
    $itemName = "Item not found";
}

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title><?php echo $itemName; ?></title>
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
<?php
        echo " <h1>" . $itemName . "</h1>\n";
        if ($itemID == null) {
            echo " <p>This item cannot be found on this website. It may have been removed, suspended, or this could be the wrong address. Please try again.</p>";
        } else {
            // breadcrumbs
            if (isset($catID)) {
                $breadcrumbs = new Breadcrumbs($catID);
                $breadcrumbs->createBreadcrumbs();
            }
?>
            </section>
            <section id="page_item">
                <div class="item_gallery">
<?php
                    // image gallery
                    $images = new GetImages($itemID);
                    $images->createGallery();
?>
                </div>
                <div class="item_details">
                    <div class="item_price" aria-label="Item price">£<?php echo $itemPrice; ?></div>
                    <div class="item_meta"><?php echo "Item code: " . $itemID . " | " . $itemStock . " in stock"; ?></div>
<?php
                    if (strlen($itemDesc1 > 0)) {
?>
                        <div class="item_desc">
                            <h2>Item description</h2>
                            <p><?php echo $itemDesc1; ?></p>
                        </div>
<?php
                    }
?>
                    <div class="shop_form">
                        <form action="cart.php?action=add" method="post">
                            <input type="hidden" name="itemID" value="<?php echo $itemID; ?>">
<?php
                            // options / values
                            $options = new GetOptions($itemID);
                            $options->createForm();
?>
                            <p><label for="quantity">Quantity:</label><span><input style="width:60px" type="number" id="quantity" name="quantity" value="1" min="1"></span></p>
                            <p><button class="btn_blue">Add to Cart</button></p>
                        </form>
                    </div>
<?php
                    if (strlen($itemDesc2 > 0)) {
                        echo "<div class=\"item_extra_desc\">" . $itemDesc2 . "</div>\n";
                    }
                    if (strlen($itemDesc3 > 0)) {
                        echo "<div class=\"item_extra_desc\">" . $itemDesc3 . "</div>\n";
                    }
?>
                </div>
            </section>
<?php
        }
?>
    </section>
</main>

</body>
</html>
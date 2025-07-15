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

// get category id
if (isset($_GET['catID'])) {
    $catID = htmlspecialchars($_GET["catID"]);
} else {
    $catID = null;
}

use Items\Lists\Category\GetItems;
use Categories\Titles\GetNameDesc;
use Item\Breadcrumbs\GetLinks as Breadcrumbs;
use Categories\List\Subs\GetCategories as GetSubs;

// Category name / page title
if (isset($catID)) {
    $cat = new GetNameDesc($catID);
    $catData = $cat->returnCat();
    if ($catData) {
        $pageTitle = $catData['catName'];
        $catDesc = $catData['catDesc'];
    } else {
        $pageTitle = "Category not found";
    }
    unset($catData);
} else {
    $pageTitle = "Category Items";
}

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title><?php echo $pageTitle; ?></title>
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
        echo "<h1>" . $pageTitle . "</h1>";

        // breadcrumbs
        if (isset($catID)) {
            $breadcrumbs = new Breadcrumbs($catID);
            $breadcrumbs->createBreadcrumbs();
        }

        if (isset($catDesc) && strlen($catDesc > 0)) {
            echo "<div class=\"category_desc\">" . $catDesc . "</div>";
        }
        unset($pageTitle, $catDesc);
?>
    </section>
<?php
    // Sub categories
    if (isset($catID)) {
        $subs = new GetSubs($catID);
        $subs->createList();
        unset($cats);
    }
?>
    <section id="page_items">
<?php
        // All items
        if (isset($catID)) {
            $items = new GetItems($catID);
            $items->createList();
            unset($items);
        }
?>
    </section>
</main>

</body>
</html>
<?php
use \Categories\SetCategory\Save;
use \Categories\DeleteCategory\Delete;

// submit / update category
if ($action == "addCat" || $action == "editCat") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $catName = htmlspecialchars($_POST["catName"]);
        $catDesc = htmlspecialchars($_POST["catDesc"]);
        $parID = htmlspecialchars($_POST["parID"]);
        $catStatus = htmlspecialchars($_POST["catStatus"]);
        if ($action == "editCat" && isset($_GET['catID']))  {
            $catID = htmlspecialchars($_GET["catID"]);
        } else {
            $catID = null;
        }

        $set = new Save($catName, $catDesc, $parID, $catStatus, $catID);
        $set->process();

        unset($catName, $catDesc, $parID, $catStatus, $catID, $set);
    }
}

// delete category
if ($action == "delCat") {
    if (isset($_GET['catID']))  {
        $catID = htmlspecialchars($_GET['catID']);
        $delete = new Delete($catID);
        $delete->process();

        unset($catID, $delete);
    } else {
        header("location: " . pageURL(true,true) . "error=0");
        exit;
    }
}
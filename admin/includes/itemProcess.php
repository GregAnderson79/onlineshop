<?php
use \Items\Item\SetItem\Save;
use \Items\Item\DeleteItem\Delete;

// submit / update item
if ($action == "addItem" || $action == "editItem") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $itemName = htmlspecialchars($_POST["itemName"]);
        $catID = htmlspecialchars($_POST["catID"]);
        $itemPrice = htmlspecialchars($_POST["itemPrice"]);
        $itemStatus = htmlspecialchars($_POST["itemStatus"]);
        $itemStock = htmlspecialchars($_POST["itemStock"]);
        $itemDesc1 = htmlspecialchars($_POST["itemDesc1"]);
        $itemDesc2 = htmlspecialchars($_POST["itemDesc2"]);
        $itemDesc3 = htmlspecialchars($_POST["itemDesc3"]);
        if ($action == "editItem" && isset($_GET['itemID']))  {
            $itemID = htmlspecialchars($_GET["itemID"]);
        } else {
            $itemID = 0;
        }

        $setItem = new Save($itemName, $catID, $itemPrice, $itemStatus, $itemStock, $itemDesc1, $itemDesc2, $itemDesc3, $itemID);
        $setItem->process();

        unset($itemName, $catID, $itemPrice, $itemStatus, $itemStock, $itemDesc1, $itemDesc2, $itemDesc3, $itemID, $setItem);
    }
}

// delete item
if ($action == "delItem") {
    if (isset($_GET['itemID']))  {
        $itemID = htmlspecialchars($_GET['itemID']);
        $delItem = new Delete($itemID);
        $delItem->process();

        unset($itemID, $delItem);
    } else {
        header("location: " . pageURL(true,true) . "error=0");
    }
}
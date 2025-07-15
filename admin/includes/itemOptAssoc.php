<?php
use \Options\Associations\Options\SetAssoc\Save;
use \Options\Associations\Options\DeleteAssoc\Delete;

// add item & option association
if ($action === "addItemOptAssoc") {
    if (isset($_GET['optID']) && isset($_GET['itemID'])) {
        $itemID = htmlspecialchars($_GET['itemID']);
        $optID = htmlspecialchars($_GET['optID']);

        $set = new Save($itemID, $optID);
        $set->process();

        unset($itemID, $optID, $set);
    }
}

// delete item & option association
if ($action === "delItemOptAssoc") {
    if (isset($_GET['assocID']) && isset($_GET['itemID'])) {     
        $assocID = htmlspecialchars($_GET['assocID']);
        $itemID = htmlspecialchars($_GET['itemID']);
        
        $delAssoc = new Delete($assocID, $itemID);
        $delAssoc->process();

         unset($assocID, $itemID, $delAssoc);
    }
}
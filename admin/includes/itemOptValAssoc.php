<?php
use \Options\Associations\Values\SetAssoc\Save;
use \Options\Associations\Values\DeleteAssoc\Delete;

// add item & value association
if ($action == "addItemValAssoc") {
    if (isset($_GET['optID']) && isset($_GET['itemID']) && isset($_GET['valID'])) {
        $itemID = htmlspecialchars($_GET['itemID']);
        $optID = htmlspecialchars($_GET['optID']);
        $valID = htmlspecialchars($_GET['valID']);

        $setAssoc = new Save($itemID, $optID, $valID);
        $setAssoc->process();

        unset($itemID, $optID, $valID, $setAssoc);
    }
}

// delete item & option association
if ($action == "delItemValAssoc") {
    if (isset($_GET['assocID']) && isset($_GET['itemID'])) {
        $assocID = htmlspecialchars($_GET['assocID']);
        $itemID = htmlspecialchars($_GET['itemID']);
        
        $delAssoc = new Delete($assocID, $itemID);
        $delAssoc->process();

        unset($assocID, $itemID, $delAssoc);
    }
}

<?php
use \Options\SetOption\Save;
use \Options\DeleteOption\Delete;

// submit / update option
if (($action === "addOpt") || ($action === "editOpt")) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $optName = htmlspecialchars($_POST["optName"]);

        if ($action === "editOpt" && isset($_GET['optID'])) {
            $optID = htmlspecialchars($_GET['optID']);
        } else {
            $optID = null;
        }

        $set = new Save($optName, $optID);
        $set->process();

        unset($optName, $optID, $set);
    }
}

// delete option
if ($action === "delOpt") {
    if (isset($_GET['optID'])) {
        $optID = htmlspecialchars($_GET['optID']);

        $delete = new Delete($optID);
        $delete->process();

        unset($optID, $delete);
    }
}
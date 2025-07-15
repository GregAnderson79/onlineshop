<?php
use \Options\Values\SetValue\Save;
use \Options\Values\DeleteValue\Delete;

 // submit / update option value
if (($action == "addVal") || ($action == "editVal")) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $valName = htmlspecialchars($_POST["valName"]);

        if (isset($_GET['optID'])) {
            $optID = htmlspecialchars($_GET['optID']);

            if ($action == "editVal" && isset($_GET['valID'])) {
                $valID = htmlspecialchars($_GET['valID']);
            } else {
                $valID = null;
            }

            $setValue = new Save($valName, $optID, $valID);
            $setValue->process();

            unset($valName, $optID, $valID, $setValue);
        }
    }
}

// delete option value
if ($action == "delVal") {
    if (isset($_GET['valID'])) {
        $valID = htmlspecialchars($_GET['valID']);

        $deleteValue = new Delete($valID);
        $deleteValue->process();

        unset($valID, $deleteValue);
    }
}
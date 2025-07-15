<?php
use \Admins\SetAdmin\Save;
use \Admins\DeleteAdmin\Delete;

// submit / update admin
if (($action == "addAdmin") || ($action == "editAdmin")) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $adminName = htmlspecialchars($_POST["adminName"]);
        $adminEmail = htmlspecialchars($_POST["adminEmail"]);
        $adminPwd = htmlspecialchars($_POST["adminPwd"]);
        if (($action === "editAdmin") && (isset($_GET['adminID'])))  {
            $adminID = htmlspecialchars($_GET['adminID']);
        } else {
            $adminID = null;
        }

        $setAdmin = new Save($adminName, $adminEmail, $adminPwd, $adminID);
        $setAdmin->process();
    }
}

// delete admin
if ($action == "delAdmin") {
    if (isset($_GET['adminID']))  {
        $adminID = htmlspecialchars($_GET['adminID']);
        $delAdmin = new Delete($adminID);
        $delAdmin->process();
    } else {
        header("location: " . pageURL(true,true) . "error=0");
    }
}

unset($adminName, $adminEmail, $adminPwd, $adminID, $setAdmin, $delAdmin);
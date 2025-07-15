<?php
use \PayPal\SetEmail\Save;

// submit / update admin PayPal email
if (($action === "addPayPalEmail") || ($action === "editPayPalEmail")) {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $payPalEmail = htmlspecialchars($_POST["payPalEmail"]);
        $ppID = htmlspecialchars($_POST["ppID"]);
        if ($action == "addPayPalEmail" || !isset($ppID))  {
            $ppID = null;
        }

        $setPayPalEmail = new Save($ppID, $payPalEmail);
        $setPayPalEmail->process();

        unset($payPalEmail, $ppID, $setPayPalEmail);
    }
}
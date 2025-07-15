<?php
use \Delivery\SetPrice\Save;

// submit / update delivery price
if ($action == "addDelPrice" || $action == "editDelPrice") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $delPrice = htmlspecialchars($_POST["delPrice"]);
        $dpID = htmlspecialchars($_POST["dpID"]);
        if ($action == "addDelPrice" || !isset($dpID))  {
            $dpID = null;
        }

        $setDelPrice = new Save($dpID, $delPrice);
        $setDelPrice->process();

        unset($delPrice, $dpID, $setDelPrice);
    }
}
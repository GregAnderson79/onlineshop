<?php
// update category order
use Categories\Order\SetOrder;

if ($action == "orderCats") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pos = $_POST["pos"];

        $order = new SetOrder($pos);
        $order->updateOrder();
    }

    unset($pos, $order);
}
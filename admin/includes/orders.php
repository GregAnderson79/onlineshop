<?php

// Orders
use Orders\List\GetOrders;

// Orders
if ($action === "orders") {
?>
    <div class="popup_bg">
        <div class="popup_big_pnl">
            <div class="popup_close"><a href="<?php echo pageURL(true,false); ?>">&#10005;</a></div>
            <div class="popup_ttl">Manage Orders</div>
            <div class="popup_pad">
<?php
                // get orders
                $orders = new GetOrders();
                $orders->createList();
?>
            </div>
        </div>
    </div>
<?php
}
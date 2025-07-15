<?php

// Get orders (View)
namespace Orders\List;

class GetOrders extends Process {

    public function createList() {
        $orders = $this->process();
        if ($orders) {
            echo "<ul class=\"order_list\">";
            echo "<li><ul>";
            echo "<li><b>Order</b></li>";
            echo "<li><b>Name</b></li>";
            echo "<li><b>Contact details</b></li>";
            echo "<li><b>Address</b></li>";
            echo "<li><b>Items</b></li>";
            echo "<li><b>Total</b></li>";
            echo "<li><b>Status</b></li>";
            echo "</ul></li>";
            foreach ($orders as $i) {
                echo "<li><ul>";
                echo "<li><span class=\"cart_hide\">Order ID: </span>" . $i['orderID'] . "</li>";
                echo "<li>" . $i['firstName'] . " " . $i['lastName'] . "</li>";
                echo "<li>" . $i['email'] . ", <span class=\"cart_br\">" . $i['tel'] . "</span></li>";
                echo "<li>" . $i['address1'] . ", <span class=\"cart_br\">" . $i['address2'] . ", </span><span class=\"cart_br\">" . $i['towncity'] . ", </span><span class=\"cart_br\">" . $i['county'] . ", </span><span class=\"cart_br\">" . $i['postcode'] . "</li>";
                echo "<li>";
                $items = json_decode($i['items'], true);
                if ($items) {
                    foreach ($items as $j) {
                        echo $j['quantity'] . " x (item ID " . $j['itemID'] . ") " . $j['itemName'] . " @ £" . $j['itemPrice'];
                        $options = $j['options'];
                        if ($options) {
                            echo "... <span class=\"cart_br\">Options:";
                            foreach ($options as $key => $value) {
                                echo " (" . $key . " = " . $value . ")";
                            }
                            echo "</span>";
                        }
                        echo "<br>&nbsp;<br>";
                    }
                }
                echo "</li>";
                echo "<li><span class=\"cart_hide\">Total: </span>£" . $i['total'] . "</li>";
                echo "<li><span class=\"cart_hide\">Status: </span>" . $i['orderStatus'] . "</li>"; 
                echo "</ul></li>";
            }
            echo "</ul>";
        } else {
            echo "<p class=\"empty_notice\">No orders</p>";
        }
    }
}
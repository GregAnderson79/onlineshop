<?php

// List items in cart
namespace Cart\Items;
class GetItems {

    public function createList() {
        if ($_SESSION["cartItems"] && $_SESSION["cartItems"] > 0) {
?>
            <ul>
            <li><b>Item</b></li>
            <li><b>Qty</b></li>
            <li><b>Price</b></li>
            <li><b>Total</b></li>
            <li></li>
            </ul>
<?php
            $items = $_SESSION["cartItems"];
            foreach($items as $i => $item) {
                echo "<ul aria-label=\"Cart item\">\n";
                echo "<li aria-label=\"Item name & selected options\">" . $item['itemName'];
                if (!empty($item['options'])) {
                    echo " (";
                    $options = $item['options'];
                    foreach ($options as $option => $value) {
                        $optName = explode("|", $option);
                        $text = str_replace("_"," ",$optName[0]);
                        echo $text . ":";
                        $valName = explode("|", $value);
                        $text = str_replace("_"," ",$valName[0]);
                        echo $text;
                        if ($option != array_key_last($options)) {
                            echo ", \n";
                        }
                    }
                
                    echo ")";
                }
                echo "</li>\n";
                echo "<li aria-label=\"Quantity\">" . $item['quantity'] . "</li>\n";
                echo "<li aria-label=\"Price each\">£" . $item['itemPrice'] . "</li>\n";
                if (!empty($item['itemPrice'])) {
                    $price = floatval($item['itemPrice']);
                    $quantity = intval($item['quantity']);
                    $total = $price * $quantity;
                    echo "<li aria-label=\"Total\"><b>£" . number_format($total, 2) . "</b></li>\n";
                }

                echo "<li><a href=\"cart.php?action=delRow&rowID=" . $i . "\"  onclick=\"return confirm('Are you sure you want to remove this item?')\">&#10005;</a></li>\n";
                echo "</ul>\n";
            }

        } else {
            echo "<p class=\"no-items\">Your shopping cart is empty.</p>";
        }
    }
}
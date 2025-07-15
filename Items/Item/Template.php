<?php

// Item template
namespace Items\Item;
use Items\Item\Images\Main\GetImage;

class Template {
    public $items;

    public function __construct($items) {
        $this->items = $items;
    }

    public function createItems() {
        foreach ($this->items as $i) {
            if ($i['itemStatus'] == "active") {
                echo "<div class=\"item\">\n";
                echo "<a href=\"item.php?itemID=" . $i['itemID'] . "\" aria-label=\"View this item (" . $i['itemName'] . ")\"></a>\n";

                // get main item image
                $mainImg = new GetImage($i['itemID'], $i['itemName']);
                $mainImg->returnImage();

                echo "<h3>" . $i['itemName'] . "</h3>\n";
                echo "<p aria-label=\"Price: £" . $i['itemPrice'] . "\">£" .  $i['itemPrice'] . "</p>\n";
                echo "</div>\n";
            }
        }
    }
}
<?php
// Get main image for item (View)
namespace Items\Item\Images\Main;

class GetImage extends Process {
    public $itemID;
    public $itemName;

    public function __construct($itemID, $itemName) {
        $this->itemID = $itemID;
        $this->itemName = $itemName;
    }

    public function returnImage() {
        $img = $this->process();
        if ($img) {
            echo "<div class=\"item_img\">\n";
            echo "<img src=\"itemImages/cat-" . $img['imgName'] . "\" alt=\"";
            if ($img['altTag'] == null) {
                echo $this->itemName;
            } else {
                echo $img['altTag'];
            }
            echo "\">\n";
            echo "</div>\n";
        } else {
            echo "<div class=\"item_no_img\"></div>\n";
        }
    }
}
<?php
// Get item images (View)
namespace Items\Item\Images\List;

class GetImages extends Process {
    public $itemID;

    public function __construct($itemID) {
        $this->itemID = $itemID;
    }

    // return Item Images and Options
    public function createList() {
        $items = $this->process();
        if ($items) {
            echo "<ul>";
            foreach ($items as $row => $cols) {
                echo "<li>";
                if ($cols['isMain'] == true) {
                    echo "<span class=\"main_item_img\"><span>&#10003</span>";
                } else {
                    echo "<span>";
                }
                echo "<img src=\"../itemImages/thumb_" . $cols['imgName'] . "\" alt=\"" . $cols['altTag'] . "\"></span>";
                echo "<span class=\"column_li_opts\">";
                if ($cols['isMain'] == true) {
                    echo "<span class=\"grey_disabled\">Main image</span>";
                } else {
                    echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=setMainItemImg&imgID=" . $cols['imgID'] . "&itemID=" . $this->itemID . "\">Set to main</a>";
                }
                echo "<a class=\"nav_red\" href=\"" . pageURL(true,true) . "action=delItemImg&imgID=" . $cols['imgID'] . "&itemID=" . $this->itemID . "\" onclick=\"return confirm('Are you sure you want to delete this image?')\">Delete</a>";
                echo "</span></li>";
            }
            echo "</ul>";
        } else {
            echo "<p class=\"empty_notice\">No images</p>";
        }
    }
}
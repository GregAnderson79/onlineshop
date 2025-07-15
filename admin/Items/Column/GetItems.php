<?php
// Item list for column (View)
namespace Items\Column;

class GetItems extends Process {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function createMenu() {
        $items = $this->process();
        if ($items) {
            echo "<ul>";
            foreach ($items as $i) {
                echo "<li><span>" . $i['itemName'] . "</span>";
                echo "<span class=\"column_li_opts\">";
                echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=editItem&itemID=" . $i['itemID'] . "\">Edit</a>";
                echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=itemImgList&itemID=" . $i['itemID'] . "\">Images</a>";
                echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=itemOpts&itemID=" . $i['itemID'] . "\">Options</a>";
                echo "<a class=\"nav_red\" href=\"" . pageURL(true,true) . "action=delItem&itemID=" . $i['itemID'] . "\" onclick=\"return confirm('Are you sure you want to delete this item?')\">Delete</a>";
                echo "</span></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No items</p>";
        }
    }
}
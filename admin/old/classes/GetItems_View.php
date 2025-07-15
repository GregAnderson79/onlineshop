<?php

// Get items 
class GetItems_View extends GetItems_Contr {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function view_getItems() {
        $cats = $this->getItems();
        if ($cats) {
            echo "<ul>";
            foreach ($cats as $row => $cols) {
                echo "<li><span>" . $cols['itemName'] . "</span>";
                echo "<span class=\"column_li_opts\">";
                echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=editItem&itemID=" . $cols['itemID'] . "\">Edit</a>";
                echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=itemImgList&itemID=" . $cols['itemID'] . "\">Images</a>";
                echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=itemOpts&itemID=" . $cols['itemID'] . "\">Options</a>";
                echo "<a class=\"nav_red\" href=\"" . pageURL(true,true) . "action=delItem&itemID=" . $cols['itemID'] . "\" onclick=\"return confirm('Are you sure you want to delete this item?')\">Delete</a>";
                echo "</span></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No items</p>";
        }
    }

    // contr
    private function getItems() {
        return $this->contr_getItems();
    }
}
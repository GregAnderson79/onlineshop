<?php

// Item list for a category (View)
namespace Items\Lists\Category;
use Items\Item\Template;

class GetItems extends Process {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function createList() {
        $items = $this->process();
        if ($items) {

            // use item template
            $itemList = new Template($items);
            $itemList->createItems();

        } else {
            echo "<p class=\"no-items\">No items found.</p>";
        }
    }
}
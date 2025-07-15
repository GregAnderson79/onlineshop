<?php

// Item list for home (View)
namespace Items\Lists\All;
use Items\Item\Template;

class GetItems extends Process {

    public function createList() {
        $items = $this->process();
        if ($items) {

            // use item template
            $itemList = new Template($items);
            $itemList->createItems();
        }
    }
}
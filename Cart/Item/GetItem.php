<?php

// Get item for cart (View)
namespace Cart\Item;

class GetItem extends Process {
    public $itemID;

    public function __construct($itemID) {
        $this->itemID = $itemID;
    }

    public function returnItem() {
        return $this->process();
    }
}
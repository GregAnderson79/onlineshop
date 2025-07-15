<?php

// Get item data for item view page (View)
namespace Item\GetItem;

class GetData extends Process {
    public $itemID;

    public function __construct($itemID) {
        $this->itemID = $itemID;
    }

    public function returnItem() {
        $item = $this->process();
        if ($item) {
            return $item;
        } else {
            return null;
        }
    }
}
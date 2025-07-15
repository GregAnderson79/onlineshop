<?php
// Get item data to edit (View)
namespace Item\GetItem;

class GetData extends Process {
    public $itemID;

    public function __construct($itemID) {
        $this->itemID = $itemID;
    }

    public function itemData() {
        return $this->process();
    }
}
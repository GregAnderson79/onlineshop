<?php

// Get item
class GetItem_View extends GetItem_Contr {
    public $itemID;

    public function __construct($itemID) {
        $this->itemID = $itemID;
    }

    public function view_getItem() {
        return $this->getItem();
    }

    private function getItem() {
        return $this->contr_getItem();
    }
}
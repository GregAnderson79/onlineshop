<?php

// delete item
class DelItem_Contr extends SetItem_Model {
    public $itemID;

    public function __construct($itemID) {
        $this->itemID = $itemID;
    }

    public function contr_delItem() { 
        if ($this->delItem() === true) {
            header("location: " . pageURL(true,false));
        } else {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }
    }

    // model
    private function delItem() {
        return $this->model_delItem();
    }
}
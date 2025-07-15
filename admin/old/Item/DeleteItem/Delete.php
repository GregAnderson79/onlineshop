<?php
// Delete item (Controller)
namespace Item\DeleteItem;

class Delete extends Model {
    public $itemID;

    public function __construct($itemID) {
        $this->itemID = $itemID;
    }

    public function process() { 
        if ($this->delete() === true) {
            header("location: " . pageURL(true,false));
            exit;
        } else {
            header("location: " . pageURL(true,true) . "error=0");
            exit;
        }
    }

    // model
    private function delete() {
        return $this->query();
    }
}
<?php
// Delete Category (Controller)
namespace Categories\DeleteCategory;

class Delete extends Model {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
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
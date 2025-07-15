<?php
// Get category name (View)
namespace Categories\Title;

class GetName extends Process {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function categoryName() {
        $name = $this->process();
        if ($name) {
            return " in " . $name;
        }
    }
}
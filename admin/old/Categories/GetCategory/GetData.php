<?php
// Get category data to edit (View)
namespace Categories\GetCategory;

class GetData extends Process {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function categoryData() {
        return $this->process();
    }
}
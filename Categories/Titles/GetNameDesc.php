<?php
// Get category name (View)
namespace Categories\Titles;

class GetNameDesc extends Process {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function returnCat() {
        return $this->process();
    }
}
<?php

// Get Category Name
// for showing the category name at the top of the columns
class GetCatName_View extends GetCatName_Contr {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function view_getCatName() {
        return $this->getCatName();
    }

    // contr
    private function getCatName() {
        return $this->contr_getCatName();
    }
}
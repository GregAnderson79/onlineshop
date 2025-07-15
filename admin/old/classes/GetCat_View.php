<?php

// Get Category Data
// for recalling stored category data
class GetCat_View extends GetCat_Contr {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function view_getCat() {
        return $this->getCat();
    }

    // contr
    private function getCat() {
        return $this->contr_getCat();
    }
}
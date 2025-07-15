<?php

// Get Category Row Count
// for finding out if there are enough parent or child categories to run ordering
class GetCatsRowCount_View extends GetCatsRowCount_Contr {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function view_getCatsRowCount() {
        return $this->getCatsRowCount();
    }

    // contr
    private function getCatsRowCount() {
        return $this->contr_getCatsRowCount();
    }
}
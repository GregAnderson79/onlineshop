<?php
// get category item row count (View)
namespace Categories\RowCounts\Items;

class GetRowCount extends Process {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function rowCount() {
        return $this->process();
    }
}
<?php
// get sub category row count (View)
namespace Categories\RowCounts\Subs;

class GetRowCount extends Process {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function rowCount() {
        return $this->process();
    }
}
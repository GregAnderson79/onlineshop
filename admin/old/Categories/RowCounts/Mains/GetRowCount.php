<?php
// get main category row count (View)
namespace Categories\RowCounts\Mains;

class GetRowCount extends Process {
    public function rowCount() {
        return $this->process();
    }
}
<?php
// get category item row count (Controller)
namespace Categories\RowCounts\Items;

class Process extends Model {
    protected function process() {
        return $this->query();
    }
}
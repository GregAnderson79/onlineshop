<?php
// get sub category row count (Controller)
namespace Categories\RowCounts\Subs;

class Process extends Model {
    protected function process() {
        $numCats = $this->privateQuery();
        if ($numCats == null) {
            return 0;
        } else {
            return $numCats;
        }
    }

    private function privateQuery() {
        return $this->query();
    }
}
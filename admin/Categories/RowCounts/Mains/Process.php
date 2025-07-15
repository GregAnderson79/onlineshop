<?php
// get main category row count (Controller)
namespace Categories\RowCounts\Mains;

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
<?php
// get main category row count (Controller)
namespace Categories\RowCounts\Mains;

class Process extends Model {
    protected function process() {
        $numCats = $this->query();
        if ($numCats == null) {
            return 0;
        } else {
            return $numCats;
        }

        unset($numCats);
    }
}
<?php
// Get category name (Controller)
namespace Categories\Title;

class Process extends Model {
    protected function process() {
        $results = $this->privateQuery();
        if ($results) {
            return $results['catName'];
        } else {
            return null;
        }

        unset($results);
    }

    private function privateQuery() {
        return $this->query();
    }
}
<?php
// Get category data to edit (Controller)
namespace Categories\GetCategory;

class Process extends Model {
    protected function process() {
        return $this->privateQuery();
    }

    private function privateQuery() {
        return $this->query();
    }
}
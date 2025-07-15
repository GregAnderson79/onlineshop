<?php
// Get category name (Controller)
namespace Categories\Titles;

class Process extends Model {
    protected function process() {
        return $this->privateQuery();
    }

    private function privateQuery() {
        return $this->query();
    }
}
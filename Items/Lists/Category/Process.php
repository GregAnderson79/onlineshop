<?php
// Item list for a category (Controller)
namespace Items\Lists\Category;

class Process extends Model {

    protected function process() {
        $items = $this->privateQuery();
        if ($items) {
            return $items;
        }
    }

    private function privateQuery() {
        return $this->query();
    }
}
<?php
// Get list of all items for home (Controller)
namespace Items\Lists\All;

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
<?php
// Get item data to edit (Controller)
namespace Items\Item\GetItem;

class Process extends Model {
    protected function process() {
        return $this->privateQuery();
    }

    private function privateQuery() {
        return $this->query();
    }
}
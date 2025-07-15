<?php

// Get item for cart (Controller)
namespace Cart\Item;

class Process extends Model {

    protected function process() {
        return $this->privateQuery();
    }

    private function privateQuery() {
        return $this->query();
    }
}
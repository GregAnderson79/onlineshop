<?php

// Get item data for item view page (Controller)
namespace Item\GetItem;

class Process extends Model {

    protected function process() {
        $item = $this->privateQuery();
        if ($item) {
            return $item;
        }
    }

    private function privateQuery() {
        return $this->query();
    }
}
<?php

// Get delivery price (Controller)
namespace Cart\Delivery;

class Process extends Model {

    protected function process() {
        $row = $this->privateQuery();
        if ($row) {
            return $row[0]['delPrice'];
        }
    }

    private function privateQuery() {
        return $this->query();
    }
}
<?php
// Get delivery price (Controller)
namespace Delivery\GetPrice;

class Process extends Model {

    protected function process() {
        return $this->privateQuery();
    }

    private function privateQuery() {
        return $this->query();
    }
}
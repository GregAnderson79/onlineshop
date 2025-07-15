<?php
// Get delivery price (Controller)
namespace Delivery\GetPrice;

class Process extends Model {

    protected function process() {
        $delPrice = $this->privateQuery();
        if ($delPrice) {
            return $delPrice;
        } else {
            return null;
        }

        unset($delPrice);
    }

    private function privateQuery() {
        return $this->query();
    }
}
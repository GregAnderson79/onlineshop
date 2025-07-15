<?php
// Get list of sub categories for mobile nav (Controller)
namespace Categories\Lists\MobileNav\Subs;
use Categories\Lists\Model\Subs as Model;

class Process extends Model {
    protected function process() {
        return $this->privateQuery();
    }

    private function privateQuery() {
        return $this->query();
    }
}
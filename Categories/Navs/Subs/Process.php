<?php
// Get list of sub categories for mobile nav (Controller)
namespace Categories\Navs\Subs;
use Categories\Model\Subs as Model;

class Process extends Model {

    protected function process() {
        $subs = $this->privateQuery();
        if ($subs) {
            return $subs;
        }
    }

    private function privateQuery() {
        return $this->query();
    }
}
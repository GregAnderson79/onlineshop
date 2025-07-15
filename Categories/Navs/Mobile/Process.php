<?php
// Get list of all categories for mobile nav (Controller)
namespace Categories\Navs\Mobile;
use Categories\Model\Mains as Model;

class Process extends Model {

    protected function process() {
        $mains = $this->privateQuery();
        if ($mains) {
            return $mains;
        }
    }

    private function privateQuery() {
        return $this->query();
    }
}
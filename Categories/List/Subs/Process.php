<?php

// Get list of sub categories for parent category page (Controller)
namespace Categories\List\Subs;
use Categories\Model\Subs as Model;

class Process extends Model {

    protected function process() {
        return $this->privateQuery();
    }

    private function privateQuery() {
        return $this->query();
    }
}

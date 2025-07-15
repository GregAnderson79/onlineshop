<?php
// Get list of main categories for selector menu (Controller)
namespace Categories\Lists\Selectors\Mains;
use Categories\Lists\Model\Mains as Model;

class Process extends Model {
    protected function process() {
        return $this->privateQuery();
    }

    private function privateQuery() {
        return $this->query();
    }
}
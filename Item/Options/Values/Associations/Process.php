<?php

// Get list of option values associations for an item (Controller)
namespace Item\Options\Values\Associations;

class Process extends Model {

    protected function process() {
        $values = $this->privateQuery();
        if ($values) {
            return $values;
        }
    }

    private function privateQuery() {
        return $this->query();
    }
}
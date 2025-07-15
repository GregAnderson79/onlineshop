<?php

// Get option name (Controller)
namespace Item\Options\Names;

class Process extends Model {

    protected function process() {
        $name = $this->privateQuery($this->optID);
        if ($name) {
            return $name['optName'];
        } else {
            return null;
        }
    }

    private function privateQuery() {
        return $this->query();
    }
}
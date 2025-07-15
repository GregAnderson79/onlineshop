<?php

// Get option value name (Controller)
namespace Item\Options\Values\Names;

class Process extends Model {

    protected function process() {
        $name = $this->privateQuery($this->valID);
        if ($name) {
            return $name['valName'];
        }
    }

    private function privateQuery() {
        return $this->query();
    }
}
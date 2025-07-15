<?php
// Get option value (Controller)
namespace Options\Values\GetValue;

class Process extends Model {
    protected function process() {
        return $this->privateQuery();
    }

    private function privateQuery() {
        return $this->query();
    }
}
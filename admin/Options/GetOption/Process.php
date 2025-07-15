<?php
// Get option (View)
namespace Options\GetOption;

class Process extends Model {

    protected function process() {
        return $this->privateQuery();
    }

    private function privateQuery() {
        return $this->query();
    }
}
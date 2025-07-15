<?php
// Return latest encryption codes (Controller)
namespace Password\Encryption;

class Process extends Model {
    protected function process() {
        $codes = $this->privateQuery();
        return end($codes);
    }

    private function privateQuery() {
        return $this->query();
    }
}
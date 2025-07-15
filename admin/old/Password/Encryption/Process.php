<?php
// Return latest encryption codes (Controller)
namespace Password\Encryption;

class Process extends Model {
    protected function process() {
        $codes = $this->query();
        return end($codes);
        unset($codes);
    }
}
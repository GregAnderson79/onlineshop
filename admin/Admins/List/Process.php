<?php
// Get all admin account details (Controller)
namespace Admins\List;

// Get all admin account details
class Process extends Model {

    protected function process() {
        return $this->privateQuery();
    }

    private function privateQuery() {
        return $this->query();
    }
}
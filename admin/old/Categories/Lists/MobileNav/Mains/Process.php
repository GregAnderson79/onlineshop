<?php
// Get list of all categories for mobile nav (Controller)
namespace Categories\Lists\MobileNav\Mains;
use \Categories\Lists\Model\Mains as Model;

class Process extends Model {
    protected function process() {
        return $this->query();
    }
}
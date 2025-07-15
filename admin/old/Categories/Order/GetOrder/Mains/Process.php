<?php
// Get category re-order form for main categories (Controller)
namespace Categories\Order\GetOrder\Mains;
use \Categories\Lists\Model\Mains as Model;

class Process extends Model {
    protected function process() {
        return $this->query();
    }
}
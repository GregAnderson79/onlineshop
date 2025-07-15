<?php
// Get category re-order form for main or sub categories (Controller)
namespace Categories\Order\GetOrder\Subs;
use \Categories\Lists\Model\Subs as Model;

class Process extends Model {
    protected function process() {
        return $this->query();
    }
}
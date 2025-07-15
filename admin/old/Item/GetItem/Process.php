<?php
// Get item data to edit (Controller)
namespace Item\GetItem;

class Process extends Model {
    protected function process() {
        return $this->query();
    }
}
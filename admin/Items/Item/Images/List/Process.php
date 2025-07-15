<?php
// Get item images (Controller)
namespace Items\Item\Images\List;

class Process extends Model {
    protected function process() {
        return $this->privateQuery();
    }

    private function privateQuery() {
        return $this->query();
    }
}
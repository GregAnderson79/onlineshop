<?php
// Item list for column (Controller)
namespace Items\Column;

class Process extends Model {
    protected function process() {
        return $this->privateQuery();
    }

    private function privateQuery() {
        return $this->query();
    }
}
<?php
// Get item images (Controller)
namespace Item\Images\List;

class Process extends Model {
    protected function process() {
        return $this->query();
    }
}
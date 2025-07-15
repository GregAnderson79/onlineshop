<?php
// Get list of options (Controller)
namespace Options\Column;

class Process extends Model {
    protected function process() {
        return $this->query();
    }
}
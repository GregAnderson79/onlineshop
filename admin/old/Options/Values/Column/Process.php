<?php
// Get option values for column (Controller)
namespace Options\Values\Column;

class Process extends Model {
    protected function process() {
        return $this->query();
    }
}
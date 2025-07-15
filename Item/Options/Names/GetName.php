<?php

// Get option name (View)
namespace Item\Options\Names;

class GetName extends Process {
    public $optID;

    public function __construct($optID) {
        $this->optID = $optID;
    }

    public function returnOptName() {
        return $this->process();
    }
}
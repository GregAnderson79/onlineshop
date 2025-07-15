<?php

// Get option value name (View)
namespace Item\Options\Values\Names;

class GetName extends Process {
    public $valID;

    public function __construct($valID) {
        $this->valID = $valID;
    }

    public function returnValName() {
        return $this->process();
    }
}
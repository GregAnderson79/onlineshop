<?php
// Get option value (View)
namespace Options\Values\GetValue;

class GetData extends Process {
    public $valID;

    public function __construct($valID) {
        $this->valID = $valID;
    }

    public function returnValue() {
        return $this->process();
    }
}
<?php
// Get option (View)
namespace Options\GetOption;

class GetData extends Process {
    public $optID;

    public function __construct($optID) {
        $this->optID = $optID;
    }

    public function returnOption() {
        return $this->process();
    }
}
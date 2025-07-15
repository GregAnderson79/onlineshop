<?php

// Get option
class GetOption_View extends GetOption_Contr {
    public $optID;

    public function __construct($optID) {
        $this->optID = $optID;
    }

    public function view_getOption() {
        return $this->getOption();
    }

    private function getOption() {
        return $this->contr_getOption();
    }
}
<?php

// Get option value
class GetValue_View extends GetValue_Contr {
    public $valID;

    public function __construct($valID) {
        $this->valID = $valID;
    }

    public function view_getValue() {
        return $this->getValue();
    }

    private function getValue() {
        return $this->contr_getValue();
    }
}
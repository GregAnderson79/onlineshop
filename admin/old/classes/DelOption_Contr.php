<?php

// Delete option
class DelOption_Contr extends SetOption_Model {
    public $optID;

    public function __construct($optID) {
        $this->optID = $optID;
    }

    // delete Item
    public function contr_delOption() {

        // validate
        if ($this->valNumeric()) {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        if ($this->delOption() === true) {
            header("location: " . pageURL(true,false));
        } else {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }
    }

    // validate ID
    private function valNumeric() {
        if (!is_numeric($this->optID)) {
            return true;
        }
    }

    // private Delete Item
    private function delOption() {
        return $this->model_delOption();
    }
}
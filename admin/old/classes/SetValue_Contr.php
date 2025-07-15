<?php

// Set option value
class SetValue_Contr extends SetValue_Model {
    protected $valName;
    protected $optID;
    protected $valID;

    public function __construct($valName, $optID, $valID) {
        $this->valName = $valName;
        $this->optID = $optID;
        $this->valID = $valID;
    }

    public function contr_setValue() {

        // validate
        if ($this->valLength()) {
            $_SESSION["valName"] = $this->valName;

            header("location: " . pageURL(false,true) . "error=2");
            exit();
        }

        // add value
        if ($this->setValue() === true) {
            header("location: " . pageURL(true,false));
        } else {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }
    }

    // model
    private function setValue() {
        if ($this->valID) {
            return $this->model_updValue();
        } else {
            return $this->model_addValue();
        }
    }

    // validate name length
    private function valLength() {
        if (strlen($this->valName) < 1) {
            return true;
        }
    }
}
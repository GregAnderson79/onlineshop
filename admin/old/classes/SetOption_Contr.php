<?php

// Set option
class SetOption_Contr extends SetOption_Model {
    protected $optName;
    protected $optID;

    public function __construct($optName, $optID) {
        $this->optName = $optName;
        $this->optID = $optID;
    }

    public function contr_setOption() {

        // validate
        if ($this->valLength()) {
            $_SESSION["optName"] = $this->optName;

            header("location: " . pageURL(false,true) . "error=2");
            exit();
        }

        // add option
        if ($this->setOption() === true) {
            header("location: " . pageURL(true,false));
        } else {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }
    }

    // model
    private function setOption() {
        if ($this->optID) {
            return $this->model_updOption();
        } else {
            return $this->model_addOption();
        }
    }

    // validate name length
    private function valLength() {
        if (strlen($this->optName) < 1) {
            return true;
        }
    }
}
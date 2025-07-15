<?php

// Delete option value
class DelValue_Contr extends SetValue_Model {
    protected $valID;

    public function __construct($valID) {
        $this->valID = $valID;
    }

    // delete Item
    public function contr_delValue() { 

        // validate
        if ($this->valNumeric()) {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        if ($this->delValue() === true) {
            header("location: " . pageURL(true,false));
        } else {
            header("location: " . pageURL(true,true) . "error=0"); // error
            exit();
        }
    }

    // validate ID
    private function valNumeric() {
        if (!is_numeric($this->valID)) {
            return true;
        }
    }

    // model
    private function delValue() {
        return $this->model_delValue();
    }
}
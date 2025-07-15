<?php

// Set delivery price (add or update)
class SetDelPrice_Contr extends SetDelPrice_Model {
    public $dpID;
    public $delPrice;

    public function __construct($dpID, $delPrice) {
        $this->dpID = $dpID;
        $this->delPrice = $delPrice;
    }

    public function contr_setDelPrice() {

        // validation
        if (($this->valNumeric()) || ($this->valFormat())) {
            $_SESSION["delPrice"] = $this->delPrice;

            if ($this->valNumeric()) {
                header("location: " . pageURL(false,true) . "error=1");
                exit();
            }

            if ($this->valFormat()) {
                header("location: " . pageURL(false,true) . "error=2");
                exit();
            }
        }

        if ($this->setDelPrice() === true) { 
            header("location: " . pageURL(true,true) . "action=editDelPrice");
        } else {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }
    }

    // to model
    private function setDelPrice() {
        if ($this->dpID) {
            return $this->model_updDelPrice();
        } else {
            return $this->model_addDelPrice();
        }
    }

    // validate price is numeric
    private function valNumeric() {
        if (!is_numeric($this->delPrice)) {
           return true;
        }
    }

    // validate price is formatted correctly NN.NN
    private function valFormat() {
        if (!preg_match("/^(0|[1-9]\d*)(\.\d{2})?$/", $this->delPrice)) {
           return true;
        }
    }
}
<?php
// Set delivery price (Controller)
namespace Delivery\SetPrice;

class Save extends Model {
    public $dpID;
    public $delPrice;

    public function __construct($dpID, $delPrice) {
        $this->dpID = $dpID;
        $this->delPrice = $delPrice;
    }

    public function process() {

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

        if ($this->set() === true) { 
            header("location: " . pageURL(false,false));
        } else {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }
    }

    // to model
    private function set() {
        if ($this->dpID) {
            return $this->queryUpdate();
        } else {
            return $this->queryAdd();
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
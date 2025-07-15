<?php

// Set PayPal email (add or update)
class SetPayPalEmail_Contr extends SetPayPalEmail_Model {
    public $ppID;
    public $payPalEmail;

    public function __construct($ppID, $payPalEmail) {
        $this->ppID = $ppID;
        $this->payPalEmail = $payPalEmail;
    }

    public function contr_setPayPalEmail() {

        // validation
        if ($this->valEmail()) {
            $_SESSION["payPalEmail"] = $this->payPalEmail;

            if ($this->valEmail()) {
                header("location: " . pageURL(false,true) . "error=1");
                exit();
            }
        }

        if ($this->setPayPalEmail() === true) { 
            header("location: " . pageURL(true,true) . "action=editPayPalEmail");
        } else {
            header("location: " . pageURL(true,true) . "error=0"); // error
            exit();
        }
    }

    // to model
    private function setPayPalEmail() {
        if ($this->ppID) {
            return $this->model_updPayPalEmail();
        } else {
            return $this->model_addPayPalEmail();
        }
    }

    // validate admin email
    private function valEmail() {
        if (!filter_var($this->payPalEmail, FILTER_VALIDATE_EMAIL)) {
           return true;
        }
    }
}
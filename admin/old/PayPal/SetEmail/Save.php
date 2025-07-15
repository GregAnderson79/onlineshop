<?php
// Set PayPal email (Controller)
namespace PayPal\SetEmail;

class Save extends Model {
    public $ppID;
    public $payPalEmail;

    public function __construct($ppID, $payPalEmail) {
        $this->ppID = $ppID;
        $this->payPalEmail = $payPalEmail;
    }

    public function process() {

        // validation
        if ($this->valEmail()) {
            $_SESSION["payPalEmail"] = $this->payPalEmail;

            if ($this->valEmail()) {
                header("location: " . pageURL(false,true) . "error=1");
                exit();
            }
        }

        if ($this->set() === true) { 
            header("location: " . pageURL(true,true) . "action=editPayPalEmail");
        } else {
            header("location: " . pageURL(true,true) . "error=0"); // error
            exit();
        }
    }

    // to model
    private function set() {
        if ($this->ppID) {
            return $this->queryUpdate();
        } else {
            return $this->queryAdd();
        }
    }

    // validate admin email
    private function valEmail() {
        if (!filter_var($this->payPalEmail, FILTER_VALIDATE_EMAIL)) {
           return true;
        }
    }
}
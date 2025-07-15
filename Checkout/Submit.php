<?php
// Checkout submission (Controller)
namespace Checkout;

class Submit extends Model {
    public $firstName;
    public $lastName;
    public $email;
    public $tel;
    public $address1;
    public $address2;
    public $towncity;
    public $county;
    public $postcode;
        
    public function __construct($firstName, $lastName, $email, $tel, $address1, $address2, $towncity, $county, $postcode) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->tel = $tel;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->towncity = $towncity;
        $this->county = $county;
        $this->postcode = $postcode;
    }

    public function processCheckout() {

        // validation
        if (
            !isset($_SESSION["cartItems"]) ||
            $this->valEmpty($this->firstName) ||
            $this->valEmpty($this->lastName) ||
            $this->valEmail() ||
            $this->valTel() ||
            $this->valEmpty($this->address1) ||
            $this->valEmpty($this->towncity) ||
            $this->valEmpty($this->postcode)        
        ) {
            $_SESSION["firstName"] = $this->firstName;
            $_SESSION["lastName"] = $this->lastName;
            $_SESSION["email"] = $this->email;
            $_SESSION["tel"] = $this->tel;
            $_SESSION["address1"] = $this->address1;
            $_SESSION["address2"] = $this->address2;
            $_SESSION["towncity"] = $this->towncity;
            $_SESSION["county"] = $this->county;
            $_SESSION["postcode"] = $this->postcode;

            // validate fields
            if ($this->valEmpty($this->firstName)) {
                header("location: checkout.php?error=1");
                exit();
            }

            if ($this->valEmpty($this->lastName)) {
                header("location: checkout.php?error=2");
                exit();
            }

            if ($this->valEmail()) {
                header("location: checkout.php?error=3");
                exit();
            }

            if ($this->valTel()) {
                header("location: checkout.php?error=4");
                exit();
            }

            if ($this->valEmpty($this->address1)) {
                header("location: checkout.php?error=5");
                exit();
            }

            if ($this->valEmpty($this->towncity)) {
                header("location: checkout.php?error=6");
                exit();
            }

            if ($this->valEmpty($this->postcode)) {
                header("location: checkout.php?error=7");
                exit();
            }
        }

        if ($this->submit() === true) { 
            header("location: complete.php");
            exit();
        } else {
            header("location: checkout.php?error=0");
            exit();
        }
    }

    // model
    private function submit() {
        $cartItems = json_encode($_SESSION["cartItems"]);
        return $this->query($cartItems);
    }

    // validate item name length
    private function valEmpty($string) {
        if (strlen($string) < 1) {
            return true;
        }
    }

    // validate admin email
    private function valEmail() {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
           return true;
        }
    }

    // validate telephone no
    private function valTel() {
        if (!preg_match('/^[0-9]{11}+$/', $this->tel)) {
            return true;
        }
    }
}
<?php

// Set PayPal email (add or update)
class SetPayPalEmail_Model extends Database_Model {

    // Add PayPal email
    protected function model_addPayPalEmail() {
        $sql = "INSERT INTO payPalEmail (payPalEmail) VALUES (?)";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->payPalEmail])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }

    // Update PayPal email
    protected function model_updPayPalEmail() {
        $sql = "UPDATE payPalEmail SET payPalEmail=? WHERE ppID=?";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->payPalEmail, $this->ppID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }   
    }
}
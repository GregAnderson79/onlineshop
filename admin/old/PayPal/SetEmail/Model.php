<?php
// Set PayPal email (Model)
namespace PayPal\SetEmail;
use \Database\Model as DB;

class Model extends DB {

    // add
    protected function queryAdd() {
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

        unset($sql, $statement);
    }

    // update
    protected function queryUpdate() {
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

        unset($sql, $statement);
    }
}
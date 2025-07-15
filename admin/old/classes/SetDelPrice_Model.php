<?php

// Set delivery price (add or update)
class SetDelPrice_Model extends Database_Model {

    // Add delivery price
    protected function model_addDelPrice() {
        $sql = "INSERT INTO delivery (delPrice) VALUES (?)";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->delPrice])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }

    // Update delivery price
    protected function model_updDelPrice() {
        $sql = "UPDATE delivery SET delPrice=? WHERE dpID=?";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->delPrice, $this->dpID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }   
    }
}
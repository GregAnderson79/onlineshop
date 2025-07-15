<?php
// Set delivery price (Model)
namespace Delivery\SetPrice;
use Database\Model as DB;

class Model extends DB {

    // Add
    protected function queryAdd() {
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

    // Update
    protected function queryUpdate() {
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
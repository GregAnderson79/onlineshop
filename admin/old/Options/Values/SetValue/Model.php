<?php
// Set option value (Model)
namespace Options\Values\SetValue;
use \Database\Model as DB;

// Set option value
class Model extends DB {

    // Add value
    protected function queryAdd() {
        $sql = "INSERT INTO optionValues (valName, optID) VALUES (?, ?);"; 
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->valName, $this->optID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }

        unset($sql, $statement);
    }

    // Update value
    protected function queryUpdate() {
        $sql = "UPDATE optionValues SET valName=? WHERE valID=?";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->valName, $this->valID])) {
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
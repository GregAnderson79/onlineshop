<?php

// Set option value
class SetValue_Model extends Database_Model {

    // Add value
    protected function model_addValue() {
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
    }

    // Update value
    protected function model_updValue() {
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
    }

    // delete value
    protected function model_delValue() {
        $sql = "DELETE FROM optionValues WHERE valID = ?;";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->valID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }
}
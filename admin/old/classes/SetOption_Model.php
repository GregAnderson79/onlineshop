<?php

// Set option
class SetOption_Model extends Database_Model {

    // Add option
    protected function model_addOption() {
        $sql = "INSERT INTO options (optName) VALUES (?);"; 
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->optName])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }

    // Update option
    protected function model_updOption() {
        $sql = "UPDATE options SET optName=? WHERE optID=?";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->optName, $this->optID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }

    // delete Option
    protected function model_delOption() {
        $sql = "DELETE FROM options WHERE optID = ?;";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->optID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }
}
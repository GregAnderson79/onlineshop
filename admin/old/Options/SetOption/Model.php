<?php
// Set option (Controller)
namespace Options\SetOption;
use \Database\Model as DB;

// Set option
class Model extends DB {

    // Add option
    protected function queryAdd() {
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

        unset($sql, $statement);
    }

    // Update option
    protected function queryUpdate() {
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

        unset($sql, $statement);
    }
}
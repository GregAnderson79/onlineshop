<?php
// Delete option value (Model)
namespace Options\Values\DeleteValue;
use Database\Model as DB;

class Model extends DB {

    // delete value
    protected function query() {
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
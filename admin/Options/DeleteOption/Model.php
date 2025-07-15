<?php
// Delete option
namespace Options\DeleteOption;
use Database\Model as DB;

class Model extends DB {

    protected function query() {
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
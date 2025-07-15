<?php
// Set association between item and option (Model)
namespace Options\Associations\Options\SetAssoc;
use \Database\Model as DB;

class Model extends DB {

    protected function query() {            
        $sql = "INSERT INTO itemOptAssoc (itemID, optID) VALUES (?, ?);";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->itemID, $this->optID])) {
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
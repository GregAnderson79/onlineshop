<?php
// Set association between item and option value (Model)
namespace Options\Associations\Values\SetAssoc;
use \Database\Model as DB;

class Model extends DB {

    protected function query() {            
        $sql = "INSERT INTO itemOptValAssoc (itemID, optID, valID) VALUES (?, ?, ?);";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->itemID, $this->optID, $this->valID])) {
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
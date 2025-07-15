<?php

// Set association between item and option
class SetItemOptAssoc_Model extends Database_Model {

    // set association
    protected function model_setAssoc() {            
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
    }

    // delete association
    protected function model_delAssoc() { 
        $sql = "DELETE FROM itemOptAssoc WHERE assocID = ?;";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->assocID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }
}
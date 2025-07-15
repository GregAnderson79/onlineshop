<?php

class SetItemValAssoc_Model extends Database_Model {

    // set association
    protected function model_setAssoc() {            
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
    }

    // delete association
    protected function model_delAssoc() { 
        $sql = "DELETE FROM itemOptValAssoc WHERE assocID = ?;";
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
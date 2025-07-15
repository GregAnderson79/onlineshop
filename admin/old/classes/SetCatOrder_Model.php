<?php

// Set Category Order
// for updating the parent or child category order
class SetCatOrder_Model extends Database_Model {

    protected function model_setCatOrder($pos, $catID) {
        $sql = "UPDATE categories SET pos=? WHERE catID=?";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$pos, $catID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit;
        } else {
            return true;
            $statement = null;
        }
    }
}
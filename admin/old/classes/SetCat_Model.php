<?php

// Set Category
class SetCat_Model extends Database_Model {

    // add Category
    protected function model_addCat() {            
        $sql = "INSERT INTO categories (catName, catDesc, parID, catStatus) VALUES (?, ?, ?, ?);";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->catName, $this->catDesc, $this->parID, $this->catStatus])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }

    // update Category
    protected function model_updCat() {          
        $sql = "UPDATE categories SET catName=?, catDesc=?, parID=?, catStatus=? WHERE catID=?";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->catName, $this->catDesc, $this->parID, $this->catStatus, $this->catID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }

    // delete Category
    protected function model_delCat() {
        $sql = "DELETE FROM categories WHERE catID = ?;";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->catID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }
}
<?php
// Set Category (Model)
namespace Categories\SetCategory;
use \Database\Model as DB;

class Model extends DB {

    // add
    protected function queryAdd() {            
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

        unset($sql, $statement);
    }

    // update
    protected function queryUpdate() {          
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

        unset($sql, $statement);
    }
}
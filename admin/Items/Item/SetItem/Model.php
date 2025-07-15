<?php
// Set item (Model)
namespace Items\Item\SetItem;
use Database\Model as DB;

class Model extends DB {

    // add
    protected function queryAdd() {            
        $sql = "INSERT INTO items (itemName, catID, itemPrice, itemStatus, itemStock, itemDesc1, itemDesc2, itemDesc3) VALUES (?, ?, ?, ?, ?, ?, ?, ?);"; 
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->itemName, $this->catID, $this->itemPrice, $this->itemStatus, $this->itemStock, $this->itemDesc1, $this->itemDesc2, $this->itemDesc3])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }

    // update
    protected function queryUpdate() {          
        $sql = "UPDATE items SET itemName=?, catID=?, itemPrice=?, itemStatus=?, itemStock=?, itemDesc1=?, itemDesc2=?, itemDesc3=? WHERE itemID=?";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->itemName, $this->catID, $this->itemPrice, $this->itemStatus, $this->itemStock, $this->itemDesc1, $this->itemDesc2, $this->itemDesc3, $this->itemID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }
}
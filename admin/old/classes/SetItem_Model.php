<?php

// set Item
class SetItem_Model extends Database_Model {

    // Add item
    protected function model_addItem() {
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

    // Update item
    protected function model_updItem() {
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

    // delete Item
    protected function model_delItem() {
        $sql = "DELETE FROM items WHERE itemID = ?;";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->itemID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }
}
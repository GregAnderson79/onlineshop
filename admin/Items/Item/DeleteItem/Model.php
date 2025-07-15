<?php
// delete item (Model)
namespace Items\Item\DeleteItem;
use Database\Model as DB;

class Model extends DB {
    protected function query() {
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
<?php
// Set item image to "main" (Model)
namespace Items\Item\Images\Main;
use Database\Model as DB;

class Model extends DB {

    // unset current main image
    protected function queryUnset() {
        $sql = "UPDATE itemImages SET isMain=false WHERE itemID=? AND isMain=true";
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

    // set new main
    protected function querySet() {
        $sql = "UPDATE itemImages SET isMain=true WHERE imgID=?";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->imgID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }

}
<?php

// Set item image to "main"
class SetMainItemImg_Model extends Database_Model {

    // unset current main image
    protected function model_unsetCurrentMain() {
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
    protected function model_setMainImg() {
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
<?php
// Delete item image
namespace Items\Item\Images\DeleteImage;
use Database\Model as DB;

class Model extends DB {

    // delete item image
    protected function query() {
        $sql = "DELETE FROM itemImages WHERE imgID = ?;";
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
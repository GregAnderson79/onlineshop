<?php
// delete Category (Model)
namespace Categories\DeleteCategory;
use Database\Model as DB;

class Model extends DB {
    protected function query() {
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
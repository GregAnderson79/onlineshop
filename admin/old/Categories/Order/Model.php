<?php
// Set main or sub category Order (Model)
namespace Categories\Order;
use \Database\Model as DB;

class Model extends DB {
    protected function query($pos, $catID) {
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

        unset($sql, $statement);
    }
}
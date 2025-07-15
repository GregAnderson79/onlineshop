<?php
// Get item for cart (Model)
namespace Cart\Item;
use Database\Model as DB;

class Model extends DB {

    protected function query() {
        $sql = "SELECT itemName, itemPrice FROM items WHERE itemID = ?";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->itemID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "?error=0");
            exit();
        }

        $results;
        if ($statement->rowCount() > 0) {
            $results = $statement->fetch();
        } else {
            $results = null;
        }

        $statement = null;
        return $results;
    }
}
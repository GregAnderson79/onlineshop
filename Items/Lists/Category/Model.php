<?php
// Item list for a category (Model)
namespace Items\Lists\Category;
use Database\Model as DB;

class Model extends DB {
    protected function query() {
        $sql = "SELECT itemID, itemName, itemStatus, itemPrice FROM items WHERE catID = ? ORDER by itemName";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->catID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        $results;
        if ($statement->rowCount() > 0) {
            $results = $statement->fetchAll();
        } else {
            $results = null;
        }

        $statement = null;
        return $results;
    }
}
<?php
// Get item data for item view page (View)
namespace Item\GetItem;
use Database\Model as DB;

class Model extends DB {
    protected function query() {
        $sql = "SELECT * FROM items WHERE itemID = ?";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->itemID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
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
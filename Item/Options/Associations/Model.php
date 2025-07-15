<?php

// Get list of option associations for an item (Model)
namespace Item\Options\Associations;
use Database\Model as DB;

class Model extends DB {
    protected function query() {
        $sql = "SELECT optID FROM itemOptAssoc WHERE itemID = ?";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->itemID])) {
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
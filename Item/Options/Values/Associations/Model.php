<?php

// Get list of option values associations for an item (Model)
namespace Item\Options\Values\Associations;
use Database\Model as DB;

class Model extends DB {
    protected function query() {
        $sql = "SELECT valID FROM itemOptValAssoc WHERE itemID = ? AND optID = ?";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->itemID, $this->optID])) {
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
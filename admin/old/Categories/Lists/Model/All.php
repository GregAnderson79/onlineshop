<?php
// Get all category lists for column, selectors and mobile menu (Model)
namespace Categories\Lists\Model;
use \Database\Model as DB;

class All extends DB {
    protected function queryMains() {
        $sql = "SELECT catID, catName, pos, catStatus FROM categories WHERE parID = 0 ORDER BY pos";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute()) {
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

        unset($sql, $statement, $results);
    }

    protected function querySubs($catID) {
        $sql = "SELECT catID, catName, parID FROM categories WHERE parID = ? ORDER BY pos";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$catID])) {
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

        unset($sql, $statement, $results);
    }
}
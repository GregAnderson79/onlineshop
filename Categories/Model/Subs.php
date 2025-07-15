<?php
// Get list of sub categories for mobile nav (Model)
namespace Categories\Model;
use Database\Model as DB;

class Subs extends DB {
    protected function query() {
        $sql = "SELECT catID, catName, parID FROM categories WHERE parID = ? ORDER BY pos";
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
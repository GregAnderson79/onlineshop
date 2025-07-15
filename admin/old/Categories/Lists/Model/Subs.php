<?php
// Get sub category list for column, selectors and mobile menu (Model)
namespace Categories\Lists\Model;
use \Database\Model as DB;

class Subs extends DB {
    protected function query() {
        $sql = "SELECT catID, catName, pos, catStatus FROM categories WHERE parID = ? ORDER BY pos";
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

        unset($sql, $statement, $results);
    }
}
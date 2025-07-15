<?php
// Get main category list for menus (Model)
namespace Categories\Model;
use Database\Model as DB;

class Mains extends DB {
    protected function query() {
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
    }
}
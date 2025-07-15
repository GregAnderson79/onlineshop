<?php
// Get sub category list for column, selectors and mobile menu (Model)
namespace Categories\Lists\Model;
use Database\Model as DB;

class Subs extends DB {
    protected function query() {
        $sql = "SELECT catID, catName, pos, catStatus FROM categories WHERE parID = ? ORDER BY pos";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$this->catID])) {
            $stmt = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        $results;
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll();
        } else {
            $results = null;
        }

        $stmt = null;
        return $results;
    }
}
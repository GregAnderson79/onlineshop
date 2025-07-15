<?php
// Get all category lists for column, selectors and mobile menu (Model)
namespace Categories\Lists\Model;
use Database\Model as DB;

class All extends DB {
    protected function queryMains() {
        $sql = "SELECT catID, catName, pos, catStatus FROM categories WHERE parID = 0 ORDER BY pos";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute()) {
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

    protected function querySubs($catID) {
        $sql = "SELECT catID, catName, parID FROM categories WHERE parID = ? ORDER BY pos";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$catID])) {
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
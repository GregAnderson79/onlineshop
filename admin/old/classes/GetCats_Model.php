<?php

// Get category lists
class GetCats_Model extends Database_Model {

    // get parent categories
    protected function model_getParCats() {
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

    // get child categories
    protected function model_getChildCats() {
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

    // get child categories loop
    protected function model_getChildCatsLoop($catID) {
        $sql = "SELECT catID, catName, parID, catStatus FROM categories WHERE parID = ? ORDER BY pos";
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

    // Get ancester categories
    protected function model_getAncCats() {
        $sql = "SELECT parID FROM categories WHERE parID <> 0";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute()) {
            $stmt = null;
            header("location: menu.php?error=0");
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

    // get items in cat
    protected function model_getCatItemsLoop($catID) {
        $sql = "SELECT null FROM items WHERE catID = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$catID])) {
            $stmt = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        $results;
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
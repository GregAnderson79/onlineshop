<?php

// Get items
class GetItems_Model extends Database_Model {

    // get Items for Column
    protected function model_getItems() {
        $sql = "SELECT itemID, itemName, itemStatus FROM items WHERE catID = ? ORDER BY itemID DESC";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$this->catID])) {
            $stmt = null;
            header("location: menu.php?error=0");
            exit;
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
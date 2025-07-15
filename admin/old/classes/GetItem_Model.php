<?php

// Get item
class GetItem_Model extends Database_Model {

    protected function model_getItem() {
        $sql = "SELECT * FROM items WHERE itemID = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$this->itemID])) {
            $stmt = null;
            header("location: menu.php?error=0");
            exit();
        }

        $results;
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetch();
        } else {
            $results = null;
        }

        $stmt = null;
        return $results;
    }
}
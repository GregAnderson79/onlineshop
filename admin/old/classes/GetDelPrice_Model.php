<?php

// Get delivery price
class GetDelPrice_Model extends Database_Model {

    protected function model_getDelPrice() {
        $sql = "SELECT * FROM delivery";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute()) {
            $stmt = null;
            header("location: " . pageURL(true,true) . "?error=0");
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
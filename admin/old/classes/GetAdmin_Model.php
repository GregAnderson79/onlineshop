<?php

// Get admin account details
class GetAdmin_Model extends Database_Model {

    protected function model_getAdmin() {
        $sql = "SELECT * FROM admins WHERE adminID = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$this->adminID])) {
            $stmt = null;
            header("location: " . pageURL(true,true) . "?error=0");
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
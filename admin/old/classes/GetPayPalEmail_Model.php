<?php

// Get PayPal email
class GetPayPalEmail_Model extends Database_Model {

    protected function model_GetPayPalEmail() {
        $sql = "SELECT * FROM payPalEmail";
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
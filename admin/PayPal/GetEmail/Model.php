<?php
// Get PayPal Email
namespace PayPal\GetEmail;
use Database\Model as DB;

class Model extends DB {

    protected function query() {
        $sql = "SELECT * FROM payPalEmail";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute()) {
            $statement = null;
            header("location: " . pageURL(true,true) . "?error=0");
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
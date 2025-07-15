<?php

// Get option name (Model)
namespace Item\Options\Names;
use Database\Model as DB;

class Model extends DB {
    protected function query() {
        $sql = "SELECT optName FROM options WHERE optID = ?";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->optID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        $results;
        if ($statement->rowCount() > 0) {
            $results = $statement->fetch();
        } else {
            $results = null;
        }

        $statement = null;
        return $results;
    }
}
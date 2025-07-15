<?php

// Get option value name (Model)
namespace Item\Options\Values\Names;
use Database\Model as DB;

class Model extends DB {
    protected function query() {
        $sql = "SELECT valName FROM optionValues WHERE valID = ?";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->valID])) {
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
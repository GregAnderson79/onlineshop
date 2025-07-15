<?php
// Get option values for column (Model)
namespace Options\Values\Column;
use Database\Model as DB;

class Model extends DB {
    protected function query() {
        $sql = "SELECT valID, valName, pos FROM optionValues WHERE optID = ? ORDER BY pos";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->optID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
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
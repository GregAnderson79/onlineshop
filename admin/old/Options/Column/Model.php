<?php
// Get list of options (Model)
namespace Options\Column;
use \Database\Model as DB;

class Model extends DB {
    protected function query() {
        $sql = "SELECT optID, optName, pos FROM options ORDER BY pos";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute()) {
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

        unset($sql, $statement, $results);
    }
}
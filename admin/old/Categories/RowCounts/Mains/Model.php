<?php
// get main category row count (Controller)
namespace Categories\RowCounts\Mains;
use \Database\Model as DB;

class Model extends DB {
    protected function query() {
        $sql = "SELECT NULL FROM categories WHERE parID = 0";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute()) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        $results;
        if ($statement->rowCount() > 0) {
            $results = $statement->rowCount();
        } else {
            $results = null;
        }

        $statement = null;
        return $results;

        unset($sql, $statement, $results);
    }
}
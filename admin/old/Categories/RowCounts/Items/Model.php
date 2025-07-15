<?php
// get category item row count (Model)
namespace Categories\RowCounts\Items;
use \Database\Model as DB;

class Model extends DB {
    protected function query() {
        $sql = "SELECT NULL FROM items WHERE catID = ?";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->catID])) {
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
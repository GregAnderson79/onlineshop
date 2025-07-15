<?php
// Get category name (Model)
namespace Categories\Titles;
use Database\Model as DB;

class Model extends DB {
    protected function query() {
        $sql = "SELECT catName, catDesc FROM categories WHERE catID = ?";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->catID])) {
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
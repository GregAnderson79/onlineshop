<?php
// Get category name for breadcrumbs (Model)
namespace Item\Breadcrumbs;
use Database\Model as DB;

class Model extends DB {
    protected function query($catID) {
        $sql = "SELECT catName, parID FROM categories WHERE catID = ?";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$catID])) {
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
<?php
// Get item images (Model)
namespace Item\Images\List;
use \Database\Model as DB;

class Model extends DB {

    protected function query() {
        $sql = "SELECT imgID, imgName, isMain, altTag, caption FROM itemImages WHERE itemID = ? ORDER BY imgID DESC";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->itemID])) {
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
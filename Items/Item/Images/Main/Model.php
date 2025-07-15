<?php
// Get main image for item (Model)
namespace Items\Item\Images\Main;
use Database\Model as DB;

class Model extends DB {

    protected function query() {
        $sql = "SELECT imgName, altTag, caption FROM itemImages WHERE itemID = ? AND isMain = true";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->itemID])) {
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
<?php

// Get list of images for item gallery (Model)
namespace Item\Gallery;
use Database\Model as DB;

class Model extends DB {
    protected function query() {
        $sql = "SELECT imgName, altTag, caption FROM itemImages WHERE itemID = ? ORDER by isMain DESC";
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
    }
}
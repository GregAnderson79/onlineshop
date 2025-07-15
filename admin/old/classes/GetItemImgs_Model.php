<?php

// Get item images
class GetItemImgs_Model extends Database_Model {

    protected function model_getItemImages() {
        $sql = "SELECT imgID, imgName, isMain, altTag, caption FROM itemImages WHERE itemID = ? ORDER BY imgID DESC";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$this->itemID])) {
            $stmt = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        $results;
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll();
        } else {
            $results = null;
        }

        $stmt = null;
        return $results;
    }
}
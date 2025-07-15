<?php

// Get Category
// for editing category information, or displaying category name
class GetCat_Model extends Database_Model {

    protected function model_getCat() {
        if (isset($this->catID)) {
            $sql = "SELECT catID, catName, catDesc, parID, catStatus FROM categories WHERE catID = ? ";
            $stmt = $this->connect()->prepare($sql);

            if (!$stmt->execute([$this->catID])) {
                $stmt = null;
                header("location: menu.php?error=0");
                exit();
            }

            $result;
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch();
            } else {
                $result = null;
            }

            $stmt = null;
            return $result;
        } else {
            return null;
        }
    }

    protected function model_getCatName() {
        if (isset($this->catID)) {
            $sql = "SELECT catName FROM categories WHERE catID = ? ";
            $stmt = $this->connect()->prepare($sql);

            if (!$stmt->execute([$this->catID])) {
                $stmt = null;
                header("location: " . pageURL(true,true) . "error=0");
                exit();
            }

            $result;
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch();
            } else {
                $result = null;
            }

            $stmt = null;
            return $result;
        } else {
            return null;
        }
    }
}
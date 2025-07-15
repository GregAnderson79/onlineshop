<?php

// Get item image name
// For deleting the images from the upload folder
class GetItemImgName_Model extends Database_Model {

    protected function model_getItemImgName() {
        if (isset($this->imgID)) {
            $sql = "SELECT imgName FROM itemImages WHERE imgID = ? ";
            $stmt = $this->connect()->prepare($sql);

            if (!$stmt->execute([$this->imgID])) {
                $stmt = null;
                header("location: " . pageURL(true,true) . "?error=0");
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
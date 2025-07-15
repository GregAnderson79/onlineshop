<?php
// Get item image name (Model)
// For deleting the images from the upload folder
namespace Item\Images\ImageName;
use \Database\Model as DB;

class Model extends DB {
    protected function query() {
        if (isset($this->imgID)) {
            $sql = "SELECT imgName FROM itemImages WHERE imgID = ? ";
            $statement = $this->connect()->prepare($sql);

            if (!$statement->execute([$this->imgID])) {
                $statement = null;
                header("location: " . pageURL(true,true) . "?error=0");
                exit();
            }

            $result;
            if ($statement->rowCount() > 0) {
                $result = $statement->fetch();
            } else {
                $result = null;
            }

            $statement = null;
            return $result;
        } else {
            return null;
        }

        unset($sql, $statement, $result);
    }
}
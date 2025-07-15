<?php
// Upload item image (Controller)
namespace Item\Images\SetImage;
use \Database\Model as DB;

class Model extends DB {

    // set item image
    protected function query($imgName) {
        if ($this->itemID) {
            $sql = "INSERT INTO itemImages (imgName, itemID, isMain, altTag, caption) VALUES (?, ?, ?, ?, ?);";
            $statement = $this->connect()->prepare($sql);

            if (!$statement->execute([$imgName, $this->itemID, false, $this->altTag, $this->caption])) {
                $statement = null;
                header("location: " . pageURL(true,true) . "error=0");
                exit();
            } else {
                return true;
                $statement = null;
            }

            unset($sql, $statement);
        }
    }
}
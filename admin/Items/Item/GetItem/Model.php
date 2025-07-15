<?php
// Get item data to edit (Model)
namespace Items\Item\GetItem;
use Database\Model as DB;

class Model extends DB {
    protected function query() {
        if (isset($this->itemID)) {
            $sql = "SELECT * FROM items WHERE itemID = ? ";
            $statement = $this->connect()->prepare($sql);

            if (!$statement->execute([$this->itemID])) {
                $statement = null;
                header("location: menu.php?error=0");
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
    }
}
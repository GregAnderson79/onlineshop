<?php
// Get category data to edit (Model)
namespace Categories\GetCategory;
use \Database\Model as DB;

class Model extends DB {
    protected function query() {
        if (isset($this->catID)) {
            $sql = "SELECT catID, catName, catDesc, parID, catStatus FROM categories WHERE catID = ? ";
            $statement = $this->connect()->prepare($sql);

            if (!$statement->execute([$this->catID])) {
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

            unset($sql, $statement, $result);
        } else {
            return null;
        }
    }
}
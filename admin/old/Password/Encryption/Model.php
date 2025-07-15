<?php
// Return latest encryption codes (Model)
namespace Password\Encryption;
use \Database\Model as DB;

class Model extends DB {
    protected function query() {
        $sql = "SELECT encMethod, encKey, encIV FROM encVars";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute()) {
            $statement = null;
            header("location: menu.php?error=0");
            exit;
        }

        $results;
        if ($statement->rowCount() > 0) {
            $results = $statement->fetchAll();
        } else {
            header("location: menu.php?error=0");
            exit;
        }

        $statement = null;
        return $results;

        unset($sql, $statement, $results);
    }
}
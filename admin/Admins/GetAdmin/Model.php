<?php
// Get admin (Model)
namespace Admins\GetAdmin;
use Database\Model as DB;

class Model extends DB {

    protected function query() {
        $sql = "SELECT * FROM admins WHERE adminID = ?";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->adminID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "?error=0");
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
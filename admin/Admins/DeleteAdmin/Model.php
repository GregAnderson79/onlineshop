<?php
// Delete admin (Model)
namespace Admins\DeleteAdmin;
use Database\Model as DB;

class Model extends DB {

    protected function query() {
        $sql = "DELETE FROM admins WHERE adminID = ?;";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->adminID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }
}
<?php
// Login (Model)
namespace Login;
use Database\Model as DB;

class Model extends DB {
    protected function query() {
        if (isset($this->adminEmail)) {
            $sql = "SELECT adminID, adminPwd, adminName FROM admins WHERE adminEmail = ? ";
            $statement = $this->connect()->prepare($sql);

            if (!$statement->execute([$this->adminEmail])) {
                $statement = null;
                header("location: /index.php?error=0");
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
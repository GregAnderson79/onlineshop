<?php
// Login (Model)
namespace Login;

class Model extends \Database\Model {
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

        unset($sql, $statement, $result);
    }
}
<?php

// Get login
class GetLogin_Model extends Database_Model {

    protected function model_getLogin() {
        if (isset($this->adminEmail)) {
            $sql = "SELECT adminID, adminPwd, adminName FROM admins WHERE adminEmail = ? ";
            $stmt = $this->connect()->prepare($sql);

            if (!$stmt->execute([$this->adminEmail])) {
                $stmt = null;
                header("location: /index.php?error=0");
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
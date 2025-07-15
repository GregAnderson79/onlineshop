<?php

// get encryption variables for passwords
class GetEncVars_Model extends Database_Model {

    protected function model_getEncVars() {
        $sql = "SELECT encMethod, encKey, encIV FROM encVars";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute()) {
            $stmt = null;
            header("location: menu.php?error=0");
            exit;
        }

        $results;
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll();
        } else {
            header("location: menu.php?error=0");
            exit;
        }

        $stmt = null;
        return $results;
    }
}
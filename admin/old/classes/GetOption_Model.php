<?php

// Get option
class GetOption_Model extends Database_Model {

    protected function model_getOption() {
        if (isset($this->optID)) {
            $sql = "SELECT optName FROM options WHERE optID = ? ";
            $stmt = $this->connect()->prepare($sql);

            if (!$stmt->execute([$this->optID])) {
                $stmt = null;
                header("location: " . pageURL(true,true) . "error=0");
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
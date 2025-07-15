<?php

// Get option value
class GetValue_Model extends Database_Model {

    protected function model_getValue() {
        if (isset($this->valID)) {
            $sql = "SELECT valName FROM optionValues WHERE valID = ? ";
            $stmt = $this->connect()->prepare($sql);

            if (!$stmt->execute([$this->valID])) {
                $stmt = null;
                header("location: " . pageURL(true,true) . "?error=0");
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
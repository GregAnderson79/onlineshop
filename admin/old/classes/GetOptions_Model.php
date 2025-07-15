<?php

// Get options
class GetOptions_Model extends Database_Model {

    // get options
    protected function model_getOptions() {
        $sql = "SELECT optID, optName, pos FROM options ORDER BY pos";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute()) {
            $stmt = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        $results;
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll();
        } else {
            $results = null;
        }

        $stmt = null;
        return $results;
    }

    // get option values for an option
    protected function model_getOptValues($optID) {
        $sql = "SELECT valID, valName, pos FROM optionValues WHERE optID = ? ORDER BY pos";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$optID])) {
            $stmt = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        $results;
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll();
        } else {
            $results = null;
        }

        $stmt = null;
        return $results;
    }

    // Get any associations between itemID and each OptID stored in itemOptAssoc
    protected function model_getItemOptAssoc() {
        $sql = "SELECT assocID, optID FROM itemOptAssoc WHERE itemID = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$this->itemID])) {
            $stmt = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        $results;
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll();
        } else {
            $results = null;
        }

        $stmt = null;
        return $results; 
    }

    // get any associations between itemID and each valID, stored in itemOptValAssoc
    protected function model_getItemValAssoc() {
        $sql = "SELECT assocID, valID FROM itemOptValAssoc WHERE itemID = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$this->itemID])) {
            $stmt = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        $results;
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll();
        } else {
            $results = null;
        }

        $stmt = null;
        return $results; 
    }

    // get the number of value associations for an option
    protected function model_getItemOptAssocNum($optID) {
        $sql = "SELECT null FROM itemOptValAssoc WHERE optID = ? AND itemID = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$optID,$this->itemID])) {
            $stmt = null;
            header("location: " . pageURL(true,true) . "?error=0");
            exit();
        }

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
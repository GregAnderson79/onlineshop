<?php
// Get item/option/value associations (View)
// For use in the item panel
namespace Options\Associations;
use \Database\Model as DB;

class Model extends DB {

    // get options
    protected function queryOptions() {
        $sql = "SELECT optID, optName, pos FROM options ORDER BY pos";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute()) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        $results;
        if ($statement->rowCount() > 0) {
            $results = $statement->fetchAll();
        } else {
            $results = null;
        }

        $statement = null;
        return $results;

        unset($sql, $statement, $results);
    }

    // get option values for an option
    protected function queryValues($optID) {
        $sql = "SELECT valID, valName, pos FROM optionValues WHERE optID = ? ORDER BY pos";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$optID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        $results;
        if ($statement->rowCount() > 0) {
            $results = $statement->fetchAll();
        } else {
            $results = null;
        }

        $statement = null;
        return $results;

        unset($sql, $statement, $results);
    }

    // Get any associations between itemID and each OptID stored in itemOptAssoc
    protected function queryOptionAssoc() {
        $sql = "SELECT assocID, optID FROM itemOptAssoc WHERE itemID = ?";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->itemID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        $results;
        if ($statement->rowCount() > 0) {
            $results = $statement->fetchAll();
        } else {
            $results = null;
        }

        $statement = null;
        return $results; 

        unset($sql, $statement, $results);
    }

    // get any associations between itemID and each valID, stored in itemOptValAssoc
    protected function queryValueAssoc() {
        $sql = "SELECT assocID, valID FROM itemOptValAssoc WHERE itemID = ?";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->itemID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        $results;
        if ($statement->rowCount() > 0) {
            $results = $statement->fetchAll();
        } else {
            $results = null;
        }

        $statement = null;
        return $results; 

        unset($sql, $statement, $results);
    }

    // get the number of value associations for an option
    protected function queryValueAssocQty($optID) {
        $sql = "SELECT null FROM itemOptValAssoc WHERE optID = ? AND itemID = ?";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$optID,$this->itemID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "?error=0");
            exit();
        }

        if ($statement->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

        unset($sql, $statement);
    }
}
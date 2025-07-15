<?php
// Get option value (Controller)
namespace Options\Values\GetValue;
use \Database\Model as DB;

class Model extends DB {

    protected function query() {
        if (isset($this->valID)) {
            $sql = "SELECT valName FROM optionValues WHERE valID = ? ";
            $statement = $this->connect()->prepare($sql);

            if (!$statement->execute([$this->valID])) {
                $statement = null;
                header("location: " . pageURL(true,true) . "?error=0");
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

            unset($sql, $statement, $result);
        } else {
            return null;
        }
    }
}
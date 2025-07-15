<?php
// Get option (View)
namespace Options\GetOption;
use \Database\Model as DB;

class Model extends DB {

    protected function query() {
        if (isset($this->optID)) {
            $sql = "SELECT optName FROM options WHERE optID = ? ";
            $statement = $this->connect()->prepare($sql);

            if (!$statement->execute([$this->optID])) {
                $statement = null;
                header("location: " . pageURL(true,true) . "error=0");
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
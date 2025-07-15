<?php
// Delete association between item and option (Model)
namespace Options\Associations\Options\DeleteAssoc;
use \Database\Model as DB;

class Model extends DB {

    protected function query() { 
        $sql = "DELETE FROM itemOptAssoc WHERE assocID = ?;";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->assocID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }

        unset($sql, $statement);
    }
}
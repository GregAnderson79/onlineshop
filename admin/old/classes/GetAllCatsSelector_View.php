<?php

// Get All Categories Select menu
// for use in assigning an item to a category
class GetAllCatsSelector_View extends GetAllCatsSelector_Contr {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function view_getAllCatsSelector() {
        $allCats = $this->getAllCatsSelector();
        foreach ($allCats as $row) {
            echo "<option value=\"" . $row['catID'] . "\"";
            if ($this->catID == $row['catID']) {
                echo " SELECTED";
            }
            echo ">";
            if (isset($row['parID'])) {echo " - ";}
            echo $row['catName'] . "</option>";
        }
    }

    // contr
    private function getAllCatsSelector() {
        return $this->contr_getAllCatsSelector();
    }
}
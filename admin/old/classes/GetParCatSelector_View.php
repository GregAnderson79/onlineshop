<?php

// Get Parent Category Select menu
// for use in setting categories as parent or child categories
class GetParCatSelector_View extends GetParCatSelector_Contr {
    public $catID;
    public $parID;

    public function __construct($catID, $parID) {
        $this->catID = $catID;
        $this->parID = $parID;
    }

    public function view_GetParCatSelector() {
        $parCats = $this->getParCatSelector();
        if ($parCats) {
            foreach ($parCats as $row) {
                if ($this->catID != $row['catID']) {
                    echo "<option value=\"" . $row['catID'] . "\"";
                    if (isset($_SESSION["parID"])) {
                        if ($_SESSION["parID"] == $row['catID']) {
                            echo " SELECTED";
                            unset($_SESSION["parID"]);
                        }
                    } else if (isset($this->parID)) {
                        if ($this->parID == $row['catID']) {
                            echo " SELECTED";
                        }
                    }
                    echo ">" . $row['catName'] . "</option>";
                }
            }
        }
    }

    // contr
    private function getParCatSelector() {
        return $this->contr_GetParCatSelector();
    }
}
<?php
// Get list of all categories for selector menu (View)
namespace Categories\Lists\Selectors\All;

class GetCategories extends Process {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function createMenu() {
        $allCats = $this->process();
        foreach ($allCats as $row) {
            echo "<option value=\"" . $row['catID'] . "\"";
            if ($this->catID == $row['catID']) {
                echo " SELECTED";
            }
            echo ">";
            if (isset($row['parID'])) {echo " - ";}
            echo $row['catName'] . "</option>\n";
        }
    }
}
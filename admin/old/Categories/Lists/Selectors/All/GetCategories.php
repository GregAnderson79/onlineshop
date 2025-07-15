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
        foreach ($allCats as $i) {
            echo "<option value=\"" . $i['catID'] . "\"";
            if ($this->catID == $i['catID']) {
                echo " SELECTED";
            }
            echo ">";
            if (isset($i['parID'])) {echo " - ";}
            echo $i['catName'] . "</option>\n";
        }

        unset($allCats, $i);
    }
}
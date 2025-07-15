<?php
// Get list of main categories for selector menu (View)
namespace Categories\Lists\Selectors\Mains;

class GetCategories extends Process {
    public $parID;

    public function __construct($parID) {
        $this->parID = $parID;
    }

    public function createMenu() {
        $cats = $this->process();
        if ($cats) {
            foreach ($cats as $i) {
                echo "<option value=\"" . $i['catID'] . "\"";
                if (isset($_SESSION["parID"])) {
                    if ($_SESSION["parID"] == $i['parID']) {
                        echo " SELECTED";
                        unset($_SESSION["parID"]);
                    }
                } else if (isset($this->parID)) {
                    if ($this->parID == $i['catID']) {
                        echo " SELECTED";
                    }
                }
                echo ">" . $i['catName'] . "</option>\n";
            }
        }
        unset($cats, $i);
    }
}
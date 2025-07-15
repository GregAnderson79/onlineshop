<?php
// Get list of main categories for selector menu (View)
namespace Categories\Lists\Selectors\Mains;

class GetCategories extends Process {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function createMenu() {
        $cats = $this->process();
        if ($cats) {
            foreach ($cats as $i) {
                echo "<option value=\"" . $i['catID'] . "\"";
                if (isset($_SESSION["catID"])) {
                    if ($_SESSION["catID"] == $i['catID']) {
                        echo " SELECTED";
                        unset($_SESSION["catID"]);
                    }
                } else if (isset($this->catID)) {
                    if ($this->catID == $i['catID']) {
                        echo " SELECTED";
                    }
                }
                echo ">" . $i['catName'] . "</option>\n";
            }
        }
        unset($cats, $i);
    }
}
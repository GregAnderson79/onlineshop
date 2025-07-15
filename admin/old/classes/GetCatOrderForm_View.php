<?php

// Get Category Order Form
// for updating the parent or child category order
class GetCatOrderForm_View extends GetCatOrderForm_Contr {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function view_getCatOrderForm() {
        $cats = $this->getCatOrderForm();

        if ($cats) {
            echo "<ul>";
            foreach ($cats as $row => $cols) {
                echo "<li>" . $cols['catName'];
                echo "<select aria-label=\"Change the category order position of ". $cols['catName'] . "\" name='pos[]'>";
                    $i = 0;
                    while ($i < count($cats)) {
                        $i++;
                        echo "<option value='" . $i . "=" . $cols['catID'] . "'";
                        if ($cols['pos'] === $i) {echo " SELECTED";}
                        echo ">" . $i . "</option>";
                    }
                echo "</select></li>";
            }
            echo "<ul>";
        }
    }

    // contr
    private function getCatOrderForm() {
        return $this->contr_getCatOrderForm();
    }
}
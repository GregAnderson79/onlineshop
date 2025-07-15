<?php
// Get category re-order form for sub categories (View)
namespace Categories\Order\GetOrder\Subs;

class GetOrder extends Process {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function createForm() {
        $cats = $this->process();

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
}
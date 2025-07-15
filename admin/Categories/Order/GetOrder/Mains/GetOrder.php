<?php
// Get category re-order form for main categories (View)
namespace Categories\Order\GetOrder\Mains;

class GetOrder extends Process {
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
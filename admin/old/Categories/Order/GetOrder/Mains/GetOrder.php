<?php
// Get category re-order form for main categories (View)
namespace Categories\Order\GetOrder\Mains;

class GetOrder extends Process {
    public function createForm() {
        $cats = $this->process();

        if ($cats) {
            echo "<ul>";
            foreach ($cats as $i) {
                echo "<li>" . $i['catName'];
                echo "<select aria-label=\"Change the category order position of ". $i['catName'] . "\" name='pos[]'>";
                    $j = 0;
                    while ($j < count($cats)) {
                        $j++;
                        echo "<option value='" . $j . "=" . $i['catID'] . "'";
                        if ($i['pos'] === $j) {echo " SELECTED";}
                        echo ">" . $j . "</option>";
                    }
                echo "</select></li>";
            }
            echo "<ul>";
        }

        unset($cats, $i, $j);
    }
}
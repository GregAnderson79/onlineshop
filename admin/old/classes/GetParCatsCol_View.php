<?php

// Get parent category column
class GetParCatsCol_View extends GetParCatsCol_Contr {

    public function view_getParCatsCol() {
        $cats = $this->getParCatsCol();
        if ($cats) {
            echo "<ul>";
            foreach ($cats as $row => $cols) {
                echo "<li><span><a href=\"" . $_SERVER['PHP_SELF'] . "?open=" . $cols['catID'] . "\">" . $cols['catName'] . "</a>";
                if ($cols['childCats'] > 0) {
                    echo " (" . $cols['childCats'] . ")";
                }
                echo " </span><span class=\"column_li_opts\">";
                echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=editCat&catID=" . $cols['catID'] . "\">Edit</a>";
                if ($cols['childCats'] > 0 || $cols['catItems']) {
                    echo "<span class=\"red_disabled\">Delete</span>";
                } else {
                    echo "<a class=\"nav_red\" href=\"" . pageURL(true,true) . "action=delCat&catID=" . $cols['catID'] . "\" onclick=\"return confirm('Are you sure you want to delete this category?')\">Delete</a>";
                }
                echo "</span></li>";
            }
            echo "</ul>";
        }
    }

    // contr
    private function getParCatsCol() {
        return $this->contr_getParCatsCol();
    }
}
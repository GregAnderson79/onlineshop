<?php 
 
// Get child categories column
class GetChildCatsCol_View extends GetChildCatsCol_Contr {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function view_getChildCatsCol() {
        $cats = $this->getChildCatsCol();
        if ($cats) {
            echo "<ul>";
            foreach ($cats as $row => $cols) {
                echo "<li><span><a href=\"" . $_SERVER['PHP_SELF'] . "?open=" . $this->catID . ":" . $cols['catID'] . "\">" . $cols['catName'] . "</a></span>";
                echo "<span class=\"column_li_opts\">";
                echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=editCat&parID=" . $this->catID . "&catID=" . $cols['catID'] . "\">Edit</a>";
                if ($cols['catItems']) {
                    echo "<span class=\"red_disabled\">Delete</span>";
                } else {
                    echo "<a class=\"nav_red\" href=\"" . pageURL(true,true) . "action=delCat&parID=" . $this->catID . "&catID=" . $cols['catID'] . "\" onclick=\"return confirm('Are you sure you want to delete this category?')\">Delete</a>";
                }
                echo "</span></li>";
            }
            echo "</ul>";
        } else {
            echo "No sub-categories";
        }
    }

    // contr
    private function getChildCatsCol() {
        return $this->contr_getChildCatsCol();
    }
}
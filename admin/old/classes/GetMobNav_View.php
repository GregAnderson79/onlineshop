<?php

// Get Mobile Navigation
class GetMobNav_View extends GetMobNav_Contr {

    public function view_getMobNav() {
        $mobNav = $this->getMobNav();
        if ($mobNav) {
            echo "<ul>";
            foreach ($mobNav as $i) {
                if ($i['parID'] == 0) {
                    echo "<li class=\"opt_parent\"><span>";
                } else {
                    echo "<li><span> - ";
                }

                echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?open=" . $i['catID'] . "\">" . $i['catName'] . "</a>";
                echo  "</span><span class=\"column_li_opts\"><a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=editCat&catID=" . $i['catID'] . "\">Edit</a>";
                if ($i['childCats']) {
                    echo "<span class=\"red_disabled\">Delete</span>";
                } else {
                    echo "<a class=\"nav_red\" href=\"" . pageURL(true,true) . "action=delCat&catID=" . $i['catID'] . "\" onclick=\"return confirm('Are you sure you want to delete this category?')\">Delete</a>";
                }
                echo "</span></li>";
            }
            echo "</ul>";
        } else {
            echo "No categories found";
        }
    }

    // contr
    private function getMobNav() {
        return $this->contr_GetMobNav();
    }
}
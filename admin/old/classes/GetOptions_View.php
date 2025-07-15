<?php

// Get options
class GetOptions_View extends GetOptions_Contr {

    public function view_getOptions() {
        $optArray = $this->contr_getOptions();
        if ($optArray) {
            echo "<ul>";
            foreach ($optArray as $i) {
                if ($i['ovParent'] > 0) { // child (value)
                    echo "<li><span>&raquo; " . $i['ovName'] . "</span><span class=\"column_li_opts\"><a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=editVal&optID=" . $i['ovParent'] . "&valID=" . $i['ovID'] . "\">Edit</a>";
                    echo "<a class=\"nav_red\" href=\"" . pageURL(true,true) . "action=delVal&optID=" . $i['ovParent'] . "&valID=" . $i['ovID'] . "\" onclick=\"return confirm('Are you sure you want to delete this option value?')\">Delete</a>";
                    echo "</span></li>";
                } else { // parent (option)
                    echo "<li class=\"opt_parent\"><span>" . $i['ovName'] . "</span><span class=\"column_li_opts\"><a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=editOpt&optID=" . $i['ovID'] . "\">Edit</a>";
                    if ($i['isParent'] === true) {
                        echo "<span class=\"red_disabled\">Delete</span>";
                    } else {
                        echo "<a class=\"nav_red\" href=\"" . pageURL(true,true) . "action=delOpt&optID=" . $i['ovID'] . "\" onclick=\"return confirm('Are you sure you want to delete this option?')\">Delete</a>";
                    }
                    echo "<a class=\"nav_green\" href=\"" . pageURL(true,true) . "action=addVal&optID=" . $i['ovID'] . "\">Add value</a></span></li>";
                }
            }
            echo "</ul>";
        } else {
            echo "No options";
        }
    }
}
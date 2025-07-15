<?php
// Get list of all categories for mobile nav (View)
namespace Categories\Navs\Mobile;
use Categories\Navs\Subs\GetCategories as SubCats;

class GetCategories extends Process {

    public function createMenu() {
        $mains = $this->process();
        if ($mains) {
            foreach ($mains as $i => $main) {
                echo "<li>\n";
                echo "<a href=\"category.php?catID=" . $main['catID'] . "\">" . $main['catName'] . "</a>\n";

                $subs = new SubCats($main['catID']);
                $subArray = $subs->subCategories();
                if ($subArray) {
                    echo "<a class=\"mob_nav_chevron mn_arr" . $i . "\" href=\"javascript:TGL_MN(" . $i . ")\"><span></span></a>\n";
                    echo "<div class=\"mn_main" . $i . "\"><ul>\n";
                    foreach ($subArray as $j) {
                        echo "<li><a href=\"category.php?catID=" . $j['catID'] . "\">" . $j['catName'] . "</a></li>\n";
                    }
                    echo "</ul></div>\n";
                }
                echo "</li>\n";
            }
        }
    }
}





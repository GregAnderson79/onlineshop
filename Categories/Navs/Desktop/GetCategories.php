<?php
// Get list of all categories for desktop nav (View)
namespace Categories\Navs\Desktop;
use Categories\Navs\Subs\GetCategories as SubCats;

class GetCategories extends Process {

    public function createMenu() {
        $mains = $this->process();
        if ($mains) {
            foreach ($mains as $i) {
                echo "<li>\n";
                echo "<a href=\"category.php?catID=" . $i['catID'] . "\">" . $i['catName'] . "</a>\n";

                $subs = new SubCats($i['catID']);
                $subArray = $subs->subCategories();
                if ($subArray) {
                    echo "<ul>\n";
                    foreach ($subArray as $j) {
                        echo "<li><a href=\"category.php?catID=" . $j['catID'] . "\">" . $j['catName'] . "</a></li>\n";
                    }
                    echo "</ul>\n";
                }
                echo "</li>\n";
            }
        }
    }
}
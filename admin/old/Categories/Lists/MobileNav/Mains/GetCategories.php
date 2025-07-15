<?php
// Get list of all categories for mobile nav (View)
namespace Categories\Lists\MobileNav\Mains;
use \Categories\Lists\MobileNav\Subs\GetCategories as SubCats;
use \Categories\RowCounts\Items\GetRowCount as NumItems;

class GetCategories extends Process {

    public function createMenu()   {
        $mains = $this->process();
        if ($mains) {
            echo "<ul>";
            foreach ($mains as $i) {
                echo "<li class=\"opt_parent\">\n";
                echo "<span><a href=\"" . $_SERVER['PHP_SELF'] . "?open=" . $i['catID'] . "\">" . $i['catName'] . "</a></span>\n";
                echo "<span class=\"column_li_opts\">\n";
                echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=editCat&catID=" . $i['catID'] . "\">Edit</a>\n";

                $subs = new SubCats($i['catID']);
                $subArray = $subs->subCategories();
                if ($subArray) {
                    echo "<span class=\"red_disabled\">Delete</span></span></li>\n";

                    foreach ($subArray as $j) {
                        echo "<li>\n";
                        echo "<span> - <a href=\"" . $_SERVER['PHP_SELF'] . "?open=" . $j['catID'] . "\">" . $j['catName'] . "</a></span>\n";
                        echo "<span class=\"column_li_opts\">\n";
                        echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=editCat&catID=" . $j['catID'] . "\">Edit</a>\n";

                        // Disable delete if items are in this category
                        $rows = new NumItems($j['catID']);
                        if ($rows->rowCount() > 0) {
                            echo "<span class=\"red_disabled\">Delete</span>\n";
                        } else {
                            echo "<a class=\"nav_red\" href=\"" . pageURL(true,true) . "action=delCat&catID=" . $j['catID'] . "\" onclick=\"return confirm('Are you sure you want to delete this category?')\">Delete</a>\n";
                        }

                        echo "</span></li>";
                        unset($rows);
                    }

                } else {

                    // Disable delete if items are in this category
                    $rows = new NumItems($i['catID']);
                    if ($rows->rowCount() > 0) {
                        echo "<span class=\"red_disabled\">Delete</span>";
                    } else {
                        echo "<a class=\"nav_red\" href=\"" . pageURL(true,true) . "action=delCat&catID=" . $i['catID'] . "\" onclick=\"return confirm('Are you sure you want to delete this category?')\">Delete</a></span></li>\n";
                    }

                    unset($rows);
                }

                unset($subs, $subArray);
            }
            echo "</ul>\n";
        } else {
            echo "<p>No categories</p>";
        }

        unset($mains);
    }
}
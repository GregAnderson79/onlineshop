<?php
// Get list of all categories for mobile nav (View)
namespace Categories\Lists\Columns\Mains;
use \Categories\RowCounts\Subs\GetRowCount as NumSubs;
use \Categories\RowCounts\Items\GetRowCount as NumItems;

class GetCategories extends Process {

    public function createMenu()   {
        $mains = $this->process();
        if ($mains) {
            echo "<ul>";
            foreach ($mains as $i) {
                echo "<li>\n";
                echo "<span><a href=\"" . $_SERVER['PHP_SELF'] . "?open=" . $i['catID'] . "\">" . $i['catName'];
                
                // Any sub categories?
                $rows = new NumSubs($i['catID']);
                $subs = $rows->rowCount();
                if ($subs > 0) {
                    echo " (" . $subs . ")";
                }

                echo "</a></span>\n";
                echo "<span class=\"column_li_opts\">\n";
                echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=editCat&catID=" . $i['catID'] . "\">Edit</a>\n";

                // Any items?
                $rows = new NumItems($i['catID']);
                $items = $rows->rowCount();

                // Disabled delete button if items or subs found
                if ($subs > 0 || $items > 0) {
                    echo "<span class=\"red_disabled\">Delete</span>";
                } else {
                    echo "<a class=\"nav_red\" href=\"" . pageURL(true,true) . "action=delCat&catID=" . $i['catID'] . "\" onclick=\"return confirm('Are you sure you want to delete this category?')\">Delete</a></span></li>\n";
                }

                unset($rows, $subs $items);
            }
            echo "</ul>\n";
        } else {
            echo "<p>No categories</p>";
        }
    }
    unset($mains);
}
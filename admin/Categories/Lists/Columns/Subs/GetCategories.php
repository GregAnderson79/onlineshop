<?php
// Sub category list for column
namespace Categories\Lists\Columns\Subs;
use Categories\RowCounts\Items\GetRowCount;

class GetCategories extends Process {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function createMenu()   {
        $cats = $this->process();
        if ($cats) {
            echo "<ul>";
            foreach ($cats as $i) {
                echo "<li><span><a href=\"" . $_SERVER['PHP_SELF'] . "?open=" . $this->catID . ":" . $i['catID'] . "\">" . $i['catName'] . "</a></span>";
                echo "<span class=\"column_li_opts\">";
                echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=editCat&parID=" . $this->catID . "&catID=" . $i['catID'] . "\">Edit</a>";

                $rows = new GetRowCount($i['catID']);
                $num = $rows->rowCount();
                if ($num > 0) {
                    echo "<span class=\"red_disabled\">Delete</span>";
                } else {
                    echo "<a class=\"nav_red\" href=\"" . pageURL(true,true) . "action=delCat&parID=" . $this->catID . "&catID=" . $i['catID'] . "\" onclick=\"return confirm('Are you sure you want to delete this category?')\">Delete</a>";
                }
                echo "</span></li>";
            }
            echo "</ul>";
        } else {
            echo "No sub-categories";
        }

        unset($cats, $i, $num);
    }
}
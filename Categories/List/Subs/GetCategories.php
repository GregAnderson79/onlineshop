<?php

// Get list of sub categories for parent category page (View)
namespace Categories\List\Subs;

class GetCategories extends Process {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function createList() {
        $subs = $this->process();
        if ($subs) {
            echo "<section id=\"sub_cats\">";
            foreach ($subs as $i) {
                echo "<a class=\"sub_cat_link\" href=\"category.php?catID=" . $i['catID'] . "\" aria-label=\"View this category (" . $i['catName'] . ")\">" . $i['catName'] . "</a>\n";
            }
            echo "</section>";
            echo "<style>.no-items {display:none}</style>";
        }
    }
}
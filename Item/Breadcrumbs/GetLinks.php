<?php

// Get category names, IDs for breadcrumbs (View)
namespace Item\Breadcrumbs;

class GetLinks extends Process {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function createBreadcrumbs() {
        $breadcrumbs = $this->process();

        if ($breadcrumbs) {
            echo "<div class=\"bread_crumbs\">\n";
            echo "<ul aria-label=\"Breadcrumbs (parent and ancester categories)\">\n";
            echo "<li><a href=\"/shop/\">Home</a></li>\n";
            foreach ($breadcrumbs as $i) {
                echo "<li>&raquo; <a href=\"category.php?catID=" . $i['catID'] . "\" aria-label=\"Items for sale in the " . $i['catName'] . " category\">" . $i['catName'] . "</a></li>\n";
            }
            echo "</ul>\n";
            echo "</div>\n";
        }
    }
}
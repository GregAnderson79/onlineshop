<?php

// Get list of images for item gallery (View)
namespace Item\Gallery;

class GetImages extends Process {
    public $itemID;

    public function __construct($itemID) {
        $this->itemID = $itemID;
    }

    public function createGallery() {
        $imgs = $this->process();
        if ($imgs) {
            echo "<div class=\"item_gallery_pnl\">\n";
            echo "<div class=\"item_gallery_loader\"></div>";
            echo "<ul>\n";
            foreach ($imgs as $i => $img) {
                if ($i == array_key_first($imgs)) {
                    echo "<li id=\"img". $i . "\" class=\"li_selected\">\n";
                } else {
                    echo "<li id=\"img". $i . "\">\n";
                }

                echo "<img src=\"itemImages/resized-" . $img['imgName'] . "\" alt=\"" . $img['altTag'] . "\">\n";
                if ($img['caption'] != null) {
                    echo "<span class=\"item_gallery_caption\" aria-label=\"Item image caption\">" . $img['caption'] . "</span>";
                }
                echo "</li>\n";
            }
            echo "</ul></div>\n";

            echo "<div class=\"item_gallery_thumbs\">\n";
            echo "<ul>\n";
            if (count($imgs) > 1) {
                foreach ($imgs as $i => $img) {
                    echo "<li>\n";
                    echo "<a href=\"javascript:SHOWIMG(" . $i . ")\">";
                    echo "<img src=\"itemImages/thumb-" . $img['imgName'] . "\" alt=\"" . $img['altTag'] . "\">\n";
                    echo "</a></li>\n";
                }
            }
            echo "</ul></div>\n";
        }
    }
}
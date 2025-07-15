<?php
// Get list of options (View)
namespace Options\Column;
use Options\Values\Column\GetValues;

class GetOptions extends Process {
    public function createMenu() {
        $options = $this->process();
        if ($options) {
            echo "<ul>\n";
            foreach ($options as $i) {
                echo "<li class=\"opt_parent\">\n";
                echo "<span>" . $i['optName'] . "</span>\n";
                echo "<span class=\"column_li_opts\">\n";
                echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=editOpt&optID=" . $i['optID'] . "\">Edit</a>\n";
                
                // values
                $valuesMenu = new GetValues($i['optID']);
                $values = $valuesMenu->createMenu();
                
                if ($values) {
                    echo "<span class=\"red_disabled\">Delete</span>";
                } else {
                    echo "<a class=\"nav_red\" href=\"" . pageURL(true,true) . "action=delOpt&optID=" . $i['optID'] . "\" onclick=\"return confirm('Are you sure you want to delete this option?')\">Delete</a>\n";
                }
                echo "<a class=\"nav_green\" href=\"" . pageURL(true,true) . "action=addVal&optID=" . $i['optID'] . "\">Add value</a></span>\n";
                echo "</li>\n";
                if ($values) {
                    echo $values;
                }
            }
            echo "</ul>\n";
        } else {
            echo "<p>No options are set up</p>";    
        }
    }
}
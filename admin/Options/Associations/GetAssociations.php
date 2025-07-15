<?php
// Get item/option/value associations (View)
// For use in the item panel
namespace Options\Associations;

class GetAssociations extends Process {
    public $itemID;

    public function __construct($itemID) {
        $this->itemID = $itemID;
    }

    // options
    public function createList() { 
        $options = $this->getOptionAssoc();
        if ($options) {
            echo "<ul>";
            foreach ($options as $i) {
                echo "<li class=\"opt_parent\"><span>" . $i['optName'] . "</span><span class=\"column_li_opts\">";
                if ($i['selected'] == true) {
                    if ($i['selectedValues'] == true) {
                        echo "<span class=\"red_disabled\">Remove this option</span></li>";
                    } else {
                        echo "<a class=\"nav_red\" href=\"" . pageURL(true,true) . "action=delItemOptAssoc&itemID=" . $this->itemID . "&assocID=" . $i['assocID'] . "\">Remove this option</a></span></li>";
                    }
                        $this->insertValues($i['optID']);
                } else {
                    echo "<a class=\"nav_green\" href=\"" . pageURL(true,true) . "action=addItemOptAssoc&itemID=" . $this->itemID . "&optID=" . $i['optID'] . "\">Add this option</a></span></li>";
                } 
            }
            echo "</ul>";
        } else {
            echo "No options";
        }
        
    }

    // values
    public function insertValues($optID) {
        $values = $this->getValueAssoc($optID);
        if ($values) {
            foreach ($values as $i) {
                echo "<li><span>" . $i['valName'] . "</span><span class=\"column_li_opts\">";
                if ($i['selected'] == true) {
                    echo "<a class=\"nav_red\" href=\"" . pageURL(true,true) . "action=delItemValAssoc&itemID=" . $this->itemID . "&assocID=" . $i['assocID'] . "\">Remove this value</a></span></li>";
                } else {
                    echo "<a class=\"nav_green\" href=\"" . pageURL(true,true) . "action=addItemValAssoc&itemID=" . $this->itemID . "&optID=" . $optID . "&valID=" . $i['valID'] . "\">Add this value</a></span></li>";
                } 
            }
        }
    }
}
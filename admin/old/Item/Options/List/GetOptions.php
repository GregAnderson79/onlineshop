<?php
// Manage option associations and option value associations for each item (View)
namespace Item\Options\List;

class GetOptions extends Process {
    public $itemID;

    public function __construct($itemID) {
        $this->itemID = $itemID;
    }

    // options
    public function createList() { 
        $options = $this->contr_itemOptAssoc();
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
                        $this->getValue($i['optID']);
                } else {
                    echo "<a class=\"nav_green\" href=\"" . pageURL(true,true) . "action=addItemOptAssoc&itemID=" . $this->itemID . "&optID=" . $i['optID'] . "\">Add this option</a></span></li>";
                } 
            }
            echo "</ul>";

        } else {
            echo "No options";
        }

        unset($options, $i);        
    }

    // values
    public function getValues($optID) {
        $values = $this->contr_itemValAssoc($optID);
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

        unset($values, $i);
    }
}
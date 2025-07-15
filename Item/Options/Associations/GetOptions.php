<?php

// Get list of option associations for an item (View)
namespace Item\Options\Associations;

class GetOptions extends Process {
    public $itemID;

    public function __construct($itemID) {
        $this->itemID = $itemID;
    }

    public function createForm() {
        $options = $this->process($this->itemID);
        if ($options) {
            // loop options
            foreach($options as $option) {
                // loop options/value rows
                // add relevant html for each
                // creat selec menus
                foreach($option as $i => $menu) {
                    $last = array_key_last($option);
                    if (array_key_exists("optID", $menu)) {
                        echo "<p><label for=\"" . $menu['optName'] . "|" . $menu['optID'] . "\">" . $menu['optName'] . "</label>\n";
                        echo "<span><select name=\"" . $menu['optName'] . "|" . $menu['optID'] . "\" id=\"" . $menu['optName'] . "|" . $menu['optID'] . "\">\n";
                    }

                    if (array_key_exists("valID", $menu)) {
                        echo "<option value=\"" . $menu['valName'] . "|" . $menu['valID'] . "\">" . $menu['valName'] . "</option>\n";
                    }

                    if ($i == array_key_last($option)) {
                        echo "</select></span></p>\n";
                    }
                }
            }
        }
    }
}
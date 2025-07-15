<?php
// Get item/option/value associations (View)
// For use in the item panel
namespace Options\Associations;

class Process extends Model {

    // Ammended array of options for item options panel
    protected function getOptionAssoc() {
        $options = $this->queryOptions(); // options
        $assoc = $this->queryOptionAssoc(); // item-option associations
        $results = [];
        if ($options) {
            foreach ($options as $i) {
                $selected = false;
                $assocID = null;

                // if association found, add assocID and "selected" to this array row
                if ($assoc) {
                    foreach ($assoc as $j) {
                        if ($i['optID'] == $j['optID']) {
                            $selected = true;
                            $assocID = $j['assocID'];
                        }
                    }
                }

                $selectedValues = $this->queryValueAssocQty($i['optID']);
                $results[] = ['assocID' => $assocID, 'optID' => $i['optID'], 'optName' => $i['optName'], 'selected' => $selected, 'selectedValues' => $selectedValues];
            }
        }
        return $results;
    }

    // Ammended array of option values for and option in the item options panel ^
    protected function getValueAssoc($optID) {
        $values = $this->queryValues($optID); // values for this option
        $assoc = $this->queryValueAssoc(); // item-value associations
        $results = [];
        if ($values) {
            foreach ($values as $i) {
                $selected = false;
                $assocID = null;

                // if association found, add assocID and "selected" to this array row
                if ($assoc) {
                    foreach ($assoc as $j) {
                        if ($i['valID'] == $j['valID']) {
                            $selected = true;
                            $assocID = $j['assocID'];
                        }
                    }
                }
                $results[] = ['assocID' => $assocID, 'valID' => $i['valID'], 'valName' => $i['valName'], 'selected' => $selected];
            }
        }
        return $results;
    }
}
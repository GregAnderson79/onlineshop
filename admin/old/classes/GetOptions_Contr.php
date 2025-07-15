<?php

// Get options
class GetOptions_Contr extends GetOptions_Model {

    // Get options
    protected function contr_getOptions() {
        $options = $this->model_getOptions();
        $optsArray = [];
        if ($options) {
            foreach ($options as $i) {
                // get values for this option
                $values = $this->model_getOptValues($i['optID']);
                if ($values) {
                    $optsArray[] = ['ovID' => $i['optID'], 'ovName' => $i['optName'], 'ovParent' => 0, 'isParent' => true];
                    foreach ($values as $j) {
                        $optsArray[] = ['ovID' => $j['valID'], 'ovName' => $j['valName'], 'ovParent' => $i['optID'], 'isParent' => false];
                    }
                } else {
                    $optsArray[] = ['ovID' => $i['optID'], 'ovName' => $i['optName'], 'ovParent' => 0, 'isParent' => false];
                }
            }
        }

        return $optsArray;
    }

    // Ammended array of options for item options panel
    protected function contr_itemOptAssoc() {
        $options = $this->model_getOptions(); // options
        $assoc = $this->model_getItemOptAssoc(); // item-option associations
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

                $selectedValues = $this->model_getItemOptAssocNum($i['optID']);
                $results[] = ['assocID' => $assocID, 'optID' => $i['optID'], 'optName' => $i['optName'], 'selected' => $selected, 'selectedValues' => $selectedValues];
            }
        }
        return $results;
    }

    // Ammended array of option values for and option in the item options panel ^
    protected function contr_itemValAssoc($optID) {
        $values = $this->model_getOptValues($optID); // values for this option
        $assoc = $this->model_getItemValAssoc(); // item-value associations
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
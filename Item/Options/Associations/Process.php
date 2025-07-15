<?php

// Get list of option associations for an item (Controller)
namespace Item\Options\Associations;
use Item\Options\Names\GetName;
use Item\Options\Values\Associations\GetValues;
use Item\Options\Values\Names\GetName as GetValueName;

class Process extends Model {

    protected function process() {
        $options = $this->privateQuery($this->itemID);
        if ($options) {
            $formData = [];
            foreach($options as $i) {
                $formRow = [];

                // get option name
                $optName = new GetName($i['optID']);
                $name = $optName->returnOptName();

                // get value associations
                $valueData = new GetValues($this->itemID, $i['optID']);
                $values = $valueData->returnValIDs();
                if ($values) {
                    $formRow[] = ['optID' => $i['optID'], 'optName' => $name];

                    foreach($values as $j) {
                        // get value name
                        $valName = new GetValueName($j['valID']);
                        $name = $valName->returnValName();

                        $formRow[] = ['valID' => $j['valID'], 'valName' => $name];
                    }
                }
                $formData[] = $formRow;
                unset($formRow);
            }
            return $formData;
        }
    }

    private function privateQuery() {
        return $this->query();
    }
}
<?php

// Get list of option values associations for an item (View)
namespace Item\Options\Values\Associations;

class GetValues extends Process {
    public $itemID;
    public $optID;

    public function __construct($itemID, $optID) {
        $this->itemID = $itemID;
        $this->optID = $optID;
    }

    public function returnValIDs() {
        return $this->process();
    }
}
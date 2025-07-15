<?php
// Set association between item and option value (Controller)
namespace Options\Associations\Values\SetAssoc;

class Save extends Model {
    protected $itemID;
    protected $optID;
    protected $valID;
        
    public function __construct($itemID, $optID, $valID) {
        $this->itemID = $itemID;
        $this->optID = $optID;
        $this->valID = $valID;
    }

    public function process() {
        // validate IDs
        if ($this->validateIDs()) {
            header("location: " . pageURL(false,true) . "error=1");
            exit();
        }

        if ($this->set() === true) {
            header("location: " . pageURL(true,true) . "action=itemOpts&itemID=" . $this->itemID);
        } else {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }
    }

    // validate IDs
    private function validateIDs() {
        if ((!is_numeric($this->itemID)) || (!is_numeric($this->optID)) || (!is_numeric($this->valID))) {
            return true;
        }
    }

    // model
    private function set() {
        return $this->query();
    }
}
<?php
// Delete association between item and option value (Model)
namespace Options\Associations\Values\DeleteAssoc;

class Delete extends Model {
    protected $assocID;
    protected $itemID;
        
    public function __construct($assocID, $itemID) {
        $this->assocID = $assocID;
        $this->itemID = $itemID;
    }

    // delete Item
    public function process() { 
        // validate IDs
        if ($this->valNumeric()) {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        if ($this->delete() === true) {
            header("location: " . pageURL(true,true) . "action=itemOpts&itemID=" . $this->itemID);
        } else {
            header("location: " . pageURL(true,true) . "error=0"); // error
            exit();
        }
    }

    // validate IDs
    private function valNumeric() {
        if ((!is_numeric($this->assocID)) || (!is_numeric($this->itemID))) {
            return true;
        }
    }

    // model
    private function delete() {
        return $this->query();
    }
}
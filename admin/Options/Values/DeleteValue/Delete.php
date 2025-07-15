<?php
// Delete option value (Controller)
namespace Options\Values\DeleteValue;

class Delete extends Model {
    protected $valID;

    public function __construct($valID) {
        $this->valID = $valID;
    }

    // delete Item
    public function process() { 

        // validate
        if ($this->valNumeric()) {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        if ($this->delete() === true) {
            header("location: " . pageURL(true,false));
        } else {
            header("location: " . pageURL(true,true) . "error=0"); // error
            exit();
        }
    }

    // validate ID
    private function valNumeric() {
        if (!is_numeric($this->valID)) {
            return true;
        }
    }

    // model
    private function delete() {
        return $this->query();
    }
}
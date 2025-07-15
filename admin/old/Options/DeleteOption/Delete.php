<?php
// Delete option
namespace Options\DeleteOption;

class Delete extends Model {
    public $optID;

    public function __construct($optID) {
        $this->optID = $optID;
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
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }
    }

    // validate ID
    private function valNumeric() {
        if (!is_numeric($this->optID)) {
            return true;
        }
    }

    // private Delete Item
    private function delete() {
        return $this->query();
    }
}
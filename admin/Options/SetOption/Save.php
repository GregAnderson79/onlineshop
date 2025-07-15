<?php
// Set option (Controller)
namespace Options\SetOption;

class Save extends Model {
    protected $optName;
    protected $optID;

    public function __construct($optName, $optID) {
        $this->optName = $optName;
        $this->optID = $optID;
    }

    public function process() {

        // validate
        if ($this->valLength()) {
            $_SESSION["optName"] = $this->optName;

            header("location: " . pageURL(false,true) . "error=2");
            exit();
        }

        // add option
        if ($this->set() === true) {
            header("location: " . pageURL(true,false));
        } else {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }
    }

    // model
    private function set() {
        if ($this->optID) {
            return $this->queryUpdate();
        } else {
            return $this->queryAdd();
        }
    }

    // validate name length
    private function valLength() {
        if (strlen($this->optName) < 1) {
            return true;
        }
    }
}
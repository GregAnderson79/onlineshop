<?php
// Set option value (Controller)
namespace Options\Values\SetValue;

class Save extends Model {
    protected $valName;
    protected $optID;
    protected $valID;

    public function __construct($valName, $optID, $valID) {
        $this->valName = $valName;
        $this->optID = $optID;
        $this->valID = $valID;
    }

    public function process() {

        // validate
        if ($this->valLength()) {
            $_SESSION["valName"] = $this->valName;

            header("location: " . pageURL(false,true) . "error=2");
            exit();
        }

        // add value
        if ($this->set() === true) {
            header("location: " . pageURL(true,false));
        } else {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }
    }

    // model
    private function set() {
        if ($this->valID) {
            return $this->queryUpdate();
        } else {
            return $this->queryAdd();
        }
    }

    // validate name length
    private function valLength() {
        if (strlen($this->valName) < 1) {
            return true;
        }
    }
}
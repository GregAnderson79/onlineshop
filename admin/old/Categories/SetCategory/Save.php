<?php
// Set Category (Controller)
namespace Categories\SetCategory;

class Save extends Model {
    public $catName;
    public $catDesc;
    public $parID;
    public $catStatus;
    public $catID;
        
    public function __construct($catName, $catDesc, $parID, $catStatus, $catID) {
        $this->catName = $catName;
        $this->catDesc = $catDesc;
        $this->parID = $parID;
        $this->catStatus = $catStatus;
        $this->catID = $catID;
    }

    public function process() {

        // validate, redirect
        if ($this->valNameLen()) {
            $_SESSION["catName"] = $this->catName;
            $_SESSION["catDesc"] = $this->catDesc;
            $_SESSION["parID"] = $this->parID;
            $_SESSION["catStatus"] = $this->catStatus;
            $_SESSION["catID"] = $this->catID;

            header("location: " . pageURL(false,true) . "error=2");
            exit;
        }

        // add / update cat
        if ($this->set() === true) {
            header("location: " . pageURL(true,false));
            exit;
        } else {
            header("location: " . pageURL(true,true) . "error=0");
            exit;
        }
    }

    // model
    private function set() {
        if ($this->catID) {
            return $this->queryUpdate();
        } else {
            return $this->queryAdd();
        }
    }

    // validate cat name length
    private function valNameLen() {
        if (strlen($this->catName) < 1) {
            return true;
        }
    }
}
<?php

// Set Category
class SetCat_Contr extends SetCat_Model {
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

    public function contr_setCat() {

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
        if ($this->setCat() === true) {
            header("location: " . pageURL(true,false));
            exit;
        } else {
            header("location: " . pageURL(true,true) . "error=0");
            exit;
        }
    }

    // model
    private function setCat() {
        if ($this->catID) {
            return $this->model_updCat();
        } else {
            return $this->model_addCat();
        }
    }

    // validate cat name length
    private function valNameLen() {
        if (strlen($this->catName) < 1) {
            return true;
        }
    }
}
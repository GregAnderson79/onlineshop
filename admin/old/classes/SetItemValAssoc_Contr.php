<?php

class SetItemValAssoc_Contr extends SetItemValAssoc_Model {
    protected $itemID;
    protected $optID;
    protected $valID;
        
    public function __construct($itemID, $optID, $valID) {
        $this->itemID = $itemID;
        $this->optID = $optID;
        $this->valID = $valID;
    }

    public function contr_setAssoc() {
        // validate IDs
        if ($this->contr_valIDs()) {
            header("location: " . pageURL(false,true) . "error=1");
            exit();
        }

        if ($this->setAssoc() === true) {
            header("location: " . pageURL(true,true) . "action=itemOpts&itemID=" . $this->itemID);
        } else {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }
    }

    // validate IDs
    private function contr_valIDs() {
        if ((!is_numeric($this->itemID)) || (!is_numeric($this->optID)) || (!is_numeric($this->valID))) {
            return true;
        }
    }

    // model
    private function setAssoc() {
        return $this->model_setAssoc();
    }
}
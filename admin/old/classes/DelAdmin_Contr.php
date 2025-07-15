<?php

class DelAdmin_Contr extends SetAdmin_Model {
    public $adminID;

    public function __construct($adminID) {
        $this->adminID = $adminID;
    }

    // delete admin
    public function contr_delAdmin() { 
        if ($this->delAdmin() === true) {
            header("location: " . pageURL(true,true) . "action=admins");
        } else {
            header("location: " . pageURL(true,true) . "error=0"); // error
            exit();
        }
    }

    // to Model
    private function delAdmin() {
        return $this->model_delAdmin();
    }
}
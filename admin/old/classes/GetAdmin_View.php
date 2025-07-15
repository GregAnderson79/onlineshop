<?php

class GetAdmin_View extends GetAdmin_Contr {
    public $adminID;
    public $encMethod;
    public $encKey;
    public $encIV;

    public function __construct($adminID, $encMethod, $encKey, $encIV) {
        $this->adminID = $adminID;
        $this->encMethod = $encMethod;
        $this->encKey = $encKey;
        $this->encIV = $encIV;
    }

    public function view_getAdmin() {
        return $this->getAdmin();
    }

    private function getAdmin() {
        return $this->contr_getAdmin();
    }
}
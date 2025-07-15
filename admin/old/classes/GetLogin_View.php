<?php

// Get login
class GetLogin_View extends GetLogin_Contr {
    public $adminEmail;
    public $adminPwd;
    public $encMethod;
    public $encKey;
    public $encIV;

    public function __construct($adminEmail, $adminPwd, $encMethod, $encKey, $encIV) {
        $this->adminEmail = $adminEmail;
        $this->adminPwd = $adminPwd;
        $this->encMethod = $encMethod;
        $this->encKey = $encKey;
        $this->encIV = $encIV;
    }

    public function view_getLogin() {
        return $this->getLogin();
    }

    // Contr
    private function getLogin() {
        return $this->contr_getLogin();
    }
}
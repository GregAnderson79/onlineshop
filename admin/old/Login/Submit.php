<?php
// Login (View)
namespace Login;

// Get login
class Submit extends Process {
    public $adminEmail;
    public $adminPwd;

    public function __construct($adminEmail, $adminPwd) {
        $this->adminEmail = $adminEmail;
        $this->adminPwd = $adminPwd;
    }

    public function login() {
        return $this->process();
    }
}
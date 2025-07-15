<?php

// Set admin (new or update)
class SetAdmin_Contr extends SetAdmin_Model {
    public $adminName;
    public $adminEmail;
    public $adminPwd;
    public $adminID;
    public $encMethod;
    public $encKey;
    public $encIV;

    public function __construct($adminName, $adminEmail, $adminPwd, $adminID, $encMethod, $encKey, $encIV) {
        $this->adminName = $adminName;
        $this->adminEmail = $adminEmail;
        $this->adminPwd = $adminPwd;
        $this->adminID = $adminID;
        $this->encMethod = $encMethod;
        $this->encKey = $encKey;
        $this->encIV = $encIV;
    }

    public function contr_setAdmin() {

        // validation
        if ($this->valName() || $this->valEmail() || $this->valPwd() || $this->valExistingEmail()) {
            $_SESSION["adminName"] = $this->adminName;
            $_SESSION["adminEmail"] = $this->adminEmail;
            $_SESSION["adminPwd"] = $this->adminPwd;

            if ($this->valName()) {
                header("location: " . pageURL(false,true) . "error=2");
                exit();
            }
            if ($this->valEmail()) {
                header("location: " . pageURL(false,true) . "error=3");
                exit();
            }
            if ($this->valPwd()) {
                header("location: " . pageURL(false,true) . "error=4");
                exit();
            }
            if ($this->valExistingEmail()) {
                header("location: " . pageURL(false,true) . "error=5");
                exit();
            }
        }

        $encrypt_method = $this->encMethod;
        $secret_key = $this->encKey;
        $secret_iv = $this->encIV;

        // hash
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        $encrptedPwd = openssl_encrypt($this->adminPwd, $encrypt_method, $key, 0, $iv);
        $encrptedPwd = base64_encode($encrptedPwd);
        $this->adminPwd = $encrptedPwd;

        if ($this->setAdmin() === true) { 
            header("location: " . pageURL(true,true) . "action=admins");
        } else {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }
    }

    // to model
    private function setAdmin() {
        if ($this->adminID) {
            return $this->model_updAdmin();
        } else {
            return $this->model_addAdmin();
        }
    }

    // validate admin name
    private function valName() {
        if (strlen($this->adminName) < 1) {
            return true;
        }
    }

    // validate admin email
    private function valEmail() {
        if (!filter_var($this->adminEmail, FILTER_VALIDATE_EMAIL)) {
           return true;
        }
    }

    // validate admin password
    private function valPwd() {
        $uppercase = preg_match('@[A-Z]@', $this->adminPwd);
        $lowercase = preg_match('@[a-z]@', $this->adminPwd);
        $number = preg_match('@[0-9]@', $this->adminPwd);
        $specialChars = preg_match('@[^\w]@', $this->adminPwd);
            
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($this->adminPwd) < 8) {
            return true;
        }
    }

    // existing email address?
    private function valExistingEmail() {
        $existingEmails = $this->model_getExistingEmails();
        $emailError = false;
        if ($existingEmails) {
            foreach ($existingEmails as $i) {
                if ($this->adminID) {
                    if ($i['adminID'] != $this->adminID) {
                        $emailError = true;
                    }
                } else {
                    $emailError = true;
                }
            }
        }
        return $emailError;
    }
}
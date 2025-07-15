<?php
// Set admin (Controller)
namespace Admins\SetAdmin;
use Password\Encryption\GetCodes;

class Save extends Model {
    public $adminName;
    public $adminEmail;
    public $adminPwd;
    public $adminID;

    public function __construct($adminName, $adminEmail, $adminPwd, $adminID) {
        $this->adminName = $adminName;
        $this->adminEmail = $adminEmail;
        $this->adminPwd = $adminPwd;
        $this->adminID = $adminID;
    }

    public function process() {

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

        // encryption
        $enc = new GetCodes();
        $codes = $enc->latestRow();
            $encrypt_method = $codes['encMethod'];
            $secret_key = $codes['encKey'];
            $secret_iv = $codes['encIV'];

        // hash
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        $encrptedPwd = openssl_encrypt($this->adminPwd, $encrypt_method, $key, 0, $iv);
        $encrptedPwd = base64_encode($encrptedPwd);
        $this->adminPwd = $encrptedPwd;

        if ($this->set() === true) { 
            header("location: " . pageURL(true,true) . "action=admins");
        } else {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        unset($enc, $codes, $encrypt_method, $secret_key, $secret_iv, $key, $iv, $encrptedPwd);
    }

    // model
    private function set() {
        if ($this->adminID) {
            return $this->queryUpdate();
        } else {
            return $this->queryAdd();
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

        unset($uppercase, $lowercase, $number, $specialChars);
    }

    // existing email address?
    private function valExistingEmail() {
        $existingEmails = $this->queryExistingEmails();
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

        unset($existingEmails, $emailError);
    }
}
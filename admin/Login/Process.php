<?php
// Login (Controller)
namespace Login;
use Password\Encryption\GetCodes;

class Process extends Model {
    protected function process() {

        // validation
        if ($this->valEmail() || $this->valPwd()) {
            $_SESSION["adminEmail"] = $this->adminEmail;

            if ($this->valEmail()) {
                header("location: index.php?error=1");
                exit();
            }
            if ($this->valPwd()) {
                header("location: index.php?error=2");
                exit();
            }
        }

        // validation
        $admin = $this->query();
        if ($admin == null) {
            header("location: index.php?error=3");
            exit;
        }

        if ($admin) {
            // encryption
            $enc = new GetCodes();
            $codes = $enc->latestRow();
                $encrypt_method = $codes['encMethod'];
                $secret_key = $codes['encKey'];
                $secret_iv = $codes['encIV'];

            // hash
            $key = hash('sha256', $secret_key);
            $iv = substr(hash('sha256', $secret_iv), 0, 16);

            $decryptedPwd = openssl_decrypt(base64_decode($admin['adminPwd']), $encrypt_method, $key, 0, $iv);

            if ($decryptedPwd == $this->adminPwd) {
                $_SESSION["loggedInAdmin"] = true;
                $_SESSION["loggedInID"] = $admin['adminID'];
                $_SESSION["loggedInUserName"] = $admin['adminName'];

                if (isset($_SESSION["loggedInAdmin"])) {
                    header("location: menu.php");
                    exit;
                }
            } else  {
                header("location: index.php?error=0");
                exit;  
            }
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
}
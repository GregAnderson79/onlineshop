<?php

// Get login
class GetLogin_Contr extends GetLogin_Model {

    protected function contr_getLogin() {
        $admin = $this->model_getLogin();
        if ($admin == null) {
            header("location: index.php?error=1");
            exit;
        }

        if ($admin) {
            $encrypt_method = $this->encMethod;
            $secret_key = $this->encKey;
            $secret_iv = $this->encIV;

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
                header("location: index.php?error=1");
                exit;  
            }
        }
    }
}
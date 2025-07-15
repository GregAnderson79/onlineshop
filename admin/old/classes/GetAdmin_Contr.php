<?php

// Get admin account details
class GetAdmin_Contr extends GetAdmin_Model {

    protected function contr_getAdmin() {
        $adminData = $this->model_getAdmin();
        if ($adminData) {

            // decrypt pwd
            $encrypt_method = $this->encMethod;
            $secret_key = $this->encKey;
            $secret_iv = $this->encIV;

            // hash
            $key = hash('sha256', $secret_key);
            $iv = substr(hash('sha256', $secret_iv), 0, 16);

            $decryptedPwd = openssl_decrypt(base64_decode($adminData['adminPwd']), $encrypt_method, $key, 0, $iv);

            // create array
            $newData = [
                'adminName' => $adminData['adminName'], 
                'adminEmail' => $adminData['adminEmail'], 
                'adminPwd' => $decryptedPwd
            ];
        } else {
            $newData = null;
        }
        return $newData;
    }
}
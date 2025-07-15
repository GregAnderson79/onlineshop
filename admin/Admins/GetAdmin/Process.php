<?php
// Get admin (Controller)
namespace Admins\GetAdmin;
use Password\Encryption\GetCodes;

class Process extends Model {

    protected function process() {
        $adminData = $this->privateQuery();
        if ($adminData) {

            // decrypt pwd
            $enc = new GetCodes();
            $codes = $enc->latestRow();
                $encrypt_method = $codes['encMethod'];
                $secret_key = $codes['encKey'];
                $secret_iv = $codes['encIV'];

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

    private function privateQuery() {
        return $this->query();
    }
}
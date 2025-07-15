<?php
// Set admin (Model)
namespace Admins\SetAdmin;
use Database\Model as DB;

class Model extends DB {

    // Add admin
    protected function queryAdd() {
        $sql = "INSERT INTO admins (adminName, adminEmail, adminPwd) VALUES (?, ?, ?);";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->adminName, $this->adminEmail, $this->adminPwd])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }

    // Update admin
    protected function queryUpdate() {
        $sql = "UPDATE admins SET adminName=?, adminEmail=?, adminPwd=? WHERE adminID=?";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->adminName, $this->adminEmail, $this->adminPwd, $this->adminID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }   
    }
    
    // Check for existing email address
    protected function queryExistingEmails() {
        $sql = "SELECT adminID FROM admins WHERE adminEmail = ?";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([$this->adminEmail])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "?error=0");
            exit();
        }

        $result;
        if ($statement->rowCount() > 0) {
            $result = $statement->fetchAll();
        } else {
            $result = null;
        }

        $statement = null;
        return $result;
    }
}
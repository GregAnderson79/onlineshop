<?php

class SetAdmin_Model extends Database_Model {

    // Add admin
    protected function model_addAdmin() {
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
    protected function model_updAdmin() {
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

    // Delete admin
    protected function model_delAdmin() {
        $sql = "DELETE FROM admins WHERE adminID = ?;";
        $statement = $this->connect()->prepare($sql);
        
        if (!$statement->execute([$this->adminID])) {
            $statement = null;
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        } else {
            return true;
            $statement = null;
        }
    }

    // Check for existing email address
    protected function model_getExistingEmails() {
        $sql = "SELECT adminID FROM admins WHERE adminEmail = ?";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$this->adminEmail])) {
            $stmt = null;
            header("location: " . pageURL(true,true) . "?error=0");
            exit();
        }

        $result;
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();
        } else {
            $result = null;
        }

        $stmt = null;
        return $result;
    }
}
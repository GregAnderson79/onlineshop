<?php
// Checkout submission (Model)
namespace Checkout;
use Database\Model as DB;

class Model extends DB {

    protected function query($cartItems) {
        $sql = "INSERT INTO orders (firstName, lastName, email, tel, address1, address2, towncity, county, postcode, items, total, orderStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $statement = $this->connect()->prepare($sql);

        if (!$statement->execute([
            $this->firstName, 
            $this->lastName, 
            $this->email, 
            $this->tel,
            $this->address1,
            $this->address2,
            $this->towncity,
            $this->county,
            $this->postcode,
            $cartItems,
            $_SESSION["cartTotal"],
            "Pending"])) {
                $statement = null;
                header("location: checkout.php?error=0");
                exit();
        } else {
            return true;
            $statement = null;
        }
    }
}
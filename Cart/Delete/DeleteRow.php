<?php

// Delete row from cart
namespace Cart\Delete;

class DeleteRow {
    public $rowID;

    public function __construct($rowID) {
        $this->rowID = $rowID;
    }

    public function delete() {
        if ($_SESSION["cartItems"]) {
            unset($_SESSION["cartItems"][$this->rowID]);
            header("location: cart.php");
        } else {
            header("location: cart.php?error=1");
        }
    }
}
<?php

// Add item to cart (Controller)
namespace Cart\Add;
use Cart\Item\GetItem;

class AddItem {
    public $fields;

    public function __construct($fields) {
        $this->fields = $fields;
    }

    public function addRow() {
        $itemID = $this->fields['itemID'];
        unset($this->fields['itemID']);
        $quantity = $this->fields['quantity'];
        unset($this->fields['quantity']);

        // get item details
        $item = new GetItem($itemID);
        $itemData = $item->returnItem();

        if ($itemData) {
            $itemName = $itemData['itemName'];
            $itemPrice = $itemData['itemPrice'];

            $row = [
                'itemID' => $itemID,
                'quantity' => $quantity,
                'itemPrice' => $itemPrice,
                'itemName' => $itemName,
                'options' => $this->fields
            ];

            if (!isset($_SESSION["cartItems"])) {
                $_SESSION["cartItems"] = [];
            }
            $_SESSION["cartItems"][] = $row;

            header("location: cart.php");
        } else {
            header("location: cart.php?error=1");
        }
    }
}
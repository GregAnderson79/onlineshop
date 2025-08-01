<?php
// Set item (Controller)
namespace Items\Item\SetItem;

class Save extends Model {
   protected $itemName;
    protected $catID;
    protected $itemPrice;
    protected $itemStatus;
    protected $itemStock;
    protected $itemDesc1;
    protected $itemDesc2;
    protected $itemDesc3;
    protected $itemID;
        
    public function __construct($itemName, $catID, $itemPrice, $itemStatus, $itemStock, $itemDesc1, $itemDesc2, $itemDesc3, $itemID) {
        $this->itemName = $itemName;
        $this->catID = $catID;
        $this->itemPrice = $itemPrice;
        $this->itemStatus = $itemStatus;
        $this->itemStock = $itemStock;
        $this->itemDesc1 = $itemDesc1;
        $this->itemDesc2 = $itemDesc2;
        $this->itemDesc3 = $itemDesc3;
        $this->itemID = $itemID;
    }

    public function process() {

        // validate
        if ($this->valNameLen() || $this->valPriceNumeric() || $this->valPriceFormat() || $this->valStockNumeric()) {
            $_SESSION["itemName"] = $this->itemName;
            $_SESSION["catID"] = $this->catID;
            $_SESSION["itemPrice"] = $this->itemPrice;
            $_SESSION["itemStatus"] = $this->itemStatus;
            $_SESSION["itemStock"] = $this->itemStock;
            $_SESSION["itemDesc1"] = $this->itemDesc1;
            $_SESSION["itemDesc2"] = $this->itemDesc2;
            $_SESSION["itemDesc3"] = $this->itemDesc3;
    
            if ($this->valNameLen()) {
                header("location: " . pageURL(false,true) . "error=2");
                exit();
            }

            if ($this->valPriceNumeric()) {
                header("location: " . pageURL(false,true) . "error=3");
                exit();
            }

            if ($this->valPriceFormat()) {
                header("location: " . pageURL(false,true) . "error=4");
                exit();
            }

            if ($this->valStockNumeric()) {
                header("location: " . pageURL(false,true) . "error=5");
                exit();
            }
        }
    
        // add / update item
        if ($this->set() === true) {
            header("location: " . pageURL(true,false));
        } else {
            header("location: " . pageURL(true,true) . "error=0"); // error
            exit();
        }
    }

    // to model
    private function set() {
        if ($this->itemID) {
            return $this->queryUpdate();
        } else {
            return $this->queryAdd();
        }
    }

    // validate item name length
    private function valNameLen() {
        if (strlen($this->itemName) < 1) {
            return true;
        }
    }

    // validate price is numeric
    private function valPriceNumeric() {
        if (!is_numeric($this->itemPrice)) {
           return true;
        }
    }

    // validate price is formatted correctly NN.NN
    private function valPriceFormat() {
        if (!preg_match("/^(0|[1-9]\d*)(\.\d{2})?$/", $this->itemPrice)) {
           return true;
        }
    }

    // validate stock is numeric
    private function valStockNumeric() {
        if (!is_numeric($this->itemStock)) {
           return true;
        }
    }
}
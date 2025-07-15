<?php

// Get delivery price
class GetDelPrice_Contr extends GetDelPrice_Model {

    protected function contr_GetDelPrice() {
        $delPrice = $this->model_getDelPrice();
        if ($delPrice) {
            return $delPrice;
        } else {
            return null;
        }
    }
}
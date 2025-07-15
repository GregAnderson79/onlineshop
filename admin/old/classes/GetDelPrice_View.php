<?php

// Get delivery price
class GetDelPrice_View extends GetDelPrice_Contr {

    public function view_getDelPrice() {
        return $this->getDelPrice();
    }

    private function getDelPrice() {
        return $this->contr_getDelPrice();
    }
}
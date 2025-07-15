<?php

// Get PayPal Email
class GetPayPalEmail_View extends GetPayPalEmail_Contr {

    public function view_getPayPalEmail() {
        return $this->getPayPalEmail();
    }

    private function getPayPalEmail() {
        return $this->contr_getPayPalEmail();
    }
}
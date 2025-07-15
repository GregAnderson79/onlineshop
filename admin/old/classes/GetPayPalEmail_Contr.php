<?php

// Get PayPal email
class GetPayPalEmail_Contr extends GetPayPalEmail_Model {

    protected function contr_GetPayPalEmail() {
        $payPalEmail = $this->model_GetPayPalEmail();
        if ($payPalEmail) {
            return $payPalEmail;
        } else {
            return null;
        }
    }
}
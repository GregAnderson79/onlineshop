<?php
// Get PayPal Email
namespace PayPal\GetEmail;

class Process extends Model {

    protected function process() {
        $payPalEmail = $this->privateQuery();
        if ($payPalEmail) {
            return $payPalEmail;
        } else {
            return null;
        }
        unset($payPalEmail);
    }

    private function privateQuery() {
        return $this->query();
    }
}
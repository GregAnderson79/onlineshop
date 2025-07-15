<?php

// Get delivery price (View)
namespace Cart\Delivery;

class GetPrice extends Process {

    public function returnPrice() {
        return $this->process();
    }
}
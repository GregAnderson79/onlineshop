<?php
// Get delivery price (View)
namespace Delivery\GetPrice;

class GetData extends Process {

    public function returnPrice() {
        return $this->process();
    }
}
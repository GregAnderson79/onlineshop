<?php
// Get list of sub categories for mobile nav (View)
namespace Categories\Lists\MobileNav\Subs;

class GetCategories extends Process {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function subCategories() {
        return $this->process();
    }
}
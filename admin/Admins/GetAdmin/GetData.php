<?php
// Get admin (View)
namespace Admins\GetAdmin;

class GetData extends Process {
    public $adminID;

    public function __construct($adminID) {
        $this->adminID = $adminID;
    }

    public function returnAdmin() {
        return $this->process();
    }
}
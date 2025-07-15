<?php
// Delete admin (Controller)
namespace Admins\DeleteAdmin;

class Delete extends Model {
    public $adminID;

    public function __construct($adminID) {
        $this->adminID = $adminID;
    }

    // delete admin
    public function process() { 
        if ($this->delete() === true) {
            header("location: " . pageURL(true,true) . "action=admins");
        } else {
            header("location: " . pageURL(true,true) . "error=0"); // error
            exit();
        }
    }

    // to Model
    private function delete() {
        return $this->query();
    }
}
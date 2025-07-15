<?php
// Get main image for item (Controller)
namespace Items\Item\Images\Main;

class Process extends Model {

    protected function process() {
        $img = $this->privateQuery();
        if ($img) {
            return $img;
        }
    }

    private function privateQuery() {
        return $this->query();
    }
}
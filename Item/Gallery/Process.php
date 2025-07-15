<?php

// Get list of images for item gallery (Model)
namespace Item\Gallery;

class Process extends Model {

    protected function process() {
        $imgs = $this->privateQuery();
        if ($imgs) {
            return $imgs;
        }
    }

    private function privateQuery() {
        return $this->query();
    }
}
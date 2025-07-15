<?php
// Return latest encryption codes (View)
namespace Password\Encryption;

class GetCodes extends Process {
    public function latestRow() {
        return $this->process();
    }
}
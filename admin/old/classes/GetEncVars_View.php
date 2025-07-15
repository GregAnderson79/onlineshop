<?php

// get encryption variables for passwords
class GetEncVars_View extends GetEncVars_Contr {

    public function view_getEncVars() {
        return $this->getEncVars();
    }

    // contr
    private function getEncVars() {
        return $this->contr_getEncVars();
    }
}
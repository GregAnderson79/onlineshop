<?php

// get encryption variables for passwords
class GetEncVars_Contr extends GetEncVars_Model {

    protected function contr_getEncVars() {
        $encData = $this->model_getEncVars();
        return end($encData);
    }
}
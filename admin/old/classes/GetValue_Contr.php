<?php

// Get option value
class GetValue_Contr extends GetValue_Model {

    protected function contr_getValue() {
        return $this->model_getValue(); 
    }
}
<?php

// Get Category Order Form
// for updating the parent or child category order
class GetCatOrderForm_Contr extends GetCats_Model {

    protected function contr_getCatOrderForm() {
        if (isset($this->catID)) {
            return $this->model_getChildCats();
        } else {
            return $this->model_getParCats();
        } 
    }
}
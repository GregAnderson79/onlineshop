<?php

// Get Category Data
// for recalling stored category data
class GetCat_Contr extends GetCat_Model {

    protected function contr_getCat() {
        return $this->model_getCat();
    }
}
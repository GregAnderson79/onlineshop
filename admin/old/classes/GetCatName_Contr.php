<?php

// Get category name
class GetCatName_Contr extends GetCat_Model {

    protected function contr_getCatName() {
        $catArray = $this->model_getCatName();
        if (isset($catArray)) {
            return $catArray['catName'];
        } else {
            return null;
        }
    }
}
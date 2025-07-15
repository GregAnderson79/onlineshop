<?php

// Get Parent Category Select menu
// for use in setting categories as parent or child categories
class GetParCatSelector_Contr extends GetCats_Model {

    protected function contr_GetParCatSelector() {
        return $this->model_getParCats();
    }
}
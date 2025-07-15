<?php

// Get Category Row Count
// for finding out if there are enough parent or child categories to run ordering
class GetCatsRowCount_Contr extends GetCats_Model {

    protected function contr_getCatsRowCount() {
        if (isset($this->catID)) {
            return $this->contr_getChildCatsRowCount();
        } else {
            return $this->contr_getParCatsRowCount();
        }
    }

    // parent cats
    protected function contr_getParCatsRowCount() {
        $numCats = $this->model_getParCats();
        if ($numCats === null) {
            return 0;
        } else {
            return count($numCats);
        }
    }

    // child cats
    protected function contr_getChildCatsRowCount() {
        $numCats = $this->model_getChildCats();
        if ($numCats === null) {
            return 0;
        } else {
            return count($numCats);
        }
    }
}
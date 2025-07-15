<?php

// Get All Categories Select menu
// for use in assigning an item to a category
class GetAllCatsSelector_Contr extends GetCats_Model {

    protected function contr_getAllCatsSelector() {
        $parCats = $this->model_getParCats();
        $cats = [];
        foreach ($parCats as $i) {
            $cats[] = ['catID' => $i['catID'], 'catName' => $i['catName']];

            $subCats = $this->model_getChildCatsLoop($i['catID']);
            if ($subCats) {
                foreach ($subCats as $j) {
                    $cats[] = ['catID' => $j['catID'], 'catName' => $j['catName'], 'parID' => $j['parID']];
                }
            }
        }
        return $cats;
    }
}
<?php

// Get child categories column
class GetChildCatsCol_Contr extends GetCats_Model {

    protected function contr_getChildCatsCol() {
    //    return $this->model_getChildCats();
        $dB_cats = $this->model_getChildCats();
        if ($dB_cats) {
            $new_cats = [];
            foreach ($dB_cats as $i) {
                $childCats = 0;
                $new_cats[] = [
                    'catID' => $i['catID'], 
                    'catName' => $i['catName'], 
                    'pos' => $i['pos'], 
                    'status' => $i['catStatus'], 
                    'catItems' => $this->model_getCatItemsLoop($i['catID'])
                ];
            }
            return $new_cats;
        } else {
            return null;
        }
    }
}
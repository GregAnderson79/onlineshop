<?php

// Get parent category column
class GetParCatsCol_Contr extends GetCats_Model {
 
    protected function contr_getParCatsCol () {
        $ancCats = $this->model_getAncCats();
        $dB_cats = $this->model_getParCats();
        
        $new_cats = [];
        foreach ($dB_cats as $i) {
            $childCats = 0;
            foreach ($ancCats as $j) {
                if ($j['parID'] == $i['catID']) {
                    $childCats++;
                }
            }
            $new_cats[] = [
                'catID' => $i['catID'], 
                'catName' => $i['catName'], 
                'pos' => $i['pos'], 
                'status' => $i['catStatus'], 
                'childCats' => $childCats,
                'catItems' => $this->model_getCatItemsLoop($i['catID'])
            ];
        }
        return $new_cats;
    }

}
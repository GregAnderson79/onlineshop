<?php

//namespace MobileNav;

// Get Mobile Navigation
class GetMobNav_Contr extends GetCats_Model {

    protected function contr_GetMobNav() {
        $mob_parCats = $this->model_getParCats();
        if ($mob_parCats) {
            $new_allCats = [];
            foreach ($mob_parCats as $i) {
                $mob_subCats = $this->model_getChildCatsLoop($i['catID']);
                if ($mob_subCats) {
                    $new_cats[] = [
                        'catID' => $i['catID'], 
                        'catName' => $i['catName'], 
                        'status' => $i['catStatus'],
                        'parID' => 0,
                        'childCats' => true
                    ];
                    foreach ($mob_subCats as $j) {
                        $new_cats[] = [
                            'catID' => $j['catID'], 
                            'catName' => $j['catName'], 
                            'status' => $j['catStatus'],
                            'parID' => $j['parID'],
                            'childCats' => false
                        ];
                    }
                } else {
                    $new_cats[] = [
                        'catID' => $i['catID'], 
                        'catName' => $i['catName'], 
                        'status' => $i['catStatus'],
                        'parID' => 0,
                        'childCats' => false
                    ];
                }
            }
            return $new_cats;
        } else {
            return null;
        }
    }
}
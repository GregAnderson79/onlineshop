<?php
// Get list of all categories for selector menu (Controller)
namespace Categories\Lists\Selectors\All;
use Categories\Lists\Model\All as Model;

class Process extends Model {

    protected function process() {
        $mainCats = $this->privateQuery();
        $cats = [];
        foreach ($mainCats as $i) {
            $cats[] = ['catID' => $i['catID'], 'catName' => $i['catName']];

            $subCats = $this->querySubs($i['catID']);
            if ($subCats) {
                foreach ($subCats as $j) {
                    $cats[] = ['catID' => $j['catID'], 'catName' => $j['catName'], 'parID' => $j['parID']];
                }
            }
        }
        return $cats;
    }

    private function privateQuery() {
        return $this->queryMains();
    }
}
<?php

// Get category names, IDs for breadcrumbs (Controller)
namespace Item\Breadcrumbs;

class Process extends Model {

    protected function process() {
        // parent cat
        $cat = $this->privateQuery($this->catID);
        if ($cat) {
            $parID = $cat['parID'];
            $breadcrumbs = [];
            
            // ancester (grandparent) cat
            if ($parID > 0) {
                $ancester = $this->privateQuery($parID);
                $breadcrumbs[] = ['catName' => $ancester['catName'], 'catID' => $parID];
            }

            $breadcrumbs[] = ['catName' => $cat['catName'], 'catID' => $this->catID]; 
            return $breadcrumbs;
        } else {
            return null;
        }
    }

    private function privateQuery($catID) {
        return $this->query($catID);
    }
}
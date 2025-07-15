<?php

// Set Category Order
// for updating the parent or child category order
class SetCatOrder_Contr extends SetCatOrder_Model {
    public $pos = [];

    public function __construct($pos) {
        $this->pos = $pos;
    }

    public function contr_setCatOrder() {
        $valPos = $this->validatePos();

        foreach ($valPos as $key => $i) {
            $row = explode("=",$i);

            if ((is_numeric($row[0])) && (is_numeric($row[1]))) {
                $this->setCatOrder($row[0],$row[1]);
            }

            if ($key === array_key_last($valPos)) {
                header("location: " . pageURL(true,false));
                exit;
            }
        }
    }

    // model
    private function setCatOrder($pos, $catID) {
        $this->model_setCatOrder($pos, $catID);
    }

    // validate pos
    private function validatePos() {
        return array_map("htmlspecialchars", $this->pos);
    }
}
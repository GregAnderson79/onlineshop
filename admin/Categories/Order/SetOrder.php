<?php
// Set main or sub category Order (Controller)
namespace Categories\Order;

class SetOrder extends Model {
    public $pos = [];

    public function __construct($pos) {
        $this->pos = $pos;
    }

    public function updateOrder() {
        $valPos = $this->valPos();

        foreach ($valPos as $key => $i) {
            $row = explode("=",$i);

            if ((is_numeric($row[0])) && (is_numeric($row[1]))) {
                $this->setPos($row[0],$row[1]);
            }

            if ($key === array_key_last($valPos)) {
                header("location: " . pageURL(true,false));
                exit;
            }
        }
    }

    // model
    private function setPos($pos, $catID) {
        $this->query($pos, $catID);
    }

    // validate pos
    private function valPos() {
        return array_map("htmlspecialchars", $this->pos);
    }
}
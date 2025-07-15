<?

// Delete category
class DelCat_Contr extends SetCat_Model {
    public $catID;

    public function __construct($catID) {
        $this->catID = $catID;
    }

    public function contr_delCat() { 
        if ($this->delCat() === true) {
            header("location: " . pageURL(true,false));
            exit;
        } else {
            header("location: " . pageURL(true,true) . "error=0");
            exit;
        }
    }

    // model
    private function delCat() {
        return $this->model_delCat();
    }
}
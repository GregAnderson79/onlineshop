<?
// Set association between item and option (Controller)
namespace Options\Associations\Options\SetAssoc;

class Save extends Model {
    protected $itemID;
    protected $optID;
        
    public function __construct($itemID, $optID) {
        $this->itemID = $itemID;
        $this->optID = $optID;
    }

    public function process() {
        // validate IDs
        if ($this->validateIDs()) {
            header("location: " . pageURL(true,true) . "error=0");
            exit();
        }

        // to Model
        if ($this->privateQuery() === true) {
            header("location: " . pageURL(true,true) . "action=itemOpts&itemID=" . $this->itemID);
        } else {
            header("location: " . pageURL(true,true) . "error=0"); // error
            exit();
        }
    }

    // validate IDs
    private function validateIDs() {
        if ((!is_numeric($this->itemID)) || (!is_numeric($this->optID))) {
            return true;
        }
    }

    // model
    private function privateQuery() {
        return $this->query();
    }
}
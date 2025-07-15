<?php
// Get option values for column (View)
namespace Options\Values\Column;

class GetValues extends Process {
    public $optID;

    public function __construct($optID) {
        $this->optID = $optID;
    }

    public function createMenu() {
        $values = $this->process();
        if ($values) {
            $html = "";
            foreach ($values as $i) {
                $html .= "<li>\n";
                $html .= "<span>&raquo; " . $i['valName'] . "</span>\n";
                $html .= "<span class=\"column_li_opts\"><a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=editVal&optID=" . $this->optID . "&valID=" . $i['valID'] . "\">Edit</a>\n";
                $html .= "<a class=\"nav_red\" href=\"" . pageURL(true,true) . "action=delVal&optID=" . $this->optID . "&valID=" . $i['valID'] . "\" onclick=\"return confirm('Are you sure you want to delete this option value?')\">Delete</a>\n";
                $html .= "</span>\n";
                $html .= "</li>\n";
            }
            return $html;
        } else {
            return null;
        }
    }
}

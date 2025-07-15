<?php
// Get all admin account details (View)
namespace Admins\List;

class GetAdmins extends Process {

    public function createList() {
        $admins = $this->process();
        if ($admins) {
            echo "<ul>";
            foreach ($admins as $i) {
                echo "<li><span>" . $i['adminName'] . "</span><span class=\"column_li_opts\">";
                echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=editAdmin&adminID=" . $i['adminID'] . "\">Edit</a>";
                if (count($admins) <= 1) {
                    echo "<span class=\"red_disabled\">Delete</span>";
                } else {
                    echo "<a class=\"nav_red\" href=\"" . pageURL(true,true) . "action=delAdmin&adminID=" . $i['adminID'] . "\" onclick=\"return confirm('Are you sure you want to delete this admin account?')\">Delete</a>";             
                }
                echo "</span></li>";
            }
            echo "</ul>";
        } else {
            echo "No admin accounts";
        }
    }
}
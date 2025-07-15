<?php
use \Admins\List\GetAdmins;
use \Admins\GetAdmin\GetData;

// Admins add, edit forms, list admins
if ($action == "admins" || $action == "addAdmin" || $action == "editAdmin") {
    if ($action == "editAdmin") {
        if (isset($_GET['adminID'])) {
            $adminID = htmlspecialchars($_GET['adminID']);
            
            // get stored option details  
            $getAdmin = new GetData($adminID);
            $adminData = $getAdmin->returnAdmin();
                $adminName = $adminData['adminName'];
                $adminEmail = $adminData['adminEmail'];
                $adminPwd = $adminData['adminPwd'];

        } else {
            $error = 1;
            $disableBtn = true;
        }
        $popupTtl = "Edit admin account";
        $btnTxt = "Update";
    } else if ($action === "addAdmin") {
        $popupTtl = "Add admin account";
        $btnTxt = "Submit";
    } else {
        $popupTtl = "Admin accounts";
    }

?>
    <div class="popup_bg">
        <div class="popup_pnl">
            <div class="popup_close"><a href="<?php echo pageURL(true,false); ?>">&#10005;</a></div>
            <div class="popup_ttl"><?php echo $popupTtl; ?></div>
            <div class="popup_pad">
                <form method="post" action="<?php echo pageURL(false,false); ?>">
<?php
                // errors
                if ($error == 1) {
                    echo "<div class=\"error_msg\">Error: Admin account could not be found<span></span></div>";
                } else if ($error == 2) {
                    echo "<div class=\"error_msg\">Error: Enter a name<span></span></div>";
                } else if ($error == 3) {
                    echo "<div class=\"error_msg\">Error: Enter a valid email address<span></span></div>";
                } else if ($error == 4) {
                    echo "<div class=\"error_msg\">Error: The password must include at least 1 upper and lower case letter, number and special character<span></span></div>";
                } else if ($error == 5) {
                    echo "<div class=\"error_msg\">Error: Email address is already registered<span></span></div>";
                }

                if ($action == "editAdmin" || $action == "addAdmin") {

                    echo "<div class=\"popup_list\">";

                    // admin name
                    echo "<p><label for=\"adminName\">Admin name</label><span><input type=\"text\" name=\"adminName\" value=\"";
                    if (isset($_SESSION["adminName"])) {
                        echo $_SESSION["adminName"];
                        unset($_SESSION["adminName"]);
                    } else if (isset($adminName)) {
                        echo $adminName;
                    }
                    echo "\"></span></p>";

                    // email
                    echo "<p><label for=\"adminEmail\">Email</label><span><input type=\"text\" name=\"adminEmail\" value=\"";
                    if (isset($_SESSION["adminEmail"])) {
                        echo $_SESSION["adminEmail"];
                        unset($_SESSION["adminEmail"]);
                    } else if (isset($adminEmail)) {
                        echo $adminEmail;
                    }
                    echo "\"></span></p>";

                    // password
                    echo "<p><label for=\"adminPwd\">Password</label><span><input type=\"password\" name=\"adminPwd\" value=\"";
                    if (isset($_SESSION["adminPwd"])) {
                        echo $_SESSION["adminPwd"];
                        unset($_SESSION["adminPwd"]);
                    } else if (isset($adminPwd)) {
                        echo $adminPwd;
                    }
                    echo "\"></span></p>";

                    if (!isset($disableBtn) || !$disableBtn) {
                        echo "<p><button class=\"btn_blue\">" . $btnTxt . "</button></p>";
                    }
                    echo "</div></form>";

                } else {
                    echo "<div class=\"popup_opts\"><a class=\"nav_green\" href=\"" . pageURL(true,true) . "action=addAdmin\">Add admin account</a></div>";
                    $admins = new GetAdmins();
                    $admins->createList();
                }
?>
            </div>
        </div>
    </div>
<?php

    unset($adminID, $getAdmin, $adminData, $adminName, $adminEmail, $adminPwd, $error, $disableBtn, $popupTtl, $btnTxt);
}
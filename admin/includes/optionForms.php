<?php
use \Options\GetOption\GetData;

// Option add / edit form
if ($action == "addOpt" || $action == "editOpt") {
    if ($action == "editOpt") {
        if (isset($_GET['optID'])) {

            // get stored option details
            $optID = htmlspecialchars($_GET['optID']);
            $option = new GetData($optID);
            $optionData = $option->returnOption();
                $optName = $optionData['optName']; 

        } else {
            $error = 1;
            $disableBtn = true;
        }
        $popupTtl = "Edit option";
        $btnTxt = "Update";
    } else {
        $popupTtl = "Add option";
        $btnTxt = "Submit";
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
                    echo "<div class=\"error_msg\">Error: Option could not be found<span></span></div>";
                } else if ($error == 2) {
                    echo "<div class=\"error_msg\">Error: Enter an option name<span></span></div>";
                }

                // Option name
                echo "<p><label for=\"optName\">Option name</label><span><input type=\"text\" name=\"optName\" id=\"optName\" value=\"";
                if (isset($_SESSION["optName"])) {
                    echo $_SESSION["optName"];
                    unset($_SESSION["optName"]);
                } else if (isset($optName)) {
                    echo $optName;
                }
                echo "\"></span></p>";

                if (!isset($disableBtn) || !$disableBtn) {
                    echo "<p><button class=\"btn_blue\">" . $btnTxt . "</button></p>";
                }
?>
                </form>
            </div>
        </div>
    </div>
<?php
    unset($optID, $option, $optionData, $optName, $error, $disableBtn, $popupTtl, $btnTxt);
}
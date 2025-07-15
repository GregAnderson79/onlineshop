<?php
use \Options\Values\GetValue\GetData;

// Add / edit option value form
if ($action == "addVal" || $action == "editVal") {
    if (isset($_GET['optID'])) {
        $optID = htmlspecialchars($_GET['optID']);

        if ($action == "editVal") {
            if (isset($_GET['valID'])) {

                // get stored value details
                $valID = htmlspecialchars($_GET['valID']);
                $value = new GetData($valID);
                $valueData = $value->returnValue();
                    $valName = $valueData['valName'];

            } else {
                $error = 1;
                $disableBtn = true;
            }
        }

    } else {
        $error = 1;
    }

    if ($action == "editVal") {
        $popupTtl = "Edit option value";
        $btnTxt = "Update";
    } else {
        $popupTtl = "Add option value";
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
                    echo "<div class=\"error_msg\">Error: Option or option value could not be found<span></span></div>";
                } else if ($error == 2) {
                    echo "<div class=\"error_msg\">Error: Enter an option value name<span></span></div>";
                }

                // option value name
                echo "<p><label for=\"valName\">Option value name</label><span><input type=\"text\" name=\"valName\" value=\"";
                if (isset($_SESSION["valName"])) {
                    echo $_SESSION["valName"];
                    unset($_SESSION["valName"]);
                } else if (isset($valName)) {
                    echo $valName;
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
    unset($optID, $valID, $value, $valueData, $valName, $error, $disableBtn, $popupTtl, $btnTxt );
}
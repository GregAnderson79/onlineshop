<?php
use \PayPal\GetEmail\GetData;

// Manage PayPal email
if ($action == "addPayPalEmail" || $action == "editPayPalEmail") {

    $email = new GetData();
    $emailData = $email->returnEmail();
    if ($emailData) {
        $payPalEmail = $emailData[0]['payPalEmail'];
        $ppID = $emailData[0]['ppID'];
        $payPalEmailMsg = $payPalEmail;
    } else {
        $payPalEmailMsg = "not set";
    }
?>
    <div class="popup_bg">
        <div class="popup_pnl">
            <div class="popup_close"><a href="<?php echo pageURL(true,false); ?>">&#10005;</a></div>
            <div class="popup_ttl">Manage PayPal email</div>
            <div class="popup_pad">
                <form method="post" action="<?php echo pageURL(false,false); ?>">
                <input type="hidden" name="ppID" value="<?php echo $ppID; ?>">
    <?php
                echo "<p>PayPal email address is " . $payPalEmailMsg;
                if ($error == 1) {
                     echo "<div class=\"error_msg\">Error: Enter a valid email address</div>";
                }
                echo "<p><label for=\"payPalEmail\">Email address</label><span><input type=\"text\" name=\"payPalEmail\" value=\"";
                if (isset($_SESSION["payPalEmail"])) {
                    echo $_SESSION["payPalEmail"];
                    unset($_SESSION["payPalEmail"]);
                } else if (isset($payPalEmail)) {
                    echo $payPalEmail;
                }
                    echo "\"></span></p>";
    ?>
                <p><button class="btn_blue">Submit</button></p>
                </form>
            </div>
        </div>
    </div>
<?php
    unset($email, $emailData, $payPalEmail, $ppID, $payPalEmailMsg, $error);
}
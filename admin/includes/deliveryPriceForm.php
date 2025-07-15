<?php
use \Delivery\GetPrice\GetData;

// Manage delivery price
if ($action == "addDelPrice" || $action == "editDelPrice") {

    $delivery = new GetData();
    $delData = $delivery->returnPrice();
    if ($delData) {
        $delPrice = $delData[0]['delPrice'];
        $dpID = $delData[0]['dpID'];
        $delPriceMsg = "£" . $delPrice;
    } else {
        $delPriceMsg = "not set";
    }
?>
    <div class="popup_bg">
        <div class="popup_pnl">
            <div class="popup_close"><a href="<?php echo pageURL(true,false); ?>">&#10005;</a></div>
            <div class="popup_ttl">Manage delivery price</div>
            <div class="popup_pad">
                <form method="post" action="<?php echo pageURL(false,false); ?>">
                <input type="hidden" name="dpID" value="<?php echo $dpID; ?>">
<?php
                echo "<p>The price of delivery is " . $delPriceMsg;
                if ($error == 1) {
                    echo "<div class=\"error_msg\">Error: The delivery price must be a numerical value<span></span></div>";
                } else if ($error == 2) {
                    echo "<div class=\"error_msg\">Error: The delivery price must be correctly formatted (NN.NN or N.NN)<span></span></div>";
                }
                echo "<p><label for=\"delPrice\">Delivery price</label><span><input type=\"text\" name=\"delPrice\" value=\"";
                if (isset($_SESSION["delPrice"])) {
                    echo $_SESSION["delPrice"];
                    unset($_SESSION["delPrice"]);
                } else if (isset($delPrice)) {
                    echo $delPrice;
                }
                echo "\"></span></p>";
?>
                <p><button class="btn_blue">Submit</button></p>
            </form>
            </div>
        </div>
    </div>
<?php

    unset($delivery, $delData, $delPrice, $dpID, $delPriceMsg, $error);
}
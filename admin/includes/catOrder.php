<?php
// Category order form
use Categories\Order\GetOrder\Mains\GetOrder as Mains;
use Categories\Order\GetOrder\Subs\GetOrder as Subs;

if ($action == "orderCats") {
    if (isset($_GET['catID'])) {
        $catID = htmlspecialchars($_GET['catID']);
        $popupTtl = "Re-order sub categories";
    } else {
        $catID = null;
        $popupTtl = "Re-order main categories";
    }
?>

    <div class="popup_bg">
        <div class="popup_pnl">
            <div class="popup_close"><a href="<?php echo pageURL(true,false); ?>">&#10005;</a></div>
            <div class="popup_ttl"><?php echo $popupTtl; ?></div>
            <div class="popup_pad">
                <form method="post" action="<?php echo pageURL(false,false); ?>">
<?php
                if (isset($catID)) {
                    $cats = new Subs($catID);
                } else {
                    $cats = new Mains();
                }
                $cats->createForm();
?>
                <p><button class="btn_blue">Update order</button></p>
                </form>
            </div>
        </div>
    </div>
    
<?php
    unset($catID, $popupTtl, $cats);
}
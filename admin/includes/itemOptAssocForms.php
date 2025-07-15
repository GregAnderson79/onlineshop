<?php
use \Options\Associations\GetAssociations;

// Manage option associations and option value associations for each item
if ($action === "itemOpts") {
    $itemID = htmlspecialchars($_GET['itemID']) ?? 0;
?>
    <div class="popup_bg">
        <div class="popup_pnl">
            <div class="popup_close"><a href="<?php echo pageURL(true,false); ?>">&#10005;</a></div>
            <div class="popup_ttl">Item Options</div>
            <div class="popup_pad">
                <div class="popup_list">
                    <form method="post" action="<?php echo pageURL(true,true) . "action=setItemOpts"; ?>">
<?php
                    $options = new GetAssociations($itemID);
                    return $options->createList();
?>
                    <p><button>Submit</button></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    unset($itemID, $options);
}
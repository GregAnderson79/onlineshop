 <?php
 use \Items\Item\Images\List\GetImages;
 
 // Manage item images
if ($action === "itemImgList") {
    if (isset($_GET['itemID'])) {
        $itemID = htmlspecialchars($_GET['itemID']);
    } else {
        $error = 1;
    }
?>
    <div class="popup_bg">
        <div class="popup_pnl">
            <div class="popup_close"><a href="<?php echo pageURL(true,false); ?>">&#10005;</a></div>
            <div class="popup_ttl">Item images</div>
            <div class="popup_pad">
                <form enctype="multipart/form-data" action="<?php echo pageURL(true,true) . "action=uplItemImg&itemID=" . $itemID; ?>" method="post">
<?php
                if ($error == 1) {
                    echo "<div class=\"error_msg\">Error: Item not found<span></span></div>";
                } else if ($error == 2) {
                    echo "<div class=\"error_msg\">Error: The file size is too large<span></span></div>";
                } else if ($error == 3) {
                    echo "<div class=\"error_msg\">Error: The file type is not permitted<span></span></div>";
                }

                echo "<div class=\"popup_form\">";
?>
                    <p><label for="image">Upload image</label><span><input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.gif,.webp"></span></p>
                    <p><label for="altTag">Alt tag</label><span><input type="text" name="altTag" id="altTag" value=""></span></p>
                    <p><label for="caption">Caption</label><span><input type="text" name="caption" id="caption" value=""></span></p>
                    <p><button class="btn_blue">Submit</button></p>
                    </form>
                </div>
                <div class="popup_gallery">
<?php
                    if (isset($itemID)) {
                        $imgs = new GetImages($itemID);
                        return $imgs->createList();
                    }
?>
                </div>
            </div>
        </div>
    </div>
<?php
    unset($itemID, $error, $imgs);
}
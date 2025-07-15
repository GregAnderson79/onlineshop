<?php
// Add / edit item form
use \Categories\Lists\Selectors\All\GetCategories;
use \Items\Item\GetItem\GetData;

if ($action == "addItem" || $action == "editItem") {
    if ($action === "editItem") {
        if (isset($_GET['itemID'])) {
            $itemID = htmlspecialchars($_GET['itemID']);
            $item = new GetData($itemID);
            $itemData = $item->itemData();
                $itemName = $itemData['itemName'];
                $catID = $itemData['catID'];
                $itemPrice = $itemData['itemPrice'];
                $itemStatus = $itemData['itemStatus'];
                $itemStock = $itemData['itemStock'];
                $itemDesc1 = $itemData['itemDesc1'];
                $itemDesc2 = $itemData['itemDesc2'];
                $itemDesc3 = $itemData['itemDesc3'];
        } else {
            $error = 1;
            $disableBtn = true;
        }
        $popupTtl = "Edit item";
        $btnTxt = "Update";
    } else {
        if (isset($_GET['catID'])) {
            $catID = htmlspecialchars($_GET['catID']);
        } else {
            $error = 1;
            $disableBtn = true;
        }       
        $popupTtl = "Add item";
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
                    echo "<div class=\"error_msg\">Error: Item or category details could not be found<span></span></div>";
                } else if ($error == 2) {
                    echo "<div class=\"error_msg\">Error: Enter an item name<span></span></div>";
                } else if ($error == 3) {
                    echo "<div class=\"error_msg\">Error: The item price must be a numerical value<span></span></div>";
                } else if ($error == 4) {
                    echo "<div class=\"error_msg\">Error: The item price must be correctly formatted (NN.NN or N.NN)<span></span></div>";
                } else if ($error == 5) {
                    echo "<div class=\"error_msg\">Error: The item stock must be a numerical value<span></span></div>";
                }

                // item name
                echo "<p><label for=\"itemName\">Item name</label><span><input type=\"text\" name=\"itemName\" id=\"itemName\" value=\"";
                if (isset($_SESSION["itemName"])) {
                    echo $_SESSION["itemName"];
                    unset($_SESSION["itemName"]);
                } else if (isset($itemName)) {
                    echo $itemName;
                }
                echo "\"></span></p>";

                // category
                echo "<p><label for=\"catID\">Category</label><span><select name=\"catID\" id=\"catID\">";
                if (isset($_SESSION["catID"])) {
                    $menu = new GetCategories($_SESSION["catID"]);
                    unset($_SESSION["catID"]);
                } else if (isset($catID)) {
                    $menu = new GetCategories($catID);
                } else {
                    $menu = new GetCategories(null);
                }

                $menu->createMenu();
                echo "</select></span></p>";                

                // item price
                echo "<p><label for=\"itemPrice\">Item price</label><span><input type=\"text\" name=\"itemPrice\" id=\"itemPrice\"  style=\"width:70px\" value=\"";
                if (isset($_SESSION["itemPrice"])) {
                    echo $_SESSION["itemPrice"];
                    unset($_SESSION["itemPrice"]);
                } else if (isset($itemPrice)) {
                    echo $itemPrice;
                }
                echo "\"></span></p>";

                // Status
                echo "<p><label for=\"itemStatus\">Item status</label><span><select name=\"itemStatus\" id=\"itemStatus\">";
                echo "<option value=\"active\"";
                if (isset($_SESSION["itemStatus"])) {
                    if ($_SESSION["itemStatus"] == "active") {
                        echo " SELECTED";
                        unset($_SESSION["itemStatus"]);
                    }
                } else if (isset($itemStatus)) {
                    if ($itemStatus == "active") {
                        echo " SELECTED";
                    }
                }
                echo "/>Active</option>";
                echo "<option value=\"hidden\"";
                if (isset($_SESSION["itemStatus"])) {
                    if ($_SESSION["itemStatus"] == "hidden") {
                        echo " SELECTED";
                        unset($_SESSION["itemStatus"]);
                    }
                } else if (isset($itemStatus)) {
                    if ($itemStatus == "hidden") {
                        echo " SELECTED";
                    }
                }
                echo "/>Hidden</option>";
                echo "</select></span></p>";

                // stock
                echo "<p><label for=\"itemStock\">Stock</label><span><input type=\"text\" name=\"itemStock\" id=\"itemStock\"  style=\"width:70px\" value=\"";
                if (isset($_SESSION["itemStock"])) {
                    echo $_SESSION["itemStock"];
                    unset($_SESSION["itemStock"]);
                } else if (isset($itemStock)) {
                    echo $itemStock;
                }
                echo "\"></span></p>";

                // main description
                echo "<p><label for=\"itemDesc1\" class=\"cat_desc_lbl\">Main description</label><span><textarea name=\"itemDesc1\" id=\"itemDesc1\">";
                if (isset($_SESSION["itemDesc1"])) {
                    echo $_SESSION["itemDesc1"];
                    unset($_SESSION["itemDesc1"]);
                } else if (isset($itemDesc1)) {
                    echo $itemDesc1;
                }
                echo "</textarea></span></p>";

                // second description
                echo "<p><label for=\"itemDesc2\" class=\"cat_desc_lbl\">Second description</label><span><textarea name=\"itemDesc2\" id=\"itemDesc2\" style=\"height:100px\">";
                if (isset($_SESSION["itemDesc2"])) {
                    echo $_SESSION["itemDesc2"];
                    unset($_SESSION["itemDesc2"]);
                } else if (isset($itemDesc2)) {
                    echo $itemDesc2;
                }
                echo "</textarea></span></p>";

                // third description
                echo "<p><label for=\"itemDesc3\" class=\"cat_desc_lbl\">Third description</label><span><textarea name=\"itemDesc3\" id=\"itemDesc3\" style=\"height:100px\">";
                if (isset($_SESSION["itemDesc3"])) {
                    echo $_SESSION["itemDesc3"];
                    unset($_SESSION["itemDesc3"]);
                } else if (isset($itemDesc3)) {
                    echo $itemDesc3;
                }
                echo "</textarea></span></p>";

                if (!isset($disableBtn) || !$disableBtn) {
                    echo "<p><button class=\"btn_blue\">" . $btnTxt . "</button></p>";
                }
?>
                </form>
            </div>
        </div>
    </div>
<?php
    unset($itemID, $item, $itemData, $itemName, $catID, $itemPrice, $itemStatus, $itemStock, $itemDesc1, $itemDesc2, $itemDesc3, $error, $disableBtn, $popupTtl, $btnTxt, $menu);
}
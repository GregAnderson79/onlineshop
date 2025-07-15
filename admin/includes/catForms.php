<?php
// Add or edit category forms
use \Categories\Lists\Selectors\Mains\GetCategories;
use \Categories\GetCategory\GetData;

if ($action == "addCat" || $action == "editCat") {
    if (isset($_GET['catID'])) {
        $catID = htmlspecialchars($_GET['catID']);
    }

    if ($action == "editCat") {
        if (isset($catID)) {
            $cat = new GetData($catID);
            $catData = $cat->categoryData();
                $catName = $catData['catName'];
                $parID = $catData['parID'];
                $catStatus = $catData['catStatus'];
                $catDesc = $catData['catDesc'];

        } else {
            $error = 0;
        }
        $popupTtl = "Edit category";
        $btnTxt = "Update";
    } else {
        if (isset($catID)) {
            $parID = $catID;
        } else {
            $parID = null;
        }
        $popupTtl = "Add category";
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
                    echo "<div class=\"error_msg\">Error: Category details could not be found<span></span></div>\n";
                } else if ($error == 2) {
                    echo "<div class=\"error_msg\">Error: Enter a name for this category<span></span></div>\n";
                } else if ($error == 3) {
                    echo "<div class=\"error_msg\">Error: The category cannot be put inside itself<span></span></div>\n";
                }

                // category name
                echo "<p><label for=\"catName\">Category name</label><span><input type=\"text\" name=\"catName\" id=\"catName\" value=\"";
                if (isset($_SESSION["catName"])) {
                    echo $_SESSION["catName"];
                    unset($_SESSION["catName"]);
                } else if (isset($catName)) {
                    echo $catName;
                }
                echo "\"></span></p>\n";

                // Main / sub category
                echo "<p><label for=\"parID\">Parent main category</label><span><select name=\"parID\" id=\"parID\">\n";
                echo "<option value=\"0\"";
                if (isset($_SESSION["parID"])) {
                    if ($_SESSION["parID"] == 0) {
                        echo " SELECTED";
                        unset($_SESSION["parID"]);
                    }
                } else if (isset($parID)) {
                    if ($parID == 0) {
                        echo " SELECTED";
                    }
                }
                echo "/>No parent (new top level category)</option>\n";

                // Main select menu
                $menu = new GetCategories($parID, $catID);
                $menu->createMenu();

                echo "</select></span></p>\n";

                // category status
                echo "<p><label for=\"catStatus\">Category status</label><span><select name=\"catStatus\" id=\"catStatus\">";
                echo "<option value=\"active\"";
                if (isset($_SESSION["catStatus"])) {
                    if ($_SESSION["catStatus"] == "active") {
                        echo " SELECTED";
                        unset($_SESSION["catStatus"]);
                    }
                } else if (isset($catStatus)) {
                    if ($catStatus == "active") {
                        echo " SELECTED";
                    }
                }
                echo "/>Active</option>";
                echo "<option value=\"hidden\"";
                if (isset($_SESSION["catStatus"])) {
                    if ($_SESSION["catStatus"] == "hidden") {
                        echo " SELECTED";
                        unset($_SESSION["catStatus"]);
                    }
                } else if (isset($catStatus)) {
                    if ($catStatus == "hidden") {
                        echo " SELECTED";
                    }
                }
                echo "/>Hidden</option>";
                echo "</select></span></p>";

                // category description
                echo "<p><label class=\"cat_desc_lbl\" for=\"catDesc\">Category<br>description</label><span><textarea name=\"catDesc\" id=\"catDesc\">";
                if (isset($_SESSION["catDesc"])) {
                    echo $_SESSION["catDesc"];
                    unset($_SESSION["catDesc"]);
                } else if (isset($catDesc)) {
                    echo $catDesc;
                }
                echo "</textarea></span></p>";

                echo "<p><button class=\"btn_blue\">" . $btnTxt . "</button></p>";
?>
                </form>
            </div>
        </div>
    </div>
<?php

    unset($catID, $cat, $catData, $catName, $parID, $catStatus, $catDesc, $error, $popupTtl, $btnTxt, $parID);
}
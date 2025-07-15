<?php
// Column 2 - sub categories
use Categories\Title\GetName;
use Categories\RowCounts\Subs\GetRowCount;
use Categories\Lists\Columns\Subs\GetCategories;

// Split querystring main:sub / num:num
$openID = htmlspecialchars($_GET["open"]);
if (strpos($openID,":")) {
    $openArr = explode(":",$openID);
    if (count($openArr) === 2) {
        $mainID = $openArr[0];
    }
} else {
    $mainID = $openID;
}

// Category title / name
if (isset($mainID)) {
    $name = new GetName($mainID);
    $title = $name->categoryName();
}
?>
    <div class="column_ttl_light">
        <span class="column_hdr_arrow">&#10140;</span> Sub-categories<?php if (isset($title)) {echo $title;} ?>
    </div>
    <div class="column_opts">
<?php
        // < 1 categories, allow ordering
        $rows = new GetRowCount($mainID);
        if ($rows->rowCount() > 1) {
            echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=orderCats&catID=" . $openID . "\">Re-order categories</a>";
        } else {
            echo "<span class=\"grey_disabled\">Re-order categories</span>";
        }
?>
        <a class="nav_green" href="<?php echo pageURL(true,true) . "action=addCat&catID=" . $openID; ?>">Add category</a>
    </div>
    <div class="column_list">
<?php
        if (isset($mainID)) {
            $cats = new GetCategories($mainID);
            $cats->createMenu();

            unset($mainID, $cats);
        }

        unset($openID, $openArr, $name, $title, $rows);
?>
    </div>





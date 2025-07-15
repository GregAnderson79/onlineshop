<?php
// Items column
use Categories\Title\GetName;
use Items\Column\GetItems;

// Split querystring main:sub / num:num
$openID = htmlspecialchars($_GET["open"]);
if (strpos($openID,":")) {
    $openArr = explode(":",$openID);
    if (count($openArr) === 2) {
        $catID = $openArr[1];
    }
} else {
    $catID = $openID;
}

// Category title / name
if (isset($catID)) {
    $name = new GetName($catID);
    $title = $name->categoryName();
}
?>

<div class="column_ttl_lighter">
    <span class="column_hdr_arrow">&#10140;</span> Items<?php if (isset($title)) {echo $title;} ?>
</div>
<div class="column_opts align_right">
    <a class="nav_green" href="<?php echo pageURL(false,true) . "action=addItem&catID=" . $catID; ?>">Add item</a>
</div>
<div class="column_list">

<?php
    // item lists
    if (isset($catID)) {
        $items = new GetItems($catID);
        $items->createMenu();

        unset($catID, $items);
    }

    unset($openArr, $openID, $name, $title);
?>

</div>
<?php
// Column 1 - main categories
use Categories\RowCounts\Mains\GetRowCount;
use Categories\Lists\Columns\Mains\GetCategories;

?>

<div class="column_ttl column_ttl_dark">Main categories</div>
<div class="column_opts">

<?php
    // < 1 categories, allow ordering
    $rows = new GetRowCount();
    if ($rows->rowCount() > 1) {
        echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=orderCats\">Re-order categories</a>\n";
    } else {
        echo "<span class=\"grey_disabled\">Re-order categories</span>\n";
    }
?>

    <a href="<?php echo pageURL(true,true) ?>action=addCat" class="nav_green">Add category</a>
</div>
<div class="column_list">

<?php
    $cats = new GetCategories();
    $cats->createMenu();

    unset($rows, $cats);
?>

</div>

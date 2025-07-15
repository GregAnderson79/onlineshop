<?php
// Mobile Nav
use Categories\RowCounts\Mains\GetRowCount as NumMains;
use Categories\Lists\MobileNav\Mains\GetCategories;

?>

<div class="mob_nav mn_closed">
    <div class="mob_nav_hdr">
<?php
        // < 1 categories, allow ordering
        $rows = new NumMains();
        if ($rows->rowCount() > 1) {
            echo "<a class=\"nav_grey\" href=\"" . pageURL(true,true) . "action=orderCats\">Re-order categories</a>";
        } else {
             echo "<span class=\"grey_disabled\">Re-order categories</span>";
        }

        unset($rows);
?>
        <a href="<?php echo pageURL(true,true) ?>action=addCat" class="nav_green">Add category</a>
        <a href="javascript:CLOSE_MN()" class="mob_nav_close" aria-label="Close mobile main category > sub category navigation">&#10005;</a>
    </div>
    <div class="mob_nav_scr">
        <nav>
<?php
        // Category lists
        $cats = new GetCategories();
        $cats->createMenu();

        unset($cats);
?>
        </nav>
        <div class="mob_nav_management">
            <ul>
            <li><a href="<?php echo pageURL(true,true); ?>action=orders">Manage orders</a></li>
            <li><a href="<?php echo pageURL(true,true); ?>action=admins">Manage admin accounts</a></li>
            <li><a href="<?php echo pageURL(true,true); ?>action=editPayPalEmail">Manage PayPal email</a></li>
            <li><a href="<?php echo pageURL(true,true); ?>action=editDelPrice">Manage delivery price</a></li>
            </ul>
        </div>
    </div>
</div>
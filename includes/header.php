<!-- Page header -->
<header>
    <a href="javascript:OPEN_MN()" class="hdr_mob_nav" aria-label="Open mobile main category > sub category navigation">
        <span></span><span></span><span></span>
    </a>
    <div class="hdr_title"><a href="/shop/">Shop Front</a></div>
    <div class="hdr_cart">
<?php
        echo "<span aria-label=\"Shopping cart quantity\">\n";
        if (isset($_SESSION["cartQty"])) {
            echo "<a href=\"cart.php\" aria-label=\"Go to shopping cart\">" . $_SESSION["cartQty"] . "</a>";
        } else {
            echo "0";
        }
        echo "</span>\n";
        echo "<span aria-label=\"Shopping cart total\">\n";
        if (isset($_SESSION["cartTotal"])) {
            $total = $_SESSION["cartTotal"];
            echo "<a href=\"cart.php\" aria-label=\"Go to shopping cart\">£" . number_format($total, 2) . "</a>";
            unset($total);
        } else {
            echo "£0.00";
        }
        echo "</span>\n";
?>
    </div>
</header>
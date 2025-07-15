<?php

// mobile Navigation
use Categories\Navs\Mobile\GetCategories as MobileNav;

?>

<div class="mob_nav mn_closed">
    <div class="mob_nav_hdr">
        <a href="javascript:CLOSE_MN()" class="mob_nav_close" aria-label="Close mobile main category > sub category navigation">&#10005;</a>
    </div>
    <div class="mob_nav_scr">
        <nav>
            <ul>
            <li><a href="/shop/">Home</a></li>
<?php
            // Category lists
            $cats = new MobileNav();
            $cats->createMenu();
            unset($cats);
?>
            </ul>
        </nav>
    </div>
</div>
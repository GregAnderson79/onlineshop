<?php

// desktop Navigation
use Categories\Navs\Desktop\GetCategories as DesktopNav;

?>

<div class="dkt_nav">
    <nav>
        <ul>
        <li><a href="/shop/">Home</a></li>
<?php
        // Category lists
        $cats = new DesktopNav();
        $cats->createMenu();
        unset($cats);
?>
        </ul>
    </nav>
</div>
<?php
// Options column
use Options\Column\GetOptions;
?>

<div class="column_ttl column_ttl_dark">Item options</div>
<div class="column_opts align_right">
    <a class="nav_green" href="<?php echo pageURL(true,true); ?>action=addOpt">Add option</a>
</div>
<div class="column_list">

<?php
    $options = new GetOptions();
    $options->createMenu();

    unset($options);
?>

</div>


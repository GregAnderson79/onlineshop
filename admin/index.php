<?php

// error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// session
session_start();

// get errors
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET["error"]);
} else {
    $error = null;
}

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Shop Admin</title>
<link href="styles.css" rel="stylesheet">
<script language="JavaScript" SRC="scripts.js"></script>
</head>
<body>

<header>
    <div class="hdr_title"><a href="menu.php">Shop Admin</a></div>
</header>

<main>
    <div class="popup_bg">
        <div class="popup_pnl">
            <div class="popup_ttl">Login</div>
            <div class="popup_pad">
<?php
                // errors
                if ($error == 1) {
                    echo "<div class=\"error_msg\">Error: Enter a valid email address<span></span></div>\n";
                } else if ($error == 2) {
                    echo "<div class=\"error_msg\">Error: The password must include at least 1 upper and lower case letter, number and special character<span></span></div>\n";
                } else if ($error == 3) {
                    echo "<div class=\"error_msg\">Error: Login details not recognised<span></span></div>\n";
                }
?>
                <form method="post" action="login.php">
<?php
                echo "<p><label for=\"adminEmail\">Email</label><span><input type=\"text\" name=\"adminEmail\" id=\"adminEmail\" value=\"";
                if (isset($_SESSION["adminEmail"])) {
                    echo $_SESSION["adminEmail"];
                    unset($_SESSION["adminEmail"]);
                }
                echo "\"></span></p>\n";
?>
                <p><label for="password">Password</label><span><input type="password" name="adminPwd" id="password" value=""></span></p>
                <p><button class="btn_blue">Login</button></p>
                </form>
            </div>
        </div>
    </div>
</main>

</body>
</html>

<?php
unset($error);
?>








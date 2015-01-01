<?php
//create WO and maintenance plans
require("header.php");
require("db.php");
?>

<?php
$woid = $_GET['woid'];
if (isset($_GET['p'])) $p = "daily";
else $p = "x";
$loggeduser = $_SESSION['valid_user'];
//if it is, enter_form() will assign the order to the guy that opens the order.
enter_form("edit", $woid, $p, $loggeduser);
?>

<?php
require ("footer.php");
?>

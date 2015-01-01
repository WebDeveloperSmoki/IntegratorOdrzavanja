<?php
//create WO and maintenance plans
require("header.php");
require("db.php");
?>

<?php
$op = $_GET['op'];
if ($op == "wo") enter_form("wo", 0, 0, 0);
if ($op == "mp") enter_form("mp", 0, 0, 0);
?>

<?php
require ("footer.php");
?>

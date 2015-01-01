<?php
//user profile page. Shows all user related settings.
//informs what level the users are
//allows user to change password
require("header.php");
require("db.php");
if (!isset($_SESSION["valid_user"]))
        {
        echo "<P>Sorry, no direct access!";
        }
else{
$username = $_SESSION["valid_user"];
echo "<H1>$username's Profile and Site Configuration Options</H1>";

$query = "SELECT * FROM users WHERE username = \"$username\"";
$r = mysql_query ($query);
$dptid = mysql_result($r,0,"dptid");

$query2 = "SELECT * FROM lv1 WHERE lv1id = \"$dptid\"";
$r2 = mysql_query($query2);
$dpt = mysql_result($r2,0,"lv1description");

$email = mysql_result($r,0,"useremail");

$level = "basic 1 ";
$aux = mysql_result($r,0,"is_site_admin");
if ($aux == "Y") $level .= "site_admin | ";

$aux = mysql_result($r,0,"is_plant_admin");
if ($aux == "Y") $level .= "plant_admin | ";

$aux = mysql_result($r,0,"is_dpt_admin");
if ($aux == "Y") $level .= "dpt_admin | ";

$aux = mysql_result($r,0,"is_system_admin");
if ($aux == "Y") $level .= "system_admin ";

echo "<B>Department: </B> $dpt<BR />";
echo "<B>Email: </B> $email<BR />";
echo "<B>Level(s): </B> $level<BR />";
echo "<BR />";

$aux = mysql_result($r,0,"receiveemails");
if ($aux == "Y") $rcvemails = "YES";
else $rcvemails = "NO";

echo "<B>Receive System Emails: </B>$rcvemails<BR />";

$aux = mysql_result($r,0,"receivessreports");
if ($aux == "Y") $rcvsreports = "YES";
else $rcvsreports = "NO";

echo "<B>Receive Show Reports: </B>$rcvsreports<BR />";

$aux = mysql_result($r,0,"does_orders");
if ($aux == "Y") $doesorders = "YES";
else $doesorders = "NO";

echo "<B>Does Maintenance Orders: </B>$doesorders<BR />";

echo "<BR />";
echo "<B>Old Password: </B><BR />";
echo "<B>Repeat Old Password: </B><BR />";
echo "<B>New Password: </B><BR />";
echo "<BR />";
echo "<B>Current main admin is: </B><BR />";
//if admin user:
echo "<B>if main admin</B><BR />";
echo "<B>Change main admin: </B><BR />";
echo "<B>Set external emails that can receive show reports:</B><BR />";

require("footer.php");
}
?>

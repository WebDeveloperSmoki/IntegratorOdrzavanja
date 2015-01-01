<?php
//show reports read and write.
require("header.php");
require("db.php");

$option = $_GET['op'];
$username = $_SESSION['valid_user'];

if ($option == "new"){
//enter new report
$date = time();
echo "<form method=\"post\" action=\"createsreport.php\" name=\"wocreation\">
  <table style=\"text-align: left; width: 100%;\" border=\"0\"
 cellpadding=\"2\" cellspacing=\"2\">
    <tbody>
      <tr>
        <td><big style=\"font-weight: bold;\"><big>";
        
        //send username
        echo "<input type = \"hidden\" value =\"$username\" name =\"show1user\">";
        
        //get user's Department:
        $query = "SELECT * FROM users WHERE username = \"$username\"";
        $result = mysql_query ($query) or die ("sreports error 101");
        $userdpt = mysql_result($result,0,'dptid');
        
        $query = "SELECT * FROM userdpt WHERE dptid = \"$userdpt\"";
        $result = $result = mysql_query ($query) or die ("sreports error 102");
        $entrydpt = mysql_result($result,0,'dptdescription');
        
        echo "$entrydpt ";
        
        //send entrydpt
        echo "<input type = \"hidden\" value =\"$entrydpt\" name =\"entrydpt\">";
        
echo" Show
Report(s) for ";
echo date('l\, jS \of F Y');

$entrydate = time();
echo "<input type = \"hidden\" value =\"$entrydate\" name =\"entrydate\">";

echo "</big></big>
<BR><B>NOTE:</B> Fill in only show 1 data fields if there was only one show today.
Fill in both areas in case today is a 2-show day. Double check your data - once you click submit,
you will no longer be able to edit the information!
        </td>
      </tr>
    </tbody>
  </table>
  <br /><table style=\"text-align: left; width: 100%;\" border=\"0\"
 cellpadding=\"2\" cellspacing=\"2\">
    <tbody>
      <tr>
        <td>
        <B>Show 1 Report General Info:</B><BR />Confirm
Show Number: <input size=\"5\" name=\"show1number\" value =\"";

//get the last db entry if any
$query = "SELECT * FROM showreports ORDER BY entrydate DESC LIMIT 1";
$result = mysql_query($query);
if (mysql_num_rows($result) == 0) echo "0";
else {
    //extract show1number if no show2 or extract show2number
    $previous_show1number = mysql_result($result,0,'show1number');
    $previous_show2number = mysql_result($result,0,'show2number');
    //add +1
    if ($previous_show2number > $previous_show1number) $show1number = $previous_show2number + 1;
    else $show1number = $previous_show1number + 1;
}
echo "$show1number\" onKeyPress=\"return numbersonly(this, event)\">";

echo "<input type = \"hidden\" value =\"$show1number\" name =\"show1number\">";

echo"<br>
Show Report by: ";

echo "$username";

echo "<BR>This was a clean $entrydpt show (operation): ";
echo "<input type=\"radio\" name=\"show1clean\" value=\"Y\" checked> Yes 
<input type=\"radio\" name=\"show1clean\" value=\"N\"> No";

echo "<BR>This was a clean $entrydpt show (equipment): ";
echo "<input type=\"radio\" name=\"show1equipclean\" value=\"Y\" checked> Yes 
<input type=\"radio\" name=\"show1equipclean\" value=\"N\"> No<br>";

echo "If equipment fault, please indicate major fault 1: ";
echo "<select name = show_1_problem_equip_1>";
echo "<option>none</option>";
list_restricted_table_entries("lv2","<option>","</option>", 1, -1,"lv2description !=\"NA\" ORDER BY lv2description ASC");
echo "</select><BR>";

echo "If equipment fault, please indicate major fault 2: ";
echo "<select name = show_1_problem_equip_2>";
echo "<option>none</option>";
list_restricted_table_entries("lv2","<option>","</option>", 1, -1,"lv2description !=\"NA\" ORDER BY lv2description ASC");
echo "</select><BR>";

echo"<B><BR />Show 1 Operators:</B><BR />
L2 Aerial: <select name = show1aerial>";

list_restricted_table_entries("users","<option>","</option>", 1, -1,"dptid = $userdpt ORDER BY username ASC");

echo "</select>";
echo "<br>
L4 Loading:";

echo " <select name = show1l4loading>";

list_restricted_table_entries("users","<option>","</option>", 1, -1,"dptid = $userdpt ORDER BY username ASC");

echo "</select>";

echo"<br>
L4 Scenic:";

echo " <select name = show1l4scenic>";

list_restricted_table_entries("users","<option>","</option>", 1, -1,"dptid = $userdpt ORDER BY username ASC");

echo "</select>";

echo "<br>
L6 Loading:";

echo " <select name = show1l6loading>";

list_restricted_table_entries("users","<option>","</option>", 1, -1,"dptid = $userdpt ORDER BY username ASC");

echo "</select>";

echo"<br>
Lift Operator:";

echo " <select name = show1liftop>";

list_restricted_table_entries("users","<option>","</option>", 1, -1,"dptid = $userdpt ORDER BY username ASC");

echo "</select>";

echo"<br>
Rover:";

echo " <select name = show1rover>";

list_restricted_table_entries("users","<option>","</option>", 1, -1,"dptid = $userdpt ORDER BY username ASC");

echo "</select>";

echo"<BR /><BR /><B>Show 1 Report: </B><BR />
        <textarea cols=\"60\" rows=\"20\" name=\"show1report\"></textarea>
        </td>
        <td>
        
        <B>Show 2 Report General Info</B><BR />Confirm
Show Number: ";

$show2number = $show1number+1;

echo "<input size=\"5\" name=\"show2number\" value =\"$show2number\" ";
echo "onKeyPress=\"return numbersonly(this, event)\">";

echo "<br>
Show Report by: ";

echo $username;

echo "<input type = \"hidden\" name = \"show2user\" value =\"$username\">";

echo "<BR>This was a clean $entrydpt show (operation): ";
echo "<input type=\"radio\" name=\"show2clean\" value=\"Y\" checked> Yes 
<input type=\"radio\" name=\"show2clean\" value=\"N\"> No";

echo "<BR>This was a clean $entrydpt show (equipment): ";
echo "<input type=\"radio\" name=\"show2equipclean\" value=\"Y\" checked> Yes 
<input type=\"radio\" name=\"show2equipclean\" value=\"N\"> No<br>";

echo "If equipment fault, please indicate major fault 1: ";
echo "<select name = show_2_problem_equip_1>";
echo "<option>none</option>";
list_restricted_table_entries("lv2","<option>","</option>", 1, -1,"lv2description !=\"NA\" ORDER BY lv2description ASC");
echo "</select><BR>";

echo "If equipment fault, please indicate major fault 2: ";
echo "<select name = show_2_problem_equip_2>";
echo "<option>none</option>";
list_restricted_table_entries("lv2","<option>","</option>", 1, -1,"lv2description !=\"NA\" ORDER BY lv2description ASC");
echo "</select><BR>";

echo"<BR /><B> Show 2 Operators: </B><BR />
L2 Aerial:";
echo " <select name = show2aerial>";

list_restricted_table_entries("users","<option>","</option>", 1, -1,"dptid = $userdpt ORDER BY username ASC");

echo "</select>";
echo"<br>
L4 Loading: ";
echo " <select name = show2l4loading>";

list_restricted_table_entries("users","<option>","</option>", 1, -1,"dptid = $userdpt ORDER BY username ASC");

echo "</select>";
echo"<br>
L4 Scenic: ";
echo " <select name = show2l4scenic>";

list_restricted_table_entries("users","<option>","</option>", 1, -1,"dptid = $userdpt ORDER BY username ASC");

echo "</select>";
echo"<br>
L6 Loading: ";

echo " <select name = show2l6loading>";

list_restricted_table_entries("users","<option>","</option>", 1, -1,"dptid = $userdpt ORDER BY username ASC");

echo "</select>";

echo"<br>
Lift Operator: ";

echo " <select name = show2liftop>";

list_restricted_table_entries("users","<option>","</option>", 1, -1,"dptid = $userdpt ORDER BY username ASC");

echo "</select>";

echo "<br>
Rover: ";

echo " <select name = show2rover>";

list_restricted_table_entries("users","<option>","</option>", 1, -1,"dptid = $userdpt ORDER BY username ASC");

echo "</select>";

echo"<BR /><BR /><B>Show 2 Report: </B><BR /><textarea
 cols=\"60\" rows=\"20\" name=\"show2report\"></textarea>
        </td>
      </tr>
    </tbody>
  </table>
  <B>Rehearsal Report: </B><BR />
  <table style=\"text-align: left; width: 100%;\" border=\"0\"
 cellpadding=\"2\" cellspacing=\"2\">
    <tbody>
      <tr>
        <td><center><textarea cols=\"120\" rows=\"20\" name=\"rehearsalreport\"></textarea></center></td>
      </tr>
    </tbody>
  </table>
  
  <B>Fast Links</b>
  <table style=\"text-align: left; width: 100%;\" border=\"0\"
 cellpadding=\"2\" cellspacing=\"2\">
    <tbody>
      <tr>
        <td><a href=\"createwomp.php?op=wo\" target=\"_ablank\">Create
WO</a></td>
      </tr>
    </tbody>
  </table>

  <input type=\"submit\">
</form>";

}
else if ($option == "read") {
//read previous locked reports
//receives show1number that we want to read. Shows the same form as to input data but with text only fields
//for both show 1 and show 2, even if there was no show2 on that day.
$show1number = $_GET['s'];
$query = "SELECT * FROM showreports WHERE show1number = $show1number";
$result = mysql_query ($query) or die ("No such show number. Error.");

//SHOW SHOW REPORTS:
//****************************

echo "<table style=\"text-align: left; \" border=\"0\"
 cellpadding=\"2\" cellspacing=\"2\">
  <tbody>
    <tr>
      <td><big style=\"font-weight: bold;\"><big>Automation&nbsp;Show
Report(s) for ";

$entrydate = mysql_result($result,0,'entrydate');
echo date('l\, jS \of F Y', $entrydate);

echo" </big></big>
      <b><br>
      </b></td>
    </tr>
  </tbody>
</table>
<table style=\"text-align: left; \" width = \"100%\" border=\"0\"
 cellpadding=\"2\" cellspacing=\"2\">
  <tbody>
    <tr>
      <td width =\"50%\" valign = \"top\">
      <B>Show 1 Report General Info</B><BR />
Show Number: ";

$show1number = mysql_result($result,0,'show1number');
echo "$show1number";

echo "<br>
Show Report by: ";

$show1user = mysql_result($result,0,'show1user');
echo "$show1user";

echo"<br>
This was a clean Automation show (operation): ";

$show1clean = mysql_result($result,0,'show1clean');
if ($show1clean == "Y") echo "<img src = \"images/opclean.png\">";
else echo "<img src = \"images/opnotclean.png\">";

echo"<br>
This was a clean Automation show (equipment): ";

$show1equipclean = mysql_result($result,0,'show1equipclean');
if ($show1equipclean == "N") {
    echo "<img src = \"images/equipnotclean.png\">";
    //*************************************************
    //if this was not a clean automation show, show which system
    //is faulted:
    $show_1_problem_equip_1 = mysql_result($result,0,'show_1_problem_equip_1');
    $show_1_problem_equip_2 = mysql_result($result,0,'show_1_problem_equip_2');
    echo "<BR>Faulted systems (if any): $show_1_problem_equip_1 and $show_1_problem_equip_2";
    //*************************************************
    }
else echo "<img src = \"images/equipclean.png\">";

echo "<br>
      <BR /><B><legend>Show 1 Operators:</B>L2
Aerial: ";

$show1aerial = mysql_result($result,0,'show1aerial');
echo "$show1aerial";

echo "<br>
L4 Loading: ";

$show1l4loading = mysql_result($result,0,'show1l4loading');
echo "$show1l4loading";

echo "<br>
L4 Scenic: ";

$show1l4scenic = mysql_result($result,0,'show1l4scenic');
echo "$show1l4scenic";

echo "<br>
L6 Loading: ";

$show1l6loading = mysql_result($result,0,'show1l6loading');
echo "$show1l6loading";

echo "<br>
Lift Operator: ";

$show1liftop = mysql_result($result,0,'show1liftop');
echo "$show1liftop";

echo "<br>
Rover: ";

$show1rover = mysql_result($result,0,'show1rover');
echo "$show1rover";

echo "<BR /><BR /><B>Show 1 Report: </B><BR />";

$show1report = mysql_result($result,0,'show1report');
echo "$show1report";

echo "</td>
      <td width =\"50%\" valign = \"top\">
      <B>Show 2 Report General Info: <BR /></B>
Show Number: ";

$show2number = mysql_result($result,0,'show2number');


if ($show2number <> 0){
    echo "$show2number";
}
else echo "none";

echo "<br>
Show Report by: ";

$show2user = mysql_result($result,0,'show2user');
if ($show2number <> 0){
    echo "$show2user";
}
else echo "none";

echo "<br>
This was a clean Automation show (operation): ";

$show2clean = mysql_result($result,0,'show2clean');
if ($show2number <> 0){
    if ($show2clean == "Y") echo "<img src = \"images/opclean.png\">";
    else echo "<img src = \"images/opnotclean.png\">";
}
else echo "none";

echo "<br>
This was a clean Automation show (equipment): ";

$show2equipclean = mysql_result($result,0,'show2equipclean');
if ($show2number <> 0){
    if ($show2equipclean == "N"){
    echo "<img src = \"images/equipnotclean.png\">";
    //*************************************************
    //if this was not a clean automation show, show which system
    //is faulted:
    $show_2_problem_equip_1 = mysql_result($result,0,'show_2_problem_equip_1');
    $show_2_problem_equip_2 = mysql_result($result,0,'show_2_problem_equip_2');
    echo "<BR>Faulted systems (if any): $show_2_problem_equip_1 and $show_2_problem_equip_2";
    //*************************************************
    }
    else echo "<img src = \"images/equipclean.png\">";
}
else echo "none";

echo "<BR /><BR /><B>Show 2 Operators:<BR /></B>
L2 Aerial: ";

$show2aerial = mysql_result($result,0,'show2aerial');
if ($show2number <> 0){
    echo "$show2aerial";
}
else echo "none";

echo "<br>
L4 Loading: ";

$show2l4loading = mysql_result($result,0,'show2l4loading');
if ($show2number <> 0){
    echo "$show2l4loading";
}
else echo "none";

echo "<br>
L4 Scenic: ";

$show2l4scenic = mysql_result($result,0,'show2l4scenic');
if ($show2number <> 0){
    echo "$show2l4scenic";
}
else echo "none";

echo "<br>
L6 Loading: ";

$show2l6loading = mysql_result($result,0,'show2l6loading');
if ($show2number <> 0){
    echo "$show2l6loading";
}
else echo "none";

echo "<br>
Lift Operator: ";

$show2liftop = mysql_result($result,0,'show2liftop');
if ($show2number <> 0){
    echo "$show2liftop";
}
else echo "none";

echo "<br>
Rover: ";

$show2rover = mysql_result($result,0,'show2rover');
if ($show2number <> 0){
    echo "$show2rover";
}
else echo "none";

echo "<BR /><BR /><B>Show 2 Report: </B><BR />";

$show2report = mysql_result($result,0,'show2report');
if ($show2number <> 0){
    echo "$show2report";
}
else echo "none";
      
echo "</td>
    </tr>
  </tbody>
</table>";

echo "<BR /><B>Rehearsal Report</B><BR />
  <table style=\"text-align: left; width: 100%;\" border=\"0\"
 cellpadding=\"2\" cellspacing=\"2\">
    <tbody>
      <tr>
        <td>";
        
        //contents of rehearsal report:
        $rehearsalreport = mysql_result($result,0,'rehearsalreport');        
        echo "$rehearsalreport";
        
        echo "</td>
      </tr>
    </tbody>
  </table>";

//****************************
//END SHOW SHOW REPORTS

}
else {
//give an error, there was an error!
echo "Option not available. Error!";

}

?>


<?php
require ("footer.php");
?>

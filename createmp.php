<?php
//process maintenance plan creation

require ("header.php");
require ("db.php");

$wocreatedate = $_POST['wocreatedate'];

$wocreatedby = $_POST['wocreatedby'];
//convert name to users table index:
//$query = "SELECT * FROM users WHERE username = \"$wocreatedby\"";
//$result = mysql_query ($query);
//$wocreatedby =  mysql_result($result,0,"users_id");

$wotype = $_POST['wotype'];
//convert type to wotype table index:
//$query = "SELECT * FROM wotype WHERE wotypename = \"$wotype\"";
//$result = mysql_query ($query);
//$wotype =  mysql_result($result,0,"wotypeid");

$wopriority = $_POST['wopriority'];
//convertpriority to wopriority table index:
//$query = "SELECT * FROM wopriority WHERE woprioritydescription = \"$wopriority\"";
//$result = mysql_query ($query);
//$wopriority =  mysql_result($result,0,"wopriorityid");

$periodicity = $_POST['periodicity'];
//convertpriority to wopriority table index:
//$query = "SELECT * FROM mpperiodicity WHERE mpperiodicityname = \"$periodicity\"";
//$result = mysql_query ($query);
//$periodicity =  mysql_result($result,0,"mpperiodicityid");

/****************************************/
//Generate starting time in unix time:
//user sends $startdate (DD-MM-YY) and $wo_generate_time (HH:MM)
//we need to convert that into unix time!
$startdate = $_POST['startdate'];
$wo_generate_time = $_POST['wo_generate_time'];

$start_date = explode("-", $startdate);
$start_time = explode(":", $wo_generate_time);

$nextordertime = mktime($start_time[0], $start_date[1], 0, $start_date[1], $start_date[0], $start_date[2]);

/****************************************/

$wolv0 = $_POST['lv0'];
//convert to index:
//$query = "SELECT * FROM lv0 WHERE lv0name = \"$wolv0\"";
//$result = mysql_query ($query);
//$wolv0 =  mysql_result($result,0,"lv0id");

$wolv1 = $_POST['lv1'];
//convert to index:
//$query = "SELECT * FROM lv1 WHERE lv1name = \"$wolv1\"";
//$result = mysql_query ($query);
//$wolv1 =  mysql_result($result,0,"lv1id");

$wolv2 = $_POST['lv2'];
//convert to index:
//$query = "SELECT * FROM lv2 WHERE lv2name = \"$wolv2\"";
//$result = mysql_query ($query);
//$wolv2 =  mysql_result($result,0,"lv2id");

$wolv3 = $_POST['lv3'];
//convert to index:
//$query = "SELECT * FROM lv3 WHERE lv3name = \"$wolv3\"";
//$result = mysql_query ($query);
//$wolv3 =  mysql_result($result,0,"lv3id");

$wolv4 = $_POST['lv4'];
//convert to index:
//$query = "SELECT * FROM lv4 WHERE lv4name = \"$wolv4\"";
//$result = mysql_query ($query);
//$wolv4 =  mysql_result($result,0,"lv4id");

$wolv5 = $_POST['lv5'];
//convert to index:
//$query = "SELECT * FROM lv5 WHERE lv5name = \"$wolv5\"";
//$result = mysql_query ($query);
//$wolv5 =  mysql_result($result,0,"lv5id");

$wolv6 = $_POST['lv6'];
//convert to index:
//$query = "SELECT * FROM lv6 WHERE lv6name = \"$wolv6\"";
//$result = mysql_query ($query);
//$wolv6 =  mysql_result($result,0,"lv6id");

$wolv7 = $_POST['lv7'];
//convert to index:
//$query = "SELECT * FROM lv7 WHERE lv7name = \"$wolv7\"";
//$result = mysql_query ($query);
//$wolv7 =  mysql_result($result,0,"lv7id");

$wosummary = $_POST['wosummary'];
$wosummary = filter_var($wosummary,FILTER_SANITIZE_SPECIAL_CHARS);

$wodescription = $_POST['wodescription'];
//$wodescription = filter_var($wodescription,FILTER_SANITIZE_SPECIAL_CHARS);

if (!isset($_POST['wodocument'])) $wodocument = "none";
else {
    $wodocument = $_POST['wodocument'];
    $wodocument = filter_var($wodocument,FILTER_SANITIZE_SPECIAL_CHARS);
}

if (!isset($_POST['wosafetydocument'])) $wosafetydocument = "none";
else {
    $wosafetydocument = $_POST['wosafetydocument'];
    $wosafetydocument = filter_var($wosafetydocument,FILTER_SANITIZE_SPECIAL_CHARS);
}

$wostatus = $_POST['wostatus']; //will be "ASSIGNED"
//convert to index:
//$query = "SELECT * FROM wostatus WHERE wostatusname = \"$wostatus\"";
//$result = mysql_query ($query);
//$wostatus =  mysql_result($result,0,"wostatusid");

$woassignedto = $_POST['woassignedto']; //will be admin
$womodifieddate = $_POST['womodifieddate'];

//TEST ENTRIES:

//PLACE INFORMATION ON THE DATABASE:

$query = "INSERT INTO maintenanceplans (wocreatedate,wocreatedby,wotype,wopriority,wolv0,wolv1,wolv2,wolv3,wolv4,wolv5,wolv6,wolv7,wosummary, wodescription,wostatus,woassignedto,womodifieddate,periodicity,nextordertime,wodocument,wosafetydocument) VALUES (\"$wocreatedate\",\"$wocreatedby\",\"$wotype\",\"$wopriority\",\"$wolv0\",\"$wolv1\",\"$wolv2\",\"$wolv3\",\"$wolv4\",\"$wolv5\",\"$wolv6\",\"$wolv7\",\"$wosummary\",\"$wodescription\",\"$wostatus\",\"$woassignedto\",\"$womodifieddate\",\"$periodicity\",\"$nextordertime\",\"$wodocument\",\"$wosafetydocument\")";

//Run query
mysql_query($query) or die (''.mysql_error().'');
    
//SEND EMAIL TO ADMIN USERS:

//OUTPUT - WO# created succsfully with number: 123
$last_id = mysql_insert_id();
echo "MP number $last_id has been created!<P>";

//echo "DEBUG DATA: $wocreatedate | $wocreatedby | $wotype | $wopriority | $wolv0 | $wolv1 | $wolv2 | $wolv3 | $wolv4 | $wolv5 | $wolv6 | $wolv7 | $wosummary | $wodescription | $wostatus | $woassignedto | $womodifieddate";

require ("footer.php");
?>

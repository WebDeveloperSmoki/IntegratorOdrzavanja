<?php
//This file is the same as creastewo.php but is called by the 
//maintenance plan scheduler file. The only difference to
//createwo.php is there's no requires header.php because
//the file will not run autoamtically because no user is logged in.
//THEREFORE this createwo_x.php can be ran by any user at any time,
//logged inb or not. THIS IS OBVIOUSLY NOT GOOD!
//
require ("db.php");
require("config/aux_funcs.php");

//WO creation METHOD 1: user creation (shows form on createwomp.php), requires the following variables to be defined:

//know if this is the creation of a new order $action = "wo" or editing an existing one $action = "edit"
$action = $_POST['action'];

$wocreatedate = time();

$wocreatedby = $_POST['wocreatedby'];
//convert name to users table index:
$query = "SELECT * FROM users WHERE username = \"$wocreatedby\"";
$result = mysql_query ($query);
$wocreatedby =  mysql_result($result,0,"users_id");

$wotype = $_POST['wotype'];
$wotypeemail = $wotype;
//convert type to wotype table index:
$query = "SELECT * FROM wotype WHERE wotypename = \"$wotype\"";
$result = mysql_query ($query);
$wotype =  mysql_result($result,0,"wotypeid");

$wopriority = $_POST['wopriority'];
$wopriorityemail = $wopriority;
//convertpriority to wopriority table index:
$query = "SELECT * FROM wopriority WHERE woprioritydescription = \"$wopriority\"";
$result = mysql_query ($query);
$wopriority =  mysql_result($result,0,"wopriorityid");

$wolv0 = $_POST['lv0'];
$wolv0email = $wolv0;
//convert to index:
$query = "SELECT * FROM lv0 WHERE lv0name = \"$wolv0\"";
$result = mysql_query ($query);
$wolv0 =  mysql_result($result,0,"lv0id");

$wolv1 = $_POST['lv1'];
$wolv1email = $wolv1;
//convert to index:
$query = "SELECT * FROM lv1 WHERE lv1name = \"$wolv1\"";
$result = mysql_query ($query);
$wolv1 =  mysql_result($result,0,"lv1id");

$wolv2 = $_POST['lv2'];
$wolv2email = $wolv2;
//convert to index:
$query = "SELECT * FROM lv2 WHERE lv2name = \"$wolv2\"";
$result = mysql_query ($query);
$wolv2 =  mysql_result($result,0,"lv2id");

$wolv3 = $_POST['lv3'];
$wolv3email = $wolv3;
//convert to index:
$query = "SELECT * FROM lv3 WHERE lv3name = \"$wolv3\"";
$result = mysql_query ($query);
$wolv3 =  mysql_result($result,0,"lv3id");

$wolv4 = $_POST['lv4'];
$wolv4email = $wolv4;
//convert to index:
$query = "SELECT * FROM lv4 WHERE lv4name = \"$wolv4\"";
$result = mysql_query ($query);
$wolv4 =  mysql_result($result,0,"lv4id");

$wolv5 = $_POST['lv5'];
$wolv5email = $wolv5;
//convert to index:
$query = "SELECT * FROM lv5 WHERE lv5name = \"$wolv5\"";
$result = mysql_query ($query);
$wolv5 =  mysql_result($result,0,"lv5id");

$wolv6 = $_POST['lv6'];
$wolv6email = $wolv6;
//convert to index:
$query = "SELECT * FROM lv6 WHERE lv6name = \"$wolv6\"";
$result = mysql_query ($query);
$wolv6 =  mysql_result($result,0,"lv6id");

$wolv7 = $_POST['lv7'];
$wolv7email = $wolv7;
//convert to index:
$query = "SELECT * FROM lv7 WHERE lv7name = \"$wolv7\"";
$result = mysql_query ($query);
$wolv7 =  mysql_result($result,0,"lv7id");

$wosummary = $_POST['wosummary'];
$wosummary = filter_var($wosummary,FILTER_SANITIZE_SPECIAL_CHARS);

$wodescription = $_POST['wodescription'];

$wodescription = filter_var($wodescription,FILTER_SANITIZE_SPECIAL_CHARS);
$wodescription = str_replace ("&#13;&#10;","<BR />",$wodescription);

$wostatus = $_POST['wostatus'];
$wostatusname = $wostatus;
//convert to index:
$query = "SELECT * FROM wostatus WHERE wostatusname = \"$wostatus\"";
$result = mysql_query ($query);
$wostatus =  mysql_result($result,0,"wostatusid");

$woassignedto = $_POST['woassignedto'];
$assignedtoemail = $woassignedto;

if ($woassignedto == "admin"){
    $query = "SELECT * FROM users WHERE usergroup = \"1\" AND mainadmin =\"Y\"";    
    }
else {
    $query = "SELECT * FROM users WHERE username = \"$woassignedto\"";
    }
    
$result = mysql_query ($query);
$woassignedto =  mysql_result($result,0,"users_id");

$womodifieddate = $_POST['womodifieddate'];

//headers to send with the emails:
$headers = 'From: '.$admin_email.'' . "\r\n" .
    'Reply-To: '.$admin_email.'' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

if (!isset($_POST['wodocument'])) $wodocument = "none";
else {
    $wodocument = $_POST['wodocument'];
    $wodocument = filter_var($wodocument,FILTER_SANITIZE_SPECIAL_CHARS);
}

if (!isset($_POST['woreportdocument'])) $woreportdocument = "none";
else {
    $woreportdocument = $_POST['woreportdocument'];
    $woreportdocument = filter_var($woreportdocument,FILTER_SANITIZE_SPECIAL_CHARS);
}

if (!isset($_POST['wosafetydocument'])) $wosafetydocument = "none";
else {
    $wosafetydocument = $_POST['wosafetydocument'];
    $wosafetydocument = filter_var($wosafetydocument,FILTER_SANITIZE_SPECIAL_CHARS);
}

//TEST ENTRIES:

//PLACE INFORMATION ON THE DATABASE:
if ($action == "edit"){
//if $action == "edit", it's an update and we received the woid number:
    $woid = $_POST['woid'];
    $womodifieddate = time();
    $woreport = $_POST['woreport'];
    $woreport = filter_var($woreport,FILTER_SANITIZE_SPECIAL_CHARS);
    //$woreport = str_replace ("&#13;&#10;","<BR />",$woreport);
    
//we now need to extract the current assignedto user, so we can detect if it changes and send an email to the new assignedto user:
//NEW: we extract all last values to log the changes:
$query = "SELECT * FROM workorders WHERE woid = \"$woid\"";
$res = mysql_query($query) or die ("fault detected on createwo.php. stopping exec.");

//----ITEM 1
$previous_woassignedto = mysql_result($res, 0, 'woassignedto');
//convert to text:
$query = "SELECT * FROM users WHERE users_id = \"$previous_woassignedto\"";
$res2 = mysql_query ($query);
$previous_woassignedto =  mysql_result($res2,0,"username");
//----END ITEM 1

//----ITEM 2
$previous_wotype = mysql_result($res, 0, 'wotype');
$query = "SELECT * FROM wotype WHERE wotypeid = \"$previous_wotype\"";
$res2 = mysql_query ($query);
$previous_wotype =  mysql_result($res2,0,"wotypename");
//----END ITEM 2

//----ITEM 3
$previous_wopriority = mysql_result($res, 0, 'wopriority');
$query = "SELECT * FROM wopriority WHERE wopriorityid = \"$previous_wopriority\"";
$res2 = mysql_query ($query);
$previous_wopriority =  mysql_result($res2,0,"woprioritydescription");
//----END ITEM 3

//----ITEM 4
$previous_wolv0 = mysql_result($res, 0, 'wolv0');
$query = "SELECT * FROM lv0 WHERE lv0id = \"$previous_wolv0\"";
$res2 = mysql_query ($query);
$previous_wolv0 =  mysql_result($res2,0,"lv0name");
//----END ITEM 4

//----ITEM 5
$previous_wolv1 = mysql_result($res, 0, 'wolv1');
$query = "SELECT * FROM lv1 WHERE lv1id = \"$previous_wolv1\"";
$res2 = mysql_query ($query);
$previous_wolv1 =  mysql_result($res2,0,"lv1name");
//----END ITEM 5

//----ITEM 6
$previous_wolv2 = mysql_result($res, 0, 'wolv2');
$query = "SELECT * FROM lv2 WHERE lv2id = \"$previous_wolv2\"";
$res2 = mysql_query ($query);
$previous_wolv2 =  mysql_result($res2,0,"lv2name");
//----END ITEM 6

//----ITEM 7
$previous_wolv3 = mysql_result($res, 0, 'wolv3');
$query = "SELECT * FROM lv3 WHERE lv3id = \"$previous_wolv3\"";
$res2 = mysql_query ($query);
$previous_wolv3 =  mysql_result($res2,0,"lv3name");
//END ITEM 7

//----ITEM 8
$previous_wolv4 = mysql_result($res, 0, 'wolv4');
$query = "SELECT * FROM lv4 WHERE lv4id = \"$previous_wolv4\"";
$res2 = mysql_query ($query);
$previous_wolv4 =  mysql_result($res2,0,"lv4name");
//END ITEM 8

//----ITEM 9
$previous_wolv5 = mysql_result($res, 0, 'wolv5');
$query = "SELECT * FROM lv5 WHERE lv5id = \"$previous_wolv5\"";
$res2 = mysql_query ($query);
$previous_wolv5 =  mysql_result($res2,0,"lv5name");
//END ITEM 9

//----ITEM 10
$previous_wolv6 = mysql_result($res, 0, 'wolv6');
$query = "SELECT * FROM lv6 WHERE lv6id = \"$previous_wolv6\"";
$res2 = mysql_query ($query);
$previous_wolv6 =  mysql_result($res2,0,"lv6name");
//END ITEM 10

//----ITEM 11
$previous_wolv7 = mysql_result($res, 0, 'wolv7');
$query = "SELECT * FROM lv7 WHERE lv7id = \"$previous_wolv7\"";
$res2 = mysql_query ($query);
$previous_wolv7 =  mysql_result($res2,0,"lv7name");
//END ITEM 11

$previous_wosummary = mysql_result($res, 0, 'wosummary');
$previous_wodescription = mysql_result($res, 0, 'wodescription');

//----ITEM 12
$previous_wostatus = mysql_result($res, 0, 'wostatus');
$query = "SELECT * FROM wostatus WHERE wostatusid = \"$previous_wostatus\"";
$res2 = mysql_query ($query);
$previous_wostatus = mysql_result($res2,0,"wostatusname");
//END ITEM 12

//----ITEM 13
$previous_woassignedto = mysql_result($res, 0, 'woassignedto');
$query = "SELECT * FROM users WHERE users_id = \"$previous_woassignedto\"";
$res2 = mysql_query ($query);
$previous_woassignedto =  mysql_result($res2,0,"username");
//END ITEM 13

$previous_woreport = mysql_result($res, 0, 'woreport');
    
    if ($wostatusname == "COMPLETE"){//set wocompletedby and wocompleteteddate
$query = "UPDATE workorders SET wocreatedby = \"$wocreatedby\", wotype = \"$wotype\", wopriority = \"$wopriority\", wolv0 = \"$wolv0\" , wolv1 = \"$wolv1\", wolv2 = \"$wolv2\", wolv3 = \"$wolv3\", wolv4 = \"$wolv4\", wolv5 = \"$wolv5\", wolv6 = \"$wolv6\", wolv7 = \"$wolv7\", wostatus =\"$wostatus\", woassignedto = \"$woassignedto\", womodifieddate=\"$womodifieddate\", woreport=\"$woreport\", wocompletedby=\"$assignedtoemail\", wocompleteddate=\"$womodifieddate\", wodocument=\"$wodocument\", woreportdocument =\"$woreportdocument\", wosafetydocument=\"$wosafetydocument\" WHERE woid =\"$woid\"";
}

    else if ($wostatusname == "CLOSED"){//set wocloseddate
$query = "UPDATE workorders SET wocreatedby = \"$wocreatedby\", wotype = \"$wotype\", wopriority = \"$wopriority\", wolv0 = \"$wolv0\" , wolv1 = \"$wolv1\", wolv2 = \"$wolv2\", wolv3 = \"$wolv3\", wolv4 = \"$wolv4\", wolv5 = \"$wolv5\", wolv6 = \"$wolv6\", wolv7 = \"$wolv7\", wostatus =\"$wostatus\", woassignedto = \"$woassignedto\", womodifieddate=\"$womodifieddate\", woreport=\"$woreport\", wocloseddate=\"$womodifieddate\", wodocument=\"$wodocument\", woreportdocument =\"$woreportdocument\", wosafetydocument=\"$wosafetydocument\" WHERE woid =\"$woid\"";
}
    else{
$query = "UPDATE workorders SET wocreatedby = \"$wocreatedby\", wotype = \"$wotype\", wopriority = \"$wopriority\", wolv0 = \"$wolv0\" , wolv1 = \"$wolv1\", wolv2 = \"$wolv2\", wolv3 = \"$wolv3\", wolv4 = \"$wolv4\", wolv5 = \"$wolv5\", wolv6 = \"$wolv6\", wolv7 = \"$wolv7\", wostatus =\"$wostatus\", woassignedto = \"$woassignedto\", womodifieddate=\"$womodifieddate\", woreport=\"$woreport\", wodocument=\"$wodocument\", woreportdocument =\"$woreportdocument\", wosafetydocument=\"$wosafetydocument\" WHERE woid =\"$woid\"";        
}
      
    mysql_query($query) or die ("error 02 on createwo.php");
    
    if ($wostatusname == "COMPLETE"){
    //set assigned to to admin, so it can be set to closed - Only admin users (usergroup 1) with email set to Y receive emails.
    $query = "SELECT * FROM users WHERE usergroup = \"1\" AND receiveemails =\"Y\"";
    $result = mysql_query ($query);

    while($row = mysql_fetch_array($result)){
	//$adminemail .= $row['useremail'];
	//$adminemail .= ",";
	
	//check wich one is the mainadmin (the one that gets all the CLOSED orders sent to:
	if ($row['mainadmin'] == "Y"){
	   $adminid = $row['users_id'];
	   $adminemail = $row['useremail'];
	   }
	//we should always have a mainadmin.. code elsewhere must make sure of that.
	
    }
    
    $query = "UPDATE workorders SET woassignedto = \"$adminid\" WHERE woid =\"$woid\"";
    mysql_query($query) or die ("error 03 on createwo.php");
    
    //**********************SEND EMAIL TO ADMIN (this is correct no need to change):
    // The message
    $message = "Hello!<BR><BR>WO# $woid has been set as complete and needs your approval to be set to CLOSED.<BR><BR>
    <a href=\"$root_dir\">Click Here</a> for quick access to maintenance site.<BR><BR>Cheers,<BR>The Maintenance Management System.";

    // In case any of our lines are larger than 70 characters, we should use wordwrap()
    $message = wordwrap($message, 70);
    $subject = "WO $woid completed!";

    // Send
    //$adminemail = mysql_result($result,0,'useremail');
    mail($adminemail, $subject, $message, $headers);
    
    }
    
    /******************************IF USER HAS CHANGED SEND EMAIL TO NEW ASSIGNEDTO USER:*/
    if ($previous_assignedto != $assignedtoemail && $wostatusname != "COMPLETE" && $wostatusname != "CLOSED"){
    
    //find the new user email address:
    $query = "SELECT * FROM users WHERE username = \"$assignedtoemail\"";
    $result = mysql_query ($query);
    $useremail = mysql_result($result, 0, 'useremail');
    
    //get current wosummary
    $query = "SELECT * FROM workorders WHERE woid = \"$woid\"";
    $result = mysql_query ($query);
    $wosummary = mysql_result($result,0,'wosummary');
    
    $message = "Hello!<BR><BR>WO# $woid has been issued and assigned to you. It is now waiting for INPROGRESS status.<BR><BR>Here's a summary of the order data:<BR><BR>WO Type: $wotypeemail<BR>WO Priority: $wopriorityemail<BR>WO FL: $wolv0email.$wolv1email.$wolv2email.$wolv3email.$wolv4email.[$wolv5email].$wolv6email.$wolv7email<BR>WO Summary: $wosummary<BR><BR><a href=\"$root_dir\">Click Here</a> for quick access to maintenance site.<BR><BR>Cheers,<BR>Your Friendly Maintenance Management System";

    // In case any of our lines are larger than 70 characters, we should use wordwrap()
    $message = wordwrap($message, 70);
    $subject = "WO $woid has been assigned to you!";

    // Send
    mail($useremail, $subject, $message, $headers);   
    }
    
    echo "WO# $woid was successfully updated!";
    
    //********************************************************************
    //LOGGING SECTION - LOGS CHANGES TO THE WO ON THE DATABASE:
    
    $change = "";
    if ($previous_woassignedto <> $assignedtoemail) $change .= "changed woassignedto from $previous_woassignedto to $assignedtoemail | ";
    if ($previous_wotype <> $wotypeemail) $change .= "changed wotype from $previous_wotype to $wotypeemail | ";
    if ($previous_wopriority <> $wopriorityemail) $change .= "changed wopriority from $previous_wopriority to $wopriorityemail | ";
    if ($previous_wolv0 <> $wolv0email) $change .= "changed wolv0 from $previous_wolv0 to $wolv0email | ";
    if ($previous_wolv1 <> $wolv1email) $change .= "changed wolv1 from $previous_wolv1 to $wolv1email | ";
    if ($previous_wolv2 <> $wolv2email) $change .= "changed wolv2 from $previous_wolv2 to $wolv2email | ";
    if ($previous_wolv3 <> $wolv3email) $change .= "changed wolv3 from $previous_wolv3 to $wolv3email | ";
    if ($previous_wolv4 <> $wolv4email) $change .= "changed wolv4 from $previous_wolv4 to $wolv4email | ";
    if ($previous_wolv5 <> $wolv5email) $change .= "changed wolv5 from $previous_wolv5 to $wolv5email | ";
    if ($previous_wolv6 <> $wolv6email) $change .= "changed wolv6 from $previous_wolv6 to $wolv6email | ";
    if ($previous_wolv7 <> $wolv7email) $change .= "changed wolv7 from $previous_wolv7 to $wolv7email | ";
    if ($previous_wostatus <> $wostatusname) $change .= "changed wostatus from $previous_wostatus to $wostatusname | ";
    if ($previous_woreport <> $woreport) $change .= "changed woreport from $previous_woreport to $woreport | ";
    $change .= "viewed";
    
     $actions_from_user = $_SESSION['valid_user'];
     $change_date = time();
     
     $query = "INSERT INTO wolog (woid, user, wologdate, wologdescription) VALUES (\"$woid\",\"$actions_from_user\",\"$change_date\",\"$change\")";
     mysql_query($query) or die ("error 210 on createwo.php");
    //END LOG SECTION
    //*********************************************************************
    
}
else {//can be "wo" or "mp"
$query = "INSERT INTO workorders (wocreatedate,wocreatedby,wotype,wopriority,wolv0,wolv1,wolv2,wolv3,wolv4,wolv5,wolv6,wolv7,wosummary,wodescription,wostatus,woassignedto,womodifieddate,wodocument,woreportdocument,wosafetydocument) VALUES (\"$wocreatedate\", \"$wocreatedby\",\"$wotype\", \"$wopriority\", \"$wolv0\", \"$wolv1\", \"$wolv2\", \"$wolv3\", \"$wolv4\", \"$wolv5\", \"$wolv6\", \"$wolv7\", \"$wosummary\", \"$wodescription\", \"$wostatus\", \"$woassignedto\", \"$womodifieddate\", \"$wodocument\", \"$woreportdocument\",\"$wosafetydocument\")";

mysql_query($query) or die ("error 21 on createwo.php");
    
    //OUTPUT - WO# created succsfully with number: 123
    $last_id = mysql_insert_id();
    echo "WO number $last_id has been created!<P>"; 
    
    //**************************SEND EMAIL TO ADMIN if wo has been created manually because it needs to be assigned to someone:
    if ($action == "wo"){
    $query = "SELECT * FROM users WHERE usergroup = \"1\" AND mainadmin =\"Y\"";
    $result = mysql_query ($query);
    $useremail = mysql_result($result,0,'useremail');
    $subject = "WO $last_id has been assigned to you!";
    }
     /******************************send email to user if WO generated from MP:*/
     /*NEW IMPLMENATION, ALL ORDERS ARE SENT TO MAIN ADMIN. EMAIL IS ALSO SENT TO THAT PERSON*/
    if ($action == "mp"){
    $query = "SELECT * FROM users WHERE usergroup = \"1\" AND mainadmin =\"Y\"";
    $result = mysql_query ($query);
    $useremail = mysql_result($result,0,'useremail');
    $subject = "[MPlan] WO $last_id was issued!";
    } 
    
$message = "Hello!<BR><BR>WO# $last_id has been issued and assigned to you. It is now waiting for INPROGRESS status.
<BR><BR>Here's a summary of the order data:<BR><BR>WO Type: $wotypeemail<BR>WO Priority: $wopriorityemail<BR>
WO FL: $wolv0email.$wolv1email.$wolv2email.$wolv3email.$wolv4email.[$wolv5email].$wolv6email.$wolv7email<BR>
WO Summary: $wosummary<BR><BR><a href=\"$root_dir\">Click Here</a> for quick acess to maintenance site.
<BR><BR>Cheers,<BR>Your Friendly Maintenance Management System";

    // In case any of our lines are larger than 70 characters, we should use wordwrap()
    $message = wordwrap($message, 70);

    // Send
    mail($useremail, $subject, $message, $headers);
             
}

require ("footer.php");
?>

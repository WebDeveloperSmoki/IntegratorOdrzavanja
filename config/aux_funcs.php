<?php
//auxiliary functions
function order_exists($ordernumber){
//will check the workorders database to see if order exists. Return true or false;
$query = "SELECT * FROM workorders WHERE woid = \"$ordernumber\"";
$r = mysql_query($query);

if (mysql_num_rows($r) == 0) return false;
else return true;
}

function extract_user_level($username){

$query = "SELECT * FROM users WHERE username = \"$username\"";
$r = mysql_query($query);
$userlevel = mysql_result($r, 0, 'usergroup');

$query = "SELECT * FROM usergroups WHERE usergroups_id = \"$userlevel\"";
$r = mysql_query($query);
$userlevel = mysql_result($r, 0, 'usergroups_name');

return $userlevel;
}

/****************************/
//functions that extract user admin level, if any:
function is_site_admin($username){
    $query = "SELECT * FROM users WHERE username = \"$username\"";
    $r = mysql_query($query);
    $is_site_admin = mysql_result($r, 0, 'is_site_admin');
    
    if ($is_site_admin == "Y") return true;
    else return false;
}

function is_plant_admin($username){
    $query = "SELECT * FROM users WHERE username = \"$username\"";
    $r = mysql_query($query);
    $is_plant_admin = mysql_result($r, 0, 'is_plant_admin');
    
    if ($is_plant_admin == "Y") return true;
    else return false;
}

function is_dpt_admin($username){
    $query = "SELECT * FROM users WHERE username = \"$username\"";
    $r = mysql_query($query);
    $is_dpt_admin = mysql_result($r, 0, 'is_dpt_admin');
    
    if ($is_dpt_admin == "Y") return true;
    else return false;
}

function is_system_admin($username){
    $query = "SELECT * FROM users WHERE username = \"$username\"";
    $r = mysql_query($query);
    $is_system_admin = mysql_result($r, 0, 'is_system_admin');
    
    if ($is_system_admin == "Y") return true;
    else return false;
}

/****************************/

function list_restricted_table_entries ($table_name, $char_before, $char_after, $field_1, $field_2, $restriction){
//works as the function below but the $query is restricted by another field
$query = "SELECT * FROM $table_name WHERE $restriction";

$result = mysql_query($query);

if (mysql_num_rows($result) == 0) echo " No results!";
else{
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
        echo "$char_before";
        if ($field_1 == 1) echo "$row[1]";
        if ($field_1 == 2) echo "$row[2]";
        if ($field_1 == 3) echo "$row[3]";        
        echo "$char_after";                   
        }

    }
}

function list_table_entries($table_name, $char_before, $char_after, $field_1, $field_2){
//list all the entries on table_name between start_text and end_text and diplays the field_1 and option filed_2 (set to -1 if no need for second field)

$query = "SELECT * FROM $table_name";

$result = mysql_query($query);
echo "This is a test!";

if (mysql_num_rows($result) == 0) echo " No results!";
else{
    
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
        echo "$char_before";
        if ($field_1 == 1) echo "$row[1]";
        if ($field_1 == 2) echo "$row[2]";
        if ($field_1 == 3) echo "$row[3]";        
        echo "$char_after";                   
        }

    }
}

function enter_form($type, $woid, $p, $loggeduser){
//$type = wo for manual work orders or mp for entering maintenance plans
//main difference between the two is that the MP shows an option
//for periodicity and a starting date

echo "<form method=\"post\" action=\"";

//if it's to create a maintenance plan, op ="mp" go to createmp.php
if ($type == "mp"){
    echo "createmp.php";   
    }
else {
    //this can be the creation of an order or the edit of an order
    echo "createwo.php";    
    }

//else post to createwo.php

echo  "\" name=\"wocreation\">";

if ($type == "wo"){
    echo "<input type = \"hidden\" name = \"action\" value =\"wo\">";
}
if ($type == "edit"){
    echo "<input type = \"hidden\" name = \"action\" value =\"edit\">";
    echo "<input type = \"hidden\" name = \"woid\" value =\"$woid\">";
}

//<fieldset><legend>WO Information</legend>

echo "General information <BR />
<table style=\"text-align: left; width: 100%;\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
    <tbody>
      <tr>
        <td style=\"text-align: right; font-weight: bold;\">WO #:</td>
        <td>";        
        //woid
        if ($type == "mp" or $type == "wo"){ 
        echo "not yet";
        }
        else {
        echo "$woid";
        }
        
        echo"</td>
        <td style=\"font-weight: bold; text-align: right;\">WO Created on:</td>
        <td>";
               
        if ($type == "mp" or $type == "wo"){        
        $current_time = time();
        echo date('l\, jS \of F Y h:i:s A');
        echo "<input type = \"hidden\" name = \"wocreatedate\" value = \"$current_time\">";
        }
        else {
        //show the creation date from the database (noneditable):
        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wocreatedate = mysql_result($res, 0, 'wocreatedate');
        $wocreatedate = date("l\, jS \of F Y h:i:s A", $wocreatedate);
        echo "$wocreatedate";
        }
        
echo"   </td>
        <td style=\"text-align: right;\"><span style=\"font-weight: bold;\">WO Priority:</span></td>
        <td>
        <select name=\"wopriority\">";
        
        if ($type == "mp" or $type == "wo"){ 
        list_table_entries("wopriority","<option>","</option>",2,0);
        }
        else {
        //pre-select as in database:
        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wopriority = mysql_result($res, 0, 'wopriority');
        
        $query = "SELECT * FROM wopriority WHERE wopriorityid =\"$wopriority\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wopriority = mysql_result($res, 0, 'woprioritydescription');
        
        echo "<option selected>$wopriority</option>";
        list_restricted_table_entries("wopriority","<option>","</option>",2,0, "woprioritydescription != \"$wopriority\"");
        }
        
echo "             </select>
        </td>
      </tr>
      <tr>
        <td style=\"text-align: right; font-weight: bold;\">WO Created by:</td>
        <td>";
        
        if ($type == "mp" or $type == "wo"){ 
        $user = $_SESSION['valid_user'];
        echo "$user";
        echo "<input type = \"hidden\" name = \"wocreatedby\" value =\"$user\">";
        }
        else{
        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wocreatedby = mysql_result($res, 0, 'wocreatedby');
        
        $query = "SELECT * FROM users WHERE users_id =\"$wocreatedby\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wocreatedby = mysql_result($res, 0, 'username');
        
        echo "<input type = \"hidden\" name = \"wocreatedby\" value = \"$wocreatedby\">";
        echo "$wocreatedby";
        
        }
                
echo "  </td>
        <td style=\"font-weight: bold; text-align: right;\">WO Status:</td>";
        
       if ($type == "mp" or $type == "wo"){        
        echo "<td>ASSIGNED<input type = \"hidden\" name = \"wostatus\" value = \"ASSIGNED\"></td>";
        }
        else {
        echo "<td>";
        
        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wostatus = mysql_result($res, 0, 'wostatus');
        
        $query = "SELECT * FROM wostatus WHERE wostatusid =\"$wostatus\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wostatus = mysql_result($res, 0, 'wostatusname');
        
        echo "<select name=\"wostatus\">";       
        echo "<option>$wostatus</option>";
        
        $user = $_SESSION['valid_user'];
        $query = "SELECT * FROM users WHERE username = \"$user\"";
        $res = mysql_query($query);
        $usergroup = mysql_result($res,0,'usergroup');
                
        if ($usergroup == 1) list_restricted_table_entries("wostatus","<option>","</option>",1,0,"wostatusname != \"$wostatus\"");
        else list_restricted_table_entries("wostatus","<option>","</option>",1,0,"wostatusname != \"$wostatus\" AND wostatusname != \"CLOSED\"");
        
        echo"</select></td>";
 
        }
        
        echo "<td style=\"font-weight: bold; text-align: right;\">WO Type:</td><td>";
        
        if ($type == "edit"){
        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wotype = mysql_result($res, 0, 'wotype');
        
        $query = "SELECT * FROM wotype WHERE wotypeid =\"$wotype\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wotype = mysql_result($res, 0, 'wotypename');
        
        echo "<select name=\"wotype\">";       
        echo "<option>$wotype</option>";        
        list_restricted_table_entries("wotype","<option>","</option>",1,0,"wotypename != \"$wotype\"");
        }
        
        else{
        echo "<select name=\"wotype\">";
        list_table_entries("wotype","<option>","</option>",1,0);
        }
        
        echo"</select>
        </td>
      </tr>
      <tr>
        <td style=\"text-align: right; font-weight: bold;\">WO Assigned to:</td>
        <td>";
        
        $user = $_SESSION['valid_user'];
        $query = "SELECT * FROM users WHERE username = \"$user\"";
        $res = mysql_query($query);
        $usergroup = mysql_result($res,0,'usergroup');
        
        if ($type == "edit" & $usergroup == 1){
        
        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $woassignedto = mysql_result($res, 0, 'woassignedto');
        
        $query = "SELECT * FROM users WHERE users_id =\"$woassignedto\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $woassignedto = mysql_result($res, 0, 'username');
        
        echo "<select name = \"woassignedto\">";      
        echo "<option>$woassignedto</option>";          
        list_restricted_table_entries("users","<option>","</option>",1,0,"username != \"$woassignedto\" AND does_orders = \"Y\" ORDER BY username ASC");
        echo "</select>";
        }
        
        else if ($type == "edit" & $usergroup == 2){
        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 12 on aux_funcs.php");
        $woassignedto = mysql_result($res, 0, 'woassignedto');
        
        $query = "SELECT * FROM users WHERE users_id =\"$woassignedto\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $woassignedto = mysql_result($res, 0, 'username');
        
        if ($p != "daily") {
            echo "$woassignedto";
            echo "<input type = \"hidden\" name = \"woassignedto\" value =\"$woassignedto\">";
        }
        else {
            echo "$loggeduser";
            echo "<input type = \"hidden\" name = \"woassignedto\" value =\"$loggeduser\">";
        }
        }
        
        else if ($type == "mp"){
        echo "<select name = \"woassignedto\">";             
        //list_table_entries("users","<option>","</option>",1,0);
        list_restricted_table_entries("users","<option>","</option>",1,0,"userpass != \"nope\" ORDER BY username ASC");
        echo "</select>";
        }
        
        else {
        echo "admin";        
        echo "<input type = \"hidden\" name = \"woassignedto\" value = \"admin\">";
        }
        echo "</td>
        <td style=\"font-weight: bold; text-align: right;\">WO Modified on:</td>
        <td>";
        echo date('l\, jS \of F Y h:i:s A');
        echo "<input type = \"hidden\" name = \"womodifieddate\" value = \"$current_time\">";
        echo "</td>
        <td style=\"font-weight: bold; text-align: right;\">Complete by:</td>
        <td>will depend on set priority</td>
      </tr>
    </tbody>
  </table>";
  
//  </fieldset>  
  
  if ($type == "mp") {
  //add opptional scheduling
  echo "<BR />Scheduling Options<BR />";
  
  echo "<table style=\"text-align: left; width: 100%;\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
    <tbody>
      <tr><td>Periodicity:
    <select name=\"periodicity\">";
    
  list_table_entries("mpperiodicity","<option>","</option>",1,0);  
    
  echo"  </select>
    Start Date (DD-MM-YY): <input type=\"text\" id=\"datepicker\" name=\"startdate\"> 
    Start Time: <input type=\"text\" name = \"wo_generate_time\" value =\"00:01\"></td></td></tbody></table>"; 
  }
   
  echo "<br />System/ Subsystem/ Component <br />
  <table style=\"text-align: left; width: 100%;\" border=\"0\"
 cellpadding=\"2\" cellspacing=\"2\">
    <tbody>
      <tr>";

        echo "<td style=\"text-align: center;\">0:&nbsp;";
        //********************************************************
        //*********************input of level 0*******************
        //********************************************************
        //only is_site_admin and is_plant_admin can edit or change this, else show the plant the user belongs to
        //send hidden field with the same name
            if ($type == "edit"){
                $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
                $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
            }        
            echo "<select name=\"lv0\">";
        
            if ($type == "edit"){
                $wolv0 = mysql_result($res, 0, 'wolv0');        
                $query_2 = "SELECT * FROM lv0 WHERE lv0id =\"$wolv0\"";
        
                $res2 = mysql_query ($query_2) or die ("error 01 on aux_funcs.php");
                $wolv0 = mysql_result($res2, 0, 'lv0name');
           
                echo "<option>$wolv0</option>";        
            }
        
        list_restricted_table_entries("lv0","<option>","</option>",1,0,"lv0name != \"$wolv0\"");
        echo "</select>";

        //********************************************************
        echo "</td>";

        //********************************************************
        //*********************input of level 1*******************
        //********************************************************
        //only is_site_admin, is_plant_admin or is_dpt_admin or change this, else show the plant the user belongs to
        //send hidden field with the same name
        echo "<td style=\"text-align: center;\">1:&nbsp;";
        
            echo "<select name=\"lv1\">";
            if ($type == "edit"){
                $wolv1 = mysql_result($res, 0, 'wolv1');        
                $query_2 = "SELECT * FROM lv1 WHERE lv1id =\"$wolv1\"";
        
                $res2 = mysql_query ($query_2) or die ("error 01 on aux_funcs.php");
                $wolv1 = mysql_result($res2, 0, 'lv1name');
           
                echo "<option>$wolv1</option>"; 
            }
        
            list_restricted_table_entries("lv1","<option>","</option>",1,0,"lv1name != \"$wolv1\" ORDER BY lv1name ASC");
        
            echo "</select>";
        
        echo "</td>";
        //********************************************************
        
        //********************************************************
        //*********************input of level 2*******************
        //********************************************************
        //only is_site_admin, is_plant_admin or is_dpt_admin or is_system_admin can change this, else show the plant the user belongs to
        //send hidden field with the same name
        echo "<td style=\"text-align: center;\">System:&nbsp;
        <select name=\"lv2\">";
        
        if ($type == "edit"){
        $wolv2 = mysql_result($res, 0, 'wolv2');        
        $query_2 = "SELECT * FROM lv2 WHERE lv2id =\"$wolv2\"";
        
        $res2 = mysql_query ($query_2) or die ("error 01 on aux_funcs.php");
        $wolv2 = mysql_result($res2, 0, 'lv2name');
           
        echo "<option>$wolv2</option>";
        }
        list_restricted_table_entries("lv2","<option>","</option>",1,0,"lv2name != \"$wolv2\" ORDER BY lv2name ASC");
        
        echo "</select>
        </td>";
        //********************************************************
        
        echo "<td style=\"text-align: center;\">Flr:&nbsp;
        <select name=\"lv3\">";
        
        if ($type == "edit"){
        $wolv3 = mysql_result($res, 0, 'wolv3');        
        $query_2 = "SELECT * FROM lv3 WHERE lv3id =\"$wolv3\"";
        
        $res2 = mysql_query ($query_2) or die ("error 01 on aux_funcs.php");
        $wolv3 = mysql_result($res2, 0, 'lv3name');
           
        echo "<option>$wolv3</option>";
        }
        list_restricted_table_entries("lv3","<option>","</option>",1,0,"lv3name != \"$wolv3\" ORDER BY lv3name ASC");
        
        echo "</select>
        </td>
        <td style=\"text-align: center;\">quad:&nbsp;
        <select name=\"lv4\">";
        
        if ($type == "edit"){
        $wolv4 = mysql_result($res, 0, 'wolv4');        
        $query_2 = "SELECT * FROM lv4 WHERE lv4id =\"$wolv4\"";
        
        $res2 = mysql_query ($query_2) or die ("error 01 on aux_funcs.php");
        $wolv4 = mysql_result($res2, 0, 'lv4name');
           
        echo "<option>$wolv4</option>";
        }
        list_restricted_table_entries("lv4","<option>","</option>",1,0,"lv4name != \"$wolv4\"");
        
        echo"</select>
        </td>
        <td style=\"text-align: center;\">subsystem:
        <select name=\"lv5\">";
        
        if ($type == "edit"){
        $wolv5 = mysql_result($res, 0, 'wolv5');        
        $query_2 = "SELECT * FROM lv5 WHERE lv5id =\"$wolv5\"";
        
        $res2 = mysql_query ($query_2) or die ("error 01 on aux_funcs.php");
        $wolv5 = mysql_result($res2, 0, 'lv5name');
           
        echo "<option>$wolv5</option>";
        }
        
        list_restricted_table_entries("lv5","<option>","</option>",1,0,"lv5name != \"$wolv5\"");
        
        echo"</select>
        </td>
        <td style=\"text-align: center;\">exp:&nbsp;
        <select name=\"lv6\">";
        
        if ($type == "edit"){
        $wolv6 = mysql_result($res, 0, 'wolv6');        
        $query_2 = "SELECT * FROM lv6 WHERE lv6id =\"$wolv6\"";
        
        $res2 = mysql_query ($query_2) or die ("error 01 on aux_funcs.php");
        $wolv6 = mysql_result($res2, 0, 'lv6name');
           
        echo "<option>$wolv6</option>";
        }
        
        list_restricted_table_entries("lv6","<option>","</option>",1,0,"lv6name != \"$wolv6\""); 
        
        echo "</select>
        </td>
        <td style=\"text-align: center;\">comp:&nbsp;
        <select name=\"lv7\">";
        
        if ($type == "edit"){
        $wolv7 = mysql_result($res, 0, 'wolv7');        
        $query_2 = "SELECT * FROM lv7 WHERE lv7id =\"$wolv7\"";
        
        $res2 = mysql_query ($query_2) or die ("error 01 on aux_funcs.php");
        $wolv7 = mysql_result($res2, 0, 'lv7name');
           
        echo "<option>$wolv7</option>";
        }
        
        list_restricted_table_entries("lv7","<option>","</option>",1,0,"lv7name != \"$wolv7\" ORDER BY lv7name ASC");
             
        echo "</select>
        </td>
      </tr>      
    </tbody>
  </table>

  <br />WO Details<br />
  <table style=\"text-align: left; width: 100%;\" border=\"0\"
 cellpadding=\"2\" cellspacing=\"2\">
    <tbody>
      <tr>";
        
        if ($type == "wo" or $type == "mp"){
        echo "<td><B>WO Summary:</B><input size=\"100\" name=\"wosummary\"></td>";
        }
        else{
        //just write the contents of db but do not allow changes:
        echo "<td>";
        echo "<B>WO Summary:</B> ";
        
        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wosummary = mysql_result ($res, 0, 'wosummary');
        
        echo "$wosummary";
        
        echo "</td>";
        }
        
      echo" </tr>
      <tr>
        <td><B>WO Description/ Actions that were taken/ Recommendations:</B><BR>";
        
        if ($type == "wo" or $type == "mp"){
        echo "<br><textarea cols=\"100\" rows=\"20\" name=\"wodescription\"></textarea>";
        echo "<BR><B>Paste support document address here:</B><BR> <input type =\"text\" size=\"100\" name = \"wodocument\">";
        echo "<BR><B>Paste safety document address here:</B><BR> <input type =\"text\" size=\"100\" name = \"wosafetydocument\">";
        }
        else {
        $wodescription = mysql_result ($res, 0, 'wodescription');
        echo " $wodescription";
                
        /***HERE INCLUDE THEN LINK TO SUPPORT DOCUMENTS:***/
        $wodocument = mysql_result ($res, 0, 'wodocument');
        echo "<BR><B>Support document:</B> ";
        if ($wodocument != "none") echo "<a href = \"$wodocument\">$wodocument</a>";
        else echo "none";
        
        echo "<input type =\"hidden\" name=\"wodocument\" value=\"$wodocument\">";
        
        $wosafetydocument = mysql_result ($res, 0, 'wosafetydocument');
        echo "<BR><B>Support safety document:</B> ";
        if ($wosafetydocument != "none") echo "<a href = \"$wosafetydocument\">$wosafetydocument</a>";
        else echo "none";
        
        echo "<input type =\"hidden\" name=\"wosafetydocument\" value=\"$wosafetydocument\">";
        
        }
        
      echo "</td>
      </tr>
    </tbody>
  </table>";

if ($type == "edit"){

echo "<br />WO Reporting Area<br />
  <table style=\"text-align: left; width: 100%;\" border=\"0\"
 cellpadding=\"2\" cellspacing=\"2\">
    <tbody>
      <tr>
        <td>WO Report:<br>
        
        <table style=\"text-align: left; width: 100%;\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
        <tr><td>
        <textarea cols=\"40\" rows=\"20\" name=\"woreport\">";
        
        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $woreport = mysql_result ($res, 0, 'woreport');
        
        echo "$woreport";
        
        echo "</textarea>";
        
        echo "</td><td>";
        echo "DO NOT USE THIS YET! <font size = \"2\">If spares were used on this order, please choose from list below and indicate how many were used on the details page:</font><iframe name=\"inlineframe\" src=\"spares.php?op=lst&system=$wolv2&format=frame&woid=$woid\" frameborder=\"0\" scrolling=\"auto\" width=\"768\" height=\"300\" marginwidth=\"5\" marginheight=\"5\" ></iframe>";
        
        echo "</td></tr></table>";
        
        echo "<BR><B>Report document location: </B>";
        $woreportdocument = mysql_result ($res, 0, 'woreportdocument');
        echo "<input type = \"text\" name = \"woreportdocument\" size = \"100\" value =\"$woreportdocument\">";
        
        echo "</td>
        
      </tr>
    </tbody>
  </table>";
}

echo"  <input type=\"submit\" name =\"Save\"></button>
</form>";
}

function print_order_function($woid,$isservicereport,$isprinthistory){

        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wocreatedate = mysql_result($res, 0, 'wocreatedate');
        $wocreatedate = date("l\, jS \of F Y h:i:s A", $wocreatedate);
            
    echo "<BR /><B>WO Information</B><BR />
  <table style=\"text-align: left; width: 100%;\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
    <tbody>
      <tr>
        <td style=\"text-align: right; font-weight: bold;\">WO #:</td>
        <td>";        

        echo "$woid";

        
        echo"</td>
        <td style=\"font-weight: bold; text-align: right;\">WO Created on:</td>
        <td>";

        echo "$wocreatedate";
        
echo"   </td>
        <td style=\"text-align: right;\"><span style=\"font-weight: bold;\">WO Priority:</span></td>
        <td>";
        
        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wopriority = mysql_result($res, 0, 'wopriority');
        
        $query = "SELECT * FROM wopriority WHERE wopriorityid =\"$wopriority\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wopriority = mysql_result($res, 0, 'woprioritydescription');
        
        echo "$wopriority";
echo " 
        </td>
      </tr>
      <tr>
        <td style=\"text-align: right; font-weight: bold;\">WO Created by:</td>
        <td>";
        
        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wocreatedby = mysql_result($res, 0, 'wocreatedby');
        
        $query = "SELECT * FROM users WHERE users_id =\"$wocreatedby\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wocreatedby = mysql_result($res, 0, 'username');
        
        echo "$wocreatedby";
        
                
echo "  </td><td style=\"font-weight: bold; text-align: right;\">WO Status:</td>";
        
        echo "<td>";
        
        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wostatus = mysql_result($res, 0, 'wostatus');
        
        $query = "SELECT * FROM wostatus WHERE wostatusid =\"$wostatus\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wostatus = mysql_result($res, 0, 'wostatusname');
            
        echo "$wostatus";
        
        $user = $_SESSION['valid_user'];
        $query = "SELECT * FROM users WHERE username = \"$user\"";
        $res = mysql_query($query);
        $usergroup = mysql_result($res,0,'usergroup');
        
        echo"</td>";
        
        echo "<td style=\"font-weight: bold; text-align: right;\">WO Type:</td><td>";
        
        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wotype = mysql_result($res, 0, 'wotype');
        
        $query = "SELECT * FROM wotype WHERE wotypeid =\"$wotype\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wotype = mysql_result($res, 0, 'wotypename');
              
        echo "$wotype";
        
        echo"
        </td>
      </tr>
      <tr>
        <td style=\"text-align: right; font-weight: bold;\">WO Completed by:</td>
        <td>";
        
        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wocompletedby = mysql_result($res, 0, 'wocompletedby');
           
        echo " $wocompletedby";          
        
        if ($wostatus == "CLOSED"){
            echo "</td>
            <td style=\"font-weight: bold; text-align: right;\">WO Closed on:</td>
            <td>";
            $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
            $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
            $wocloseddate = mysql_result($res, 0, 'wocloseddate');
            
            echo date("l\, jS \of F Y h:i:s A", $wocloseddate);
        }
        else{
        echo "</td>
        <td style=\"font-weight: bold; text-align: right;\"></td>
        <td>";
        $womodifieddate = mysql_result($res, 0, 'womodifieddate');           
        echo " $womodifieddate";          
        }
        
        echo "</td>
        <td style=\"font-weight: bold; text-align: right;\"></td>
        <td></td>
      </tr>
    </tbody>
  </table>";
   
  echo "<BR /><B>Functional Location</B><BR />
  <table style=\"text-align: left; width: 100%;\" border=\"0\"
 cellpadding=\"2\" cellspacing=\"2\">
    <tbody>
      <tr>
        <td style=\"text-align: center;\">lv0:&nbsp;";
        
        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        
        $wolv0 = mysql_result($res, 0, 'wolv0');        
        $query_2 = "SELECT * FROM lv0 WHERE lv0id =\"$wolv0\"";
        
        $res2 = mysql_query ($query_2) or die ("error 01 on aux_funcs.php");
        $wolv0 = mysql_result($res2, 0, 'lv0name');
           
        echo "$wolv0"; 
          
        echo "</td>
        <td style=\"text-align: center;\">lv1:&nbsp;";

        $wolv1 = mysql_result($res, 0, 'wolv1');        
        $query_2 = "SELECT * FROM lv1 WHERE lv1id =\"$wolv1\"";
        
        $res2 = mysql_query ($query_2) or die ("error 01 on aux_funcs.php");
        $wolv1 = mysql_result($res2, 0, 'lv1name');
           
        echo "$wolv1"; 
        
        echo "</td>
        <td style=\"text-align: center;\">lv2:&nbsp;";
        
        $wolv2 = mysql_result($res, 0, 'wolv2');        
        $query_2 = "SELECT * FROM lv2 WHERE lv2id =\"$wolv2\"";
        
        $res2 = mysql_query ($query_2) or die ("error 01 on aux_funcs.php");
        $wolv2 = mysql_result($res2, 0, 'lv2name');
           
        echo "$wolv2";
        
        echo "</td><td style=\"text-align: center;\">lv3:&nbsp;";
        
        $wolv3 = mysql_result($res, 0, 'wolv3');      
        $query_2 = "SELECT * FROM lv3 WHERE lv3id =\"$wolv3\"";
        
        $res2 = mysql_query ($query_2) or die ("error 01 on aux_funcs.php");
        $wolv3 = mysql_result($res2, 0, 'lv3name');
           
        echo "$wolv3";

        echo "</td>
        <td style=\"text-align: center;\">lv4:&nbsp;";
        
        $wolv4 = mysql_result($res, 0, 'wolv4');        
        $query_2 = "SELECT * FROM lv4 WHERE lv4id =\"$wolv4\"";
        
        $res2 = mysql_query ($query_2) or die ("error 01 on aux_funcs.php");
        $wolv4 = mysql_result($res2, 0, 'lv4name');
           
        echo "$wolv4";
        
        echo"</td>
        <td style=\"text-align: center;\">lv5:";

        $wolv5 = mysql_result($res, 0, 'wolv5');        
        $query_2 = "SELECT * FROM lv5 WHERE lv5id =\"$wolv5\"";
        
        $res2 = mysql_query ($query_2) or die ("error 01 on aux_funcs.php");
        $wolv5 = mysql_result($res2, 0, 'lv5name');
           
        echo "$wolv5";

        
        echo"</td>
        <td style=\"text-align: center;\">lv6:&nbsp;";
        
        $wolv6 = mysql_result($res, 0, 'wolv6');        
        $query_2 = "SELECT * FROM lv6 WHERE lv6id =\"$wolv6\"";
        
        $res2 = mysql_query ($query_2) or die ("error 01 on aux_funcs.php");
        $wolv6 = mysql_result($res2, 0, 'lv6name');
           
        echo "$wolv6"; 
        
        echo "</td>
        <td style=\"text-align: center;\">lv7:&nbsp;";
        
        $wolv7 = mysql_result($res, 0, 'wolv7');        
        $query_2 = "SELECT * FROM lv7 WHERE lv7id =\"$wolv7\"";
        
        $res2 = mysql_query ($query_2) or die ("error 01 on aux_funcs.php");
        $wolv7 = mysql_result($res2, 0, 'lv7name');
           
        echo "$wolv7";
             
        echo "</td>
      </tr>      
    </tbody>
  </table>";

/*************WO REPORTING AREA BLOCK******************************/
echo "<BR /><B>WO Reporting Area</B><BR />
  <table style=\"text-align: left; width: 100%;\" border=\"0\"
 cellpadding=\"2\" cellspacing=\"2\">
    <tbody>
      <tr>
        <td>WO Report:<br>";
        
        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $woreport = mysql_result ($res, 0, 'woreport');
        
        //replace &#13;&#10;&#13;&#10; by <BR /> before displaying:
        $woreport = str_replace ("&#13;&#10;","<BR>",$woreport);
        
        echo "$woreport";
        
        echo "<BR><B>Support report document: </B>";
        $woreportdocument = mysql_result ($res, 0, 'woreportdocument');
        if ($woreportdocument == "none") echo "none";
        else echo "<a href = \"$woreportdocument\">$woreportdocument</a>";
        
        echo "</td>
      </tr>
      <tr>
      <td>
      
      </td>
      </tr>
    </tbody>
  </table>";
/*************WO REPORTING AREA BLOCK******************************/

/*************WO DETAILS BLOCK******************************/
  echo"<BR /><B>WO Details</B><BR />
  <table style=\"text-align: left; width: 100%;\" border=\"0\"
 cellpadding=\"2\" cellspacing=\"2\">
    <tbody>
      <tr>";
        
        echo "<td>";
        echo "<B>WO Summary:</B> ";
        
        $query = "SELECT * FROM workorders WHERE woid =\"$woid\"";
        $res = mysql_query ($query) or die ("error 01 on aux_funcs.php");
        $wosummary = mysql_result ($res, 0, 'wosummary');
        
        echo "$wosummary";
        
        echo "</td>";
        
      echo" </tr>
      <tr>
        <td><B>WO Description/ Actions that were taken/ Recommendations:</B><BR />";
        
        $wodescription = mysql_result ($res, 0, 'wodescription');
        echo " $wodescription";
        
        echo "<BR><B>Support document: </B>";
        $wodocument = mysql_result ($res, 0, 'wodocument');
        if ($wodocument == "none") echo "none";
        else echo "$wodocument";
        
        echo "<BR><B>Support safety document: </B>";
        $wosafetydocument = mysql_result ($res, 0, 'wosafetydocument');
        if ($wosafetydocument == "none") echo "none";
        else echo "$wosafetydocument";
        
      echo "</td>
      </tr>
    </tbody>
  </table>";
/*************WO DETAILS BLOCK******************************/
   
    if ($isprinthistory == "on") {
        echo "<BR /><B>WO Change History</B><BR /><table style=\"text-align: left;\" border=\"1\"
 cellpadding=\"2\" cellspacing=\"2\"><tbody>    <tr>
      <td>log id</td>
      <td>user</td>
      <td>change date</td>
      <td>changes</td>
    </tr>";
        $query = "SELECT * FROM wolog WHERE woid = \"$woid\"";
        $res = mysql_query ($query) or die ("error 10 on aux_funcs.php");
        while ($row = mysql_fetch_array($res)) {
            //just show ach line of the table here:
            echo "
    <tr>
        <td>".$row[0]."</td>
      <td>".$row[2]."</td>
      <td>".date("d/m/Y H:i", $row[3])."</td>
      <td>".$row[4]."</td>
    </tr>";
        }
        echo "    </tbody></table>";
    }
    
    if ($isservicereport == "on") echo "<br><CENTER>Service Report - Sig Supplier: ____________ Sign Auto: ____________ Supplier Job #: ____________ Date: ____________ Start Time: ____________ End Time:____________ </CENTER><br>";

echo "<table style=\"text-align: left; width: 100%;\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\" bgcolor=#0000FF><TR><TD></TD></TR></TABLE>";
}
?>

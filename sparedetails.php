<?php
//This page only shows up for admin users
//receives spares id number.
if (isset($_GET['format'])) $format = $_GET['format'];
else $format = "qq outra coisa";

if ($format == "frame"){
    echo "<html>
        <head>
            <title>Maintenance dB</title>
    <link type=\"text/css\" href=\"$root_dir/jqueryUI/css/redmond/jquery-ui-1.8.16.custom.css\" rel=\"stylesheet\" />	
    <script type=\"text/javascript\" src=\"$root_dir/jqueryUI/js/jquery-1.6.2.min.js\"></script>
    <script type=\"text/javascript\" src=\"$root_dir/jqueryUI/js/jquery-ui-1.8.16.custom.min.js\"></script>
    <style type=\"text/css\">
	body{ font: 80% \"Trebuchet MS\", sans-serif; margin: 50px;}
	.datepicker{ font: 65% \"Trebuchet MS\", sans-serif; margin: 50px;}
	.datepicker2{ font: 65% \"Trebuchet MS\", sans-serif; margin: 50px;}
	.demoHeaders { margin-top: 2em; }
	#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
	#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
	ul#icons {margin: 0; padding: 0;}
	ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
	ul#icons span.ui-icon {float: left; margin: 0 4px;}
	
	table, th
{
border:2px solid black;
border-collapse:collapse;
}

td
{
border:1px solid black;
border-collapse:collapse;
}

th
{
background-color:3399FF;
color:white;
}
</style><body>";
}
else require("header.php");

require("db.php");
//select this spare from database

if (isset($_GET['id'])) $sparesid = $_GET['id'];
else {
    echo "hum, there was a problem! 01";
    require("footer.php");
    die;
}

$query = "SELECT * FROM spares WHERE sparesid = $sparesid";
$result = mysql_query($query);

//if there was 0 hits, there was a problem with the id variable that was passed.
if (mysql_num_rows($result) == 0) {
    echo "hum, no spare found. Wrong id number. This shouldn't really happen and yet it did!";
    require("footer.php");
    die;
}
else{ 
    //extract spare part information from database:
    $sparesid = mysql_result($result,0,'sparesid');
    $sparesbrand = mysql_result($result,0,'sparesbrand');
    $sparesmodel = mysql_result($result,0,'sparesmodel');
    $sparesdescription = mysql_result($result,0,'sparesdescription');
    $sparesordernumber = mysql_result($result,0,'sparesordernumber');
    $sparesbarcode = mysql_result($result,0,'sparesbarcode');
    $spareisconsumable = mysql_result($result,0,'sparesisconsumable');
    $sparesquantity = mysql_result($result,0,'sparesquantity');
    $sparesminquantity = mysql_result($result,0,'sparesminquantity');
    $sparespiclocation = mysql_result($result,0,'sparespiclocation');
    $system = mysql_result($result,0,'system');
    $subsystem = mysql_result($result,0,'subsystem');
    $component = mysql_result($result,0,'component');
    $sparestorelocation = mysql_result($result,0,'sparestorelocation');
    $unitcost = mysql_result($result,0,'unitcost');
    $supplierphone = mysql_result($result,0,'supplierphone');
    $supplieremail = mysql_result($result,0,'supplieremail');
    $suppliername = mysql_result($result,0,'suppliername');
    $currency = mysql_result($result,0,'currency');
    $suppliername = mysql_result($result,0,'suppliername');
}

?>

<table style="text-align: left; width: 100%;" border="1"
 cellpadding="2" cellspacing="2">
  <tbody>
    <tr>
      <td style="text-align: center;"><span
 style="font-style: italic;">Spare id number: <?php echo $sparesid; ?> - click pic for larger image</span></td>
      <td style="text-align: center;"><span
 style="font-weight: bold;">Brand </span></td>
      <td style="text-align: center;"><span
 style="font-weight: bold;">Model</span></td>
      <td style="text-align: center;"><span
 style="font-weight: bold;">Supplier Name</span></td>
    </tr>
    <tr>
      <td style="text-align: center;" colspan="1"
 rowspan="10"><a href = "<?php echo "images/spares/$sparespiclocation";?>" target = "_blank">
 <img src = "<?php echo "images/spares/$sparespiclocation";?>" HEIGHT="120" WIDTH="80" BORDER="0"></a></td>
      <td style="text-align: center;"><?php echo $sparesbrand;?></td>
      <td style="text-align: center;"><?php echo $sparesmodel;?></td>
      <td style="text-align: center;"><?php echo $suppliername;?></td>
    </tr>
    <tr>
      <td style="font-weight: bold; text-align: center;">Description</td>
      <td style="text-align: center;"><span
 style="font-weight: bold;">Order Number</span></td>
      <td style="text-align: center;"><span
 style="font-weight: bold;">Supplier Email</span></td>
    </tr>
    <tr>
      <td style="text-align: center;" colspan="1"
 rowspan="2"><?php echo $sparesdescription;?></td>
      <td style="text-align: center;"><?php echo $sparesordernumber;?></td>
      <td style="text-align: center;"><?php echo $supplieremail;?></td>
    </tr>
    <tr>
      <td style="font-weight: bold; text-align: center;">Barcode</td>
      <td style="text-align: center;"><span
 style="font-weight: bold;">Supplier Phone</span></td>
    </tr>
    <tr>
      <td style="text-align: center;"><span
 style="font-weight: bold;">System</span></td>
      <td style="text-align: center;"><?php echo "$sparesbarcode";?></td>
      <td style="text-align: center;"><?php echo $supplierphone;?></td>
    </tr>
    <tr>
      <td style="text-align: center;"><?php echo $system;?></td>
      <td style="text-align: center;"><span
 style="font-weight: bold;">Qty In stock</span></td>
      <td style="font-weight: bold; text-align: center;">Unit
Cost <span style="font-weight: normal;">(<?php echo $currency;?>)</span></td>
    </tr>
    <tr>
      <td style="text-align: center;"><span
 style="font-weight: bold;">Subsystem</span></td>
      <td style="text-align: center;"><?php echo $sparesquantity;?></td>
      <td style="text-align: center;"><?php echo $unitcost;?></td>
    </tr>
    <tr>
      <td style="text-align: center;"><?php echo $subsystem;?></td>
      <td style="font-weight: bold; text-align: center;">Is
consumable? <span style="font-weight: normal;"><?php echo "$spareisconsumable";?></span></td>
      <td style="font-weight: bold; text-align: center;">Store
Location</td>
    </tr>
    <tr>
      <td style="text-align: center;"><span
 style="font-weight: bold;">Component</span></td>
      <td style="font-weight: bold; text-align: center;">Min
Qty</td>
      <td style="text-align: center;"><?php echo $sparestorelocation;?></td>
    </tr>
    <tr>
      <td style="text-align: center;"><?php echo $component;?></td>
      <td style="text-align: center;"><?php echo $sparesminquantity;?></td>
      <td style="text-align: center;"></td>
    </tr>
  </tbody>
</table>

<?php
if ($format != "frame") echo "<form method =\"post\" action=\"sparesprocess.php?op=updt\" style='margin: 0; padding: 0'>";
else echo "<form method =\"post\" action=\"sparesprocess.php?op=mrev&format=frame\" style='margin: 0; padding: 0'>";
echo "used ";
echo "<select name = \"num_spares_used\">";
for ($i = 1; $i <= $sparesquantity; $i++){
    echo "<option>$i</option>";
}
echo "</select>";
echo "units of this spare were used on WO#";
if ($format != "frame") echo "<input type = \"text\" name = \"wonumber\">";
else {
    echo "$woid";
    echo "<input type =\"hidden\" name = \"wonumber\" value = \"$woid\">";
}
echo "<input type =\"hidden\" name = \"sparesid\" value = \"$sparesid\">";
echo "<input type = \"submit\">";

//If user is admin, he/ she can update the spare information:
//also, this next table does not show up on the frame display of this page
if ($format != "frame"){//display update part info table and form to admin user
    
    if (extract_user_level($_SESSION['valid_user']) == "admin"){
        echo "<H1>Edit Spare Information</H1>";
        //START EDITING TABLE
        echo "<form method =\"post\"  action=\"sparesprocess.php?op=updt\" style='margin: 0; padding: 0'>";
        
        echo "Brand: ";
        echo "<input type=\"text\" name = \"sparesbrand\" value=\"$sparesbrand\">";
        
        echo "<BR>Model: ";
        echo "<input type=\"text\" name = \"sparesmodel\" value=\"$sparesmodel\">";
        
        echo "<BR>Description: ";
        echo "<input type=\"text\" name = \"sparesdecription\" value=\"$sparesdescription\">";
        
        echo "<BR>Order Number: ";
        echo "<input type=\"text\" name = \"sparesordernumber\" value=\"$sparesordernumber\">";
        
        echo "<BR>Barcode: ";
        echo "<input type=\"text\" name = \"sparesbarcode\" value=\"$sparesbarcode\">";
        
        echo "<BR>Quantity: ";
        echo "<input type=\"text\" name = \"sparesquantity\" value=\"$sparesquantity\">";
        
        echo "<BR>Minimum Quantity (for reorder flag): ";
        echo "<input type=\"text\" name = \"sparesminquantity\" value=\"$sparesminquantity\">";
        
        echo "<BR>Picture Location: ";
        echo "<input type=\"text\" name = \"sparespiclocation\" value=\"$sparespiclocation\">";
        
        echo "<BR>Store Location: ";
        echo "<input type=\"text\" name = \"sparestorelocation\" value=\"$sparestorelocation\">";
        
        echo "<BR>Supplier Name: ";
        echo "<input type=\"text\" name = \"suppliername\" value=\"$suppliername\">";
        
        echo "<BR>Supplier Email: ";
        echo "<input type=\"text\" name = \"supplieremail\" value=\"$supplieremail\">";
        
        echo "<BR>Supplier Phone: ";
        echo "<input type=\"text\" name = \"supplierphone\" value=\"$supplierphone\">";
        
        echo "<BR>Unit Cost: ";
        echo "<input type=\"text\" name = \"unitcost\" value=\"$unitcost\">";

        echo "<BR>Currency: ";
        echo "<input type=\"text\" name = \"currency\" value=\"$currency\">";
        
        echo "<BR>System: ";
        echo "<select name=\"system\">";
        echo "<option>$system</option>";
        list_restricted_table_entries("lv2","<option>","</option>",1,0, "lv2name != \"$system\"");
        echo "</select>";

        echo "<BR>Subsystem: ";
        echo "<select name=\"subsystem\">";
        echo "<option>$subsystem</option>";
        list_restricted_table_entries("lv5","<option>","</option>",1,0, "lv5name != \"$subsystem\"");
        echo "</select>";

        echo "<BR>Component: ";
        echo "<select name=\"component\">";
        echo "<option>$component</option>";
        list_restricted_table_entries("lv7","<option>","</option>",1,0, "lv7name != \"$component\"");
        echo "</select>";
        
        echo "<BR><input type=\"checkbox\" name=\"disable\" value=\"Y\" />Disable Spare<br /> - Note: you cannot enable a previously disabled spare!";
        
        echo "<input type = \"hidden\" name =\"sparesid\" value =\"$sparesid\">";
        
        echo "<BR>";
        echo "<input type=\"submit\" name = \"submit\" value=\"update\">";
        
        echo "</form>";
        //END SPARE EDITING TABLE
    }
}


if ($format == "frame") { if (isset($link)) mysql_close($link);}
else require("footer.php");
?>

<?php
//spare part management. Create, edit and disable spare.
if (isset($_GET['format'])) $format = $_GET['format'];
else $format = "qq outra coisa";

if (isset($_GET['woid'])) $woid = $_GET['woid'];
else $woid = "qq outra coisa";

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
//require("config/aux_funcs.php");

if ( $_GET['op'] == "lst" ){
    //lists all spares for a given system, with the option to go inside
    //the parts' page:
    //What system are we talking about?
    if (!isset($_POST['system'])) $system = $_GET['system'];
    else $system = $_POST['system'];
    
    if ($format != "frame") echo "<H1>Listing all spares for the $system system</H1>";
    else {}
    //check database, extract all spares for that system
    $query = "SELECT * FROM spares WHERE system LIKE \"$system\" AND active NOT LIKE \"Y\"";
    $result = mysql_query($query);
    
    if (mysql_num_rows($result) == 0) echo "No spares defined on database for this system.";
    
    //build table with a link for each spare with the spare id and send to this page with op=spr
    while ($row = mysql_fetch_array($result)){
        echo "<table style=\"text-align: left; width: 100%; height: 136px;\" border=\"1\" cellpadding=\"2\" cellspacing=\"2\">
        <tbody>
        <tr>
            <td colspan=\"1\" rowspan=\"4\"><center><a href=\"images/spares/".$row[10]."\" target =\"_blank\"><img src =\"images/spares/".$row[10]."\" HEIGHT=\"120\" WIDTH=\"80\" BORDER=\"0\"></a><center></td>
            <td style=\"font-weight: bold; text-align: center;\">#</td>
            <td style=\"font-weight: bold; text-align: center;\">Brand</td>
            <td style=\"font-weight: bold; text-align: center;\">Model</td>
            <td style=\"font-weight: bold; text-align: center;\">Description</td>
            <td style=\"font-weight: bold; text-align: center;\">Order Number</td>
            <td style=\"font-weight: bold; text-align: center;\">Barcode</td>
        </tr>
        <tr>
            <td style=\"text-align: center;\">".$row['sparesid']."</td>
            <td style=\"text-align: center;\">".$row['sparesbrand']."</td>
            <td style=\"text-align: center;\">".$row['sparesmodel']."</td>
            <td style=\"text-align: center;\">".$row['sparesdescription']."</td>
            <td style=\"text-align: center;\">".$row['sparesordernumber']."</td>
            <td style=\"text-align: center;\">".$row['sparesbarcode']."</td>
        </tr>
        <tr>
            <td style=\"font-weight: bold; text-align: center;\">Qty in Stock (min)</td>
            <td style=\"font-weight: bold; text-align: center;\">Storage Loc.</td>
            <td style=\"font-weight: bold; text-align: center;\">System</td>
            <td style=\"font-weight: bold; text-align: center;\">SubSystem</td>
            <td style=\"font-weight: bold; text-align: center;\">Component</td>";
            if ($format != "frame")
                echo "<td style= \"text-align: center;\"><a href = \"sparedetails.php?id=".$row['sparesid']."\">View Details</a></td>";
            else echo "<td style= \"text-align: center;\"><a href = \"sparedetails.php?id=".$row['sparesid']."&format=frame&woid=$woid\">View Details</a></td>";
            echo"
        </tr>
        <tr>
            
            <td style=\"font-weight: bold; text-align: center; \"><font color =\"red\">".$row['sparesquantity']." (".$row['sparesminquantity'].")</font></td>
            <td style=\"text-align: center;\">".$row['sparestorelocation']."</td>
            <td style=\"text-align: center;\">".$row['system']."</td>
            <td style=\"text-align: center;\">".$row['subsystem']."</td>
            <td style=\"text-align: center;\">".$row['component']."</td>
            <td></td>
        </tr>
        </tbody>
        </table><BR />";
    }

}

else if ( $_GET['op'] == "rdr" ){
    //show list of spares that have their stock at lower than the re-order number
    //with option to do something about this
    
}

else if ( $_GET['op'] == "new" ){
    //add new spare
    echo "<h1>Add New Spare</h1>";
    //******
        //START EDITING TABLE
        echo "<form method =\"post\"  action=\"sparesprocess.php?op=new\" style='margin: 0; padding: 0'>";
        
        echo "Brand: ";
        echo "<input type=\"text\" name = \"new_brand\">";
        
        echo "<BR>Model: ";
        echo "<input type=\"text\" name = \"new_model\">";
        
        echo "<BR>Description: ";
        echo "<input type=\"text\" name = \"new_description\">";
        
        echo "<BR>Order Number: ";
        echo "<input type=\"text\" name = \"new_ordernumber\">";
        
        echo "<BR>Barcode: ";
        echo "<input type=\"text\" name = \"new_barcode\">";
        
        echo "<BR>Quantity: ";
        echo "<input type=\"text\" name = \"new_quantity\">";
        
        echo "<BR>Minimum Quantity (for reorder flag): ";
        echo "<input type=\"text\" name = \"new_minquantity\">";
        
        echo "<BR>Picture Location: ";
        echo "<input type=\"text\" name = \"new_piclocation\"> currently simply write file name with extension and email image files to Rui.";
        
        echo "<BR>Store Location: ";
        echo "<input type=\"text\" name = \"new_storelocation\">";
        
        echo "<BR>Supplier Name: ";
        echo "<input type=\"text\" name = \"new_suppliername\">";
        
        echo "<BR>Supplier Email: ";
        echo "<input type=\"text\" name = \"new_supplieremail\">";
        
        echo "<BR>Supplier Phone: ";
        echo "<input type=\"text\" name = \"new_supplierphone\">";
        
        echo "<BR>Unit Cost: ";
        echo "<input type=\"text\" name = \"new_unitcost\">";

        echo "<BR>Currency: ";
        echo "<input type=\"text\" name = \"new_currency\">";
        
        echo "<BR>System: ";
        echo "<select name=\"new_system\">";
        list_table_entries("lv2","<option>","</option>",1,0);
        echo "</select>";

        echo "<BR>Subsystem: ";
        echo "<select name=\"new_subsystem\">";
        list_table_entries("lv5","<option>","</option>",1,0);
        echo "</select>";

        echo "<BR>Component: ";
        echo "<select name=\"new_component\">";
        list_table_entries("lv7","<option>","</option>",1,0);
        echo "</select>";
        
        echo "<BR>";
        echo "<input type=\"submit\" name = \"submit\" value=\"add part\">";
        
        echo "</form>";
    //******
}

else if ( $_GET['op'] == "mng" ){
    //see list of spares that need their usage on WO approved:
    //go to the sparelog table and get all the entries that are tagged as "needs revision":
    //make a loop with a form to accept or reject the amount used; the amount can be adjusted
    
    echo "<h1>Spare Usage Waiting Approval</h1>";
    $query = "SELECT * FROM spareslog WHERE needsrevision = \"Y\"";
    $result = mysql_query($query) or die();
    
    echo "<table style=\"text-align: left; width: 100%; height: 136px;\" border=\"1\" cellpadding=\"2\" cellspacing=\"2\">";
    echo "<tr>";
        echo "<td>";
        echo "<B>";
        echo "Date of Stock Move";
        echo "</B>";
        echo "</td>";
        echo "<td>";
        echo "<B>";
        echo "Spare Info";
        echo "</B>";
        echo "</td>";
        echo "<td>";
        echo "<B>";
        echo "Used on WO#:";
        echo "</B>";
        echo "</td>";
        echo "<td>";
        echo "<B>";
        echo "Quantity Used</B>";
        echo "</B>";
        echo "</td>";
        echo "<td>";
        echo "<B>";
        echo "Action";
        echo "</B>";
        echo "</td>";
    echo "</tr>";
    
    while ($row = mysql_fetch_array($result)){
        
        echo "<tr>";
        echo "<form method =\"post\" action=\"sparesprocess.php?op=cfm\" style='margin: 0; padding: 0'>";
        echo "<td>";
        $date = $row['entrydate'];
        $date = date('l\, jS \of F Y h:i:s A',$date);
        echo $date;
        echo "</td>";
        echo "<td>";
        
        $query2 = "SELECT * FROM spares WHERE sparesid = ".$row[2]."";
        $result2 = mysql_query($query2);
        $sparesid = mysql_result($result2,0,'sparesid');
        $sparesbrand = mysql_result($result2,0,'sparesbrand');
        $sparesmodel = mysql_result($result2,0,'sparesmodel');
        $sparesdescription = mysql_result($result2,0,'sparesdescription');
        
        echo "<B>ID:</B> <A HREF=\"sparedetails.php?id=$sparesid\">$sparesid</A><BR>";
        echo "<B>BRAND:</B> $sparesbrand<BR>";
        echo "<B>MODEL:</B> $sparesmodel<BR>";
        echo "<B>DESCR:</B> $sparesdescription<BR>";
        
        echo "</td>";
        echo "<td>";
        echo "<a href=\"printorder.php?p=".$row[3]."\">".$row[3]."</a>";
        echo "</td>";
        echo "<td>";
        echo $row[6];
        echo "</td>";
        echo "<td>";
        echo "<input type=\"hidden\" name=\"quantity\" value=\"".$row[6]."\">";
        echo "<input type=\"hidden\" name=\"sparesid\" value=\"".$row[2]."\">";
        echo "<input type=\"hidden\" name=\"entryid\" value=\"".$row[0]."\">";
        echo "<input type=\"submit\" name=\"button\" value=\"accept\">";
        echo "<input type=\"submit\" name=\"button\" value=\"cancel\">";        
        echo "</td>";
        echo "</form>";
        echo "</tr>";
           
    }
    
    echo "</table>";
    
    //see list of spares that are below the reordering quantity:
    echo "<h1>Spares Below Re-ordering Level</h1>";
    $query = "SELECT * FROM spares WHERE sparesquantity < sparesminquantity";
    $result = mysql_query($query);
    
        while ($row = mysql_fetch_array($result)){
        echo "<table style=\"text-align: left; width: 100%; height: 136px;\" border=\"1\" cellpadding=\"2\" cellspacing=\"2\">
        <tbody>
        <tr>
            <td colspan=\"1\" rowspan=\"4\"><center><a href=\"images/spares/".$row[10]."\" target =\"_blank\"><img src =\"images/spares/".$row[10]."\" HEIGHT=\"120\" WIDTH=\"80\" BORDER=\"0\"></a><center></td>
            <td style=\"font-weight: bold; text-align: center;\">#</td>
            <td style=\"font-weight: bold; text-align: center;\">Brand</td>
            <td style=\"font-weight: bold; text-align: center;\">Model</td>
            <td style=\"font-weight: bold; text-align: center;\">Description</td>
            <td style=\"font-weight: bold; text-align: center;\">Order Number</td>
            <td style=\"font-weight: bold; text-align: center;\">Barcode</td>
        </tr>
        <tr>
            <td style=\"text-align: center;\">".$row['sparesid']."</td>
            <td style=\"text-align: center;\">".$row['sparesbrand']."</td>
            <td style=\"text-align: center;\">".$row['sparesmodel']."</td>
            <td style=\"text-align: center;\">".$row['sparesdescription']."</td>
            <td style=\"text-align: center;\">".$row['sparesordernumber']."</td>
            <td style=\"text-align: center;\">".$row['sparesbarcode']."</td>
        </tr>
        <tr>
            <td style=\"font-weight: bold; text-align: center;\">Qty in Stock (min)</td>
            <td style=\"font-weight: bold; text-align: center;\">Storage Loc.</td>
            <td style=\"font-weight: bold; text-align: center;\">System</td>
            <td style=\"font-weight: bold; text-align: center;\">SubSystem</td>
            <td style=\"font-weight: bold; text-align: center;\">Component</td>";
            if ($format != "frame")
                echo "<td style= \"text-align: center;\"><a href = \"sparedetails.php?id=".$row['sparesid']."\">View Details</a></td>";
            else echo "<td style= \"text-align: center;\"><a href = \"sparedetails.php?id=".$row['sparesid']."&format=frame&woid=$woid\">View Details</a></td>";
            echo"
        </tr>
        <tr>
            
            <td style=\"font-weight: bold; text-align: center; \"><font color =\"red\">".$row['sparesquantity']." (".$row['sparesminquantity'].")</font></td>
            <td style=\"text-align: center;\">".$row['sparestorelocation']."</td>
            <td style=\"text-align: center;\">".$row['system']."</td>
            <td style=\"text-align: center;\">".$row['subsystem']."</td>
            <td style=\"text-align: center;\">".$row['component']."</td>
            <td></td>
        </tr>
        </tbody>
        </table><BR />";
    }
}

else {
    //What does the user want to do?
    //1. Find all spares from a given system:
    if ($format == "frame")
        echo "<form method =\"post\"  action=\"?op=lst&format=frame&woid=$woid\" style='margin: 0; padding: 0'>List all the spares from ";
    else
        echo "<form method =\"post\"  action=\"?op=lst\" style='margin: 0; padding: 0'>List all the spares from ";
        
    echo "<select name = \"system\">";
    if ($format == "frame")
        require("config/aux_funcs.php");
    list_restricted_table_entries("lv2","<option>","</option>", 1, -1,"lv2description !=\"NA\" ORDER BY lv2description ASC");
    echo "</select>";
    echo "<input type =\"submit\">";
    echo "</form>";
    
    //if username is admin level, allow for adding new spare:
    if ($format != "frame"){
        if (extract_user_level($_SESSION['valid_user']) == "admin"){
            echo "<a href=\"?op=new\">Add New Spare</a>";
            echo "<BR><a href=\"?op=mng\">Manage Spares Usage</a>";
        }
    }
}
if ($format == "frame") { if (isset($link)) mysql_close($link);}
else require("footer.php");
?>

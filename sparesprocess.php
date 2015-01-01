<?php
//sparesprocess.php - adds qty, deletes qty, shows spares lists that need attention

//Get operation type:
if (!isset ($_GET['op'])) $op = "nada";
else $op = $_GET['op'];

if (isset ($_GET['format'])) $format = $_GET['format'];
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

if ($op == "mrev"){
    //part was used on a WO; update spareslog for that part
    //get data:

    $spares_id = $_POST["sparesid"];
    $num_spares_used = $_POST["num_spares_used"];
    $woid = $_POST["wonumber"];
    
    //update spareslog, say it was marked for revision:
    //later, for the same spare number, we see the last entry of the log
    //if "marked for revision" is Y, it shows up on the list that need attention
    //Y is then changed to N when the number of parts is approved by admin
    $time = time();
    $query = "INSERT INTO spareslog (entrydate,sparesid,woid,needsrevision,movement,quantity) VALUES (\"$time\",\"$spares_id\",\"$woid\",\"Y\",\"OUT\",\"$num_spares_used\")";
    $result = mysql_query($query) or die(mysql_error());
    
    //update actual quantity on spares table (temporarily the spares indicated as used will not be available.
    //later if admin or user puts then back, the right quantity is updated
    //also if further spares are used for other orders before final admin update of spares count,
    //they are already not available in the system
    
    //how many spare we had?
    $query = "SELECT * FROM spares WHERE sparesid = $spares_id";
    $result = mysql_query($query) or die();
    $previousquantity = mysql_result($result,0,"sparesquantity");
    $currentquantity = $previousquantity - $num_spares_used;
    
    $query = "UPDATE spares SET sparesquantity = $currentquantity WHERE sparesid = $spares_id";
    $result = mysql_query($query) or die(mysql_error());
    
    echo "Spares quantity updated. <a href = \"spares.php?format=frame&woid=$woid\">back to main system spares list</a>.";
    
}

else if ($op == "updt"){
    //Update spares information (info should come from sparedetails.php)
    //$new_system, $new_subsystem, $new_component, $sparesid
    $sparesbrand = $_POST['sparesbrand'];
    $sparesbrand = filter_var($sparesbrand,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $sparesmodel = $_POST['sparesmodel'];
    $sparesmodel = filter_var($sparesmodel,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $sparesdescription = $_POST['sparesdescription'];
    $sparesdescription = filter_var($sparesdescription,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $sparesordernumber = $_POST['sparesordernumber'];
    $sparesordernumber = filter_var($sparesordernumber,FILTER_SANITIZE_SPECIAL_CHARS);

    $sparesbarcode = $_POST['sparesbarcode'];
    $sparesbarcode = filter_var($sparesbarcode,FILTER_SANITIZE_SPECIAL_CHARS);

    $sparesquantity = $_POST['sparesquantity'];
    $sparesquantity = filter_var($sparesquantity,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $sparesminquantity = $_POST['sparesminquantity'];
    $sparesminquantity = filter_var($sparesminquantity,FILTER_SANITIZE_SPECIAL_CHARS);

    $sparestorelocation = $_POST['sparestorelocation'];
    $sparestorelocation = filter_var($sparestorelocation,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $sparespiclocation = $_POST['sparespiclocation'];
    $sparespiclocation = filter_var($sparespiclocation,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $suppliername = $_POST['suppliername'];
    $suppliername = filter_var($suppliername,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $supplieremail = $_POST['supplieremail'];
    $supplieremail = filter_var($supplieremail,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $supplierphone = $_POST['supplierphone'];
    $supplierphone = filter_var($supplierphone,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $unitcost = $_POST['unitcost'];
    $unitcost = filter_var($unitcost,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $currency = $_POST['currency'];
    $currency = filter_var($currency,FILTER_SANITIZE_SPECIAL_CHARS);

    $system = $_POST['system'];
    
    $subsystem = $_POST['subsystem'];

    $component = $_POST['component'];
    
    $disable = $_POST['disable'];
    
    $sparesid = $_POST['sparesid'];
    
    //replace all the information on the database with the new info:
    $query = "UPDATE spares SET sparesbrand = \"$sparesbrand\",sparesmodel=\"$sparesmodel\",sparesdescription=\"$sparesdecription\",sparesordernumber=\"$sparesordernumber\",sparesbarcode=\"$sparesbarcode\",sparesquantity=$sparesquantity,sparesminquantity=$sparesminquantity,sparespiclocation=\"$sparespiclocation\",sparestorelocation=\"$sparestorelocation\",suppliername=\"$suppliername\",supplieremail=\"$supplieremail\",supplierphone=\"$supplierphone\",unitcost=\"$unitcost\",currency=\"$currency\",system=\"$system\",subsystem=\"$subsystem\",component=\"$component\", active=\"$disable\" WHERE sparesid = $sparesid";
    
    $result = mysql_query($query) or die(mysql_error());
    
    if ($disable == "Y") echo "Spare has been disabled, <a href=\"spares.php\">click here</a> to return to the main spares page.";
    else echo "<BR>Information for spare number $sparesid has been updated. <a href=\"sparedetails.php?id=$sparesid&format=none\">Return</a> to spare details page.<BR>";
}

else if ($op == "new"){

    $sparesbrand = $_POST['new_brand'];
    $sparesbrand = filter_var($sparesbrand,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $sparesmodel = $_POST['new_model'];
    $sparesmodel = filter_var($sparesmodel,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $sparesdescription = $_POST['new_description'];
    $sparesdescription = filter_var($sparesdescription,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $sparesordernumber = $_POST['new_ordernumber'];
    $sparesordernumber = filter_var($sparesordernumber,FILTER_SANITIZE_SPECIAL_CHARS);

    $sparesbarcode = $_POST['new_barcode'];
    $sparesbarcode = filter_var($sparesbarcode,FILTER_SANITIZE_SPECIAL_CHARS);

    $sparesquantity = $_POST['new_quantity'];
    $sparesquantity = filter_var($sparesquantity,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $sparesminquantity = $_POST['new_minquantity'];
    $sparesminquantity = filter_var($sparesminquantity,FILTER_SANITIZE_SPECIAL_CHARS);

    $sparestorelocation = $_POST['new_storelocation'];
    $sparestorelocation = filter_var($sparestorelocation,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $sparespiclocation = $_POST['new_piclocation'];
    $sparespiclocation = filter_var($sparespiclocation,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $suppliername = $_POST['new_suppliername'];
    $suppliername = filter_var($suppliername,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $supplieremail = $_POST['new_supplieremail'];
    $supplieremail = filter_var($supplieremail,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $supplierphone = $_POST['new_supplierphone'];
    $supplierphone = filter_var($supplierphone,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $unitcost = $_POST['new_unitcost'];
    $unitcost = filter_var($unitcost,FILTER_SANITIZE_SPECIAL_CHARS);
    
    $currency = $_POST['new_currency'];
    $currency = filter_var($currency,FILTER_SANITIZE_SPECIAL_CHARS);

    $system = $_POST['new_system'];
    
    $subsystem = $_POST['new_subsystem'];

    $component = $_POST['new_component'];
    
    //replace all the information on the database with the new info:
    $query = "INSERT INTO spares (sparesbrand,sparesmodel,sparesdescription,sparesordernumber,sparesbarcode,sparesquantity,sparesminquantity,sparespiclocation,sparestorelocation,suppliername,supplieremail,supplierphone,unitcost,currency,system,subsystem,component) VALUES (\"$sparesbrand\",\"$sparesmodel\",\"$sparesdescription\",\"$sparesordernumber\",\"$sparesbarcode\",\"$sparesquantity\",\"$sparesminquantity\",\"$sparespiclocation\",\"$sparestorelocation\",\"$suppliername\",\"$supplieremail\",\"$supplierphone\",\"$unitcost\",\"$currency\",\"$system\",\"$subsystem\",\"$component\")";
    
    $result = mysql_query($query) or die(mysql_error());
    
    echo "<BR>Spare added to database. <a href=\"spares.php\">Return</a> to spare details page.<BR>";
}

else if ($op == "cfm"){
    //Extract the information that was sent to this file:
    //spareid
    $sparesid = $_POST['sparesid'];
    //quantity used
    $quantityused = $_POST['quantity'];
    //entryid of the spareslog table this request refers to
    $entryid = $_POST['entryid'];
    //wich button was pressed?
    $button = $_POST['button'];
    
    if ($button == "accept"){
        //EXTRACT EXISTING QUANTITY SO WE CAN SUBTRACT THE AMOUNT USED IN THE ORDER:
        $query = "SELECT * FROM spares WHERE sparesid = $sparesid";
        $result = mysql_query($query) or die("ERROR1: ".mysql_error()."");
        $updated_amount = mysql_result($result,0,'sparesquantity') - $quantityused;
        //Admin has confirmed that the parts were ok to be used, so deduct quantity of the spare from stock:
        $query = "UPDATE spares SET sparesquantity=$updated_amount WHERE sparesid = $sparesid";
        $result = mysql_query($query) or die("ERROR2: ".mysql_error()."");
        $time = time();
        
        //change the entry "needs revision" to N on spareslog table
        $query = "UPDATE spareslog SET needsrevision = \"N\", datechanged = $time, actions = \"$button\" WHERE entryid = \"$entryid\"";
        $result = mysql_query($query) or die("ERROR3: ".mysql_error()."");
        
        echo "Done! Spare $sparesid changes accepted. <a href = \"spares.php?op=mng\">Back to list</a>.";
    }
    else if ($button == "cancel"){
        //cancel button pressed. Add this quantity to spares, not used after all.
        //in sapreslog table change needs revision to N; change movement to IN
        //EXTRACT EXISTING QUANTITY SO WE CAN SUBTRACT THE AMOUNT USED IN THE ORDER:
        $query = "SELECT * FROM spares WHERE sparesid = $sparesid";
        $result = mysql_query($query) or die("ERROR4: ".mysql_error()."");
        $updated_amount = mysql_result($result,0,'sparesquantity') + $quantityused;
        //Admin has confirmed that the parts were ok to be used, so deduct quantity of the spare from stock:
        $query = "UPDATE spares SET sparesquantity=$updated_amount WHERE sparesid = $sparesid";
        $result = mysql_query($query) or die("ERROR5: ".mysql_error()."");
        $time = time();
        
        //change the entry "needs revision" to N on spareslog table
        $query = "UPDATE spareslog SET needsrevision = \"N\",datechanged = $time, actions = \"$button\" WHERE entryid = \"$entryid\"";
        $result = mysql_query($query) or die("ERROR6: ".mysql_error()."");
        
        echo "Done! Spare $sparesid changes canceled. <a href = \"spares.php?op=mng\">Back to list</a>.";
        
    }
    //OR if the cancel button is pressed, add the number of parts again
    
}

if ($format == "frame") { if (isset($link)) mysql_close($link);}
else require("footer.php");
?>

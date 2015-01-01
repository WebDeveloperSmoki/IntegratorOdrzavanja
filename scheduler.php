<?php
//call this file to analyze the maintenance plans table
// and generate all WO (calling createwo.php with the required data
//defined on the maintenance plan table)

//should be called using cron from the local machine or from another
//always on machine (bad for security...)

//UPDATE (the following commented lines are from createwo_x.php:
//This file is the same as creastewo.php but is called by the 
//maintenance plan scheduler file. The only difference to
//createwo.php is there's no requires header.php because
//the file will not run autoamtically because no user is logged in.
//THEREFORE this createwo_x.php can be ran by any user at any time,
//logged inb or not. THIS IS OBVIOUSLY NOT GOOD!

require("db.php");
require("config/config.php");

//get current time
$current_time = time();

//for each entry on the maintenanceplan table,
$query = "SELECT * FROM maintenanceplans";
$res = mysql_query($query) or die (mysql_error());

while ($row = mysql_fetch_array($res)) {
    //printf("next order time: %s", $row[20]);
    //if nextordertime < current time,
    $coiso = $row['nextordertime'];
    echo "$coiso - $current_time<BR />";
    
    if ($row['nextordertime'] <= $current_time){
        //echo "we have to generate another order for MP # ".$row[0]."";
        
        $nextordertime = $row['nextordertime'];
        //1. extract information from maintenance plan database and place it in the appropriate named variables
        //may need to check all the other tables and convert indexes to text or int
        $wocreatedate = time();
        //$mplannumber = $row[0];
        $wocreatedby = $row['wocreatedby'];
        $wotype = $row['wotype'];
        $wopriority = $row['wopriority'];
        $wolv0 = $row['wolv0'];
        $wolv1 = $row['wolv1'];
        $wolv2 = $row['wolv2'];
        $wolv3 = $row['wolv3'];
        $wolv4 = $row['wolv4'];
        $wolv5 = $row['wolv5'];
        $wolv6 = $row['wolv6'];
        $wolv7 = $row['wolv7'];
        $wosummary = $row['wosummary'];
        $wodescription = $row['wodescription'];
        $wostatus = $row['wostatus'];
        $woassignedto = $row['woassignedto'];
        $womodifieddate = time();
        $wodocument = $row['wodocument'];
        $wosafetydocument = $row['wosafetydocument'];
        $action = "mp";
        //2. call createwo.php posting the variables (USES CURL)

//****************************************************************************************    
    //set POST variables
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"$root_dir/createwo_x.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "wocreatedate=$wocreatedate&wocreatedby=$wocreatedby&wotype=$wotype&wopriority=$wopriority&lv0=$wolv0&lv1=$wolv1&lv2=$wolv2&lv3=$wolv3&lv4=$wolv4&lv5=$wolv5&lv6=$wolv6&lv7=$wolv7&wosummary=$wosummary&wodescription=$wodescription&wostatus=$wostatus&woassignedto=$woassignedto&womodifieddate=$womodifieddate&wodocument=$wodocument&wosafetydocument=$wosafetydocument&action=$action");

    // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);

        curl_close ($ch);
               
    //update nextordertime and lastwotime
        echo "$server_output";
        //1. Get interval between orders from mpperiodicity (row[18] contains the periodicity in text):
        $periodicity = $row[18];
        
        $query = "SELECT * FROM mpperiodicity WHERE mpperiodicityname = \"$periodicity\"";
        $res_2 = mysql_query($query);
        $period = mysql_result($res_2,0,"mpperiodicityunixtimegap");
        
        
        $nextordertime = $nextordertime + $period;
        $mpid = $row[0];
        //input the updated next order date on the datababse:
        $query = "UPDATE maintenanceplans SET nextordertime = \"$nextordertime\" WHERE woid = \"$mpid\"";
        $res_3 = mysql_query($query) or die ("could not insert on database");
    }

}

//get all variable values that are required to generate the order and
//call createwo.php with the POST variables and generate the order

?>

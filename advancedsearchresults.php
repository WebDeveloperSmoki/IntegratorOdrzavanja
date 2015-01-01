<?php
//searchresults.php
require("header.php");
require("db.php");
//WO search results code

//extract query $q variable
$searchtype = $_GET['q'];
//1 = List of all open orders (organized by user)

if ($searchtype == 2){

    echo "<H1>Dark Jobs List</H1>";
    $query = "SELECT * FROM maintenanceplans WHERE wosummary LIKE \"%[FEB DARK]%\"";
    $result_feb = mysql_query($query);
    $query = "SELECT * FROM maintenanceplans WHERE wosummary LIKE \"%[JUNE DARK]%\"";
    $result_june = mysql_query($query);
    $query = "SELECT * FROM maintenanceplans WHERE wosummary LIKE \"%[OCT DARK]%\"";
    $result_oct = mysql_query($query);
    
    echo "<!-- Tabs -->
		<div id=\"tabs\">
			<ul>
				<li><a href=\"#tabs-1\">February</a></li>
				<li><a href=\"#tabs-2\">June</a></li>
				<li><a href=\"#tabs-3\">October</a></li>
			</ul>";
    
    /************************************************/
    echo "<div id=\"tabs-1\">";
    while ($row = mysql_fetch_array($result_feb)) {
        //wopriority
            
            echo "<table style=\"text-align: left; width: 100%;\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\"> <tbody>";
            
            echo "<tr>
      <th style=\"text-align: center;\">WO Number</th>
      <th style=\"text-align: center;\">WO Date</th>
      <th style=\"text-align: center;\">WO Type</th>
      <th style=\"text-align: center;\">WO Priority</th>
      <th style=\"text-align: center;\">0</th>
      <th>1</th>
      <th style=\"text-align: center;\">System</th>
      <th style=\"text-align: center;\">Flr</th>
      <th style=\"text-align: center;\">Quad</th>
      <th style=\"text-align: center;\">Subsystem</th>
      <th style=\"text-align: center;\">Exp</th>
      <th style=\"text-align: center;\">Component</th>
      <th style=\"text-align: center;\">WO Status</th>
      <th></th>
            </tr>
            <tr>
            <td style=\"text-align: center;\">";
      
            //woid
            echo "".$row[0]."";      
            echo "</td>
            <td style=\"text-align: center;\">";
      
            //wocreatedate
            $wocreatedate = date("d/m/Y H:i", $row[1]);
            echo "$wocreatedate";
      
            echo "</td><td style=\"text-align: center;\">";
      
      echo "$row[3]";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      echo "$row[4]";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      //wolv0
      echo "$row[5]";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      //wolv1
      echo "$row[6]";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv2
      echo "$row[7]";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv3
      echo "$row[8]";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv4
      echo "$row[9]";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv5
      echo "$row[10]";
            
      echo" </td>
      <td style=\"text-align: center;\">";
      
      //wolv6
      echo "$row[11]";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv7
      echo "$row[12]";
            
      echo" </td>
      <td style=\"text-align: center;\">";
      
      //wostatus
      //echo "$row[15]";
      echo "NOT ISSUED";
      
      echo "</td>
      <td></td>
    </tr>
    <tr>
      <td style=\"text-align: right;\">Summary</td>
      <td colspan=\"12\" rowspan=\"1\">";
      
      //wosummary</td>
      $wossummary = $row[13];
      echo "$wossummary";      
      
      
      echo" </td><td></td>
    </tr>
  </tbody>
</table><BR>";
    }
    echo "</div>";
    
    /**********************************************/
    
        echo "<div id=\"tabs-2\">";
    while ($row = mysql_fetch_array($result_june)) {
        //wopriority
            
            echo "<table style=\"text-align: left; width: 100%;\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\"> <tbody>";
            
            echo "<tr>
      <th style=\"text-align: center;\">WO Number</th>
      <th style=\"text-align: center;\">WO Date</th>
      <th style=\"text-align: center;\">WO Type</th>
      <th style=\"text-align: center;\">WO Priority</th>
      <th style=\"text-align: center;\">0</th>
      <th>1</th>
      <th style=\"text-align: center;\">System</th>
      <th style=\"text-align: center;\">Flr</th>
      <th style=\"text-align: center;\">Quad</th>
      <th style=\"text-align: center;\">Subsystem</th>
      <th style=\"text-align: center;\">Exp</th>
      <th style=\"text-align: center;\">Component</th>
      <th style=\"text-align: center;\">WO Status</th>
      <th></th>
            </tr>
            <tr>
            <td style=\"text-align: center;\">";
      
            //woid
            echo "".$row[0]."";      
            echo "</td>
            <td style=\"text-align: center;\">";
      
            //wocreatedate
            $wocreatedate = date("d/m/Y H:i", $row[1]);
            echo "$wocreatedate";
      
            echo "</td><td style=\"text-align: center;\">";
      
      echo "$row[3]";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      echo "$row[4]";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      //wolv0
      echo "$row[5]";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      //wolv1
      echo "$row[6]";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv2
      echo "$row[7]";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv3
      echo "$row[8]";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv4
      echo "$row[9]";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv5
      echo "$row[10]";
            
      echo" </td>
      <td style=\"text-align: center;\">";
      
      //wolv6
      echo "$row[11]";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv7
      echo "$row[12]";
            
      echo" </td>
      <td style=\"text-align: center;\">";
      
      //wostatus
      //echo "$row[15]";
      echo "NOT ISSUED";
      
      echo "</td>
      <td></td>
    </tr>
    <tr>
      <td style=\"text-align: right;\">Summary</td>
      <td colspan=\"12\" rowspan=\"1\">";
      
      //wosummary</td>
      $wossummary = $row[13];
      echo "$wossummary";      
      
      
      echo" </td><td></td>
    </tr>
  </tbody>
</table><br>";
    }
    echo "</div>";
    
    /**********************************************/
            echo "<div id=\"tabs-3\">";
    while ($row = mysql_fetch_array($result_oct)) {
        //wopriority
            
            echo "<table style=\"text-align: left; width: 100%;\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\"> <tbody>";
            
            echo "<tr>
      <th style=\"text-align: center;\">WO Number</th>
      <th style=\"text-align: center;\">WO Date</th>
      <th style=\"text-align: center;\">WO Type</th>
      <th style=\"text-align: center;\">WO Priority</th>
      <th style=\"text-align: center;\">0</th>
      <th>1</th>
      <th style=\"text-align: center;\">System</th>
      <th style=\"text-align: center;\">Flr</th>
      <th style=\"text-align: center;\">Quad</th>
      <th style=\"text-align: center;\">Subsystem</th>
      <th style=\"text-align: center;\">Exp</th>
      <th style=\"text-align: center;\">Component</th>
      <th style=\"text-align: center;\">WO Status</th>
      <th></th>
            </tr>
            <tr>
            <td style=\"text-align: center;\">";
      
            //woid
            echo "".$row[0]."";      
            echo "</td>
            <td style=\"text-align: center;\">";
      
            //wocreatedate
            $wocreatedate = date("d/m/Y H:i", $row[1]);
            echo "$wocreatedate";
      
            echo "</td><td style=\"text-align: center;\">";
      
      echo "$row[3]";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      echo "$row[4]";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      //wolv0
      echo "$row[5]";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      //wolv1
      echo "$row[6]";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv2
      echo "$row[7]";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv3
      echo "$row[8]";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv4
      echo "$row[9]";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv5
      echo "$row[10]";
            
      echo" </td>
      <td style=\"text-align: center;\">";
      
      //wolv6
      echo "$row[11]";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv7
      echo "$row[12]";
            
      echo" </td>
      <td style=\"text-align: center;\">";
      
      //wostatus
      //echo "$row[15]";
      echo "NOT ISSUED";
      
      echo "</td>
      <td></td>
    </tr>
    <tr>
      <td style=\"text-align: right;\">Summary</td>
      <td colspan=\"12\" rowspan=\"1\">";
      
      //wosummary</td>
      $wossummary = $row[13];
      echo "$wossummary";      
      
      echo" </td><td></td>
    </tr>
  </tbody>
</table> <BR>";
    }
echo "</div>";
    /**********************************************/
}
 
else if ($searchtype == 1){
//1 = List of all open orders (organized by user)

    $query = "SELECT * FROM workorders WHERE (wostatus NOT LIKE '5' AND wostatus NOT LIKE '6') ORDER BY woassignedto";
    $result = mysql_query($query);
    
    while ($row = mysql_fetch_array($result)) {
        
        $user_id = $row[16];        
        $query = "SELECT * FROM users WHERE users_id = \"$user_id\"";
        $res = mysql_query($query);
        $username = mysql_result($res,0,'username');
          
        if ($username != $previous_username) echo "<h1>Open Orders for $username<h1>";
            
            //wopriority
            $wopriority = $row[4];
            $query = "SELECT * FROM wopriority WHERE wopriorityid = \"$wopriority\"";
            $res2 = mysql_query($query);
            $wopriority = mysql_result($res2,0,'wopriorityname');
            
            if ($wopriority == "1")
            echo "<table style=\"text-align: left; background-color: rgb(255, 204, 153); width: 100%;\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\"> <tbody>";
            
            else
            echo "<table style=\"text-align: left; width: 100%;\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\"> <tbody>";
            
            echo "<tr>
      <th style=\"text-align: center;\">WO Number</th>
      <th style=\"text-align: center;\">WO Date</th>
      <th style=\"text-align: center;\">WO Type</th>
      <th style=\"text-align: center;\">WO Priority</th>
      <th style=\"text-align: center;\">0</th>
      <th>1</th>
      <th style=\"text-align: center;\">System</th>
      <th style=\"text-align: center;\">Flr</th>
      <th style=\"text-align: center;\">Quad</th>
      <th style=\"text-align: center;\">Subsystem</th>
      <th style=\"text-align: center;\">Exp</th>
      <th style=\"text-align: center;\">Component</th>
      <th style=\"text-align: center;\">WO Status</th>
      <th></th>
            </tr>
            <tr>
            <td style=\"text-align: center;\">";
      
            //woid
            echo "".$row[0]."";      
            echo "</td>
            <td style=\"text-align: center;\">";
      
            //wocreatedate
            $wocreatedate = date("d/m/Y H:i", $row[1]);
            echo "$wocreatedate";
      
            echo "</td><td style=\"text-align: center;\">";
      
      //wotype
      $wotypeindex = $row[3];
      $query = "SELECT * FROM wotype WHERE wotypeid = \"$wotypeindex\"";
      $res2 = mysql_query($query);
      $wotype = mysql_result($res2,0,'wotypename');
      echo "$wotype";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      echo "$wopriority";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      //wolv0
      $wolv0 = $row[5];
      $query = "SELECT * FROM lv0 WHERE lv0id = \"$wolv0\"";
      $res2 = mysql_query($query);
      $wolv0 = mysql_result($res2,0,'lv0name');
      echo "$wolv0";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      //wolv1
      $wolv1 = $row[6];
      $query = "SELECT * FROM lv1 WHERE lv1id = \"$wolv1\"";
      $res2 = mysql_query($query);
      $wolv1 = mysql_result($res2,0,'lv1name');
      echo "$wolv1";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv2
      $wolv2 = $row[7];
      $query = "SELECT * FROM lv2 WHERE lv2id = \"$wolv2\"";
      $res2 = mysql_query($query);
      $wolv2 = mysql_result($res2,0,'lv2name');
      echo "$wolv2";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv3
      $wolv3 = $row[8];
      $query = "SELECT * FROM lv3 WHERE lv3id = \"$wolv3\"";
      $res2 = mysql_query($query);
      $wolv3 = mysql_result($res2,0,'lv3name');
      echo "$wolv3";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv4
      $wolv4 = $row[9];
      $query = "SELECT * FROM lv4 WHERE lv4id = \"$wolv4\"";
      $res2 = mysql_query($query);
      $wolv4 = mysql_result($res2,0,'lv4name');
      echo "$wolv4";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv5
      $wolv5 = $row[10];
      $query = "SELECT * FROM lv5 WHERE lv5id = \"$wolv5\"";
      $res2 = mysql_query($query);
      $wolv5 = mysql_result($res2,0,'lv5name');
      echo "$wolv5";
            
      echo" </td>
      <td style=\"text-align: center;\">";
      
      //wolv6
      $wolv6 = $row[11];
      $query = "SELECT * FROM lv6 WHERE lv6id = \"$wolv6\"";
      $res2 = mysql_query($query);
      $wolv6 = mysql_result($res2,0,'lv6name');
      echo "$wolv6";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv7
      $wolv7 = $row[12];
      $query = "SELECT * FROM lv7 WHERE lv7id = \"$wolv7\"";
      $res2 = mysql_query($query);
      $wolv7 = mysql_result($res2,0,'lv7name');
      echo "$wolv7";
            
      echo" </td>
      <td style=\"text-align: center;\">";
      
      //wostatus
      $wostatus = $row[15];
      $query = "SELECT * FROM wostatus WHERE wostatusid = \"$wostatus\"";
      $res2 = mysql_query($query);
      $wostatus = mysql_result($res2,0,'wostatusname');
      echo "$wostatus";
      
      echo "</td>
      <td><a href= \"editorder.php?woid=".$row[0]."\">EDIT</a></td>
    </tr>
    <tr>
      <td style=\"text-align: right;\">Summary</td>
      <td colspan=\"12\" rowspan=\"1\">";
      
      //wosummary</td>
      $wossummary = $row[13];
      echo "$wossummary";      
      
      
      echo" </td><td></td>
    </tr>
  </tbody>
</table>";
            
            $previous_username = $username;
    }

}

else if ($searchtype == 3){
    //search by string on wosummary
    $wosummarystring = $_POST['wosummary'];
    
    $query = "SELECT * FROM workorders WHERE wosummary LIKE \"%$wosummarystring%\"";
    $result = mysql_query($query);
    
    if (mysql_num_rows($result) == 0) echo "None found.";
    else {
        $num_orders = mysql_num_rows($result);
        echo "Found $num_orders orders:";
        
            while ($row = mysql_fetch_array($result)) {
        
        $user_id = $row[16];        
        $query = "SELECT * FROM users WHERE users_id = \"$user_id\"";
        $res = mysql_query($query);
        $username = mysql_result($res,0,'username');
            
            //wopriority
            $wopriority = $row[4];
            $query = "SELECT * FROM wopriority WHERE wopriorityid = \"$wopriority\"";
            $res2 = mysql_query($query);
            $wopriority = mysql_result($res2,0,'wopriorityname');
            
            if ($wopriority == "1")
            echo "<table style=\"text-align: left; background-color: rgb(255, 204, 153); width: 100%;\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\"> <tbody>";
            
            else
            echo "<table style=\"text-align: left; width: 100%;\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\"> <tbody>";
            
            echo "<tr>
      <th style=\"text-align: center;\">WO Number</th>
      <th style=\"text-align: center;\">WO Date</th>
      <th style=\"text-align: center;\">WO Type</th>
      <th style=\"text-align: center;\">WO Priority</th>
      <th style=\"text-align: center;\">0</th>
      <th>1</th>
      <th style=\"text-align: center;\">System</th>
      <th style=\"text-align: center;\">Flr</th>
      <th style=\"text-align: center;\">Quad</th>
      <th style=\"text-align: center;\">Subsystem</th>
      <th style=\"text-align: center;\">Exp</th>
      <th style=\"text-align: center;\">Component</th>
      <th style=\"text-align: center;\">WO Status</th>
      <th></th>
            </tr>
            <tr>
            <td style=\"text-align: center;\">";
      
            //woid
            echo "".$row[0]."";      
            echo "</td>
            <td style=\"text-align: center;\">";
      
            //wocreatedate
            $wocreatedate = date("d/m/Y H:i", $row[1]);
            echo "$wocreatedate";
      
            echo "</td><td style=\"text-align: center;\">";
      
      //wotype
      $wotypeindex = $row[3];
      $query = "SELECT * FROM wotype WHERE wotypeid = \"$wotypeindex\"";
      $res2 = mysql_query($query);
      $wotype = mysql_result($res2,0,'wotypename');
      echo "$wotype";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      echo "$wopriority";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      //wolv0
      $wolv0 = $row[5];
      $query = "SELECT * FROM lv0 WHERE lv0id = \"$wolv0\"";
      $res2 = mysql_query($query);
      $wolv0 = mysql_result($res2,0,'lv0name');
      echo "$wolv0";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      //wolv1
      $wolv1 = $row[6];
      $query = "SELECT * FROM lv1 WHERE lv1id = \"$wolv1\"";
      $res2 = mysql_query($query);
      $wolv1 = mysql_result($res2,0,'lv1name');
      echo "$wolv1";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv2
      $wolv2 = $row[7];
      $query = "SELECT * FROM lv2 WHERE lv2id = \"$wolv2\"";
      $res2 = mysql_query($query);
      $wolv2 = mysql_result($res2,0,'lv2name');
      echo "$wolv2";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv3
      $wolv3 = $row[8];
      $query = "SELECT * FROM lv3 WHERE lv3id = \"$wolv3\"";
      $res2 = mysql_query($query);
      $wolv3 = mysql_result($res2,0,'lv3name');
      echo "$wolv3";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv4
      $wolv4 = $row[9];
      $query = "SELECT * FROM lv4 WHERE lv4id = \"$wolv4\"";
      $res2 = mysql_query($query);
      $wolv4 = mysql_result($res2,0,'lv4name');
      echo "$wolv4";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv5
      $wolv5 = $row[10];
      $query = "SELECT * FROM lv5 WHERE lv5id = \"$wolv5\"";
      $res2 = mysql_query($query);
      $wolv5 = mysql_result($res2,0,'lv5name');
      echo "$wolv5";
            
      echo" </td>
      <td style=\"text-align: center;\">";
      
      //wolv6
      $wolv6 = $row[11];
      $query = "SELECT * FROM lv6 WHERE lv6id = \"$wolv6\"";
      $res2 = mysql_query($query);
      $wolv6 = mysql_result($res2,0,'lv6name');
      echo "$wolv6";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv7
      $wolv7 = $row[12];
      $query = "SELECT * FROM lv7 WHERE lv7id = \"$wolv7\"";
      $res2 = mysql_query($query);
      $wolv7 = mysql_result($res2,0,'lv7name');
      echo "$wolv7";
            
      echo" </td>
      <td style=\"text-align: center;\">";
      
      //wostatus
      $wostatus = $row[15];
      $query = "SELECT * FROM wostatus WHERE wostatusid = \"$wostatus\"";
      $res2 = mysql_query($query);
      $wostatus = mysql_result($res2,0,'wostatusname');
      echo "$wostatus";
      
      echo "</td>
      <td><a href = \"printorder.php?p=".$row[0]."\">View</a></td>
    </tr>
    <tr>
      <td style=\"text-align: right;\">Summary</td>
      <td colspan=\"12\" rowspan=\"1\">";
      
      //wosummary</td>
      $wossummary = $row[13];
      echo "$wossummary";      
      
      
      echo" </td><td></td>
    </tr>
  </tbody>
</table><BR>";
        
    }
    
}
}
else if ($searchtype == 4){
    //Show all information available per system:
    echo "<H1>Db Information by System</H1>";
    //connect to system (Lv2) table and get all available from list
    $query = "SELECT * FROM lv2 ORDER BY lv2id";
    $result = mysql_query($query);
    echo "<div id=\"tabs\"><ul>";
    //make a special tabbed <ul> for each lv2 found
    $numsystems = 1;
    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
        echo "<li><a href=\"#tabs-$numsystems\">".$row[1]."</li>";
        $numsystems++;
    }
    echo "</ul>";
    
    //for each system (STL, FSH, etc list all:
    $i = 1;
    while ($i <= $numsystems){
        echo "<div id=\"tabs-$i\">";
        //1. Open orders
        echo "<H1>Open Orders</H1>";
        $query = "SELECT * FROM lv2 ORDER BY lv2id";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
            //get all not closed orders for this system:
            $query = "SELECT * FROM workorders WHERE wolv2 LIKE ".$row[0]." AND wostatus != \"6\"";
            $result2 = mysql_query($query) or die (mysql_error());
            $num_rows = mysql_num_rows($result2);
            echo "<table width = \"100%\">";
            while ($row2 = mysql_fetch_array($result2, MYSQL_NUM)) {
                echo "<tr><td>".$row2[0]."</td><td>".$row2[13]."</td></tr>";
            }
            echo "</table>";
            //2. Maintenance plans
    
            //3. Spares
    
            //4. Documentation
    
            //5. Open and closed PRs
    
            //6. Open and closed POs
        }
        
        $i++;
    }
    
    echo "</div>";
}

else echo "Search type not defined!";

require("footer.php");
?>

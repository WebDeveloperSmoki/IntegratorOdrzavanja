<?php
//searchresults.php
require("header.php");
require("db.php");
//WO search results code

echo "<H1>Your Open Orders:</H1>";

//1. extract username:
$username = $_SESSION['valid_user'];

//Extract user level:
$userlevel = extract_user_level($username);

//2. what index from users is this?
$query = "SELECT * FROM users WHERE username = \"$username\"";
$res = mysql_query($query);
$userid = mysql_result($res,0,'users_id');

if ($userlevel == "admin"){
//we show all orders to admin except the completed ones (that needs to be another search...)
$query = "SELECT * FROM workorders WHERE (woassignedto = '$userid' AND wostatus NOT LIKE '6')";
$res = mysql_query($query);
}
else {
//we do not show complete or closed orders to normal users
$query = "SELECT * FROM workorders WHERE (woassignedto = '$userid' AND wostatus NOT LIKE '5' AND wostatus NOT LIKE '6')";
$res = mysql_query($query);
}

while ($row = mysql_fetch_array($res)) {
    
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
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      //wotype
      $wotypeindex = $row[3];
      $query = "SELECT * FROM wotype WHERE wotypeid = \"$wotypeindex\"";
      $res2 = mysql_query($query);
      $wotype = mysql_result($res2,0,'wotypename');
      echo "$wotype";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      //wopriority
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
</table><BR>";

}

require("footer.php");

?>

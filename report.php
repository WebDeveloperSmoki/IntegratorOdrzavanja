<?php
//generates the maintenance report
require("header.php");
require("db.php");

//get information

//START DATE
$startdate = $_POST['startdate'];

//END DATE
$enddate = $_POST['enddate'];

if (!isset($startdate) OR !isset($enddate) OR $startdate == "" OR $enddate == ""){
    echo "ERROR! Wrong date specified!";
    require('footer.php');
    die();
}

$start_date = explode("-", $startdate);
$startdate = mktime(0, $start_date[1], 0, $start_date[1], $start_date[0], $start_date[2]) + 28800;

$end_date = explode("-", $enddate);
$enddate = mktime(0, $end_date[1], 0, $end_date[1], $end_date[0], $end_date[2]) + 28800;

if ($startdate > $enddate) {
    echo "<BR>ERROR! Start date must be before or equal to the end date!<BR>";
    require('footer.php');
    die();
    }
else {
    //all good with date tests, proceed:
    echo "<big><span style=\"font-weight: bold;\">Sytem Report
(template 1)</span></big><br>Time period from <span style=\"font-weight: bold;\">";

    $printstartdate = date("d/m/Y", $startdate);
    $printenddate = date("d/m/Y", $enddate);
    
    echo "$printstartdate";
    echo " </span>to <span style=\"font-weight: bold;\"> $printenddate</span><BR><BR>";
}

?>

<table style="text-align: left; height: 50%; width: 50%;"
 border="1" cellpadding="2" cellspacing="2">
  <tbody>
    <tr align="center">
      <td colspan="2" rowspan="1"><span
 style="font-weight: bold;">MAINTENANCE</span></td>
    </tr>
    <tr>
      <td>Number of open orders</td>
      
      <td style="height: 50%; width: 50%;">     
      <?php
      //get all orders that were open during this period:
      $query1 = "SELECT * FROM `workorders` WHERE `wocreatedate` < $startdate AND (`wocompleteddate` > $enddate OR `wocompleteddate` = 0)";
      $query2 = "SELECT * FROM `workorders` WHERE `wocreatedate` = $startdate AND `wocompleteddate` = $enddate";
      $query3 = "SELECT * FROM `workorders` WHERE `wocreatedate` > $startdate AND `wocompleteddate` < $enddate";
      $query4 = "SELECT * FROM `workorders` WHERE `wocreatedate` > $startdate AND (`wocompleteddate` > $enddate OR `wocompleteddate` = 0)";
      $query5 = "SELECT * FROM `workorders` WHERE `wocreatedate` <= $startdate AND `wocompleteddate` BETWEEN $startdate AND $enddate";
      
      $num_open_orders = 0;
      $result1 = mysql_query($query1) or die (mysql_error());      
      //place each different order number on an array:
      while ($row = mysql_fetch_array($result1)){
        $value = $row[0];
        echo "$value | ";
      }      
      $num_open_orders = mysql_num_rows($result1);
      
      $result2 = mysql_query($query2) or die (mysql_error());
      while ($row = mysql_fetch_array($result2)){
        $value = $row[0];
        echo "$value | ";
      }     
      $num_open_orders = $num_open_orders + mysql_num_rows($result2);
      
      $result3 = mysql_query($query3) or die (mysql_error());
      while ($row = mysql_fetch_array($result3)){
        $value = $row[0];
        echo "$value | ";
      }
      
      $num_open_orders = $num_open_orders + mysql_num_rows($result3);
      $result4 = mysql_query($query4) or die (mysql_error());
            while ($row = mysql_fetch_array($result4)){
        $value = $row[0];
        echo "$value | ";
      }
      $num_open_orders = $num_open_orders + mysql_num_rows($result4);
      $result5 = mysql_query($query5) or die (mysql_error());
            while ($row = mysql_fetch_array($result5)){
        $value = $row[0];
        echo "$value | ";
      }
      $num_open_orders = $num_open_orders + mysql_num_rows($result5);
      
      echo "$num_open_orders";

      ?>
      </td>
      
    </tr>
    <tr>
      <td>Total number of open orders by user</td>
      <td style="height: 50%; width: 50%;">
      <?php
      //From all orders above, go one by one and extract info from the wolog table
      
      ?>
      </td>
    </tr>
    <tr>
      <td>Total orders in WAITMAT</td>
      <td></td>
    </tr>
    <tr>
      <td>Total orders set to CLOSED</td>
      <td style="height: 50%; width: 50%;"></td>
    </tr>
    <tr>
      <td>Work achievement total %</td>
      <td></td>
    </tr>
    <tr>
      <td>Number of orders created manually</td>
      <td style="height: 50%; width: 50%;"></td>
    </tr>
    <tr>
      <td>Work achievement for manual orders %</td>
      <td></td>
    </tr>
    <tr>
      <td>Number of orders generated automatically</td>
      <td></td>
    </tr>
    <tr>
      <td>Work achievement for PM generated orders %</td>
      <td></td>
    </tr>
    <tr>
      <td>Number of P1 orders</td>
      <td></td>
    </tr>
    <tr>
      <td>Work achievement for P1 orders %</td>
      <td></td>
    </tr>
    <tr>
      <td>Total recorded man-hours spent on maintenance tasks</td>
      <td></td>
    </tr>
    <tr>
      <td>Total recorded man-hours per system</td>
      <td></td>
    </tr>
    <tr>
      <td>Total number of spares used</td>
      <td></td>
    </tr>
    <tr>
      <td>Total number of spares per system</td>
      <td></td>
    </tr>
    <tr>
      <td>Number of spares below order limit</td>
      <td></td>
    </tr>
    <tr>
      <td>Estimate total spares cost</td>
      <td></td>
    </tr>
    <tr>
      <td>Estimated man-hour cost (non-overtime)</td>
      <td></td>
    </tr>
    <tr>
      <td>Estimated man-hour cost (overtime)</td>
      <td></td>
    </tr>
    <tr>
      <td>Estimated total cost (spares + man-hour)</td>
      <td></td>
    </tr>
    <tr style="font-weight: bold;" align="center">
      <td colspan="2" rowspan="1">MANAGEMENT</td>
    </tr>
    <tr>
      <td>Total PRs issued</td>
      <td></td>
    </tr>
    <tr>
      <td>Total PR value</td>
      <td></td>
    </tr>
    <tr>
      <td>Total PO issued</td>
      <td></td>
    </tr>
    <tr>
      <td>Total PO value</td>
      <td></td>
    </tr>
    <tr>
      <td>Total&nbsp; deliveries of bought items</td>
      <td></td>
    </tr>
    <tr>
      <td>Total PR pending approval</td>
      <td></td>
    </tr>
    <tr>
      <td>Total POs pending delivery</td>
      <td></td>
    </tr>
    <tr>
      <td>Traning&nbsp;per user</td>
      <td></td>
    </tr>
    <tr>
      <td>Total new or revised documentation</td>
      <td>SOP, FROM, RECORD</td>
    </tr>
    <tr align="center">
      <td colspan="2" rowspan="1"><span
 style="font-weight: bold;">SHOWS</span></td>
    </tr>
    <tr>
      <td>Total number of shows</td>
      <td style="height: 50%; width: 50%;"></td>
    </tr>
    <tr>
      <td>Total number of clean shows</td>
      <td style="height: 50%; width: 50%;"></td>
    </tr>
    <tr>
      <td>Total number of not clean shows (operation)</td>
      <td></td>
    </tr>
    <tr>
      <td>Total number of not clean shows (equipment)</td>
      <td></td>
    </tr>
    <tr>
      <td>% Equipment failure</td>
      <td></td>
    </tr>
    <tr>
      <td>% Operations failure</td>
      <td></td>
    </tr>
    <tr>
      <td>% YTD* Equipment failure</td>
      <td></td>
    </tr>
    <tr>
      <td>% YTD* Operations failure</td>
      <td></td>
    </tr>
    <tr align="center">
      <td colspan="2" rowspan="1"><span
 style="font-weight: bold;">CMMS</span></td>
    </tr>
    <tr>
      <td>Total number of users</td>
      <td></td>
    </tr>
    <tr>
      <td>Number of users by Department</td>
      <td></td>
    </tr>
    <tr>
      <td>Number of users by access level</td>
      <td></td>
    </tr>
    <tr>
      <td>Total number of systems monitored</td>
      <td></td>
    </tr>
    <tr>
      <td>Total number of maintenance plans</td>
      <td></td>
    </tr>
    <tr>
      <td>Total number of maintenance plans by periodicity</td>
      <td></td>
    </tr>
    <tr>
      <td>Total number of orders (any status)</td>
      <td></td>
    </tr>
    <tr>
      <td>Total database backups performed</td>
      <td></td>
    </tr>
  </tbody>
</table>
<span style="font-style: italic;">*YTD from first data
recording to end date on report date range</span>

<P>List of orders closed during this period:

<table style="text-align: left; height: 50%; width: 50%;" border="1" cellpadding="2" cellspacing="2">
  <tbody>
    <tr align="center">
    <td>test</td>
    <td>test</td>
    </tr>
    <tr align="center">
    <td>test</td>
    <td>test</td>
    </tr>
  </tbody>
</table>

<?php
require("footer.php");
?>

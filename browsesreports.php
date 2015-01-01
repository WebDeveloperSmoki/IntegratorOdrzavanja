<?php
//browse show reports for reading
require("header.php");
require("db.php");
require("config/config.php")
?>

<?php

echo "<big style=\"font-weight: bold;\"><big>Automation Show
Reports Log</big></big><br>";

//1. load all entries from sreports database order by entrydate ORDER ASC
$query = "SELECT * FROM showreports ORDER BY entrydate DESC";
$result = mysql_query($query);
$previousyear = "";
$previousmonth = "";

$totalmonth = 1;
$totalmonthopclean = 0;
$totalmonthequipclean = 0;

$totalyear = 0;
$totalyearopclean = 0;
$totalyearequipclean = 0;

$loop_count = 0;

while ($row = mysql_fetch_array($result)){
    //2. for each entry extract year for first, write year
    $entrydate = $row['entrydate'];
    
    $entryyear = date("Y",$entrydate);
    if ($entryyear <> $previousyear){
        
        if ($loop_count <> 0){
        
        $percentagegoodopshows = round(($totalmonthopclean / $totalmonth) * 100);
        $percentagegoodequipshows = round(($totalmonthequipclean / $totalmonth) * 100);
        
        echo "<BR>Total shows: $totalmonth | Total clean (operation): $totalmonthopclean | Total clean (equip): $totalmonthequipclean | $percentagegoodopshows% clean shows (operation) $percentagegoodequipshows% clean shows (equipment)";
        
        $percentagegoodopshows = round(($totalyearopclean / $totalyear) * 100);
        $percentagegoodequipshows = round(($totalyearequipclean / $totalyear) * 100);
        echo "<BR><BR><B>Yearly stats: $totalyear total shows of which $totalyearopclean were clean (OP) and $totalyearequipclean were clean (equip)| $percentagegoodopshows% clean shows (OP) $percentagegoodequipshows% clean shows (equip)</B>";
        //percentage clean shows vs not clean shows (yearly)
        }
        
        echo "<P><big style=\"font-weight: bold;\">$entryyear</big><BR>";
        $previousyear = $entryyear;
        
        $totalyear = 0;
        $totalyearopclean = 0;
        $totalyearequipclean = 0;
        $loop_count = 0;
        
    }
    
    $entrymonth = date("F",$entrydate);
    if ($entrymonth <> $previousmonth){
        if ($loop_count <> 0){
        $percentagegoodopshows = round(($totalmonthopclean / $totalmonth) * 100);
        $percentagegoodequipshows = round(($totalmonthequipclean / $totalmonth) * 100);
        
        echo "<BR>Total shows: $totalmonth | Total clean (operation): $totalmonthopclean | Total clean (equip): $totalmonthequipclean | $percentagegoodopshows% clean shows (operation) $percentagegoodequipshows% clean shows (equipment)<br>";
        //percentage clean shows vs not clean shows (monthly)
        }
        
        echo "<BR><span style=\"text-decoration: underline;\">$entrymonth</span><BR>";
        
        $previousmonth = $entrymonth;
        
        $totalmonth = 0;
        $totalmonthopclean = 0;
        $totalmonthequipclean = 0;
    }
    
    $entryday = date("d", $entrydate);
    $show1number = $row['show1number'];
    
    echo " $entryday (<a href=\"$root_dir/sreports.php?op=read&s=$show1number\">show #$show1number</a> ";
    
    $show1clean = $row['show1clean'];
    
    if ($show1clean == "Y"){
        echo "<img src = \"images/opclean.png\">";
        $totalmonthopclean++;
        $totalyearopclean++;
    }
    else{
        echo "<img src = \"images/opnotclean.png\">";
    }
    
    $show1equipclean = $row['show1equipclean'];
    if ($show1equipclean == "N"){
        echo "<img src = \"images/equipnotclean.png\">";
    }
    else{
        echo "<img src = \"images/equipclean.png\">";
        $totalmonthequipclean++;
        $totalyearequipclean++;
    }
    
    echo ")";
    
    $totalmonth++;
    $totalyear++;
    
    $show2number = $row['show2number'];
    
    if ($show2number <> 0){
        $show2clean = $row['show2clean'];
        $show2equipclean = $row['show2equipclean'];
        echo " (<a href=\"$root_dir/sreports.php?op=read&s=$show1number\">show #$show2number</a>";
        if ($show2clean == "Y") {
            echo "<img src = \"images/opclean.png\">";
            $totalmonthopclean++;
            $totalyearopclean++;
        }
        else echo "<img src = \"images/opnotclean.png\">";
        if ($show2equipclean == "N") echo "<img src = \"images/equipnotclean.png\">";
        else{
            echo "<img src = \"images/equipclean.png\">";
            $totalmonthequipclean++;
            $totalyearequipclean++;
        }
        echo ")";
        $totalmonth++;
        $totalyear++;
    }
    
    $loop_count++;
}
?>

<?php
require ("footer.php");
?>

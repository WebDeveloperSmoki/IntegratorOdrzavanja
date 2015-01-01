<?php

//require("config/aux_funcs.php");
require ("db.php");

//printorder.php
//receives a string of the type:
//unique (XXXX), range (AAAA-BBBB) or discrete (XXXX, XXXX, etc), where AAAA < BBBB
//and generates a pdf with each page being
$printorderhistory =$_POST['printorderhistory']; //contains "on" or empty string
$converttoservicereport=$_POST['converttoservicereport']; //contains "on" or empty string
$printorder = $_POST['printorder']; //contains search string
$converttopdf = $_POST['converttopdf'];
$add_text = $_POST['add_text'];

if (!isset($_POST['printorder'])){
    $printorder = $_GET['p'];
}
else $printorder = $_POST['printorder'];

if ($converttopdf != "on"){
require ("header.php");
$orders_array[] = 0;

//test user input:
//faults: not a number or AAAA>BBBB

$is_range = false;
$is_discrete = false;

$orderrange = explode("-", $printorder);

if (count($orderrange) > 1) $is_range = true;

//split from ,
$orderdiscrete = explode(",", $printorder);

if (count($orderdiscrete) > 1) $is_discrete = true;

//don't allow combination of range and discrete:
if ($is_discrete && $is_range){
    echo "ERROR: Please only this format: XXXX-XXXX for range or XXXX,XXXX,etc for discrete orders.";
    require("footer.php");
    die;
}

//if both is_discrete and is_ranage are empty, that's because we have one order only or an empty field or a mistake
if (!$is_discrete && !$is_range){
    if (!is_numeric($printorder)){
        echo "ERROR: Empty order field or not a number.";
        require("footer.php");
        die;
    }
    
//IT SHOULD BE ONE ORDER ONLY!
if (!order_exists($printorder)) echo "Order number $printorder does not exist!";
else {
    $orders_array[0] = $printorder;
    print_orders($orders_array, $converttoservicereport, $printorderhistory,$converttopdf);
}

}

//ok, it's a discrete list of numbers, give error is empty field or a mistake:
if ($is_discrete){
    $j = 0;
    for ($i=0; $i<sizeof($orderdiscrete); $i++){
        //test each entry and do not generate if not numberic:
        if (is_numeric($orderdiscrete[$i]) && order_exists($orderdiscrete[$i])){
            //CALL TO PRINT ORDER HERE!!!
//            echo 'print_order($printorder) - this from a discrete number of orders';
//            echo "".$orderdiscrete[$i]."<BR>";
            $orders_array[$j] = $orderdiscrete[$i];
            $j++;
        }
    }
    print_orders($orders_array, $converttoservicereport, $printorderhistory,$converttopdf);
}

//ok, it's a range list of numbers, give error is empty field or a mistake:
//ALLOW FOR ONLY ONE RANGE AT THIS MOMENT, so we should have only two numbers:
if ($is_range){
    $j = 0;
    
    if ($orderrange[0] > $orderrange[1]){
        echo "not a valid range.";
        require("footer.php");
        die;
    }
    
    else {
        $num_orders_to_print = $orderrange[1] - $orderrange[0];
        $startcycle = $orderrange[0];
        $endcycle = $orderrange[1];
        $j = 0;
        //edit $orderrange array to include all the orders on the range
        for ($i = $startcycle; $i <= $endcycle; $i++){
            $orderrange[$j] = $startcycle+$j;
            $j++;
        }
    }
    
    $j = 0;
    for ($i=0; $i<=$num_orders_to_print; $i++){
        //test each entry and do not generate if not numberic:
        if (is_numeric($orderrange[$i]) && order_exists($orderrange[$i])){
            $orders_array[$j] = $orderrange[$i];
            $j++;
        }
    }
    print_orders($orders_array, $converttoservicereport, $printorderhistory,$converttopdf);
}
    require ("footer.php");
}
else {

include("config/config.php");
require("config/aux_funcs.php");
date_default_timezone_set("$default_time_zone");

$is_range = false;
$is_discrete = false;

if (!is_numeric($printorder)) echo "wrong WO# (cannot be range, only unique).";
else {
    if (!order_exists($printorder)) echo "no such order.";
    else {
        
        //ok, found the order, get all the required values:
        $query = "SELECT * FROM workorders WHERE woid = $printorder";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        //Extract $printorder wo data from datababse:
        $wocreatedate = date('l\, jS \of F Y h:i:s A',$row[1]);
        
        $temp = $row[2];
        $query = "SELECT * FROM users WHERE users_id = $temp";
        $result = mysql_query($query);
        $row_2 = mysql_fetch_array($result);
        $wocreatedby = $row_2[1];
        
        $temp = $row[2];
        $query = "SELECT * FROM users WHERE users_id = $temp";
        $result = mysql_query($query);
        $row_2 = mysql_fetch_array($result);
        $completedby = $row_2[1];
        
        $temp = $row[7];
        $query = "SELECT * FROM lv2 WHERE lv2id = $temp";
        $result = mysql_query($query);
        $row_2 = mysql_fetch_array($result);
        $system = $row_2[2];
        
        $temp = $row[10];
        $query = "SELECT * FROM lv5 WHERE lv5id = $temp";
        $result = mysql_query($query);
        $row_2 = mysql_fetch_array($result);
        $subsystem = $row_2[1];
        
        $completeddate = date($row[20]);
        if ($completeddate == "") $completeddate = "still open";
        else $completeddate = date('l\, jS \of F Y h:i:s A',$completeddate);
        
        $summary = $row[13];
        $description = $row[14];
        
        
        //AND DO NOT FORGET add_text and place it on the pdf
        
        //********************************************************************
        //******************************START PDF GENERATOR
        //********************************************************************
require('pdfgen/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    global $printorder;
    // Logo
    $this->Image('images/thodw.jpg',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',20);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Automation Department',0,0,'C');
    $this->SetFont('Arial','I',15);
    $this->Ln();
    $this->Cell(80);
    $this->Cell(30,10,'Work Report for WO# '.$printorder.'',0,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

//*****CONTENTS
$pdf->SetFont('Arial','B',15);
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->Cell(0,10,'Additional Message',0,0,'L',true);

$pdf->Ln();
$pdf->SetTextColor(0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,6,''.$add_text.'',0,0,'L',false);

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',15);
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->Cell(0,10,'General Job Data',0,0,'L',true);

$pdf->Ln();
$pdf->SetTextColor(0);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,6,'Job Number: ',0,0,'L',false);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,6,''.$printorder.'',0,0,'L',false);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(25,6,'Created on: ',0,0,'L',false);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,6,''.$wocreatedate.'',0,0,'L',false);

$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(25,6,'Created by: ',0,0,'L',false);
$pdf->SetFont('Arial','',12);
$pdf->Cell(12,6,''.$wocreatedby.'',0,0,'L',false);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,6,'Completed by: ',0,0,'L',false);
$pdf->SetFont('Arial','',12);
$pdf->Cell(12,6,''.$completedby.'',0,0,'L',false);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,6,'Completed on: ',0,0,'L',false);
$pdf->SetFont('Arial','',12);
$pdf->Cell(20,6,''.$completeddate.'',0,0,'L',false);

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',15);
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->Cell(0,10,'System/ Subsystem',0,0,'L',true);

$pdf->Ln();
$pdf->SetTextColor(0);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,6,'System: ',0,0,'L',false);
$pdf->SetFont('Arial','',12);
$pdf->Cell(60,6,''.$system.'',0,0,'L',false);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,6,'SubSytem: ',0,0,'L',false);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40,6,''.$subsystem.'',0,0,'L',false);

//****END CONTENTS

$pdf->Output();

//********************************************************************
//******************************FINISH PDF GENERATOR
//********************************************************************

    }
}

}

?>

<?php
//pdf generating function:
//takes list of order(s) to print as a pdf and if printing job is for a service report or not
//and this function needs to take also a variable for whether to print history report or not


function print_orders($orders_array, $converttoservicereport, $printorderhistory,$converttopdf){
    for ($i = 0; $i < sizeof($orders_array); $i++){
//      echo "Are we getting the array? $i = $orders_array[$i]";
        print_order_function($orders_array[$i],$converttoservicereport,$printorderhistory,$converttopdf);
    }
}
?>

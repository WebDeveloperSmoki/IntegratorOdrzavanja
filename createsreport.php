<?php
//createshowreport.php
//does just that from sreports, creates show report or edits showreport

require("header.php");
require("db.php");

//variables that get here when a new showreport is saved:
$username = $_POST['username'];
$entrydpt = $_POST['entrydpt'];
$entrydate = $_POST['entrydate'];
//above is relevant for 1 and 2 show days

$show1clean = $_POST['show1clean'];
$show1equipclean = $_POST['show1equipclean'];
$show1number = $_POST['show1number'];
$show1aerial = $_POST['show1aerial'];
$show1l4loading = $_POST['show1l4loading'];
$show1l4scenic = $_POST['show1l4scenic'];
$show1l6loading = $_POST['show1l6loading'];
$show1liftop = $_POST['show1liftop'];
$show1rover = $_POST['show1rover'];
$show_1_problem_equip_1 = $_POST['show_1_problem_equip_1'];
$show_1_problem_equip_2 = $_POST['show_1_problem_equip_2'];

//filter the following to allow special chars and not <> and the like.
$show1report = $_POST['show1report'];
$show1report = filter_var($show1report,FILTER_SANITIZE_SPECIAL_CHARS);
$show1report = str_replace ("&#13;&#10;","<BR />",$show1report);

//filter the following to allow special chars and not <> and the like.
$show2report = $_POST['show2report'];
$show2report = filter_var($show2report,FILTER_SANITIZE_SPECIAL_CHARS);
$show2report = str_replace ("&#13;&#10;","<BR />",$show2report);

$rehearsalreport = $_POST['rehearsalreport'];
$rehearsalreport = filter_var($rehearsalreport,FILTER_SANITIZE_SPECIAL_CHARS);
$rehearsalreport = str_replace ("&#13;&#10;","<BR />",$rehearsalreport);

if ($show2report == "") $show2number = 0;
else $show2number = $_POST['show2number'];

//The following may or may not be filled sent:
$show2clean = $_POST['show2clean'];
$show2equipclean = $_POST['show2equipclean'];
$show2aerial = $_POST['show2aerial'];
$show2l4loading = $_POST['show2l4loading'];
$show2l4scenic = $_POST['show2l4scenic'];
$show2l6loading = $_POST['show2l6loading'];
$show2liftop = $_POST['show2liftop'];
$show2rover = $_POST['show2rover'];
$show_2_problem_equip_1 = $_POST['show_2_problem_equip_1'];
$show_2_problem_equip_2 = $_POST['show_2_problem_equip_2'];

$query = "INSERT INTO showreports (entrydate,entrydpt,show1number,show1report,show1user,show1aerial,show1l4loading,show1l4scenic,show1l6loading,show1liftop,show1rover,show1clean,show1equipclean,show_1_problem_equip_1,show_1_problem_equip_2,show2number,show2report,show2user,show2aerial,show2l4loading,show2l4scenic,show2l6loading,show2liftop,show2rover,show2clean,show2equipclean,show_2_problem_equip_1,show_2_problem_equip_2,rehearsalreport) VALUES (\"$entrydate\", \"$entrydpt\",\"$show1number\", \"$show1report\", \"$show1user\", \"$show1aerial\", \"$show1l4loading\", \"$show1l4scenic\", \"$show1l6loading\", \"$show1liftop\", \"$show1rover\", \"$show1clean\", \"$show1equipclean\",\"$show_1_problem_equip_1\",\"$show_1_problem_equip_2\",\"$show2number\", \"$show2report\", \"$show2user\", \"$show2aerial\", \"$show2l4loading\",\"$show2l4scenic\",\"$show2l6loading\",\"$show2liftop\",\"$show2rover\",\"$show2clean\", \"$show2equipclean\",\"$show_2_problem_equip_1\",\"$show_2_problem_equip_2\",\"$rehearsalreport\")";

$result = mysql_query($query) or die ("Error 201: createsreport.php");

if ($show2number == 0) {
    echo "Show report for show #$show1number has been saved!";
    $subject = "Automation Show Report (#$show1number)";
    $show2report = "none";
}
else {
    echo "Show report for shows #$show1number and #$show2number has been saved!";
    $subject = "Automation Show Report (#$show1number and #$show2number)";
}

$entrydateemail = date('l\, jS \of F Y', $entrydate);

$getemails = "SELECT * FROM users WHERE receivessreports = \"Y\"";
$emailaddresses = mysql_query($getemails);

if (mysql_num_rows($emailaddresses) == 0) echo " Will not send report email!";
else{
$i = 0;
while ($row = mysql_fetch_array($emailaddresses, MYSQL_NUM)) {
    $i++; 
    if ($i == mysql_num_rows($emailaddresses))
        $to .= "".$row[4]."";
    else $to .= "".$row[4].",";   
    }
}

require("footer.php"); //<-- don't forget that this will close the db connection

//****************GENERATE PDF FILE AND SEND IN EMAIL*********************//
//List of email addresses to be managed by admin users.
//************************************************************************//

// download fpdf class (http://fpdf.org)
require("pdfgen/fpdf.php");

// fpdf object
$pdf = new FPDF();

// generate a simple PDF (for more info, see http://fpdf.org/en/tutorial/)
//$pdf->AddPage();
//$pdf->SetFont("Arial","B",14);
//$pdf->Cell(40,10, "this is a pdf example");

//**************My own pdf generator************

class PDF extends FPDF
{

function Header()
{
    global $subject;
    global $entrydateemail;
    // Logo
    $this->Ln();
    $this->Image('images/thodw.jpg',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,''.$subject.'',0,0,'C');
    $this->Ln();
    $this->Ln();
    $this->Cell(30,10,'Date: '.$entrydateemail.'',0,0,'L');
    // Line break
    $this->Ln();
}

// Colored table
function FancyTable($header)
{

global $subject;
global $show1number;
global $show2number;
global $entrydateemail;
global $show1user;
global $show2user;
global $show1clean;
global $show2clean;
global $show1equipclean;
global $show_1_problem_equip_1;
global $show_1_problem_equip_2;
global $show_2_problem_equip_1;
global $show_2_problem_equip_2;
global $show2equipclean;
global $show2aerial;
global $show2l4loading;
global $show2l4scenic;
global $show2l6loading;
global $show2liftop;
global $show2rover;
global $show1aerial;
global $show1l4loading;
global $show1l4scenic;
global $show1l6loading;
global $show1liftop;
global $show1rover;
global $show1report;
global $show2report;

    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    
    // Header
    $w = array(90, 90);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
        
    //put data in the table on the two columns we have
    $this->SetFont('','B');
    $this->Cell($w[0],6,'Show 1 General Info','LR',0,'L',$fill);
    $this->Cell($w[1],6,'Show 2 General Info','LR',0,'L',$fill);
    $this->SetFont('');
    $this->Ln();
    
    $this->Cell($w[0],6,'Show Number: '.$show1number.'','LR',0,'L',$fill);
    $this->Cell($w[1],6,'Show Number: '.$show2number.'','LR',0,'L',$fill);
    $this->Ln();
    
    $this->Cell($w[0],6,'Show Report by: '.$show1user.'','LR',0,'L',$fill);
    $this->Cell($w[1],6,'Show Report by: '.$show2user.'','LR',0,'L',$fill);
    $this->Ln();
    
    $this->Cell($w[0],6,'Clean Operator Show? '.$show1clean.'','LR',0,'L',$fill);
    $this->Cell($w[1],6,'Clean Operator Show? '.$show2clean.'','LR',0,'L',$fill);
    $this->Ln();
    
    $this->Cell($w[0],6,'Clean Equipment Show? '.$show1equipclean.'','LR',0,'L',$fill);
    $this->Cell($w[1],6,'Clean Equipment Show? '.$show2equipclean.'','LR',0,'L',$fill);
    $this->Ln();
    
    //if not show 1 equip clean
    if ($show1equipclean=="N" && $show2equipclean=="N"){
        $this->Cell($w[0],6,'Faults on: '.$show_1_problem_equip_1.' | '.$show_1_problem_equip_2.'','LR',0,'L',$fill);
        $this->Cell($w[0],6,'Faults on: '.$show_1_problem_equip_1.' | '.$show_1_problem_equip_2.'','LR',0,'L',$fill);
    }
    else if ($show1equipclean=="N" && $show2equipclean=="Y"){
        $this->Cell($w[0],6,'Faults on: '.$show_1_problem_equip_1.' | '.$show_1_problem_equip_2.'','LR',0,'L',$fill);
        $this->Cell($w[0],6,'No Faults','LR',0,'L',$fill);       
    }
    else if ($show1equipclean=="Y" && $show2equipclean=="N"){
        $this->Cell($w[0],6,'No Faults','LR',0,'L',$fill);
        $this->Cell($w[0],6,'Faults on: '.$show_2_problem_equip_1.' | '.$show_2_problem_equip_2.'','LR',0,'L',$fill);     
    }
    else {
        $this->Cell($w[0],6,'No Faults','LR',0,'L',$fill);
        $this->Cell($w[0],6,'No Faults','LR',0,'L',$fill);
    }
    $this->Ln();
    
    //another section:
    $fill = !$fill;   
    $this->SetFont('','B');
    $this->Cell($w[0],6,'Show 1 Operators','LR',0,'L',$fill);
    $this->Cell($w[1],6,'Show 2 Operators','LR',0,'L',$fill);
    $this->SetFont('');
    $this->Ln();
    
    $this->Cell($w[0],6,'L2 Aerial: '.$show1aerial.'','LR',0,'L',$fill);
    $this->Cell($w[1],6,'L2 Aerial: '.$show2aerial.'','LR',0,'L',$fill);
    $this->Ln();
    
    $this->Cell($w[0],6,'L4 Loading: '.$show1l4loading.'','LR',0,'L',$fill);
    $this->Cell($w[1],6,'L4 Loading: '.$show2l4loading.'','LR',0,'L',$fill);
    $this->Ln();

    $this->Cell($w[0],6,'L4 Scenic: '.$show1l4scenic.'','LR',0,'L',$fill);
    $this->Cell($w[1],6,'L4 Scenic: '.$show2l4scenic.'','LR',0,'L',$fill);
    $this->Ln();
    
    $this->Cell($w[0],6,'L6 Loading: '.$show1l6loading.'','LR',0,'L',$fill);
    $this->Cell($w[1],6,'L6 Loading: '.$show2l6loading.'','LR',0,'L',$fill);
    $this->Ln();
    
    $this->Cell($w[0],6,'Lift Operator: '.$show1liftop.'','LR',0,'L',$fill);
    $this->Cell($w[1],6,'Lift Operator: '.$show2liftop.'','LR',0,'L',$fill);
    $this->Ln();
    
    $this->Cell($w[0],6,'L4 Loading: '.$show1rover.'','LR',0,'L',$fill);
    $this->Cell($w[1],6,'L4 Loading: '.$show2rover.'','LR',0,'L',$fill);
    $this->Ln();
    
    //another section:
    $fill = !$fill;
    $this->SetFont('','B');
    $this->Cell($w[0],6,'Show 1 Report','LR',0,'L',$fill);
    $this->Cell($w[1],6,'Show 2 Report','LR',0,'L',$fill);
    $this->SetFont('');
    $this->Ln();
    
    //Now to print the show report text:
    //*************************************************************
    //The text has <BR /> for each new line, replace with \n char:
    $show1report = str_replace ("<BR />","\n",$show1report);
    $show2report = str_replace ("<BR />","\n",$show2report);
    
    //get cursor position:
    $x_report_area = $this->GetX();
    $y_report_area = $this->GetY();
    //print this:
    $this->MultiCell($w[0],6,$show1report,'LR','L',$fill);    
    $y_report1 = $this->GetY();
    
    //move to the top, side by side with the contents of the show 1 report:
    $this->SetY($y_report_area);
    $this->SetLeftMargin($x_report_area + 90);
    
    //print this (2nd column):
    $this->MultiCell($w[1],6,$show2report,'LR','L',$fill);
    $y_report2 = $this->GetY();
    
    if ($y_report1 > $y_report2){
        for ($i = $y_report2; $i <= $y_report1; $i++){
            $this->MultiCell($w[1],1,'','LR');    
        }
        $this->SetY($y_report1);
    }
    else {
        $this->SetY($y_report1);
        $this->SetLeftMargin($x_report_area);
        $this->SetX($x_report_area);
        for ($i = $y_report1; $i <= $y_report2; $i++){
            $this->MultiCell($w[1],1,'','LR');    
        }
        $this->SetY($y_report2);        
    }
    
    //Finish up the document
    $this->SetLeftMargin($x_report_area);
    $this->SetX($x_report_area);
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
    $this->Ln();   
    $this->Ln();
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'Automatically generated from dynamic content. On occasions, page formatting may be incorrect.',0,0,'L');
}
}

$pdf = new PDF();
// Column headings
$header = array('Show 1', 'Show 2');
// Data loading
//$data = $pdf->LoadData('countries.txt');
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->FancyTable($header);

//**********************************************

// email stuff (change data below)
//Get list of users to send email to from users table

$from = "Automation mdb";
//$subject = "Automation Show Report"; 
$message = "<p><B>$subject</B> for <B>$entrydateemail</B> attached to this email.</p>Please note that this message and associated attachment were generated automatically and may contain errors.<P>
Regards,<BR / > Automation Department";

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
$filename = "$subject.pdf";

// encode data (puts attachment in proper format)
$pdfdoc = $pdf->Output("", "S");
$attachment = chunk_split(base64_encode($pdfdoc));

// main header (multipart mandatory)
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol.$eol; 
$headers .= "Content-Transfer-Encoding: 7bit".$eol;
$headers .= "This is a MIME encoded message.".$eol.$eol;

// message
$headers .= "--".$separator.$eol;
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$headers .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$headers .= $message.$eol.$eol;

// attachment
$headers .= "--".$separator.$eol;
$headers .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
$headers .= "Content-Transfer-Encoding: base64".$eol;
$headers .= "Content-Disposition: attachment".$eol.$eol;
$headers .= $attachment.$eol.$eol;
$headers .= "--".$separator."--";

// send message
mail($to, $subject, "", $headers);

?>

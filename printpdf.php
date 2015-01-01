<?php
require ("header.php");

//convert an order to pdf after asking the user if they would like to add information:

//test if we are new to this page or if it's step 2, the pdf creation
if (!isset($_POST['iteration'])) {
    //we have not been in this page before:
    $iteration = 0;
    $converttopdf = $_POST['converttopdf']; //should contain the work order number
    }
    
else {
    $iteration = 1;
    $extra_comments = $_POST['extracomments'];
    $converttopdf = $_POST['converttopdf'];// resend that WO number...
    }

if ($iteration == 0){
    //step 1: test input (if number only):
    if (!is_numeric($converttopdf)){
        echo "ERROR 2: <BR />Work Order number not numeric. Stop Exec.<BR />";
        require ("footer.php");
        die();
    }
    else {
        //test input if order exists
        require ("db.php");
        $query = "SELECT * FROM `workorders` WHERE `woid` = $converttopdf";
        $result = mysql_query($query);
        $num_results = mysql_num_rows($result);
        //if order exist, extract data:
        if ($num_results != 1) echo "ERROR 3: No such WO number!";
        else {
            //ok, we found the order, show the contents with additional field to add comments:
            //but first add the extra comments area:
            echo"<H1>Print Work Report</H1>";
                     
            print_order_function($converttopdf,"","");
            
            //print the form that will be sent back to this file to generate the pdf:
            echo "<form method=\"post\" action=\"printpdf.php\"><BR />
            <B>Enter additional comments to be printed on pdf:<BR>
            <textarea cols=\"100\" rows=\"20\" name=\"extra_comments\"></textarea>
            <input type = \"hidden\" name =\"iteration\" value =\"1\">
            <input type = \"hidden\" name =\"converttopdf\" value = \"$converttopdf\">
            <BR /><input name=\"gen_pdf\" id=\"gen_pdf\" type=\"submit\"></form>";
        }   
    }
    
    //display data to user with possibility of adding extra user info, press button to confirm pdf creation,
    
}
else if ($iteration == 1){
    //get variables
    echo "we're here!";
    //order number:
    
    //additional comments:
    
    //strip additional comments of non permitted chars:
    
    //query database to extract all other data:
    
    //generate pdf, so user can download it:
    
}

else {
//iteration number problem
echo "<BR />ERROR 1: fault. Stopping exec.<BR />";
}

require ("footer.php");

?>

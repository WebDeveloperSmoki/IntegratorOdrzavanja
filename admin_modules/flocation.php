<?php
//flocation.php - let user create, edit and disable deparments

    require("../header.php");
    require("../db.php");

    if (is_site_admin($_SESSION['valid_user']) OR is_plant_admin($_SESSION['valid_user']) OR is_dpt_admin($_SESSION['valid_user']) OR is_system_admin($_SESSION['valid_user'])){
        
        //START OF ACCESSIBLE PAGE CONTENTS
        
        if (!isset($_GET["op"])) $operation = "f";
        else $operation = $_GET["op"];
        
        if ($operation == "reg"){
                       
            //test all entries and confirm what new level(s) the user wants to add
            
            //***********************LEVEL 0 STUFF************************************
            if (!isset($_POST["lv0name"]) || ($_POST["lv0name"] == "")) $lv0add = false;
            else {
                $lv0name = $_POST["lv0name"];
                $lv0name = filter_var($lv0name,FILTER_SANITIZE_SPECIAL_CHARS);
                $lv0add = true;
            }
            
            //accept empty lv descriptions...   
            if (!isset($_POST["lv0description"]) || ($_POST["lv0description"] == "")) {}
            else {
                $lv0description = $_POST["lv0description"];
                $lv0description = filter_var($lv0description,FILTER_SANITIZE_SPECIAL_CHARS);
            }
            
            if ($lv0add) {
                $query = "INSERT INTO `lv0` (`lv0name`,`lv0description`) VALUES ('$lv0name','$lv0description')";
            
                mysql_query($query);
    
                if ( !mysql_insert_id() ){
                    echo "Error: User not added to database.".mysql_error().". Stopping exec!";
                    require ("footer.php");
                    die;
                }
                else{      
                    // Redirect to thank you page.
                    echo "NEW LEVEL 0 ADDED!<BR />";
                }
            }
            //*******************END*LEVEL 0 STUFF************************************
            
            //***********************LEVEL 2 STUFF************************************
            if (!isset($_POST["lv2name"]) || ($_POST["lv2name"] == "")) $lv2add = false;
            else {
                $lv2name = $_POST["lv2name"];
                $lv2name = filter_var($lv2name,FILTER_SANITIZE_SPECIAL_CHARS);
                $lv2add = true;
            }
            
            //accept empty lv descriptions...   
            if (!isset($_POST["lv2description"]) || ($_POST["lv2description"] == "")) {}
            else {
                $lv2description = $_POST["lv2description"];
                $lv2description = filter_var($lv2description,FILTER_SANITIZE_SPECIAL_CHARS);
            }
            
            if ($lv2add) {
                $query = "INSERT INTO `lv2` (`lv2name`,`lv2description`) VALUES ('$lv2name','$lv2description')";
            
                mysql_query($query);
    
                if ( !mysql_insert_id() ){
                    echo "Error: User not added to database.".mysql_error().". Stopping exec!";
                    require ("footer.php");
                    die;
                }
                else{      
                    // Redirect to thank you page.
                    echo "NEW LEVEL 2 ADDED!<BR />";
                }
            }
            //*******************END*LEVEL 2 STUFF************************************
            //***********************LEVEL 3 STUFF************************************
            if (!isset($_POST["lv3name"]) || ($_POST["lv3name"] == "")) $lv3add = false;
            else {
                $lv3name = $_POST["lv3name"];
                $lv3name = filter_var($lv3name,FILTER_SANITIZE_SPECIAL_CHARS);
                $lv3add = true;
            }
            
            //accept empty lv descriptions...   
            if (!isset($_POST["lv3description"]) || ($_POST["lv3description"] == "")) {}
            else {
                $lv3description = $_POST["lv3description"];
                $lv3description = filter_var($lv3description,FILTER_SANITIZE_SPECIAL_CHARS);
            }
            
            if ($lv3add) {
                $query = "INSERT INTO `lv3` (`lv3name`,`lv3description`) VALUES ('$lv3name','$lv3description')";
            
                mysql_query($query);
    
                if ( !mysql_insert_id() ){
                    echo "Error: User not added to database.".mysql_error().". Stopping exec!";
                    require ("footer.php");
                    die;
                }
                else{      
                    // Redirect to thank you page.
                    echo "NEW LEVEL 3 ADDED!<BR />";
                }
            }
            //*******************END*LEVEL 3 STUFF************************************
            //***********************lv4 STUFF************************************
            if (!isset($_POST["lv4name"]) || ($_POST["lv4name"] == "")) $lv4add = false;
            else {
                $lv4name = $_POST["lv4name"];
                $lv4name = filter_var($lv4name,FILTER_SANITIZE_SPECIAL_CHARS);
                $lv4add = true;
            }
            
            //accept empty lv descriptions...   
            if (!isset($_POST["lv4description"]) || ($_POST["lv4description"] == "")) {}
            else {
                $lv4description = $_POST["lv4description"];
                $lv4description = filter_var($lv4description,FILTER_SANITIZE_SPECIAL_CHARS);
            }
            
            if ($lv4add) {
                $query = "INSERT INTO `lv4` (`lv4name`,`lv4description`) VALUES ('$lv4name','$lv4description')";
            
                mysql_query($query);
    
                if ( !mysql_insert_id() ){
                    echo "Error: User not added to database.".mysql_error().". Stopping exec!";
                    require ("footer.php");
                    die;
                }
                else{      
                    // Redirect to thank you page.
                    echo "NEW LEVEL 4 ADDED!<BR />";
                }
            }
            //*******************END lv4 STUFF************************************
            //***********************lv5 STUFF************************************
            if (!isset($_POST["lv5name"]) || ($_POST["lv5name"] == "")) $lv5add = false;
            else {
                $lv5name = $_POST["lv5name"];
                $lv5name = filter_var($lv5name,FILTER_SANITIZE_SPECIAL_CHARS);
                $lv5add = true;
            }
            
            //accept empty lv descriptions...   
            if (!isset($_POST["lv5description"]) || ($_POST["lv5description"] == "")) {}
            else {
                $lv5description = $_POST["lv5description"];
                $lv5description = filter_var($lv5description,FILTER_SANITIZE_SPECIAL_CHARS);
            }
            
            if ($lv5add) {
                $query = "INSERT INTO `lv5` (`lv5name`,`lv5description`) VALUES ('$lv5name','$lv5description')";
            
                mysql_query($query);
    
                if ( !mysql_insert_id() ){
                    echo "Error: User not added to database.".mysql_error().". Stopping exec!";
                    require ("footer.php");
                    die;
                }
                else{      
                    // Redirect to thank you page.
                    echo "NEW LEVEL 5 ADDED!<BR />";
                }
            }
            //*******************END lv5 STUFF************************************
            //***********************lv6 STUFF************************************
            if (!isset($_POST["lv6name"]) || ($_POST["lv6name"] == "")) $lv6add = false;
            else {
                $lv6name = $_POST["lv6name"];
                $lv6name = filter_var($lv6name,FILTER_SANITIZE_SPECIAL_CHARS);
                $lv6add = true;
            }
            
            //accept empty lv descriptions...   
            if (!isset($_POST["lv6description"]) || ($_POST["lv6description"] == "")) {}
            else {
                $lv6description = $_POST["lv6description"];
                $lv6description = filter_var($lv6description,FILTER_SANITIZE_SPECIAL_CHARS);
            }
            
            if ($lv6add) {
                $query = "INSERT INTO `lv6` (`lv6name`,`lv6description`) VALUES ('$lv6name','$lv6description')";
            
                mysql_query($query);
    
                if ( !mysql_insert_id() ){
                    echo "Error: User not added to database.".mysql_error().". Stopping exec!";
                    require ("footer.php");
                    die;
                }
                else{      
                    // Redirect to thank you page.
                    echo "NEW LEVEL 6 ADDED!<BR />";
                }
            }
            //*******************END lv6 STUFF************************************        
            //***********************lv7 STUFF************************************
            if (!isset($_POST["lv7name"]) || ($_POST["lv7name"] == "")) $lv7add = false;
            else {
                $lv7name = $_POST["lv7name"];
                $lv7name = filter_var($lv7name,FILTER_SANITIZE_SPECIAL_CHARS);
                $lv7add = true;
            }
            
            //accept empty lv descriptions...   
            if (!isset($_POST["lv7description"]) || ($_POST["lv7description"] == "")) {}
            else {
                $lv7description = $_POST["lv7description"];
                $lv7description = filter_var($lv7description,FILTER_SANITIZE_SPECIAL_CHARS);
            }
            
            if ($lv7add) {
                $query = "INSERT INTO `lv7` (`lv7name`,`lv7description`) VALUES ('$lv7name','$lv7description')";
            
                mysql_query($query);
    
                if ( !mysql_insert_id() ){
                    echo "Error: User not added to database.".mysql_error().". Stopping exec!";
                    require ("footer.php");
                    die;
                }
                else{      
                    // Redirect to thank you page.
                    echo "NEW LEVEL 7 ADDED!<BR />";
                }
            }
            //*******************END lv7 STUFF************************************
            echo "<br /><a href = \"flocation.php\">Back</a><BR />";                   
        }
        
         else {
            //Whatever other option that $operation may have comes here
            //so show the add department form:
            echo "<H1>Add New Equipment Level</H1>";
            echo "<form action=\"?op=reg\" method=\"POST\">\n";
            
            echo "You may add all or some of the following. If not adding an item to a level, simply leave the entries empty. (click the submit button at the bottom when you're done): <BR />";
            
            //----------------------------------------LEVEL 0
            if (!is_site_admin($_SESSION['valid_user'])) echo "No permissions to add level 0 entries.";
            else{
                echo "<BR /><table border =\"0\" width =\"100%\"><tr><td>";
                echo "<B><font color=\"red\">LEVEL 0 - UNIT/ VENUE/ PLANT</font></B><BR />";
                echo "<B>Name:</B> <input name=\"lv0name\" MAXLENGTH=\"30\"><BR /><I>This is the root level. Tipically a manufacturing unit or venue. Most users should use only one item at this level. Shows on forms. It's better to make it short. e.g. Unit A</I><P>\n";
                echo "<B>Description:</B> <input name=\"lv0description\" MAXLENGTH=\"100\"><BR /><I> This is the root level short description. e.g. ABC Plastic Factory - Unit A.</I>\n";           
                echo "</tr></td></table>";
            } 
            //----------------------------------------END LEVEL 0
            
            //----------------------------------------LEVEL 2
            if (is_site_admin($_SESSION['valid_user']) OR is_plant_admin($_SESSION['valid_user']) OR is_dpt_admin($_SESSION['valid_user'])){
                echo "<BR /><table border =\"0\" width =\"100%\"><tr><td>";
                echo "<B><font color=\"red\">LEVEL 2 - SYSTEM</font> <I><font size = \"1\">There's no level 1 because that's department and that is configured <a href= \"departments.php\">here</a></font></I></B><BR />";
                echo "<B>Name:</B> <input name=\"lv2name\" MAXLENGTH=\"30\"><BR /><I>This is the system level. Shows on forms. It's better to make it short. e.g. HVAC 1</I><P>\n";
                echo "<B>Description:</B> <input name=\"lv2description\" MAXLENGTH=\"100\"><BR /><I>e.g. HVAC System 1</I>\n";           
                echo "</tr></td></table>";
            }
            else echo "No permissions to add level 2 entries.";
            //----------------------------------------END LEVEL 2
            
            //----------------------------------------LEVEL 3
                echo "<BR /><table border =\"0\" width =\"100%\"><tr><td>";
                echo "<B><font color=\"red\">LEVEL 3 - LOCATION PART 1</font></B><BR />";
                echo "<B>Name:</B> <input name=\"lv3name\" MAXLENGTH=\"30\"><BR /><I>Geographic location like building name or floor number. Useful to assign jobs by physical location. Shows on forms. It's better to make it short. e.g. Building A</I><P>\n";
                echo "<B>Description:</B> <input name=\"lv3description\" MAXLENGTH=\"100\"><BR /><I>e.g. Office Unit</I>\n";           
                echo "</tr></td></table>";
            //----------------------------------------END LEVEL 3
            
            //----------------------------------------LEVEL 4
            echo "<BR /><table border =\"0\" width =\"100%\"><tr><td>";
            echo "<B><font color=\"red\">LEVEL 4 - LOCATION PART 2</font></B><BR />";
            echo "<B>Name:</B> <input name=\"lv4name\" MAXLENGTH=\"30\"><BR />
            <I>Geographic location like floor number. Useful to assign jobs by physical location. Shows on forms. It's better to make it short. e.g. L02</I><P>\n";
            echo "<B>Description:</B> <input name=\"lv4description\" MAXLENGTH=\"100\"><BR /><I>e.g. 2nd Floor</I>\n";           
            echo "</tr></td></table>";
            //----------------------------------------END LEVEL 4
            
            //----------------------------------------LEVEL 5
            if (is_site_admin($_SESSION['valid_user']) OR is_plant_admin($_SESSION['valid_user']) OR is_dpt_admin($_SESSION['valid_user']) OR is_system_admin($_SESSION['valid_user'])){
            echo "<BR /><table border =\"0\" width =\"100%\"><tr><td>";
            echo "<B><font color=\"red\">LEVEL 5 - SUBSYSTEM</font></B><BR />";
            echo "<B>Name:</B> <input name=\"lv5name\" MAXLENGTH=\"30\"><BR />
            <I>Subsystem under the system. Shows on forms. It's better to make it short. e.g. WP1</I><P>\n";
            echo "<B>Description:</B> <input name=\"lv5description\" MAXLENGTH=\"100\"><BR /><I>e.g. HVAC Water Pump Skid 1</I>\n";           
            echo "</tr></td></table>";
            }
            else echo "No permissions to add level 3 entries.";
            //----------------------------------------END LEVEL 5
            
            //----------------------------------------LEVEL 6
            echo "<BR /><table border =\"0\" width =\"100%\"><tr><td>";
            echo "<B><font color=\"red\">LEVEL 6 - JOB TYPE</font></B><BR />";
            echo "<B>Name:</B> <input name=\"lv6name\" MAXLENGTH=\"30\"><BR />
            <I>Specifies the job type. Shows on forms. It's better to make it short. e.g. ELEC</I><P>\n";
            echo "<B>Description:</B> <input name=\"lv6description\" MAXLENGTH=\"100\"><BR /><I>e.g. Electrical</I>\n";           
            echo "</tr></td></table>";
            //----------------------------------------END LEVEL 6
            
            //----------------------------------------LEVEL 7
            echo "<BR /><table border =\"0\" width =\"100%\"><tr><td>";
            echo "<B><font color=\"red\">LEVEL 7 - COMPONENT</font></B><BR />";
            echo "<B>Name:</B> <input name=\"lv7name\" MAXLENGTH=\"30\"><BR />
            <I>The component on the system/subsystem. Shows on forms. It's better to make it short. e.g. PP Contactor</I><P>\n";
            echo "<B>Description:</B> <input name=\"lv7description\" MAXLENGTH=\"100\"><BR /><I>e.g. Main Pump Contactor</I>\n";           
            echo "</tr></td></table>";
            //----------------------------------------END LEVEL 7
            
            echo "<input type=\"submit\">\n ";
            echo "</form>\n";
            
            echo "<H1>Edit/ Disable Equipment Level</H1>";

        }
        
        //END OF ACCESSIBLE PAGE CONTENTS
    }
    else {
        //user not authorized
        echo "You're not authorized to access this file!";
    }
    
    require("../footer.php");

?>

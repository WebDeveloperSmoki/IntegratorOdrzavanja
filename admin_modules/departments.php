<?php
//departments.php - let user create, edit and disable deparments

    require("../header.php");
    require("../db.php");

    if (is_site_admin($_SESSION['valid_user']) OR is_plant_admin($_SESSION['valid_user'])){
        //START OF ACCESSIBLE PAGE CONTENTS
        
        if (!isset($_GET["op"])) $operation = "f";
        else $operation = $_GET["op"];
        
        if ($operation == "reg"){
            //ok, this is to register a new department:
            $bInputFlag = true;
    
            if (!isset($_POST["newdptname"]) || ($_POST["newdptname"] == "")) $bInputFlag = false;
            else $newdptname = $_POST["newdptname"];
    
            if (!isset($_POST["newdptdescription"]) || ($_POST["newdptdescription"] == "")) $bInputFlag = false;
            else $newdptdescription = $_POST["newdptdescription"];
            
            //test inputs:
            if ($bInputFlag == false) {
            echo "All fields are required (<a href = departments.php><- go back</a>). Stopping exec!";
            require("../footer.php");
            die;            
            }
            
            //ok, all should be good, lets put stuff in the database after stripping illegal chars:
            $newdptname = filter_var($newdptname,FILTER_SANITIZE_SPECIAL_CHARS);
            $newdptdescription = filter_var($newdptdescription,FILTER_SANITIZE_SPECIAL_CHARS);
            
            $query = "INSERT INTO `lv1` (`lv1name`,`lv1description`) VALUES ('$newdptname','$newdptdescription')";
            
            mysql_query($query);
    
            if ( !mysql_insert_id() ){
                echo "Error: Dpt not added to database.".mysql_error().". Stopping exec!";
                require ("footer.php");
                die;
            }
            else{      
                // Redirect to thank you page.
                echo "All good! <a href= \"$root_dir/admin_modules/departments.php\">Go Back</a>.";
            }
                       
        }      
        else {
            //Whatever other option that $operation may have comes here
            //so show the add department form:
            echo "<H1>Add New Department</H1>";
            echo "<form action=\"?op=reg\" method=\"POST\">\n";
            echo "New Department Name: <input name=\"newdptname\" MAXLENGTH=\"16\"><br />\n";
            echo "Department Description: <input name=\"newdptdescription\" MAXLENGTH=\"50\"><br />\n";
            echo "<input type=\"submit\" name =\"Add Department\">\n ";
            echo "</form>\n";
            
            echo "<H1>Edit/ Disable Department</H1>";

        }
        
        //END OF ACCESSIBLE PAGE CONTENTS
    }
    else {
        //user not authorized
        echo "You're not authorized to access this file!";
    }
    
    require("../footer.php");

?>

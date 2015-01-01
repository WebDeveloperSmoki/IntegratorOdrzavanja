<?php

    require("../header.php");
    require("../db.php");

if (is_site_admin($_SESSION['valid_user']) OR is_plant_admin($_SESSION['valid_user']) OR is_dpt_admin($_SESSION['valid_user'])){
        //START OF ACCESSIBLE PAGE CONTENTS
        if (!isset($_GET["op"])) $operation = "f";
        else $operation = $_GET["op"];
        
        if ($operation == "reg"){
            //ok, this is to register a new department:
            $bInputFlag = true;
    
            if (!isset($_POST["newtagname"]) || ($_POST["newtagname"] == "")) $bInputFlag = false;
            else $newtagname = $_POST["newtagname"];
    
            if (!isset($_POST["newtagdescription"]) || ($_POST["newtagdescription"] == "")) $bInputFlag = false;
            else $newtagdescription = $_POST["newtagdescription"];
            
            //test inputs:
            if ($bInputFlag == false) {
            echo "All fields are required (<a href = tags.php><- go back</a>). Stopping exec!";
            require("../footer.php");
            die;            
            }
            
            //ok, all should be good, lets put stuff in the database after stripping illegal chars:
            $newtagname = filter_var($newtagname,FILTER_SANITIZE_SPECIAL_CHARS);
            $newtagdescription = filter_var($newtagdescription,FILTER_SANITIZE_SPECIAL_CHARS);
            
            $query = "INSERT INTO `tags` (`tagname`,`tagdescription`) VALUES ('$newtagname','$newtagdescription')";
            
            mysql_query($query);
    
            if ( !mysql_insert_id() ){
                echo "Error: Tag not added to database.".mysql_error().". Stopping exec!";
                require ("footer.php");
                die;
            }
            else{      
                // Redirect to thank you page.
                echo "All good! <a href= \"$root_dir/admin_modules/tags.php\">Go Back</a>.";
            }
                       
        }      
        else {
            //Whatever other option that $operation may have comes here
            //so show the add department form:
            echo "<H1>Add New Tag</H1>";
            echo "<form action=\"?op=reg\" method=\"POST\">\n";
            echo "New Tag Name: <input name=\"newtagname\" MAXLENGTH=\"16\"><br />\n";
            echo "Department Description: <input name=\"newtagdescription\" MAXLENGTH=\"50\"><br />\n";
            echo "<input type=\"submit\" name =\"Add Tag\">\n ";
            echo "</form>\n";
            
            echo "<H1>Edit/ Disable Tags</H1>";

        }
        
        //END OF ACCESSIBLE PAGE CONTENTS
    }
    else {
        //user not authorized
        echo "You're not authorized to access this file!";
    }
    
    require("../footer.php");

?>

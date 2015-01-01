<?php
require("../header.php");
require("../db.php");

if (is_site_admin($_SESSION['valid_user']) OR is_plant_admin($_SESSION['valid_user']) OR is_dpt_admin($_SESSION['valid_user'])){
//User registration handling file
//***
echo "<H1>Register a New User</H1>";
//gets and tests proposed username for uniqueness (remember username must be unique)
//tests if required email address already exists | tests email address for validity
//sends confirmation email/ generate write and read key
//creates and resets passwords

if (!isset($_GET["op"])) $operation = "f";
else $operation = $_GET["op"];

//Input validation and the dbase code
if ($operation == "reg"){
    
    $bInputFlag = true;
    
    if (!isset($_POST["username"]) || ($_POST["username"] == "")) $bInputFlag = false;
    else $username = $_POST["username"];
    
    if (!isset($_POST["password"]) || ($_POST["password"] == "")) $bInputFlag = false;
    else $userpass = $_POST["password"];
    
    if (!isset($_POST["email"]) || ($_POST["email"] == "")) $bInputFlag = false;
    else $useremail = $_POST["email"];
    
    if (!isset($_POST["usergroup"]) || ($_POST["usergroup"] == "")) $bInputFlag = false;
    else $usergroup = $_POST["usergroup"];
    
    if (!isset($_POST["userdepartment"]) || ($_POST["userdepartment"] == "")) $bInputFlag = false;
    else $userdepartment = $_POST["userdepartment"];
    
    //turn usergroup into an index:
    $query = "SELECT * FROM usergroups WHERE usergroups_name = \"$usergroup\"";
    $result = mysql_query ($query);
    $usergroup =  mysql_result($result,0,"usergroups_id");
    
    //turn userdepartment into an index:
    $query = "SELECT * FROM lv1 WHERE lv1name = \"$userdepartment\"";
    $result = mysql_query ($query);
    $userdepartment =  mysql_result($result,0,"lv1id");
    
    //If we had problems with the input, exit with error
    if ($bInputFlag == false) {
        echo "All fields are required (<a href = registerusers.php><- go back</a>). Stopping exec!";
        require("../footer.php");
        die;
       }
        
    //Check if username is unique:
    $query = "SELECT * FROM users WHERE username = \"$username\"";
    $result = mysql_query ($query);
    
    if (mysql_num_rows($result) == 0) {} //do nothing, keep going
    else {
        echo "username not unique, sorry! (<a href = registerusers.php><- go back</a>). Stopping exec!";
        require("../footer.php");
        die;
       }

    //test email entry:
    
    if(filter_var("$useremail", FILTER_VALIDATE_EMAIL)) {} //do nothing, keep going
    else {
        echo "email address not valid! (<a href = registerusers.php><- go back</a>). Stopping exec!";
        require("../footer.php");
        die;
    }
    
    //Fields are clear, add user to database
    //Setup query
$query = "INSERT INTO `users` (`username`,`dptid`,`userpass`,`useremail`,`usergroup`,`receiveemails`,`mainadmin`) VALUES ('".$username."',".$userdepartment.", PASSWORD('".$userpass."'), '".$useremail."',".$usergroup.",\"N\",\"N\")";
    //Run query
    mysql_query($query);
    
    if ( !mysql_insert_id() )
        {
        die("Error: User not added to database.".mysql_error().". Stopping exec!");
        }
    else
        {      
        // Redirect to thank you page.
        echo "All good! <a href= \"$root_dir/dashboard.php\">Click here</a> to continue.";
        }
} // end if


//The thank you page
elseif ($operation == "thanks") echo "<h2>Thanks for registering!</h2>";
  
//The web form for input ability
else{
    echo "<form action=\"?op=reg\" method=\"POST\">\n";
    echo "Username: <input name=\"username\" MAXLENGTH=\"16\"><br />\n";
    echo "Password: <input type=\"password\" name=\"password\" MAXLENGTH=\"16\"><br />\n";
    echo "Email Address: <input name=\"email\" MAXLENGTH=\"100\"><br />\n";
    echo "User Group: <select name=\"usergroup\" id=\"level\">";
    /****/
    list_table_entries("usergroups", "<option>", "</option>", 1, -1);      
    /****/
    echo "</select><br />\n";
    
    echo "User Department: <select name=\"userdepartment\" id=\"userdepartment\">";
    /****/
    list_table_entries("lv1", "<option>", "</option>", 1, -1);      
    /****/
    echo "</select><br />\n";
    
    echo "<input type=\"submit\">\n ";
    echo "</form>\n";
    
    //*******************************************
    //LIST ALL USERS TO ALLOW EDIT OF INFORMATION
    
    echo "<H1>Edit/ Disable Existing Users</H1>";
    
    $q = "SELECT * FROM users";
    $result = mysql_query($q);
    $num_rows = mysql_num_rows( $result );
    
    print "There are currently $num_rows rows in the table<P>";
//    print "<table border=1>\n";
//    
//    while ( $a_row = mysql_fetch_row( $result ) ){
//        print "<tr>\n";
//        
//        foreach ( $a_row as $field )
//            print "\t<td>$field</td>\n";
//        print "</tr>\n";
//    
//    }

//    print "</table>\n";

    
    //*******************************************
}

    }
    else {
        //user not authorized
        echo "You're not authorized to access this file!";
    }    
    require("../footer.php");
?>

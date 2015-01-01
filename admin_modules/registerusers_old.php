<?php
require("../header.php");

//User registration handling file
//***
echo "<H1>Register a New User</H1>";
//gets and tests proposed username for uniqueness (remember username must be unique)
//tests if required email address already exists | tests email address for validity
//sends confirmation email/ generate write and read key
//creates and resets passwords

require ("../db.php");

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
    
    //turn usergroup into an index:
    $query = "SELECT * FROM usergroups WHERE usergroups_name = \"$usergroup\"";
    $result = mysql_query ($query);
    $usergroup =  mysql_result($result,0,"usergroups_id");
    
    //If we had problems with the input, exit with error
    if ($bInputFlag == false) die( "All fields are required (<a href = register.php><- go back</a>). Stopping exec!");

    //Fields are clear, add user to database
    //Setup query
    $query = "INSERT INTO `users` (`username`,`userpass`,`useremail`,`usergroup`) VALUES ('".$username."', PASSWORD('".$userpass."'), '".$useremail."',".$usergroup.")";
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
    echo "<input type=\"submit\">\n ";
    echo "</form>\n";
}

require ("../footer.php");
?>

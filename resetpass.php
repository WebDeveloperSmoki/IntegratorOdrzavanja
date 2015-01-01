<?php
require ('db.php');
//sends reset password for the username
echo "<H1>Reset Your Password</H1>";
//ask username (this can always be retrieved from the list of users, even if the user does not know his username:

$op = $_GET['op'];

if (!isset($op) || ($op != "s2" && $op != "s3")){
    echo "<form action=\"?op=s2\" method=\"POST\">";
    echo "Username: <input name=\"username\" size=\"15\"><br />";
    echo "Email Address: <input type=\"text\" name=\"email\" size=\"20\"><br />";
    echo "<input type=\"submit\" value=\"resetpass\">";
    echo "</form>";
    }

else if ($op == "s2") {
    //ok, we're in step two, user entered info, get data:
    $username = $_POST['username'];
    //$username = filter_var($username,FILTER_SANITIZE_SPECIAL_CHARS);
    $emailaddress = $_POST['email'];
    //$emailaddress = filter_var($emailaddress,FILTER_SANITIZE_SPECIAL_CHARS);    
    
    //verify if username exists
    $query = "SELECT * FROM `users` WHERE (`username` = \"$username\" AND `useremail` = \"$emailaddress\")";
    $resultuser = mysql_query($query) or die (mysql_error());
    
    if (mysql_num_rows($resultuser) != 1)
        echo "ERROR 1. Confirm email and/ or username spelling. 
        Back to <a href=\"$site_root/login.php\">login page</a> or back to <a href=\"$site_root/resetpass.php\">reset password</a> page.";
    else {    
        //if all good, generate new password and place in the user's field on the users' table
        $newpass = generatePassword();
        //Place this new password on the database:
        $row = mysql_fetch_array($resultuser) or die (mysql_error());
        $query = "UPDATE users SET userpass = PASSWORD('$newpass') WHERE users_id = \"".$row[0]."\"";
        //Run query
        mysql_query($query) or die (mysql_error());
        //send email to user with new pass and verification URL, wich is this one
        
        $headers = 'From: automation@dragone.mo' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
        
        mail($emailaddress, "New Automation mdb password!", "Your new mdb passsword is $newpass.", $headers);
        
        echo "<BR />OK! Your New password has been emailed to you! Back to the <a href= \"login.php\">login page</a>.";
    }

    }
else if ($op == "s3"){
    //activate pass, user has confirmed.
    echo "here, on s3";
    }
else echo "This is not supposed to happen!";


function generatePassword ($length = 6)
  {

    // start with a blank password
    $password = "";

    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);
  
    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
      $length = $maxlength;
    }
	
    // set up a counter for how many characters are in the password so far
    $i = 0; 
    
    // add random characters to $password until $length is reached
    while ($i < $length) { 

      // pick a random character from the possible ones
      $char = substr($possible, mt_rand(0, $maxlength-1), 1);
        
      // have we already used this character in $password?
      if (!strstr($password, $char)) { 
        // no, so it's OK to add it onto the end of whatever we've already got...
        $password .= $char;
        // ... and increase the counter by one
        $i++;
      }

    }

    // done!
    return $password;

  }

?>

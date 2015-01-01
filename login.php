<?php

//logs user in...
require("header.php");
include "db.php";

if (!isset($_GET["op"])) $operation = "f";
else $operation = $_GET["op"];

        if ($operation == "login")
  {
  if (!$_POST["username"] || !$_POST["password"])
        {
        die("<P>You need to provide a username and password.");
        }
  
  // Create query
  $q = "SELECT * FROM `users` "
        ."WHERE `username`='".$_POST["username"]."' "
        ."AND `userpass`=PASSWORD('".$_POST["password"]."') "
        ."LIMIT 1";
  // Run query
  $r = mysql_query($q);

  if ( $obj = @mysql_fetch_object($r) )
        {
        // Login good, create session variables
        $_SESSION["valid_id"] = $obj->id;
        $_SESSION["valid_user"] = $_POST["username"];
        $_SESSION["valid_time"] = time();

        // Redirect to member page
        echo "You're in! Please <a href=\"dashboard.php\">Click here</a> to continue.";
        }
  else
        {
        // Login not successful
        echo "Sorry, could not log you in. Wrong login information.";
        }
  }
        else
  {
//If all went right the Web form appears and users can log in
  echo "<form action=\"?op=login\" method=\"POST\">";
  echo "Username: <input name=\"username\" size=\"15\"><br />";
  echo "Password: <input type=\"password\" name=\"password\" size=\"8\"><br />";
  echo "<input type=\"submit\" value=\"Login\">";
  echo "</form>";
  echo "<a href = \"resetpass.php\">Forgot password?</A>";
  }
  
  require("footer.php");
        ?>

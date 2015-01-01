<?php
//This page is showned to the main admin user and allows him/ her to:
//1.
    require("../header.php");
    require("../db.php");

    if (is_site_admin($_SESSION['valid_user']) OR is_plant_admin($_SESSION['valid_user']) OR is_dpt_admin($_SESSION['valid_user']) OR is_system_admin($_SESSION['valid_user'])){
        //START OF ACCESSIBLE PAGE CONTENTS
        //tabs: users | functional locations | equipment | spares | site
        
        echo "<P><a href = \"registerusers.php\">Users</a><BR />";
        echo "<a href = \"departments.php\">Organization Departments</a><BR />";
        echo "<a href = \"flocation.php\">Asset/ Equipment Codes</a><BR />";
        echo "<a href = \"tags.php\">Tags</a><BR />";
        echo "<a href = \"sconfig.php\">Site</a><BR />";
        
        
        //END OF ACCESSIBLE PAGE CONTENTS
    }
    else {
        //user not authorized
        echo "You're not authorized to access this file!";
    }
    
    require("../footer.php");

?>

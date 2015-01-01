<?php
//footer - just login information and other fixed links

if (isset($link)) mysql_close($link); //we're just closing the connection that was opened by db_conf.php

echo "<HR>";
echo "<CENTER><img src =\"$root_dir/images/thodw.jpg\" border = \"0\" width =\"100\" height =\"76\"></CENTER>";
?>

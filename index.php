<?php
//index.php - simple redirect from root to dashboard.php

require ("config/config.php");

header( "Location: $root_dir/dashboard.php" ) ;
?>

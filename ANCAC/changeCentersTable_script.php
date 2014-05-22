<?php
require("./Variables.php");
require($root."dbconn.php");

echo("changing table  ");
$sqlAlter = "ALTER TABLE `centers` ADD `centerAddressLine1` VARCHAR(200) NOT NULL, ADD `centerAddressLine2` VARCHAR(200) NOT NULL, ADD `centerCity` VARCHAR(50) NOT NULL, ADD `centerZip` VARCHAR(10) NOT NULL, ADD `centerPhone` VARCHAR(25) NOT NULL, ADD `centerEmail` VARCHAR(100) NOT NULL";
mysql_query($sqlAlter);
echo("   done");
?>

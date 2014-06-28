<?php
require("./Variables.php");
require($root."dbconn.php");

echo("changing table  ");
$sqlAlter = "ALTER TABLE `actualPerfStats` ADD `fi18plus` MEDIUMINT(9) NOT NULL, ADD `humanTrafficking` MEDIUMINT(9) NOT NULL";
mysql_query($sqlAlter);
echo("   done");
?>

<?php
require("./Variables.php");
require($root."dbconn.php");

echo("changing table  ");
$sqlAlter = "ALTER TABLE `directors` ADD `mailing_address` varchar(100) NOT NULL DEFAULT ''";
mysql_query($sqlAlter);
echo("   done");
?>

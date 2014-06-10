<?php
require("./Variables.php");
require($root."dbconn.php");
require($root."PasswordHash.php");

$hasher = new PasswordHash(8, false);
echo("altering batabase tables  ");

$sqlAlter = "ALTER TABLE `directors` CHANGE `password` `password` VARCHAR( 72 ) NOT NULL DEFAULT''";
mysql_query($sqlAlter);

$sqlAlter = "ALTER TABLE `centers` ADD `centerAddressLine1` VARCHAR(200) NOT NULL, ADD `centerAddressLine2` VARCHAR(200) NOT NULL, ADD `centerCity` VARCHAR(50) NOT NULL, ADD `centerZip` VARCHAR(10) NOT NULL, ADD `centerPhone` VARCHAR(25) NOT NULL, ADD `centerEmail` VARCHAR(100) NOT NULL";
mysql_query($sqlAlter);

$sqlAlter = "ALTER TABLE `directors` ADD `mailing_address` varchar(100) NOT NULL DEFAULT ''";
mysql_query($sqlAlter);


$sql = "SELECT password FROM directors";
$result = @mysql_query($sql) or mysql_error();
while ($row = mysql_fetch_object($result)) {
	echo("hashing passwords...");

	$hash=$hasher->HashPassword($row->password);
	$sqlUpdate = "UPDATE directors SET password = '".$hash."' WHERE password = '".$row->password."'";
	//	echo($sqlUpdate);
	mysql_query($sqlUpdate);
}
echo("   done");
?>

<?
require("./dbconn.php");
require("./PasswordHash.php");

$hasher = new PasswordHash(8, false);

$sql = "SELECT password FROM directors";
$result = @mysql_query($sql) or mysql_error();
echo($result);
while ($row = mysql_fetch_object($result)) {
	
	
	$hash=$hasher->HashPassword($row->password);
echo($hash."  "."|".$row->password."|");
	$sqlUpdate = "UPDATE directors SET password = '".$hash."' WHERE password = '".$row->password."'";
//	echo($sqlUpdate);
	$resultUpdate = @mysql_query($sqlUpdate) or mysql_error();
	echo($resultUpdate);
}
?>

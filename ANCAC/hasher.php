<?php
require("./dbconn.php");
require("./PasswordHash.php");

echo("checking for backup table... ");
$result = mysql_query("SHOW TABLES LIKE 'directors_BACKUP'");
$tableExists = mysql_num_rows($result) > 0;

if(!$tableExists){
        echo(" making backup... ");
        $sqlCreate="CREATE TABLE `ancac`.`directors_BACKUP` ( `RID` int( 11 ) NOT NULL AUTO_INCREMENT ,`name` varchar( 40 ) NOT NULL DEFAULT '',`username` varchar( 12 ) NOT NULL DEFAULT '',`email` varchar( $
        mysql_query($sqlCreate);
        $sqlSet="SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';";
        mysql_query($sqlSet);  
        $sqlInsert="INSERT INTO `ancac`.`directors_BACKUP` SELECT * FROM `ancac`.`directors`;[...]";
        $hasher = new PasswordHash(8, false);
        echo(" changing table... ");
        $sqlAlter = "ALTER TABLE `directors` CHANGE `password` `password` VARCHAR( 72 ) NOT NULL DEFAULT''";
        mysql_query($sqlAlter); 

        $sql = "SELECT password FROM directors";
        $result = @mysql_query($sql) or mysql_error();
        while ($row = mysql_fetch_object($result)) {
                echo("hashing...");

                $hash=$hasher->HashPassword($row->password);
                $sqlUpdate = "UPDATE directors SET password = '".$hash."' WHERE password = '".$row->password."'";
        //      echo($sqlUpdate);
                mysql_query($sqlUpdate);
        }
}
else
        echo(" passwords already hashed.");
echo(" finished");
?>

<?php
require("./Variables.php");
require($root."dbconn.php");
require($root."PasswordHash.php");
$hasher = new PasswordHash(8, false);


function randomPassword() {
	$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < 8; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass); //turn the array into a string
}


if($_POST['Reset'] != 1)
{
	echo "<html><head><title>ANCAC: Password reset</title><br><br><link rel='stylesheet' href='login.css' type='text/css'></head>";
	echo "<p><form method=POST action='$self'><input type=hidden name=Reset value=1><div align='center' style='width=100%;'>";
	echo "<table class='loginMain' align=center><tr><td colspan='2' class='login-header' align=center>ANCAC".
			"<div class='login-subheader'>For Centers & Admin Office</div></td></tr> <tr><br><br><td colspan='2' class='login'><br><br>Please enter your username.</td></tr>".
			"<tr><td class='login-left' align=right>User Name:&nbsp</td><td class='login-right'>".
			"<input type=text NAME=username></td></tr><tr>".
			"<td colspan=2 class=login>A new password will be sent to the email address associated with this username.</td></tr>";
	echo "<tr><td colspan='2' class='login' align=center><input type=hidden value=on name=keeplog></td></tr><tr><td colspan='2' class='login' align=center><input type='SUBMIT' value='Reset'><br><br></td></tr></form></table></div>";
}
else
{
	//	$admin_email = "ki4dfh@gmail.com";
	$admin_email = "gsouth@alabamacacs.org";
	$sql="SELECT email FROM directors WHERE username = '".$_POST['username']."'";
	$result = @mysql_query($sql) or mysql_error();
	if ($row = mysql_fetch_object($result))
	{
		$to=$row->email;

		header("Content-Type:text/html");
		$password = randomPassword();

		//		echo("User:".$_POST['username']."  New Password:".$password);
		$email_body = "A password reset was requested for ".$_POST['username'].".\nThe new password is: ".$password."\n\nThis is an automated message, for any problems, contact ".$admin_email;
		$success = mail($to,"ANCAC Password reset for ".$_POST['username'],$email_body, "From: \"ANCAC Online\" <ANCAC_DONOTREPLY@alabamacacs.org>\r\nReply-To:ANCAC_DONOTREPLY@alabamacacs.org\r\nBcc:$admin_email");
		$success = 1;
		//		echo $to;
		if ($success == 1){
			echo "</br>Your email was sent successfully.</br>";
			$sqlUpdate = "UPDATE directors SET password = '".$hasher->HashPassword($password)."' WHERE username = '".$_POST['username']."'";
			//				echo $sqlUpdate;
			$resultUpdate = @mysql_query($sqlUpdate) or mysql_error();
		}
		else
			echo "Your email was NOT sent.  Please contact ".$admin_email."</br>";
	}
	else
		echo "ERROR: username not found</br>";
	echo "</br><a href=./index.php> Return to login page.</a>";


}
//}

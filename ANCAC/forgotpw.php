<?php
if($_POST['Reset'] != 1)
{
	echo "<html><head><title>ANCAC: Password reset</title><br><br><link rel='stylesheet' href='login.css' type='text/css'></head>";
	echo "<p><form method=POST action='$self'><input type=hidden name=Login value=1><div align='center' style='width=100%;'>";
	echo "<table class='loginMain' align=center><tr><td colspan='2' class='login-header' align=center>ANCAC".
                 "<div class='login-subheader'>For Centers & Admin Office</div></td></tr> <tr><br><br><td colspan='2' class='login'><br><br>Please Login</td></tr>".
                 "<tr><td class='login-left' align=right>User Name:&nbsp</td><td class='login-right'>".
                 "<input type=text NAME=username></td></tr><tr>".
                 "<td class='login-left' align=right>A new password will be sent to the email address associated with this username.</td></tr>";
	echo "<tr><td colspan='2' class='login' align=center><input type=hidden value=on name=keeplog></td></tr><tr><td colspan='2' class='login' align=center><input type='SUBMIT' value='Reset'><br><br></td></tr></form></table></div>";
}
else
{
	echo($_POST['username']);
	
}
<?PHP
	require("ulogin.php");
	$page_title = 'ANCAC: Main Menu';
	require($root."header.php");

	switch (date("m")){
                case 10:
                        $EOYAvailable = 1;
                        //The below was commented out since they say they want it to be good for the rest of October
//                        if (date("j") < 11)
 //                               $EOYAvailable = 1;
  //                      else
   //                             $EOYAvailable = 0;
                        break;
                case 1:
                case 2:
                case 3:
                case 4:
                case 5:
                case 6:
                case 7:
                case 8:
                case 9:
                case 11:
                case 12:
                        $EOYAvailable = 0;
                        break;
        }
?>

<table class='login' align=center width="293"><tr>
<td class='login-header' colspan='2' align=center>ANCAC MAIN MENU<br></td></tr> <tr>
<td class='login' align=left><br>
&nbsp;<div align="center">
	<table border="0" width="80%" id="table1">
		<tr>
			<td>
<?PHP
	if($_SESSION['admin'] > 1)
	{
		echo '<br><u>Admin Functions:</u>';
		echo '<p>1. <a href="AcctAdmin.php">Account Administration</a></p>';
		echo '<p>2. <a href="LastLogin.php">View Last Login for Centers</a></p>';
		echo '<p>3. <a href="email.php">Email Entire Network</a></p>';
		echo '<p>4. <a href=networkcalendar/login.php>Calendar Admin</a></p>';
		echo '<p>5. Lock/Unlock All Non-Admins Out of System</p>';
		echo '<p>6. <a href="qreportAdmin.php?from=8">Received Snail-Mail Documents</a></p>';
		echo '<br><br>';

	}

?>


<?PHP
	if($_SESSION['admin'] > 0)
	{
		echo '<br><u>Special Functions:</u>';
		echo '<p>1. <a href=haveSubmit.php>View which Centers have/havent submitted current Quarterly Report</a></p>';
		echo '<p>2. <a href="selectYearGT.php?from=2">View / Print ANCAC Grand Total Report</a></p>';
		echo '<p>3. <a href="selectYearGT.php?from=3">View / Print ANCAC Estimated Budget Totals Report</a></p>';
		echo '<p>4. <a href="qreportAdmin.php?from=9">View / Print ANCAC Board of Directors</a></p>';
		echo '<p>5. Add/Delete Shared Documents</p>';
		echo '<p>6. Add/Edit/Delete Job Announcements</p>';
		echo '<p>7. <a href="eoyProgress.php">Check the End of Year Status</a></p>';
		echo '<br><br>';

	}

?>

			<?PHP if ($_SESSION['admin'] == 1) echo '<p>1. Quarterly Reports (Unavailable)</p>';
			     else echo '<p>1. <a href=qreports.php>Quarterly Reports</a></p>'; ?>
			<?PHP if ($_SESSION['admin'] > 1) echo '<p>2. <a href="qreportAdmin.php?from=7">End of Year Reports</a></p>';
                           else {
                             if ($EOYAvailable == 1) echo '<p>2. <a href=eoyreports.php>End of Year Reports</a></p>';
			     else echo '<p>2. End of Year Reports (Unavailable)</p>';
                            } ?>
			<p>3. <a href=networkcalendar/>ANCAC Calendar</a></p>
			<p>4. <a href=ancacdocs/>ANCAC Shared Documents</a></p>
			<p>&nbsp;</p>
			<p>0. <a href="logout.php">Logout</a></p>
			<p>&nbsp;</p>

			</td>
		</tr>
	</table>
</div>
<p>&nbsp;</td></tr> </table></div>

<?PHP
	require($root."footer.php");
?>
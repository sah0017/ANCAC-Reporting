<?
	require("./ulogin.php");
	require("./dbconn.php");
	$From = $_GET['from'];
	if($From == 1)
	         $page_title = 'ANCAC: Admin Year to Date Reports';
	if($From == 2)
		 $page_title = 'ANCAC: Childrens First Plan of Investment - Budgets';
        if($From == 5)
                 $page_title = 'ANCAC: Add or Remove Other Incomes';
        if($From == 6)
                 $page_title = 'ANCAC: Edit Current FY Budgets';
        if($From == 7)
                $page_title = 'ANCAC : Year End Reports';
        if($From == 8)
                $page_title = 'ANCAC : Received Snail-Mail Documents';
        if($From == 9)
                $page_title = 'ANCAC : Board of Directors Report';
	require("./header.php");
?>

<table class='OutlineTable' align=center width="95%">
<tr>
    <?
      if($From == 1)
               echo '<td class="login-header" colspan="2" align=center>View, Edit, or Print Year to Date Report<br /></td>';
      if($From == 2)
               echo '<td class="login-header" colspan="2" align=center>Edit Childrens First Plan of Investment Budgets<br /></td>';
      if($From == 5)
               echo '<td class="login-header" colspan="2" align=center>Add or Remove Other Incomes<br /></td>';
      if($From == 6)
               echo '<td class="login-header" colspan="2" align=center>Edit Current FY Budgets<br /></td>';
      if($From == 7)
               echo '<td class="login-header" colspan="2" align=center>Year End Reports<br /></td>';
      if($From == 8)
               echo '<td class="login-header" colspan="2" align=center>Received Snail-Mail Documents<br /></td>';
      if($From == 9)
               echo '<td class="login-header" colspan="2" align=center>Board of Directors Report<br /></td>';
    ?>
</tr>
<tr>
	<td class='login' align=left><br>
	<div align="center">
		<table border="0" width="100%" id="table1">
		<tr>
			<td>
				<table width="100%">
					<tr align="left">
						<td colspan="4"><b>Select a Center:</b></td>
					</tr>
<?
	if($_SESSION['admin'] > 0){
		$sql = "SELECT center,CenterName FROM centers WHERE center not in (0)";
		$result= @mysql_query($sql) or mysql_error();

		while ($row = mysql_fetch_object($result)) {
		      echo '<tr align="left">';
		      echo '<td>';
		      if($From == 1)
		               echo '<a href="selectYear.php?center='.$row->center.'&from=1">'.$row->CenterName.'</a>';
                      if($From == 2)
		               echo '<a href="editBudgetsTOP.php?center='.$row->center.'">'.$row->CenterName.'</a>';
                      if($From == 5)
                               echo '<a href="addRemoveOI.php?center='.$row->center.'&Y=1"> Current FY</a></td><td><a href="addRemoveOI.php?center='.$row->center.'"> Next FY</a></td><td>'.$row->CenterName.'</a>';
                      if($From == 6)
                               echo '<a href="editBudgets.php?center='.$row->center.'&Y=1"> Current FY</a></td><td><a href="editBudgets.php?center='.$row->center.'"> Next FY</a></td><td>'.$row->CenterName.'</td>';
                      if($From == 7)
                               echo '<a href="eoyreports.php?center='.$row->center.'">'.$row->CenterName.'</a>';
                      if($From == 8)
                               echo '<a href="SnailMail.php?center='.$row->center.'">'.$row->CenterName.'</a>';
                      if($From == 9)
                               echo '<a href="selectYear.php?center='.$row->center.'&from=2">'.$row->CenterName.'</a>';
		      echo '</td>';
                      echo '</tr>';
		}
	}
	else{
		echo '<td>';
		echo '<p>You do not have Administration access</p></td>';

	}
?>
					</tr>
				</table>
			</td>
		</tr>
		</table>
	</div>
	</td>
</tr>
</table></div>
<?
	require("./footer.php");
?>
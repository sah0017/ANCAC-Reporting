<?
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/ulogin.php");
	require("/home/cluster1/data/a/p/a1224426/data/dbconn.php");
        $page_title = 'ANCAC: Current Quarterly Report Submissions';
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/header.php");
	
	switch (date("m")){
                case 10:
                case 11:
                case 12:
                     $fiscalYear = date("Y");
                     $currentQuarter = 4;
                     $Ending = "Sep 30";
                     break;
                case 1:
                case 2:
                case 3:
                     $fiscalYear = date("Y");
                     $currentQuarter = 1;
                     $Ending = "Dec 31";
                     break;
                case 4:
                case 5:
                case 6:
                     $fiscalYear = date("Y");
                     $currentQuarter = 2;
                     $Ending = "Mar 31";
                     break;
                case 7:
                case 8:
                case 9:
                     $fiscalYear = date("Y");
                     $currentQuarter = 3;
                     $Ending = "Jun 30";
                     break;
         }
?>

<table class='OutlineTable' align=center width="600px">
<tr>
    <td class="login-header" colspan="2" align=center>ANCAC Centers: Quarterly Report Submissions for Quarter ending <? echo $Ending; ?><br></td>
</tr>
<tr>
	<td class='login' align=left><br>
	<div align="center">
		<table border="0" width="600px" id="table1">
		<tr>
			<td>
				<table width="100%">
				<tr align="left" valign="top">
<?
	if($_SESSION['admin'] > 0){
		$sql = "SELECT CenterName FROM centers JOIN actualExpenditures ON centers.center = actualExpenditures.center and actualExpenditures.fiscalyear = ".$fiscalYear." and actualExpenditures.quarter = ".$currentQuarter." and actualExpenditures.completed = 'COM' WHERE centers.center not in (0,99)";
		$result= @mysql_query($sql) or mysql_error();

		$numRecords = mysql_num_rows($result);
		echo '<td width="50%"><table class="haveSubmit" width="100%"><tr align="left"><td><b>Centers that HAVE submitted Current Quarter Report</b><br><br></td></tr>';
		echo '<tr align="left"><td><ul>';
                if ($numRecords > 0){

		      while ($row = mysql_fetch_object($result)) {
                              echo '<li>';
		              echo $row->CenterName;
		              echo '</li>';
		      }
		}
		else
		      echo '<li>NONE</li>';
		echo '</ul></td></tr></table></td>';

		$sql = "SELECT CenterName FROM centers LEFT JOIN actualExpenditures ON centers.center = actualExpenditures.center and actualExpenditures.fiscalyear = ".$fiscalYear." and actualExpenditures.quarter = ".$currentQuarter." and actualExpenditures.completed = 'INC' WHERE centers.center not in (0,99)  and actualExpenditures.completed <> 'COM' UNION SELECT CenterName FROM centers WHERE center not in (SELECT center FROM actualExpenditures WHERE fiscalyear = ".$fiscalYear." and quarter = ".$currentQuarter.") and center not in (0,99)";
		$result= @mysql_query($sql) or mysql_error();

		$numRecords = mysql_num_rows($result);
		echo '<td>&nbsp;<td><td><table class="haveSubmit" width="100%"><tr align="left"><td><b>Centers that HAVE NOT submitted Current Quarter Report</b><br><br></td></tr>';
		echo '<tr align="left"><td><ul>';
                if ($numRecords > 0){

		      while ($row = mysql_fetch_object($result)) {
		              echo '<li>';
		              echo $row->CenterName;
		              echo '</li>';
		      }
		}
		else
		      echo '<li>NONE</li>';
		echo '</ul></td></tr></table></td>';
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
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/footer.php");
?>
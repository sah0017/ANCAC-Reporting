<?
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/ulogin.php");
	require("/home/cluster1/data/a/p/a1224426/data/dbconn.php");
	
	if($_SESSION['admin'] > 0){
                if(isset($_POST['center']))
                        $center = $_POST['center'];
                else
                        $center = $_GET['center'];
        }
        else{
                $center = $_SESSION['center'];
        }

	$sqlCenter = "SELECT CenterName FROM centers ".
             "WHERE center = '".$center."'";
        $resultCenter = @mysql_query($sqlCenter) or mysql_error();
        $rowCenter = mysql_fetch_object($resultCenter);
        $CenterName = $rowCenter->CenterName;

	$page_title = 'ANCAC: Year to Date Report for '.$CenterName;
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/header.php");
        require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/buildReport.php");

        //Get the fiscal year from the select Year page drop down
        if(isset($_POST['year']))
                $fiscalYear = $_POST['year'];
        else
                $fiscalYear = $_GET['year'];
?>

<body>
<table class='OutlineTable' align=center width="95%">
<tr>
	<td class='login-header' colspan='2' align=center>ANCAC Year to Date Report<br></td>
</tr>
<tr>
	<td class='login' align=left>
	<center>
		<table border="0" width="100%" id="table1">
		<tr>
			<td>
<?
		echo '<table width="100%">';
		echo '<tr align="left">';
		echo '<td colspan="3"><br><b>Name of Child Advocacy Center: </b>'.$CenterName.'</td>';
		echo '</tr>';
		echo '<tr align="left">';
		echo '<td width="40%"><b>Year: </b>'.$fiscalYear.'</td><td width="40%"><b>Date: </b>'.date("M d Y").'</td><td></td>';
		echo '</tr>';
		echo '<tr><td colspan="3">'.buildReport("FULL", $center, $fiscalYear, "NO", "100%").'</td></tr>';
		
		if($_SESSION['admin'] > 0){
	               echo '<tr class="nav"><td><p><center><a href="qreportAdmin.php?from=1">Return to Center List</a></center></p></td></tr>';
	        }
		echo '</table>';
	        echo '<script language=javascript>disableForm("TextInput", "true");</script>';
?>
			</td>
		</tr>
		</table>
	</center>
	</td>
</tr>
</table></div>
</body>
<?
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/footer.php");
?>


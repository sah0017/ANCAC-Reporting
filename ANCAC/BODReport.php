<?PHP
	require("ulogin.php");
	require($root."dbconn.php");
	
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

	$page_title = 'ANCAC: Board of Directors for '.$CenterName;
	require($root."header.php");

        //Get the fiscal year from the select Year page drop down
        //if(isset($_POST['year']))
        //        $fiscalYear = $_POST['year'];
        //else
        //        $fiscalYear = $_GET['year'];
        
	$fiscalYear = $_SESSION['year'];
?>

<body>
<table class='OutlineTable' align=center width="95%">
<tr>
	<td class='login-header' colspan='2' align=center>List of Board Members for <?PHP echo $CenterName; ?> - FY <?PHP echo $fiscalYear; ?><br /></td>
</tr>
<tr>
	<td class='login' align=left>
	<center>
		<table border="0" width="100%" id="table1">
		<tr>
			<td>
<?PHP
                $sqlBODCY = "SELECT name, boardPosition, occupation, address, phone, yearsOnBoard, BODID".
                        " FROM boardOfDirItem WHERE center = '".$center."' AND fiscalyear = '".$fiscalYear."'";
                $resultBODCY = @mysql_query($sqlBODCY) or mysql_error();

                $numRecordsCY = mysql_num_rows($resultBODCY);
                echo '<table width="100%">';
                //If there is information for current year show it
                if ($numRecordsCY > 0){
                        echo '<tr class="BoldText"><td valign=bottom>Name of Board Member</td><td valign=bottom>Board Position</td><td valign=bottom>Occupation</td><td valign=bottom>Address</td><td valign=bottom>Phone</td><td valign=bottom><center># Years on Board</center></td></tr>';
                        while ($rowCY = mysql_fetch_object($resultBODCY)) {
                                echo '<tr>';
                                echo '<td valign=top>'.$rowCY->name.'</td><td valign=top>'.$rowCY->boardPosition.'</td><td valign=top>'.$rowCY->occupation.'</td><td valign=top>'.$rowCY->address.'</td><td valign=top>'.$rowCY->phone.'</td><td valign=top><center>'.$rowCY->yearsOnBoard.'</centeR></td>';
                                echo '</tr>';
                        }
                }
                else
                        echo '<tr><td><b>There are no Board Members for this center and Fiscal Year</b><hr /></td></tr>';

                if($_SESSION['admin'] > 0){
	               echo '<tr class="nav"><td colspan="6"><p><center><a href="qreportAdmin.php?from=9">Return to Center List</a></center></p></td></tr>';
	        }
                echo '</table>';
?>
			</td>
		</tr>
		<tr>
		      <td>
		              <center><div class=nav><?PHP echo '<a href="eoyreports.php?center='.$center.'">Return to End of Year Reports Main Menu</a>'; ?></div></center>
		      </td>
		</tr>
		</table>
	</center>
	</td>
</tr>
</table></div>
</body>
<?PHP
	require($root."footer.php");
?>


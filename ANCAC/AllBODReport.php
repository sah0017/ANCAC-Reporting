<?PHPphp
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/ulogin.php");
	require("/home/cluster1/data/a/p/a1224426/data/dbconn.php");

	$page_title = 'ANCAC: All Board of Directors Listings';
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/header.php");

        $fiscalYear = $_POST['year'];
?>

<?PHPphp
                $sql = "SELECT centers.center, centers.CenterName FROM `centers` JOIN `eoyChecks` ON centers.center = eoyChecks.center".
                        " AND eoyChecks.fiscalyear = '".$fiscalYear."' AND eoyChecks.BoardOfDir = '1'".
                        "  WHERE centers.center not in (0,99) order by centers.center";
                $result = @mysql_query($sql) or mysql_error();
?>
                <center>
		<table class="OutlineTable" width="85%">
		        <tr><td class="login-header" colspan="6">All Submitted Board of Directors Listings - FY <?PHPphp echo $fiscalYear; ?></td></tr>
                        <tr align="left"><td colspan="6"><b>Date: </b><?PHPphp echo date("M d Y"); ?></td></tr>
                        <tr><td colspan="6">&nbsp;</td></tr>
<?PHPphp
		while ($row = mysql_fetch_object($result)) {
                        $sqlBODCY = "SELECT name, boardPosition, occupation, address, phone, yearsOnBoard, BODID".
                                " FROM boardOfDirItem WHERE center = '".$row->center."' AND fiscalyear = '".$fiscalYear."'";
                        $resultBODCY = @mysql_query($sqlBODCY) or mysql_error();
                        $numRecordsCY = mysql_num_rows($resultBODCY);
                        
                        if ($numRecordsCY > 0){
                                echo '<tr align="left"><td colspan="6"><b>Name of Child Advocacy Center: </b>'.$row->CenterName.'</td></tr>';
                                echo '<tr align="left"><td colspan="6"><hr /></td></tr>';
                                echo '<tr class="BoldText"><td valign=bottom>Name of Board Member</td><td valign=bottom>Board Position</td><td valign=bottom>Occupation</td><td valign=bottom>Address</td><td valign=bottom>Phone</td><td valign=bottom><center># Years on Board</center></td></tr>';
                                
                                while ($rowCY = mysql_fetch_object($resultBODCY)) {
                                        echo '<tr>';
                                        echo '<td valign=top>'.$rowCY->name.'</td><td valign=top>'.$rowCY->boardPosition.'</td><td valign=top>'.$rowCY->occupation.'</td><td valign=top>'.$rowCY->address.'</td><td valign=top>'.$rowCY->phone.'</td><td valign=top><center>'.$rowCY->yearsOnBoard.'</centeR></td>';
                                        echo '</tr>';
                                }
                                
                                echo '<tr><td colspan="6">&nbsp;</td></tr>';
                                echo '<div class="page-break"></div>';
                        }
                }
?>
                </table>
                </center>



</html>


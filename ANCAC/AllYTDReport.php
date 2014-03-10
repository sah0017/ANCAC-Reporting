<?
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/ulogin.php");
	require("/home/cluster1/data/a/p/a1224426/data/dbconn.php");

	$page_title = 'ANCAC: All Centers Year to Date Report';
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/header.php");
        require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/buildReport.php");
        require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/buildReport08.php");

         switch (date("m")){
                case 10:
                case 11:
                case 12:
                     $fiscalYear = date("Y");
                     $currentQuarter = 4;
                     break;
                case 1:
                case 2:
                case 3:
                     $fiscalYear = date("Y");
                     $currentQuarter = 1;
                     break;
                case 4:
                case 5:
                case 6:
                     $fiscalYear = date("Y");
                     $currentQuarter = 2;
                     break;
                case 7:
                case 8:
                case 9:
                     $fiscalYear = date("Y");
                     $currentQuarter = 3;
                     break;
         }
?>

<?
                $sql = "SELECT centers.center, centers.CenterName FROM `centers` JOIN `actualExpenditures` ON centers.center = actualExpenditures.center".
                        " AND actualExpenditures.fiscalyear = '".$fiscalYear."' AND actualExpenditures.quarter = '".$currentQuarter."' AND actualExpenditures.completed = 'COM'".
                        "  WHERE centers.center not in (0,99) order by centers.center";
                $result = @mysql_query($sql) or mysql_error();
                echo '<center>';
		echo '<table width="85%">';
                echo '<tr align="left"><td width="50%"><b>Year: </b>'.$fiscalYear.'</td><td width="50%"><b>Date: </b>'.date("M d Y").'</td></tr>';
                echo '</table>';
		while ($row = mysql_fetch_object($result)) {
                      echo '<table width="85%"><tr align="left"><td><b>Name of Child Advocacy Center: </b>'.$row->CenterName.'</td></tr></table>';
                      if ($fiscalYear == 2008)
                        echo buildReport08("FULL", $row->center, $fiscalYear, "YES", "85%");
                      else
		        echo buildReport("FULL", $row->center, $fiscalYear, "YES", "85%");
		      echo '<br>';
		      echo '<div class="page-break"></div>';
                }
                echo '</center>';

?>

</html>


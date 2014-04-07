<?PHP
	require("ulogin.php");
	$page_title = 'ANCAC: Quarterly Reports Menu';
	require($root."header.php");
	
	require($root."Variables.php");

	$TOPAvailable = 0;
	$TOPBudget = 0;

	switch (date("m")){
                case 10:
                     $fiscalYear = date("Y");
                     $currentQuarter = 4;
                     if (date("j") < $Quarter4Date)
                        $Available = 1;
                     else
                        $Available = 0;
                     break;
                case 11:
                case 12:
                     $fiscalYear = date("Y");
                     $currentQuarter = 4;
                     $Available = 0;
                     break;
                case 1:
                     $fiscalYear = date("Y");
                     $currentQuarter = 1;
                     if (date("j") < $Quarter1Date)
                        $Available = 1;
                     else
                        $Available = 0;
                     break;
                case 2:
                case 3:
                     $fiscalYear = date("Y");
                     $currentQuarter = 1;
                     $Available = 0;
                     break;
                case 4:
                     $fiscalYear = date("Y");
                     $currentQuarter = 2;
                     if (date("j") < $Quarter2Date)
                        $Available = 1;
                     else
                        $Available = 0;
                     break;
                case 5:
                case 6:
                     $fiscalYear = date("Y");
                     $currentQuarter = 2;
                     $Available = 0;
                     break;
                case 7:
                     $fiscalYear = date("Y");
                     $currentQuarter = 3;
		     $TOPBudget = 1;
                     if (date("j") < $Quarter3Date)
                        $Available = 1;
                     else
                        $Available = 0;
		     if (date("j") < 16)
                        $TOPAvailable = 1;
                     break;
                case 8:
                case 9:
                     $fiscalYear = date("Y");
                     $currentQuarter = 3;
                     $Available = 0;
		     $TOPBudget = 1;
                     break;
         }
?>

<table class='login' align=center width="293">
       <tr>
           <td class='login-header' colspan='2' align=center>ANCAC: QUARTERLY REPORTS MENU<br></td>
       </tr>
       <tr>
           <td class='login' align=left><br>
               <div align="center">
	            <table border="0" width="80%" id="table1">
		           <tr><br><p>Reminder: Quarterly information needs to be submitted no later than the 10th during the months of January, April, July & October.</p><br><br>
<?PHP
	if($_SESSION['admin'] == 2)
	{
		echo '<td>';
		echo '<p>1. <a href="qreportAdmin.php?from=1">View / Edit / Print any Centers Year to Date information</a><br><br></p>';
		echo '<p>&nbsp;&nbsp;<a href="qreportAdmin.php?from=2">Start or continue work on the Estimated Budget Numbers for Childrens First Plan of Investment</a><br><br></p>';
                echo '<p>2. <a href="AllYTDReport.php">Print current all Year to Date reports (all Centers)</a><br><br></p>';
		echo '<p>&nbsp;</p>';
		echo '<p>&nbsp;</p>';
		echo '<p>0. <a href="{$webroot}index.php">Return to Main Menu</p>';
		echo '<p>&nbsp;</p>';
		echo '</td>';
	}
	else
	{
                $center = $_SESSION['center'];
                $sql = "SELECT completed".
                        " FROM actualExpenditures ".
                        "WHERE center = ".$center." AND fiscalyear = ".$fiscalYear.
                        " AND quarter = ".$currentQuarter;

                $result= @mysql_query($sql) or mysql_error();
                $row = mysql_fetch_object($result);

                echo '<td>';
                if (isset($row->completed)){
                        if ($row->completed == "INC"){
                                if ($Available == 1){
                                        echo '<p>1. <a href="editQuarter.php">Start or continue work on the most current Quarterly Report for your Center</a><br><br></p>';
					if ($TOPAvailable == 1) echo '<p>&nbsp;&nbsp;<a href="editBudgetsTOP.php">Start or continue work on the Estimated Budget Numbers for Childrens First Plan of Investment</a><br><br></p>';
                                        echo '<p>2. <a href="submitCQ.php" onclick="javascript:return confirm(\'Are you sure you want to submit the Current Quarter Report?\')">Submit current Quarterly Report to Home Office</a><br><br></p>';
                                }
                                else{
                                        echo '<p>1. Start or continue work on the most current Quarterly Report for your Center (Unavailable)<br><br></p>';
                                        echo '<p>2. Submit current Quarterly Report to Home Office (Unavailable)<br><br></p>';
                                }
                        }
                        else{
                                echo '<p>1. Start or continue work on the most current Quarterly Report for your center<br><br></p>';
				if ($TOPAvailable == 1) echo '<p>&nbsp;&nbsp;<a href="editBudgetsTOP.php">Start or continue work on the Estimated Budget Numbers for Childrens First Plan of Investment</a><br><br></p>';
                                echo '<p>2. You have <b>successfully submitted</b> this Quarter\'s Report<br><br></p>';
                        }
                }
                else{
                        if ($Available == 1){
                                echo '<p>1. <a href="editQuarter.php">Start or continue work on the most current Quarterly Report for your Center</a><br><br></p>';
				if ($TOPAvailable == 1) echo '<p>&nbsp;&nbsp;<a href="editBudgetsTOP.php">Start or continue work on the Estimated Budget Numbers for Childrens First Plan of Investment</a><br><br></p>';
                                echo '<p>2. <a href="submitCQ.php" onclick="javascript:return confirm(\'Are you sure you want to submit the Current Quarter Report?\')">Submit current Quarterly Report to Home Office</a><br><br></p>';
                        }
                        else{
                                echo '<p>1. Start or continue work on the most current Quarterly Report for your Center (Unavailable)<br><br></p>';
                                echo '<p>2. Submit current Quarterly Report to Home Office (Unavailable)<br><br></p>';
                        }
                }
                echo '<p>3. <a href="selectYear.php">View / Print the Year to Date report for your Center</a><br><br></p>';
                echo '<p>&nbsp;</p>';
		echo '<p>0. <a href="{$webroot}index.php">Return to Main Menu</p>';
                echo '<p>&nbsp;</p>';
      		echo '</td>';
	}
?>
                             </tr>
	           </table>
            </div>
         </td>
      </tr>
</table>

<?PHP
  	require($root."footer.php");
?>
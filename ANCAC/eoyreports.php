<?PHP
	require("ulogin.php");
	require($root."dbconn.php");

	$page_title = 'ANCAC: End of Year Reports Menu';
	$flag_Image = '<img src="images/Flag.gif" />';
	$check_Image = '<img src="images/Check.gif" />';

	if($_SESSION['admin'] > 0){
                $center = $_GET['center'];
                $Admin = 1;
        }
        else{
                $center = $_SESSION['center'];
                $Admin = 0;
        }

	require($root."header.php");

	switch (date("m")){
                case 10:
                     $fiscalYear = date("Y") + 1;
                     $currentQuarter = 4;
                     $EOYAvailable = 1;
                     break;
                case 11:
                case 12:
                     $fiscalYear = date("Y") + 1;
                     $currentQuarter = 4;
                     $EOYAvailable = 1;
                     break;
                case 1:
                case 2:
                case 3:
                     $fiscalYear = date("Y");
                     $currentQuarter = 1;
                     $EOYAvailable = 1;
                     break;
                case 4:
                case 5:
                case 6:
                     $fiscalYear = date("Y");
                     $currentQuarter = 2;
                     $EOYAvailable = 1;
                     break;
                case 7:
                case 8:
                     $fiscalYear = date("Y");
                     $currentQuarter = 3;
                     $EOYAvailable = 1;
                     break;
                case 9:
                     $fiscalYear = date("Y");
                     $currentQuarter = 3;
                     $EOYAvailable = 0;
                     break;
         }
         //Get the completed Portions
         $sql = "SELECT OtherIncome, OtherExpense, EstBudget, BoardOfDir, DiversityActPlan, BudgetReq, AllocationReq, Audit, AnnualStan,".
                "CASE completed when 'COM' then 1 else 0 End as completed, centerName".
                " FROM eoyChecks LEFT JOIN actualExpenditures ON eoyChecks.center = actualExpenditures.center".
                " AND eoyChecks.fiscalyear - 1 = actualExpenditures.fiscalyear AND actualExpenditures.quarter = 4".
                " JOIN centers ON eoyChecks.center = centers.center".
                " WHERE eoyChecks.center = ".$center." AND eoyChecks.fiscalyear = ".$fiscalYear;
                //TODO :: Change this sql statement above to grab the actualExpenditures from fiscalYear - 1

        $result = @mysql_query($sql) or mysql_error();
        $row1 = mysql_fetch_object($result);

        $numRecords = mysql_num_rows($result);

        if ($numRecords == 0){
                //Insert a row for this center and year
                $sqlExecute = "INSERT INTO `eoyChecks` ( `center` , `fiscalyear` , `username` , ".
                        "`datemod` , `OtherIncome` , `OtherExpense` , `EstBudget` , `BoardOfDir` , `DiversityActPlan` , ".
                        "`BudgetReq` , `AllocationReq` , `Audit` , `AnnualStan` ) ".
                "VALUES ('".$center."', '".$fiscalYear."', '".$_SESSION['user']."', ".
                        "NOW(), '0', '0', '0', '0', '0', ".
                        "'0', '0', '0', '0')";

                //insert into the actualExpenditures table
                $resultExecute = @mysql_query($sqlExecute);

                $result = @mysql_query($sql) or mysql_error();
                $row1 = mysql_fetch_object($result);
        }
?>

<table class='login' align=center width="550">
       <tr>
          <?PHP echo '<td class="login-header" colspan="2" align=center>ANCAC: End Of Year Reports Menu for Center: '.$row1->centerName.'<br /></td>'; ?>
       </tr>
       <tr>
           <td class='login' align=left><br>
               <div align="center">
	            <table border="0" width="95%" id="table1">
<?PHP
                if ($EOYAvailable == 1 || $Admin == 1){
                        echo '<tr><td align="center">Due Date</td><td align="center">Completed</td><td>Task</td></tr>';
                        echo '<tr><td colspan="3">&nbsp;</td></tr>';
                        //4th Quarter Reporting
                        echo '<tr><td align="center">Oct 10</td><td align="center">';
                        if ($row1->completed == 0) echo $flag_Image;
                        else echo $check_Image;
                        echo '</td><td>1.  <a href="qreports.php">Enter 4th quarter Quarterly Numbers</a></td></tr>';
                        echo '<tr><td colspan="3">&nbsp;</td></tr>';
                         //Other Income
                        /*echo '<tr><td align="center">Oct 10</td><td align="center">';
                        if ($row1->OtherIncome == 0) {
                          echo $flag_Image.'</td><td>2. a. <a href="addRemoveOI.php?center='.$center.'">Enter Other Incomes for Next Year</a>';
                          if ($Admin == 0){
                            //Grab all the Other Incomes
                            $sqlOICheck = "SELECT IncomeName".
                                " FROM otherIncomeLU WHERE center = '".$center."' AND fiscalyear = '".$fiscalYear."'";
                            $resultOICheck = @mysql_query($sqlOICheck) or mysql_error();

                            $numRecOICheck = mysql_num_rows($resultOICheck);

                            //if they have don't have any Other Incomes input
                            if ($numRecOICheck == 0){
                                echo '&nbsp;&nbsp;OR   <a href="submitOI.php" onclick="javascript:return confirm(\'You have not entered any Other Incomes. Are you sure you want to submit?\')">Submit Other Incomes</a></td></tr>';
                            }
                            else
                                echo '&nbsp;&nbsp;OR   <a href="submitOI.php" onclick="javascript:return confirm(\'Are you sure you want to submit your Other Incomes?\')">Submit Other Incomes</a></td></tr>';
                          }
                        }
                        else {
                          if ($Admin == 0)
                                echo $check_Image.'</td><td>2. a. Enter Other Incomes for Next Year</td></tr>';
                          else
                                echo $check_Image.'</td><td>2. a. <a href="addRemoveOI.php?center='.$center.'">Enter Other Incomes for Next Year</a></td></tr>';
                        }
                         //Other Expense
                        echo '<tr><td align="center">Oct 10</td><td align="center">';
                        if ($row1->OtherExpense == 0) {
                          echo $flag_Image.'</td><td>&nbsp;&nbsp;&nbsp;&nbsp;b. <a href="addRemoveEx.php?center='.$center.'">Enter Other Expenses for Next Year</a>';
                          if ($Admin == 0){
                                //Grab all the Other Expenses
                                $sqlOECheck = "SELECT ExpenseName".
                                        " FROM otherExpenseLU WHERE center = '".$center."' AND fiscalyear = '".$fiscalYear."'";
                                $resultOECheck = @mysql_query($sqlOECheck) or mysql_error();

                                $numRecOECheck = mysql_num_rows($resultOECheck);

                                //if they have a row in the table
                                if ($numRecOECheck == 0){
                                        echo '   OR   <a href="submitOE.php" onclick="javascript:return confirm(\'You have not entered any Other Expenses. Are you sure you want to submit?\')">Submit Other Expenses</a></td></tr>';
                                }
                                else
                                        echo '   OR   <a href="submitOE.php" onclick="javascript:return confirm(\'Are you sure you want to submit your Other Expenses?\')">Submit Other Expenses</a></td></tr>';
                          }
                        }
                        else {
                          if ($Admin == 0)
                                echo $check_Image.'</td><td>&nbsp;&nbsp;&nbsp;&nbsp;b. Enter Other Expenses for Next Year</td></tr>';
                          else
                                echo $check_Image.'</td><td>&nbsp;&nbsp;&nbsp;&nbsp;b. <a href="addRemoveEx.php?center='.$center.'">Enter Other Expenses for Next Year</a></td></tr>';
                        }
                        echo '<tr><td colspan="3">&nbsp;</td></tr>';
                        */
                        //Estimated Budget
                        if($row1->OtherIncome == 1 && $row1->OtherExpense == 1){
                              echo '<tr><td align="center">Oct 10</td><td align="center">';
                              if ($row1->EstBudget == 0){
                                if ($Admin == 0){
                                        echo $flag_Image.'</td><td>2. <a href="editBudgets.php?center='.$center.'">Enter Estimated Budget for all 4 quarters for Next Year</a>';
                                        echo '   OR   <a href="submitEB.php" onclick="javascript:return confirm(\'Are you sure you want to submit your Estimated Budget for next year?\')">Submit Estimated Budget</a></td></tr>';
                                }
                                else
                                        echo $flag_Image.'</td><td>2. <a href="editBudgets.php?center='.$center.'">Enter Estimated Budget for all 4 quarters for Next Year</a></td></tr>';
                              }
                              else {
                                if ($Admin == 0)
                                    echo $check_Image.'</td><td>2.  <a href="viewBudgets.php?center='.$center.'">View/Print Estimated Budget for all 4 quarters for Next Year</a></td></tr>';
                                else
                                    echo $check_Image.'</td><td>2.  <a href="editBudgets.php?center='.$center.'">Enter Estimated Budget for all 4 quarters for Next Year</a></td></tr>';
                              }
                        }
                        else{
                              echo '<tr><td align="center">Oct 10</td><td align="center">';
                              echo $flag_Image.'</td><td>2.  Enter Estimated Budget for all 4 quarters for Next Year</td></tr>';
                        }
                        echo '<tr><td colspan="3">&nbsp;</td></tr>';
                        //Board of Directors
                        echo '<tr><td align="center">Oct 30</td><td align="center">';
                        if ($row1->BoardOfDir == 0) {
                                echo $flag_Image.'</td><td>3.  <a href="boardOfDir.php?center='.$center.'">Enter Board of Directors List for Next Year</a>';
                                if ($Admin == 0)
                                        echo '   OR   <a href="submitBOD.php" onclick="javascript:return confirm(\'Are you sure you want to submit the Board of Directors Report?\')">Submit Board of Directors Report</a></td></tr>';
                        }
                        else{
                           if ($Admin == 0)
                                echo $check_Image.'</td><td>3.  <a href="BODReport.php?year='.$fiscalYear.'">View/Print Board of Directors List</a></td></tr>';
                           else
                                echo $check_Image.'</td><td>3.  <a href="boardOfDir.php?center='.$center.'">Enter Board of Directors List for Next Year</a></td></tr>';
                        }
                        //Diversity Action Plan
                        echo '<tr><td align="center">Oct 30</td><td align="center">';
                        if ($row1->DiversityActPlan == 0){
                                echo $flag_Image.'</td><td>4.  <a href="divAction.php?center='.$center.'">Enter Diversity Action Plan for Next Year</a>';
                                if ($Admin == 0)
                                        echo '   OR   <a href="submitDAP.php" onclick="javascript:return confirm(\'Are you sure you want to submit the Diversity Action Plan?\')">Submit Diversity Action Plan</a></td></tr>';
                        }
                        else{
                           if ($Admin == 0)
                                echo $check_Image.'</td><td>4.  <a href="DAPReport.php?year='.$fiscalYear.'">View/Print Diversity Action Plan</a></td></tr>';
                           else
                                echo $check_Image.'</td><td>4.  <a href="divAction.php?center='.$center.'">Enter Diversity Action Plan for Next Year</a></td></tr>';
                        }
                        //Budget Request
                        if($row1->EstBudget == 1){
                              echo '<tr><td align="center">Oct 30</td><td align="center">';
                                    echo $check_Image.'</td><td>5.  <a href="budReq.php?center='.$center.'">View/Print Budget Request for Next Year</a></td></tr>';
                        }
                        else{
                              echo '<tr><td align="center">Oct 30</td><td align="center">';
                              echo $flag_Image.'</td><td>5.  View/Print Budget Request for Next Year (Must Complete Step 3 First)</td></tr>';
                        }
                        echo '<tr><td colspan="3">&nbsp;</td></tr>';
                        //Snail Mail Allocation
                        echo '<tr><td align="center">Oct 30</td><td align="center">';
                        if ($row1->AllocationReq == 0) echo $flag_Image;
                        else echo $check_Image;
                        echo '</td><td>6.  Snail-Mail your 12 official copies of your Allocation Request Form</td></tr>';
                        //Snail Mail Audit
                        echo '<tr><td align="center">Aug 1</td><td align="center">';
                        if ($row1->Audit == 0) echo $flag_Image;
                        else echo $check_Image;
                        echo '</td><td>7.  Snail-Mail your Audit</td></tr>';
                        //Snail Mail Annual Standards
                        echo '<tr><td align="center">Aug 1</td><td align="center">';
                        if ($row1->AnnualStan == 0) echo $flag_Image;
                        else echo $check_Image;
                        echo '</td><td>8.  Snail-Mail your Annual Standards Documentation</td></tr>';
                        //Completion of the entire End of Year stuff
                        echo '<tr><td colspan="3">&nbsp;</td></tr>';
                        echo '<tr><td colspan="3"><hr /></td></tr>';
                        echo '<tr><td>&nbsp;</td><td align="center">';
                        if ($row1->completed == 1 && $row1->OtherIncome == 1 && $row1->OtherExpense == 1 && $row1->EstBudget == 1
                                && $row1->BoardOfDir == 1 && $row1->DiversityActPlan == 1 && $row1->AllocationReq == 1
                                && $row1->Audit == 1 && $row1->AnnualStan == 1){
                                echo $check_Image;
                                echo '</td><td>You HAVE completed your End of Year reports</td></tr>';
                        }
                        else{
                                echo $flag_Image;
                                echo '</td><td>You have NOT completed your End of Year reports</td></tr>';
                        }

      	  }
      	  else{
                        echo '<tr><td colspan="3">These options are not available in September.</td></tr>';
                }
                echo '<tr><td colspan="3">&nbsp;</td></tr>';
		//echo '<tr><td align="center"></td><td align="center"></td><td>0. <a href="/ANCAC-Online/index.php">Return to Main Menu</a></td></tr>';

?>
	           </table>
            </div>
         </td>
      </tr>
</table>

<?PHP
  	require($root."footer.php");
?>

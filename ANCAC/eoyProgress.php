<?
	require("./ulogin.php");
	require("./dbconn.php");

	$page_title = 'ANCAC: End of Year Reporting Progress';
	require("./header.php");

        $fiscalYear = date("Y") + 1;
        $flag_Image = '<img src="images/Flag.gif" />';
	$check_Image = '<img src="images/Check.gif" />';
        
        $sql = "SELECT center, CenterName FROM `centers`".
                "  WHERE center not in (0, 99) order by center";
        $result = @mysql_query($sql) or mysql_error();
?>
        <center>
        <table width="85%" class="Admin">
                <tr class="BoldText"><td class="login-header" colspan="10"><center><h3>ANCAC: End of Year Reporting Progress</h3></center></td></tr>
                <tr align="left"><td colspan="5"><b>Year: </b><?php echo $fiscalYear; ?></td><td colspan="5"><b>Date: </b><?php echo date("M d Y"); ?></td></tr>
                <tr><td colspan="10">&nbsp;</td></tr>
        <!-- Headers for the Main Table -->
                <tr class="BoldText" align="center">
                        <td align="left">Name of Child Advocacy Center</td><td>4th Quarter</td><td>Other Income</td><td>Other Expense</td><td>Estimated Budget</td><td>BOD List</td>
                        <td>Diversity Action Plan</td><td>Snail Mail Allocation</td><td>Snail Mail Audit</td><td>Snail Mail Standards</td>
                </tr>
                <?php
                        while ($row = mysql_fetch_object($result)) {
                                //Get the completed Portions
                                $sqlChecks = "SELECT OtherIncome, OtherExpense, EstBudget, BoardOfDir, DiversityActPlan, AllocationReq, Audit, AnnualStan,".
                                        "CASE completed when 'COM' then 1 else 0 End as completed".
                                        " FROM eoyChecks LEFT JOIN actualExpenditures ON eoyChecks.center = actualExpenditures.center".
                                        " AND eoyChecks.fiscalyear - 1 = actualExpenditures.fiscalyear AND actualExpenditures.quarter = 4".
                                        " WHERE eoyChecks.center = ".$row->center." AND eoyChecks.fiscalyear = ".$fiscalYear;

                                $resultChecks = @mysql_query($sqlChecks) or mysql_error();
                                $rowChecks = mysql_fetch_object($resultChecks);
                                $numChecks = mysql_num_rows($resultChecks);
                                
                                //Center Name
                                echo '<tr align="center">';
                                echo '<td align="left">'.$row->CenterName.'</td>';
                                
                                if ($numChecks == 0){
                                        //4th Quarter
                                        echo '<td>'.$flag_Image.'</td>';
                                        //Other Income
                                        echo '<td>'.$flag_Image.'</td>';
                                        //Other Expense
                                        echo '<td>'.$flag_Image.'</td>';
                                        //Estimated Budget
                                        echo '<td>'.$flag_Image.'</td>';
                                        //BOD LIst
                                        echo '<td>'.$flag_Image.'</td>';
                                        //Diversity Action Plan
                                        echo '<td>'.$flag_Image.'</td>';
                                        //SnailMail 1
                                        echo '<td>'.$flag_Image.'</td>';
                                        //SnailMail 2
                                        echo '<td>'.$flag_Image.'</td>';
                                        //SnailMail 3
                                        echo '<td>'.$flag_Image.'</td>';
                                }
                                else{
                                        //4th Quarter
                                        if(isset($rowChecks->completed)){
                                                if ($rowChecks->completed == 1) 
                                                        echo '<td>'.$check_Image.'</td>';
                                                else 
                                                        echo '<td>'.$flag_Image.'</td>';
                                        }
                                        else
                                                echo '<td>'.$flag_Image.'</td>';
                                        //Other Income
                                        if(isset($rowChecks->OtherIncome)){
                                                if ($rowChecks->OtherIncome == 1)
                                                        echo '<td>'.$check_Image.'</td>';
                                                else 
                                                        echo '<td>'.$flag_Image.'</td>';
                                        }
                                        else
                                                echo '<td>'.$flag_Image.'</td>';
                                        //Other Expense
                                        if(isset($rowChecks->OtherExpense)){
                                                if ($rowChecks->OtherExpense == 1)
                                                        echo '<td>'.$check_Image.'</td>';
                                                else 
                                                        echo '<td>'.$flag_Image.'</td>';
                                        }
                                        else
                                                echo '<td>'.$flag_Image.'</td>';
                                        //Estimated Budget
                                        if(isset($rowChecks->EstBudget)){
                                                if ($rowChecks->EstBudget == 1)
                                                        echo '<td>'.$check_Image.'</td>';
                                                else 
                                                        echo '<td>'.$flag_Image.'</td>';
                                        }
                                        else
                                                echo '<td>'.$flag_Image.'</td>';
                                        //BOD LIst
                                        if(isset($rowChecks->BoardOfDir)){
                                                if ($rowChecks->BoardOfDir == 1)
                                                        echo '<td>'.$check_Image.'</td>';
                                                else 
                                                        echo '<td>'.$flag_Image.'</td>';
                                        }
                                        else
                                                echo '<td>'.$flag_Image.'</td>';
                                        //Diversity Action Plan
                                        if(isset($rowChecks->DiversityActPlan)){
                                                if ($rowChecks->DiversityActPlan == 1)
                                                        echo '<td>'.$check_Image.'</td>';
                                                else 
                                                        echo '<td>'.$flag_Image.'</td>';
                                        }
                                        else
                                                echo '<td>'.$flag_Image.'</td>';
                                        //SnailMail 1
                                        if(isset($rowChecks->AllocationReq)){
                                                if ($rowChecks->AllocationReq == 1)
                                                        echo '<td>'.$check_Image.'</td>';
                                                else 
                                                        echo '<td>'.$flag_Image.'</td>';
                                        }
                                        else
                                                echo '<td>'.$flag_Image.'</td>';
                                        //SnailMail 2
                                        if(isset($rowChecks->Audit)){
                                                if ($rowChecks->Audit == 1)
                                                        echo '<td>'.$check_Image.'</td>';
                                                else 
                                                        echo '<td>'.$flag_Image.'</td>';
                                        }
                                        else
                                                echo '<td>'.$flag_Image.'</td>';
                                        //SnailMail 3
                                        if(isset($rowChecks->AnnualStan)){
                                                if ($rowChecks->AnnualStan == 1)
                                                        echo '<td>'.$check_Image.'</td>';
                                                else 
                                                        echo '<td>'.$flag_Image.'</td>';
                                        }
                                        else
                                                echo '<td>'.$flag_Image.'</td>';
                                }

                                //close the Table Row
                                echo '</tr>';
                        }
                ?>
        </table>
        </center>

</html>


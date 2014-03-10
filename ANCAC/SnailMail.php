<?PHP
	require("ulogin.php");
	require($root."dbconn.php");

	$page_title = 'Snail Mail Documents';
	require($root."header.php");
	
	switch (date("m")){
          case 10:
          case 11:
          case 12:
               $fiscalYear = date("Y") + 1;
               break;
          case 1:
          case 2:
          case 3:
               $fiscalYear = date("Y");
               break;
          case 4:
          case 5:
          case 6:
               $fiscalYear = date("Y");
               break;
          case 7:
          case 8:
          case 9:
               $fiscalYear = date("Y");
               break;
        }
	
	$center = $_GET['center'];
	
	//Get the current information
	$sql = "SELECT CASE AllocationReq When 0 then 'no' else 'yes' END as AllocationReq,".
                " CASE Audit When 0 then 'no' else 'yes' END as Audit,".
                " CASE AnnualStan When 0 then 'no' else 'yes' END as AnnualStan, centerName,".
                " CASE OtherIncome When 0 then 'no' else 'yes' END as OtherIncome,".
                " CASE OtherExpense When 0 then 'no' else 'yes' END as OtherExpense,".
                " CASE EstBudget When 0 then 'no' else 'yes' END as EstBudget,".
                " CASE BoardOfDir When 0 then 'no' else 'yes' END as BoardOfDir,".
                " CASE DiversityActPlan When 0 then 'no' else 'yes' END as DiversityActPlan".
                " FROM eoyChecks join centers on eoyChecks.center = centers.center".
                " WHERE fiscalyear = ".$fiscalYear." AND eoyChecks.center = ".$center;

        $result = @mysql_query($sql) or mysql_error();
        $row1 = mysql_fetch_object($result);
        

?>

<body>
<table class='OutlineTable' align=center width="640px">
<tr>
        <?PHP echo '<td class="login-header" colspan="2" align=center>Snail Mail Documents for '.$row1->centerName.'<br /></td>'; ?>
</tr>
<tr>
	<td class='login' align=left><br>
	<div align="center">
		<table border="0" width="100%" id="table1">
		<tr>
			<td>
<?PHP
        if (isset($_POST['submitted'])){
                 //SET THE VARIABLES TO USE WHEN UPDATING/INSERTING
                 if ($_POST['AllocationReq'] == 'yes') $AllocationReq = 1;
                 else $AllocationReq = 0;
                
                 if ($_POST['Audit'] == 'yes') $Audit = 1;
                 else $Audit = 0;
                 
                 if ($_POST['AnnualStan'] == 'yes') $AnnualStan = 1;
                 else $AnnualStan = 0;
                 
                 if ($_POST['OtherIncome'] == 'yes') $OtherIncome = 1;
                 else $OtherIncome = 0;
                 
                 if ($_POST['OtherExpense'] == 'yes') $OtherExpense = 1;
                 else $OtherExpense = 0;
                 
                 if ($_POST['EstBudget'] == 'yes') $EstBudget = 1;
                 else $EstBudget = 0;
                 
                 if ($_POST['BoardOfDir'] == 'yes') $BoardOfDir = 1;
                 else $BoardOfDir = 0;
                 
                 if ($_POST['DiversityActPlan'] == 'yes') $DiversityActPlan = 1;
                 else $DiversityActPlan = 0;

                 $numRecords = mysql_num_rows($result);

                 if ($numRecords > 0){
                        //UPDATE THE CURRENT RECORD
                        $sqlExecute = "UPDATE eoyChecks SET AllocationReq = '".$AllocationReq."', Audit = '".$Audit."', ".
                        "AnnualStan = '".$AnnualStan."', OtherIncome = '".$OtherIncome."', OtherExpense = '".$OtherExpense."', ".
                        "EstBudget = '".$EstBudget."', BoardOfDir = '".$BoardOfDir."', DiversityActPlan = '".$DiversityActPlan."', username = '".$_SESSION['user']."', datemod = NOW()".
                        " WHERE center = '".$center."' AND fiscalyear = '".$fiscalYear."' ";

                        //update the actualPerfStats table
                        $resultExecute = @mysql_query($sqlExecute);
                        
                        if ($resultExecute)
                                echo '<p>Snail Mail Documents Updated.</p>';
                 }
                 else {
                        //INSERT A RECORD
                        $sqlExecute = "INSERT INTO `eoyChecks` ( `center` , `fiscalyear` , `username` , ".
                                "`datemod` , `OtherIncome` , `OtherExpense` , `EstBudget` , `BoardOfDir` , `DiversityActPlan` , ".
                                "`BudgetReq` , `AllocationReq` , `Audit` , `AnnualStan` ) ".
                        "VALUES ('".$center."', '".$fiscalYear."', '".$_SESSION['user']."', ".
                                "NOW(), '".$OtherIncome."', '".$OtherExpense."', '".$EstBudget."', '".$BoardOfDir."', '".$DiversityActPlan."', ".
                                "'0', '".$AllocationReq."', '".$Audit."', '".$AnnualStan."')";

                        //insert into the actualExpenditures table
                        $resultExecute = @mysql_query($sqlExecute);

                        if ($resultExecute)
                                echo '<p>Snail Mail Documents Updated.</p>';
                 }

                //Get the current information
	        $sql = "SELECT CASE AllocationReq When 0 then 'no' else 'yes' END as AllocationReq,".
                        " CASE Audit When 0 then 'no' else 'yes' END as Audit,".
                        " CASE AnnualStan When 0 then 'no' else 'yes' END as AnnualStan, centerName,".
                        " CASE OtherIncome When 0 then 'no' else 'yes' END as OtherIncome,".
                        " CASE OtherExpense When 0 then 'no' else 'yes' END as OtherExpense,".
                        " CASE EstBudget When 0 then 'no' else 'yes' END as EstBudget,".
                        " CASE BoardOfDir When 0 then 'no' else 'yes' END as BoardOfDir,".
                        " CASE DiversityActPlan When 0 then 'no' else 'yes' END as DiversityActPlan".
                        " FROM eoyChecks join centers on eoyChecks.center = centers.center".
                        " WHERE fiscalyear = ".$fiscalYear." AND eoyChecks.center = ".$center;

                $result = @mysql_query($sql) or mysql_error();
                $row1 = mysql_fetch_object($result);
        }
?>

			</td>
		</tr>
		<tr>
		    <td>
		        <?PHP
		              if($_SESSION['admin'] == 2){
                                echo '<form action="SnailMail.php?center='.$center.'" method="post">';
                                echo '<p><input type="checkbox" name="AllocationReq" value="yes" ';
                                if(isset($row1->AllocationReq)) {if ($row1->AllocationReq == "yes") echo 'CHECKED'; }
                                echo '/><b> 12 Official copies of Allocation Request Form Received?</b></p>';
                                echo '<p><input type="checkbox" name="Audit" value="yes" ';
                                if(isset($row1->Audit)) {if ($row1->Audit == "yes") echo 'CHECKED'; }
                                echo '/><b> Audit Received?</b></p>';
                                echo '<p><input type="checkbox" name="AnnualStan" value="yes" ';
                                if(isset($row1->AnnualStan)) {if ($row1->AnnualStan == "yes") echo 'CHECKED'; }
                                echo '/><b> Annual Standards Documentation Received?</b></p>';
                                echo '<p><input type="checkbox" name="OtherIncome" value="yes" ';
                                if(isset($row1->OtherIncome)) {if ($row1->OtherIncome == "yes") echo 'CHECKED'; }
                                echo '/><b> Other Income?</b></p>';
                                echo '<p><input type="checkbox" name="OtherExpense" value="yes" ';
                                if(isset($row1->OtherExpense)) {if ($row1->OtherExpense == "yes") echo 'CHECKED'; }
                                echo '/><b> Other Expense?</b></p>';
                                echo '<p><input type="checkbox" name="EstBudget" value="yes" ';
                                if(isset($row1->EstBudget)) {if ($row1->EstBudget == "yes") echo 'CHECKED'; }
                                echo '/><b> Estimated Budget?</b></p>';
                                echo '<p><input type="checkbox" name="BoardOfDir" value="yes" ';
                                if(isset($row1->BoardOfDir)) {if ($row1->BoardOfDir == "yes") echo 'CHECKED'; }
                                echo '/><b> Board of Directors List?</b></p>';
                                echo '<p><input type="checkbox" name="DiversityActPlan" value="yes" ';
                                if(isset($row1->DiversityActPlan)) {if ($row1->DiversityActPlan == "yes") echo 'CHECKED'; }
                                echo '/><b> Diversity Action Plan?</b></p>';
                                echo '<br />';
                                echo '<p><input type="submit" name="submit" value="Submit Received Documents" onclick="javascript:return confirm(\'Are you sure you want to submit the received documents?\')" /></p>';
                                echo '<input type="hidden" name="submitted" value="TRUE" />';
                                echo '</form>';
                                }
                                else
                                echo '<p>You do not have Administration access</p>';
                        ?>
		    </td>
		</tr>
		</table>
	</div>
	</td>
</tr>
</table></div>
</body>
<?PHP
	require($root."footer.php");
?>


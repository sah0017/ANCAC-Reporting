<?
	require("./ulogin.php");
	require("./dbconn.php");
        //set the fiscalYear
        switch (date("m")){
                case 10:
                case 11:
                case 12:
                        $fiscalYear = date("Y") + 1;
                        $ThisAvailable = 0;
                        break;
                case 1:
                case 2:
                case 3:
                        $fiscalYear = date("Y");
                        $ThisAvailable = 0;
                        break;
                case 4:
                case 5:
                case 6:
                        $fiscalYear = date("Y");
                        $ThisAvailable = 0;
                        break;
                case 7:
		       	$fiscalYear = date("Y") + 1;
                        if (date("j") < 16)
                                $ThisAvailable = 1;
                        else
                                $ThisAvailable = 0;
                        break;
                case 8:
                case 9:
                        $fiscalYear = date("Y") + 1;
                        $ThisAvailable = 0;
                        break;
        }
        $CY = 0;
        //set the center that is being edited for
        if($_SESSION['admin'] > 0){
                //Center
                if (isset($_GET['center'])){
                        $centerID = $_GET['center'];
                }
                if (isset($_GET['Y'])){
                        if ($_GET['Y'] == 1){
                                $fiscalYear = $fiscalYear - 1;
                                $CY = 1;
                        }
                }
                $ThisAvailable = 1;
        }
        else{
                //center
                if (isset($_SESSION['center'])){
                        $centerID = $_SESSION['center'];
                }
        }

	$sqlCenter = "SELECT CenterName FROM centers ".
             "WHERE center = '".$centerID."'";
        $resultCenter = @mysql_query($sqlCenter) or mysql_error();
        $rowCenter = mysql_fetch_object($resultCenter);
        $CenterName = $rowCenter->CenterName;

	$page_title = 'ANCAC: Editing Budgets for Childrens First Plan of Investment for '.$CenterName;
	require("./header.php");

?>

<body>
<table class='OutlineTable' align=center width="95%">
<tr>
	<td class='login-header' colspan='2' align=center><? echo $CenterName; ?> Editing Budgets for Childrens First Plan of Investment - FY <? echo $fiscalYear; ?><br></td>
</tr>
<tr>
	<td class='login' align=left>
	<center>
		<table border="0" width="100%" id="table1">
		<tr>
			<td>
			<form action="updateBudgetsTOP.php" method="post">
			<? //grab the budgeted information to display
			     $sql = "SELECT fiTotal,extForenEval,intCounsSes".
              " FROM budgetedPerfStats ".
              "WHERE budgetedPerfStats.center = ".$centerID." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 1";

                             $result = @mysql_query($sql) or mysql_error();
                             $row1QBudgeted = mysql_fetch_object($result);
                             $Update1 = mysql_num_rows($result);

                             $sql = "SELECT fiTotal,extForenEval,intCounsSes".
              " FROM budgetedPerfStats ".
              "WHERE budgetedPerfStats.center = ".$centerID." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 2";

                             $result = @mysql_query($sql) or mysql_error();
                             $row2QBudgeted = mysql_fetch_object($result);
                             $Update2 = mysql_num_rows($result);

                             $sql = "SELECT fiTotal,extForenEval,intCounsSes".
              " FROM budgetedPerfStats ".
              "WHERE budgetedPerfStats.center = ".$centerID." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 3";

                             $result = @mysql_query($sql) or mysql_error();
                             $row3QBudgeted = mysql_fetch_object($result);
                             $Update3 = mysql_num_rows($result);

                             $sql = "SELECT fiTotal,extForenEval,intCounsSes".
              " FROM budgetedPerfStats ".
              "WHERE budgetedPerfStats.center = ".$centerID." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 4";

                             $result = @mysql_query($sql) or mysql_error();
                             $row4QBudgeted = mysql_fetch_object($result);
                             $Update4 = mysql_num_rows($result);

                             $ExpenseBud1 = array();
                             $ExpenseBud2 = array();
                             $ExpenseBud3 = array();
                             $ExpenseBud4 = array();

                        ?>

                <table width="100%" class="Admin">
                <tr>
                        <td width="40%"><b>Performance Statistics</td>
                        <td align="center"><b>Quarter ending Dec 31</b></td>
                        <td align="center"><b>Quarter ending Mar 31</b></td>
                        <td align="center"><b>Quarter ending Jun 31</b></td>
                        <td align="center"><b>Quarter ending Sep 31</b></td>
                </tr>
                <tr align="center">
                        <td align="left">1) Number of children receiving an initial forensic interview at the CAC</td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fiTotal1"
                                value="<? if(isset($row1QBudgeted->fiTotal)) echo $row1QBudgeted->fiTotal; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fiTotal2"
                                value="<? if(isset($row2QBudgeted->fiTotal)) echo $row2QBudgeted->fiTotal; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fiTotal3"
                                value="<? if(isset($row3QBudgeted->fiTotal)) echo $row3QBudgeted->fiTotal; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fiTotal4"
                                value="<? if(isset($row4QBudgeted->fiTotal)) echo $row4QBudgeted->fiTotal; ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">2) Number of children receiving <u>initial</u> extended forensic evaluations at the CAC</td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="extForenEval1"
                                value="<? if(isset($row1QBudgeted->extForenEval)) echo $row1QBudgeted->extForenEval; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="extForenEval2"
                                value="<? if(isset($row2QBudgeted->extForenEval)) echo $row2QBudgeted->extForenEval; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="extForenEval3"
                                value="<? if(isset($row3QBudgeted->extForenEval)) echo $row3QBudgeted->extForenEval; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="extForenEval4"
                                value="<? if(isset($row4QBudgeted->extForenEval)) echo $row4QBudgeted->extForenEval; ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">3) Number of children receiving <u>initial</u> counseling sessions at the CAC</td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="intCounsSes1"
                                value="<? if(isset($row1QBudgeted->intCounsSes)) echo $row1QBudgeted->intCounsSes; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="intCounsSes2"
                                value="<? if(isset($row2QBudgeted->intCounsSes)) echo $row2QBudgeted->intCounsSes; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="intCounsSes3"
                                value="<? if(isset($row3QBudgeted->intCounsSes)) echo $row3QBudgeted->intCounsSes; ?>" /></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="intCounsSes4"
                                value="<? if(isset($row4QBudgeted->intCounsSes)) echo $row4QBudgeted->intCounsSes; ?>" /></td>
                </tr>
                <tr>
                        <td colspan="5"><br></td>
                </tr>
                </table>
                                <? if ($ThisAvailable == 1){
                                        if ($_SESSION['admin'] != 1)
                                                echo '<p><input type="submit" name="submit" value="Update Budgets for Childrens First Plan of Investment" /></p>';
                                }
                                ?>
                                <input type="hidden" name="centerID" value="<? echo $centerID; ?>" />
                                <input type="hidden" name="fiscalYear" value="<? echo $fiscalYear; ?>" />
                                <input type="hidden" name="Update1" value="<? echo $Update1; ?>" />
                                <input type="hidden" name="Update2" value="<? echo $Update2; ?>" />
                                <input type="hidden" name="Update3" value="<? echo $Update3; ?>" />
                                <input type="hidden" name="Update4" value="<? echo $Update4; ?>" />
                                <input type="hidden" name="CY" value="<? echo $CY; ?>" />
                        </form>
			</td>
		</tr>
		</table>
	</center>
	</td>
</tr>
</table>
</body>
<?
	require("./footer.php");
?>



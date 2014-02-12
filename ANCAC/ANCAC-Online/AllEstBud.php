<?php
	require("./ulogin.php");
	require("/home/cluster1/data/a/p/a1224426/data/dbconn.php");

	$page_title = 'ANCAC: Estimated Budget for All 4 Quarters';
	require("./header.php");

        $fiscalYear = $_POST['year'];
?>

<?php
                $sql = "SELECT centers.center, centers.CenterName FROM `centers` JOIN `eoyChecks` ON centers.center = eoyChecks.center".
                        " AND eoyChecks.fiscalyear = '".$fiscalYear."' AND eoyChecks.EstBudget = '1'".
                        "  WHERE centers.center not in (0,99) order by centers.center";
                $result = @mysql_query($sql) or mysql_error();
?>
                <center>
		<table class="OutlineTable" width="85%">
                        <tr><td class="login-header" colspan="5">All Submitted Estimated Budget for All 4 Quarters - FY <?php echo $fiscalYear; ?></td></tr>
                        <tr align="left"><td colspan="5"><b>Date: </b><?php echo date("M d Y"); ?></td></tr>
                        <tr><td colspan="5">&nbsp;</td></tr>
                </table>
                <table class="Admin" width="85%">
<?php
		while ($row = mysql_fetch_object($result)) {
                         $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,".
              "areaSchools,corpDonations,privDonations,fundraisers,bankInterest".
              " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
              "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
              "WHERE budgetedPerfStats.center = ".$row->center." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 1";

                             $result1Q = @mysql_query($sql) or mysql_error();
                             $row1QBudgeted = mysql_fetch_object($result1Q);

                             $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,".
              "areaSchools,corpDonations,privDonations,fundraisers,bankInterest".
              " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
              "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
              "WHERE budgetedPerfStats.center = ".$row->center." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 2";

                             $result2Q = @mysql_query($sql) or mysql_error();
                             $row2QBudgeted = mysql_fetch_object($result2Q);

                             $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,".
              "areaSchools,corpDonations,privDonations,fundraisers,bankInterest".
              " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
              "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
              "WHERE budgetedPerfStats.center = ".$row->center." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 3";

                             $result3Q = @mysql_query($sql) or mysql_error();
                             $row3QBudgeted = mysql_fetch_object($result3Q);

                             $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,".
              "areaSchools,corpDonations,privDonations,fundraisers,bankInterest".
              " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
              "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
              "WHERE budgetedPerfStats.center = ".$row->center." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 4";

                             $result4Q = @mysql_query($sql) or mysql_error();
                             $row4QBudgeted = mysql_fetch_object($result4Q);

                             $ExpenseBud1 = array();
                             $ExpenseBud2 = array();
                             $ExpenseBud3 = array();
                             $ExpenseBud4 = array();
                echo '<tr><td colspan="5"><b>Name of Child Advocacy Center: </b>'.$row->CenterName.'</td></tr>';
                echo '<tr><td width="40%"><b>Performance Statistics</td><td align="center"><b>Quarter ending Dec 31</b></td><td align="center"><b>Quarter ending Mar 31</b></td>'.
                        '<td align="center"><b>Quarter ending Jun 31</b></td><td align="center"><b>Quarter ending Sep 31</b></td></tr>';
                echo '<tr align="center"><td align="left">1) Number of children receiving an initial forensic interview at the CAC</td>';
                echo '<td>'; 
                if(isset($row1QBudgeted->fiTotal)) echo $row1QBudgeted->fiTotal;
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->fiTotal)) echo $row2QBudgeted->fiTotal;
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->fiTotal)) echo $row3QBudgeted->fiTotal;
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->fiTotal)) echo $row4QBudgeted->fiTotal;
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">2) Number of children receiving <u>initial</u> extended forensic evaluations at the CAC</td>';
                echo '<td>'; 
                if(isset($row1QBudgeted->extForenEval)) echo $row1QBudgeted->extForenEval;
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->extForenEval)) echo $row2QBudgeted->extForenEval;
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->extForenEval)) echo $row3QBudgeted->extForenEval;
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->extForenEval)) echo $row4QBudgeted->extForenEval;
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">3) Number of children receiving <u>initial</u> counseling sessions at the CAC</td>';
                echo '<td>'; 
                if(isset($row1QBudgeted->intCounsSes)) echo $row1QBudgeted->intCounsSes;
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->intCounsSes)) echo $row2QBudgeted->intCounsSes;
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->intCounsSes)) echo $row3QBudgeted->intCounsSes;
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->intCounsSes)) echo $row4QBudgeted->intCounsSes;
                echo '</td>';
                echo '</tr>';
                echo '<tr><td colspan="5"><br /></td></tr>';
                echo '<tr><td><b>Quarterly Expenditures</td><td align="center"><b>Quarter ending Dec 31</b></td><td align="center"><b>Quarter ending Mar 31</b></td>'.
                        '<td align="center"><b>Quarter ending Jun 31</b></td><td align="center"><b>Quarter ending Sep 31</b></td></tr>';
                echo '<tr align="center"><td align="left">Personnel Costs</td>';
                echo '<td>'; 
                if(isset($row1QBudgeted->personnelCosts)){ echo $row1QBudgeted->personnelCosts; $ExpenseBud1[] = $row1QBudgeted->personnelCosts;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->personnelCosts)){ echo $row2QBudgeted->personnelCosts; $ExpenseBud2[] = $row2QBudgeted->personnelCosts;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->personnelCosts)){ echo $row3QBudgeted->personnelCosts; $ExpenseBud3[] = $row3QBudgeted->personnelCosts;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->personnelCosts)){ echo $row4QBudgeted->personnelCosts; $ExpenseBud4[] = $row4QBudgeted->personnelCosts;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Employee Benefits</td>';
                echo '<td>'; 
                if(isset($row1QBudgeted->empBenefits)){ echo $row1QBudgeted->empBenefits; $ExpenseBud1[] = $row1QBudgeted->empBenefits;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->empBenefits)){ echo $row2QBudgeted->empBenefits; $ExpenseBud2[] = $row2QBudgeted->empBenefits;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->empBenefits)){ echo $row3QBudgeted->empBenefits; $ExpenseBud3[] = $row3QBudgeted->empBenefits;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->empBenefits)){ echo $row4QBudgeted->empBenefits; $ExpenseBud4[] = $row4QBudgeted->empBenefits;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Travel-In-State</td>';
                echo '<td>'; 
                if(isset($row1QBudgeted->travelInState)){ echo $row1QBudgeted->travelInState; $ExpenseBud1[] = $row1QBudgeted->travelInState;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->travelInState)){ echo $row2QBudgeted->travelInState; $ExpenseBud2[] = $row2QBudgeted->travelInState;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->travelInState)){ echo $row3QBudgeted->travelInState; $ExpenseBud3[] = $row3QBudgeted->travelInState;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->travelInState)){ echo $row4QBudgeted->travelInState; $ExpenseBud4[] = $row4QBudgeted->travelInState;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Travel-Out-of-State</td>';
                echo '<td>'; 
                if(isset($row1QBudgeted->travelOutState)){ echo $row1QBudgeted->travelOutState; $ExpenseBud1[] = $row1QBudgeted->travelOutState;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->travelOutState)){ echo $row2QBudgeted->travelOutState; $ExpenseBud2[] = $row2QBudgeted->travelOutState;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->travelOutState)){ echo $row3QBudgeted->travelOutState; $ExpenseBud3[] = $row3QBudgeted->travelOutState;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->travelOutState)){ echo $row4QBudgeted->travelOutState; $ExpenseBud4[] = $row4QBudgeted->travelOutState;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Repairs and Maintenance</td>';
                echo '<td>'; 
                if(isset($row1QBudgeted->repairsAndMx)){ echo $row1QBudgeted->repairsAndMx; $ExpenseBud1[] = $row1QBudgeted->repairsAndMx;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->repairsAndMx)){ echo $row2QBudgeted->repairsAndMx; $ExpenseBud2[] = $row2QBudgeted->repairsAndMx;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->repairsAndMx)){ echo $row3QBudgeted->repairsAndMx; $ExpenseBud3[] = $row3QBudgeted->repairsAndMx;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->repairsAndMx)){ echo $row4QBudgeted->repairsAndMx; $ExpenseBud4[] = $row4QBudgeted->repairsAndMx;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Rentals and Leases</td>';
                echo '<td>'; 
                if(isset($row1QBudgeted->rentalsLease)){ echo $row1QBudgeted->rentalsLease; $ExpenseBud1[] = $row1QBudgeted->rentalsLease;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->rentalsLease)){ echo $row2QBudgeted->rentalsLease; $ExpenseBud2[] = $row2QBudgeted->rentalsLease;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->rentalsLease)){ echo $row3QBudgeted->rentalsLease; $ExpenseBud3[] = $row3QBudgeted->rentalsLease;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->rentalsLease)){ echo $row4QBudgeted->rentalsLease; $ExpenseBud4[] = $row4QBudgeted->rentalsLease;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Utilities and Communications</td>';
                echo '<td>'; 
                if(isset($row1QBudgeted->utilComm)){ echo $row1QBudgeted->utilComm; $ExpenseBud1[] = $row1QBudgeted->utilComm;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->utilComm)){ echo $row2QBudgeted->utilComm; $ExpenseBud2[] = $row2QBudgeted->utilComm;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->utilComm)){ echo $row3QBudgeted->utilComm; $ExpenseBud3[] = $row3QBudgeted->utilComm;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->utilComm)){ echo $row4QBudgeted->utilComm; $ExpenseBud4[] = $row4QBudgeted->utilComm;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Professional Services</td>';
                echo '<td>'; 
                if(isset($row1QBudgeted->profServ)){ echo $row1QBudgeted->profServ; $ExpenseBud1[] = $row1QBudgeted->profServ;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->profServ)){ echo $row2QBudgeted->profServ; $ExpenseBud2[] = $row2QBudgeted->profServ;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->profServ)){ echo $row3QBudgeted->profServ; $ExpenseBud3[] = $row3QBudgeted->profServ;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->profServ)){ echo $row4QBudgeted->profServ; $ExpenseBud4[] = $row4QBudgeted->profServ;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Supplies, Materials, Operations</td>';
                echo '<td>'; 
                if(isset($row1QBudgeted->suppMatOper)){ echo $row1QBudgeted->suppMatOper; $ExpenseBud1[] = $row1QBudgeted->suppMatOper;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->suppMatOper)){ echo $row2QBudgeted->suppMatOper; $ExpenseBud2[] = $row2QBudgeted->suppMatOper;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->suppMatOper)){ echo $row3QBudgeted->suppMatOper; $ExpenseBud3[] = $row3QBudgeted->suppMatOper;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->suppMatOper)){ echo $row4QBudgeted->suppMatOper; $ExpenseBud4[] = $row4QBudgeted->suppMatOper;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Transportation Equip. Purchases</td>';
                echo '<td>'; 
                if(isset($row1QBudgeted->tranEqpPurch)){ echo $row1QBudgeted->tranEqpPurch; $ExpenseBud1[] = $row1QBudgeted->tranEqpPurch;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->tranEqpPurch)){ echo $row2QBudgeted->tranEqpPurch; $ExpenseBud2[] = $row2QBudgeted->tranEqpPurch;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->tranEqpPurch)){ echo $row3QBudgeted->tranEqpPurch; $ExpenseBud3[] = $row3QBudgeted->tranEqpPurch;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->tranEqpPurch)){ echo $row4QBudgeted->tranEqpPurch; $ExpenseBud4[] = $row4QBudgeted->tranEqpPurch;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Other Equipment Purchases</td>';
                echo '<td>'; 
                if(isset($row1QBudgeted->otherEqpPurch)){ echo $row1QBudgeted->otherEqpPurch; $ExpenseBud1[] = $row1QBudgeted->otherEqpPurch;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->otherEqpPurch)){ echo $row2QBudgeted->otherEqpPurch; $ExpenseBud2[] = $row2QBudgeted->otherEqpPurch;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->otherEqpPurch)){ echo $row3QBudgeted->otherEqpPurch; $ExpenseBud3[] = $row3QBudgeted->otherEqpPurch;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->otherEqpPurch)){ echo $row4QBudgeted->otherEqpPurch; $ExpenseBud4[] = $row4QBudgeted->otherEqpPurch;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Capital Outlay</td>';
                echo '<td>'; 
                if(isset($row1QBudgeted->capOutlay)){ echo $row1QBudgeted->capOutlay; $ExpenseBud1[] = $row1QBudgeted->capOutlay;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->capOutlay)){ echo $row2QBudgeted->capOutlay; $ExpenseBud2[] = $row2QBudgeted->capOutlay;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->capOutlay)){ echo $row3QBudgeted->capOutlay; $ExpenseBud3[] = $row3QBudgeted->capOutlay;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->capOutlay)){ echo $row4QBudgeted->capOutlay; $ExpenseBud4[] = $row4QBudgeted->capOutlay;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Debt Service</td>';
                echo '<td>'; 
                if(isset($row1QBudgeted->debtService)){ echo $row1QBudgeted->debtService; $ExpenseBud1[] = $row1QBudgeted->debtService;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->debtService)){ echo $row2QBudgeted->debtService; $ExpenseBud2[] = $row2QBudgeted->debtService;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->debtService)){ echo $row3QBudgeted->debtService; $ExpenseBud3[] = $row3QBudgeted->debtService;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->debtService)){ echo $row4QBudgeted->debtService; $ExpenseBud4[] = $row4QBudgeted->debtService;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Miscellaneous</td>';
                echo '<td>'; 
                if(isset($row1QBudgeted->misc)){ echo $row1QBudgeted->misc; $ExpenseBud1[] = $row1QBudgeted->misc;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->misc)){ echo $row2QBudgeted->misc; $ExpenseBud2[] = $row2QBudgeted->misc;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->misc)){ echo $row3QBudgeted->misc; $ExpenseBud3[] = $row3QBudgeted->misc;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->misc)){ echo $row4QBudgeted->misc; $ExpenseBud4[] = $row4QBudgeted->misc;}
                echo '</td>';
                echo '</tr>';
                //check to see if they have any other expenses entered
                $sqlOE = "SELECT OExpenseID, ExpenseName FROM otherExpenseLU WHERE center = '".$row->center."' AND fiscalyear = '".$fiscalYear."' ORDER BY OExpenseID";
                $resultOE = @mysql_query($sqlOE) or mysql_error();

                $numRecords = mysql_num_rows($resultOE);
                if ($numRecords > 0){
                        while ($rowOE = mysql_fetch_object($resultOE)) {
                        echo '<tr align="center"><td align="left">'.$rowOE->ExpenseName.'</td>';
                                $sqlOEValues = "SELECT oeValue FROM budgetedOtherExpense WHERE center = ".$row->center." AND ".
                                        "fiscalyear = ".$fiscalYear." AND quarter = 1 AND OExpenseID = ".$rowOE->OExpenseID;
                                $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                                $rowOEValues = mysql_fetch_object($resultOEValues);
                        echo '<td>';
                        if(isset($rowOEValues->oeValue)){ echo $rowOEValues->oeValue; $ExpenseBud1[] = $rowOEValues->oeValue;}
                        echo '</td>';
                                $sqlOEValues = "SELECT oeValue FROM budgetedOtherExpense WHERE center = ".$row->center." AND ".
                                        "fiscalyear = ".$fiscalYear." AND quarter = 2 AND OExpenseID = ".$rowOE->OExpenseID;
                                $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                                $rowOEValues = mysql_fetch_object($resultOEValues);
                        echo '<td>';
                        if(isset($rowOEValues->oeValue)){ echo $rowOEValues->oeValue; $ExpenseBud2[] = $rowOEValues->oeValue;}
                        echo '</td>';
                                $sqlOEValues = "SELECT oeValue FROM budgetedOtherExpense WHERE center = ".$row->center." AND ".
                                        "fiscalyear = ".$fiscalYear." AND quarter = 3 AND OExpenseID = ".$rowOE->OExpenseID;
                                $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                                $rowOEValues = mysql_fetch_object($resultOEValues);
                        echo '<td>';
                        if(isset($rowOEValues->oeValue)){ echo $rowOEValues->oeValue; $ExpenseBud3[] = $rowOEValues->oeValue;}
                        echo '</td>';
                                $sqlOEValues = "SELECT oeValue FROM budgetedOtherExpense WHERE center = ".$row->center." AND ".
                                        "fiscalyear = ".$fiscalYear." AND quarter = 4 AND OExpenseID = ".$rowOE->OExpenseID;
                                $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                                $rowOEValues = mysql_fetch_object($resultOEValues);
                        echo '<td>';
                        if(isset($rowOEValues->oeValue)){ echo $rowOEValues->oeValue; $ExpenseBud4[] = $rowOEValues->oeValue;}
                        echo '</td>';
                        echo '</tr>';
                        }
                }
                //THIS IS THE TOTAL STUFF THAT IS COMMENTED OUT
                /* <!--
                <tr align="center">
                        <td align="center"><b>Total Expenditures</b></td>
                        <td align="right"><b><? $totExpendsBudget = 0;
                                foreach ($ExpenseBud1 as $floatFund){
                                        $totExpendsBudget = $totExpendsBudget + $floatFund;
                                }
                                echo number_format($totExpendsBudget, 2); ?></b></td>
                        <td align="right"><b><? $totExpendsBudget = 0;
                                foreach ($ExpenseBud2 as $floatFund){
                                        $totExpendsBudget = $totExpendsBudget + $floatFund;
                                }
                                echo number_format($totExpendsBudget, 2); ?></b></td>
                        <td align="right"><b><? $totExpendsBudget = 0;
                                foreach ($ExpenseBud3 as $floatFund){
                                        $totExpendsBudget = $totExpendsBudget + $floatFund;
                                }
                                echo number_format($totExpendsBudget, 2); ?></b></td>
                        <td align="right"><b><? $totExpendsBudget = 0;
                                foreach ($ExpenseBud4 as $floatFund){
                                        $totExpendsBudget = $totExpendsBudget + $floatFund;
                                }
                                echo number_format($totExpendsBudget, 2); ?></b></td>
                </tr>
                --> */
                //END OF TOTAL STUFF
                echo '<tr><td colspan="5">&nbsp;</td></tr>';
                echo '<tr><td><b>Source of Funds</td><td align="center"><b>Quarter ending Dec 31</b></td><td align="center"><b>Quarter ending Mar 31</b></td>'.
                        '<td align="center"><b>Quarter ending Jun 31</b></td><td align="center"><b>Quarter ending Sep 31</b></td></tr>';
                echo '<tr align="center"><td align="left">State of AL General Fund</td>';
                echo '<td>';
                if(isset($row1QBudgeted->genFund)){ echo $row1QBudgeted->genFund; $FundsBud1[] = $row1QBudgeted->genFund;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->genFund)){ echo $row2QBudgeted->genFund; $FundsBud2[] = $row2QBudgeted->genFund;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->genFund)){ echo $row3QBudgeted->genFund; $FundsBud3[] = $row3QBudgeted->genFund;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->genFund)){ echo $row4QBudgeted->genFund; $FundsBud4[] = $row4QBudgeted->genFund;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">State of AL Children First Trust</td>';
                echo '<td>';
                if(isset($row1QBudgeted->chilFirstTrust)){ echo $row1QBudgeted->chilFirstTrust; $FundsBud1[] = $row1QBudgeted->chilFirstTrust;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->chilFirstTrust)){ echo $row2QBudgeted->chilFirstTrust; $FundsBud2[] = $row2QBudgeted->chilFirstTrust;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->chilFirstTrust)){ echo $row3QBudgeted->chilFirstTrust; $FundsBud3[] = $row3QBudgeted->chilFirstTrust;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->chilFirstTrust)){ echo $row4QBudgeted->chilFirstTrust; $FundsBud4[] = $row4QBudgeted->chilFirstTrust;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">United Way</td>';
                echo '<td>';
                if(isset($row1QBudgeted->unitedWay)){ echo $row1QBudgeted->unitedWay; $FundsBud1[] = $row1QBudgeted->unitedWay;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->unitedWay)){ echo $row2QBudgeted->unitedWay; $FundsBud2[] = $row2QBudgeted->unitedWay;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->unitedWay)){ echo $row3QBudgeted->unitedWay; $FundsBud3[] = $row3QBudgeted->unitedWay;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->unitedWay)){ echo $row4QBudgeted->unitedWay; $FundsBud4[] = $row4QBudgeted->unitedWay;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">ADECA</td>';
                echo '<td>';
                if(isset($row1QBudgeted->adeca)){ echo $row1QBudgeted->adeca; $FundsBud1[] = $row1QBudgeted->adeca;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->adeca)){ echo $row2QBudgeted->adeca; $FundsBud2[] = $row2QBudgeted->adeca;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->adeca)){ echo $row3QBudgeted->adeca; $FundsBud3[] = $row3QBudgeted->adeca;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->adeca)){ echo $row4QBudgeted->adeca; $FundsBud4[] = $row4QBudgeted->adeca;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">National Childrens Alliance</td>';
                echo '<td>';
                if(isset($row1QBudgeted->natlChilAlliance)){ echo $row1QBudgeted->natlChilAlliance; $FundsBud1[] = $row1QBudgeted->natlChilAlliance;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->natlChilAlliance)){ echo $row2QBudgeted->natlChilAlliance; $FundsBud2[] = $row2QBudgeted->natlChilAlliance;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->natlChilAlliance)){ echo $row3QBudgeted->natlChilAlliance; $FundsBud3[] = $row3QBudgeted->natlChilAlliance;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->natlChilAlliance)){ echo $row4QBudgeted->natlChilAlliance; $FundsBud4[] = $row4QBudgeted->natlChilAlliance;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Childrens Trust Fund</td>';
                echo '<td>';
                if(isset($row1QBudgeted->chilTrustFund)){ echo $row1QBudgeted->chilTrustFund; $FundsBud1[] = $row1QBudgeted->chilTrustFund;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->chilTrustFund)){ echo $row2QBudgeted->chilTrustFund; $FundsBud2[] = $row2QBudgeted->chilTrustFund;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->chilTrustFund)){ echo $row3QBudgeted->chilTrustFund; $FundsBud3[] = $row3QBudgeted->chilTrustFund;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->chilTrustFund)){ echo $row4QBudgeted->chilTrustFund; $FundsBud4[] = $row4QBudgeted->chilTrustFund;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Department of Human Resources</td>';
                echo '<td>';
                if(isset($row1QBudgeted->deptOfHR)){ echo $row1QBudgeted->deptOfHR; $FundsBud1[] = $row1QBudgeted->deptOfHR;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->deptOfHR)){ echo $row2QBudgeted->deptOfHR; $FundsBud2[] = $row2QBudgeted->deptOfHR;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->deptOfHR)){ echo $row3QBudgeted->deptOfHR; $FundsBud3[] = $row3QBudgeted->deptOfHR;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->deptOfHR)){ echo $row4QBudgeted->deptOfHR; $FundsBud4[] = $row4QBudgeted->deptOfHR;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">County Commissions</td>';
                echo '<td>';
                if(isset($row1QBudgeted->countyComm)){ echo $row1QBudgeted->countyComm; $FundsBud1[] = $row1QBudgeted->countyComm;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->countyComm)){ echo $row2QBudgeted->countyComm; $FundsBud2[] = $row2QBudgeted->countyComm;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->countyComm)){ echo $row3QBudgeted->countyComm; $FundsBud3[] = $row3QBudgeted->countyComm;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->countyComm)){ echo $row4QBudgeted->countyComm; $FundsBud4[] = $row4QBudgeted->countyComm;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">City Councils</td>';
                echo '<td>';
                if(isset($row1QBudgeted->cityCouncil)){ echo $row1QBudgeted->cityCouncil; $FundsBud1[] = $row1QBudgeted->cityCouncil;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->cityCouncil)){ echo $row2QBudgeted->cityCouncil; $FundsBud2[] = $row2QBudgeted->cityCouncil;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->cityCouncil)){ echo $row3QBudgeted->cityCouncil; $FundsBud3[] = $row3QBudgeted->cityCouncil;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->cityCouncil)){ echo $row4QBudgeted->cityCouncil; $FundsBud4[] = $row4QBudgeted->cityCouncil;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Local Grants</td>';
                echo '<td>';
                if(isset($row1QBudgeted->localGrants)){ echo $row1QBudgeted->localGrants; $FundsBud1[] = $row1QBudgeted->localGrants;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->localGrants)){ echo $row2QBudgeted->localGrants; $FundsBud2[] = $row2QBudgeted->localGrants;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->localGrants)){ echo $row3QBudgeted->localGrants; $FundsBud3[] = $row3QBudgeted->localGrants;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->localGrants)){ echo $row4QBudgeted->localGrants; $FundsBud4[] = $row4QBudgeted->localGrants;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Area Schools</td>';
                echo '<td>';
                if(isset($row1QBudgeted->areaSchools)){ echo $row1QBudgeted->areaSchools; $FundsBud1[] = $row1QBudgeted->areaSchools;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->areaSchools)){ echo $row2QBudgeted->areaSchools; $FundsBud2[] = $row2QBudgeted->areaSchools;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->areaSchools)){ echo $row3QBudgeted->areaSchools; $FundsBud3[] = $row3QBudgeted->areaSchools;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->areaSchools)){ echo $row4QBudgeted->areaSchools; $FundsBud4[] = $row4QBudgeted->areaSchools;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Corporate Donations</td>';
                echo '<td>';
                if(isset($row1QBudgeted->corpDonations)){ echo $row1QBudgeted->corpDonations; $FundsBud1[] = $row1QBudgeted->corpDonations;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->corpDonations)){ echo $row2QBudgeted->corpDonations; $FundsBud2[] = $row2QBudgeted->corpDonations;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->corpDonations)){ echo $row3QBudgeted->corpDonations; $FundsBud3[] = $row3QBudgeted->corpDonations;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->corpDonations)){ echo $row4QBudgeted->corpDonations; $FundsBud4[] = $row4QBudgeted->corpDonations;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Private Donations</td>';
                echo '<td>';
                if(isset($row1QBudgeted->privDonations)){ echo $row1QBudgeted->privDonations; $FundsBud1[] = $row1QBudgeted->privDonations;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->privDonations)){ echo $row2QBudgeted->privDonations; $FundsBud2[] = $row2QBudgeted->privDonations;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->privDonations)){ echo $row3QBudgeted->privDonations; $FundsBud3[] = $row3QBudgeted->privDonations;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->privDonations)){ echo $row4QBudgeted->privDonations; $FundsBud4[] = $row4QBudgeted->privDonations;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Fundraisers</td>';
                echo '<td>';
                if(isset($row1QBudgeted->fundraisers)){ echo $row1QBudgeted->fundraisers; $FundsBud1[] = $row1QBudgeted->fundraisers;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->fundraisers)){ echo $row2QBudgeted->fundraisers; $FundsBud2[] = $row2QBudgeted->fundraisers;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->fundraisers)){ echo $row3QBudgeted->fundraisers; $FundsBud3[] = $row3QBudgeted->fundraisers;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->fundraisers)){ echo $row4QBudgeted->fundraisers; $FundsBud4[] = $row4QBudgeted->fundraisers;}
                echo '</td>';
                echo '</tr>';
                echo '<tr align="center"><td align="left">Bank Interest</td>';
                echo '<td>';
                if(isset($row1QBudgeted->bankInterest)){ echo $row1QBudgeted->bankInterest; $FundsBud1[] = $row1QBudgeted->bankInterest;}
                echo '</td>';
                echo '<td>';
                if(isset($row2QBudgeted->bankInterest)){ echo $row2QBudgeted->bankInterest; $FundsBud2[] = $row2QBudgeted->bankInterest;}
                echo '</td>';
                echo '<td>';
                if(isset($row3QBudgeted->bankInterest)){ echo $row3QBudgeted->bankInterest; $FundsBud3[] = $row3QBudgeted->bankInterest;}
                echo '</td>';
                echo '<td>';
                if(isset($row4QBudgeted->bankInterest)){ echo $row4QBudgeted->bankInterest; $FundsBud4[] = $row4QBudgeted->bankInterest;}
                echo '</td>';
                echo '</tr>';
                //check to see if they have any other incomes entered
                $sqlOI = "SELECT OIncomeID, IncomeName FROM otherIncomeLU WHERE center = '".$row->center."' AND fiscalyear = '".$fiscalYear."' ORDER BY OIncomeID";
                $resultOI = @mysql_query($sqlOI) or mysql_error();

                $numRecords = mysql_num_rows($resultOI);
                if ($numRecords > 0){
                        while ($rowOI = mysql_fetch_object($resultOI)) {
                        echo '<tr align="center"><td align="left">'.$rowOI->IncomeName.'</td>';
                                $sqlOIValues = "SELECT oiValue FROM budgetedOtherIncome WHERE center = ".$row->center." AND ".
                                        "fiscalyear = ".$fiscalYear." AND quarter = 1 AND OIncomeID = ".$rowOI->OIncomeID;
                                $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                                $rowOIValues = mysql_fetch_object($resultOIValues);
                        echo '<td>';
                        if(isset($rowOIValues->oiValue)){ echo $rowOIValues->oiValue; $FundsBud1[] = $rowOIValues->oiValue;}
                        echo '</td>';
                                $sqlOIValues = "SELECT oiValue FROM budgetedOtherIncome WHERE center = ".$row->center." AND ".
                                        "fiscalyear = ".$fiscalYear." AND quarter = 2 AND OIncomeID = ".$rowOI->OIncomeID;
                                $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                                $rowOIValues = mysql_fetch_object($resultOIValues);
                        echo '<td>';
                        if(isset($rowOIValues->oiValue)){ echo $rowOIValues->oiValue; $FundsBud2[] = $rowOIValues->oiValue;}
                        echo '</td>';
                                $sqlOIValues = "SELECT oiValue FROM budgetedOtherIncome WHERE center = ".$row->center." AND ".
                                        "fiscalyear = ".$fiscalYear." AND quarter = 3 AND OIncomeID = ".$rowOI->OIncomeID;
                                $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                                $rowOIValues = mysql_fetch_object($resultOIValues);
                        echo '<td>';
                        if(isset($rowOIValues->oiValue)){ echo $rowOIValues->oiValue; $FundsBud3[] = $rowOIValues->oiValue;}
                        echo '</td>';
                                $sqlOIValues = "SELECT oiValue FROM budgetedOtherIncome WHERE center = ".$row->center." AND ".
                                        "fiscalyear = ".$fiscalYear." AND quarter = 4 AND OIncomeID = ".$rowOI->OIncomeID;
                                $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                                $rowOIValues = mysql_fetch_object($resultOIValues);
                        echo '<td>';
                        if(isset($rowOIValues->oiValue)){ echo $rowOIValues->oiValue; $FundsBud4[] = $rowOIValues->oiValue;}
                        echo '</td>';
                        echo '</tr>';
                        }
                }
                //THIS IS THE COMMENTED OUT TOTAL STUFF
                /* <tr align="center">
                        <td align="center"><b>Total Funds</b></td>
                        <td align="right"><b><? $totFundsBudget = 0;
                                foreach ($FundsBud1 as $floatFund){
                                        $totFundsBudget = $totFundsBudget + $floatFund;
                                }
                                echo number_format($totFundsBudget, 2); ?></b></td>
                        <td align="right"><b><? $totFundsBudget = 0;
                                foreach ($FundsBud2 as $floatFund){
                                        $totFundsBudget = $totFundsBudget + $floatFund;
                                }
                                echo number_format($totFundsBudget, 2); ?></b></td>
                        <td align="right"><b><? $totFundsBudget = 0;
                                foreach ($FundsBud3 as $floatFund){
                                        $totFundsBudget = $totFundsBudget + $floatFund;
                                }
                                echo number_format($totFundsBudget, 2); ?></b></td>
                        <td align="right"><b><? $totFundsBudget = 0;
                                foreach ($FundsBud4 as $floatFund){
                                        $totFundsBudget = $totFundsBudget + $floatFund;
                                }
                                 echo number_format($totFundsBudget, 2); ?></b></td>
                </tr> */
                //THIS IS THE END OF THE TOTAL STUFF
                echo '<tr><td colspan="5">&nbsp;</td></tr>';
                echo '<div class="page-break"></div>';
  }
?>

                </table>
                </center>



</html>


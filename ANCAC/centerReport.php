<?PHP
	require("ulogin.php");
	require($root."dbconn.php");

	$sqlCenter = "SELECT CenterName FROM centers ".
             "WHERE center = '".$_SESSION['center']."'";
        $resultCenter = @mysql_query($sqlCenter) or mysql_error();
        $rowCenter = mysql_fetch_object($resultCenter);
        $CenterName = $rowCenter->CenterName;

	$page_title = 'ANCAC: Quarterly Report for '.$CenterName;
	require($root."header.php");

        switch (date("m")){
                case 10:
                case 11:
                case 12:
                     $fiscalYear = date("Y");
                     $currentQuarter = 4;
                     $Ending = "Sep 30";
                     break;
                case 1:
                case 2:
                case 3:
                     $fiscalYear = date("Y");
                     $currentQuarter = 1;
                     $Ending = "Dec 31";
                     break;
                case 4:
                case 5:
                case 6:
                     $fiscalYear = date("Y");
                     $currentQuarter = 2;
                     $Ending = "Mar 31";
                     break;
                case 7:
                case 8:
                case 9:
                     $fiscalYear = date("Y");
                     $currentQuarter = 3;
                     $Ending = "Jun 30";
                     break;
         }
?>

<body>
<table class='OutlineTable' align=center width="640px">
<tr>
	<td class='login-header' colspan='2' align=center>ANCAC Quarterly Report<br></td>
</tr>
<tr>
	<td class='login' align=left><br>
	<div align="center">
		<table border="0" width="100%" id="table1">
		<tr>
			<td>
<?PHP
     $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
          "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
          "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,".
          "areaSchools,corpDonations,privDonations,fundraisers,bankInterest".
          " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
          "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
          "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
          "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
          "WHERE budgetedPerfStats.center = ".$_SESSION['center']." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
          " AND budgetedPerfStats.quarter = ".$currentQuarter;
     $result = @mysql_query($sql) or mysql_error();
     $row1QBudgeted = mysql_fetch_object($result);

     $sql = "SELECT fiTotal,fi0to6,fi7to12,fi13to18,fiMale,fiFemale,fiAfrAmerican,fiAsian,".
              "fiCauc,fiHispanic,fiOther,extForenEval,intCounsSes,totCounSes,multDisTeamMeet,prosCases,medExamRef,".
              "fullTimeEmp,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,".
              "areaSchools,corpDonations,privDonations,fundraisers,bankInterest".
              " FROM actualPerfStats JOIN actualExpenditures ON actualPerfStats.center = actualExpenditures.center ".
              "AND actualPerfStats.fiscalyear = actualExpenditures.fiscalyear and actualPerfStats.quarter = actualExpenditures.quarter ".
              "JOIN actualSourceFunds ON actualPerfStats.center = actualSourceFunds.center ".
              "AND actualPerfStats.fiscalyear = actualSourceFunds.fiscalyear AND actualPerfStats.quarter = actualSourceFunds.quarter ".
          "WHERE actualPerfStats.center = ".$_SESSION['center']." AND actualPerfStats.fiscalyear = ".$fiscalYear.
          " AND actualPerfStats.quarter = ".$currentQuarter;
     $result = @mysql_query($sql) or mysql_error();
     $row1QActual = mysql_fetch_object($result);

     //Initialize the error array
     $ExpenseBud = array();
     $FundsBud = array();
     $ExpenseAct = array();
     $FundsAct = array();

		echo '<table width="100%">';
		echo '<tr align="left">';
		echo '<td colspan="3"><b>Name of Child Advocacy Center: </b>'.$CenterName.'</td>';
		echo '</tr>';
		echo '<tr align="left">';
		echo '<td><b>Fiscal Year: </b>'.$fiscalYear.'</td><td><b>For Quarter Ending: </b>'.$Ending.'</td><td></td>';
		echo '</tr>';
		echo '<tr><td colspan="3">';


                echo '<table width="100%" class="Admin">'.
                '<tr>'.
                '<td width="50%"><b>Performance Statistics</td>'.
                '<td colspan="2" align="center"><b>Current Quarter ending '.$Ending.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td> </td>'.
                '<td width="25%"><b>Budgeted</b></td><td width="25%"><b>Actual</b></td>'.
                '</tr>';
           if ($_SESSION['admin'] != 1){
                echo '<tr align="center">'.
                        '<td> </td>'.
                        '<td colspan="2"><p class="SpecialLink"><a href="editQuarter.php">Edit</a></p></td>'.
                        '</tr>';
           }
           echo '<tr align="center">'.
                '<td align="left">1) Number of children receiving an initial forensic interview at the CAC</td>'.
                '<td>';
           if(isset($row1QBudgeted->fiTotal)) echo $row1QBudgeted->fiTotal;
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->fiTotal)){if ($row1QActual->fiTotal != -99){echo $row1QActual->fiTotal;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a) Age:&nbsp;&nbsp;0 - 6</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fi0to6)){if ($row1QActual->fi0to6 != -99){ echo $row1QActual->fi0to6;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7 - 12</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fi7to12)){if ($row1QActual->fi7to12 != -99){ echo $row1QActual->fi7to12;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13 - 18</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fi13to18)){if ($row1QActual->fi13to18 != -99){ echo $row1QActual->fi13to18;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b) Gender:&nbsp;&nbsp;&nbsp;Male</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fiMale)){if ($row1QActual->fiMale != -99){ echo $row1QActual->fiMale;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Female</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fiFemale)){if ($row1QActual->fiFemale != -99){ echo $row1QActual->fiFemale; }}
           echo '</td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c) Race:&nbsp;&nbsp;&nbsp;African-American</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fiAfrAmerican)){if ($row1QActual->fiAfrAmerican != -99){ echo $row1QActual->fiAfrAmerican;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Asian</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fiAsian)){if ($row1QActual->fiAsian != -99){ echo $row1QActual->fiAsian;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Caucasian</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fiCauc)){if ($row1QActual->fiCauc != -99){ echo $row1QActual->fiCauc;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hispanic</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fiHispanic)){if ($row1QActual->fiHispanic != -99){ echo $row1QActual->fiHispanic;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Other</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fiOther)){if ($row1QActual->fiOther != -99){ echo $row1QActual->fiOther;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">2) Number of children receiving <u>initial</u> extended forensic evaluations at the CAC</td>'.
                '<td>';
           if(isset($row1QBudgeted->extForenEval)) echo $row1QBudgeted->extForenEval;
           echo'</td>'.
                '<td>';
           if(isset($row1QActual->extForenEval)){if ($row1QActual->extForenEval != -99){ echo $row1QActual->extForenEval;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">3) Number of children receiving <u>initial</u> counseling sessions at the CAC</td>'.
                '<td>';
           if(isset($row1QBudgeted->intCounsSes)) echo $row1QBudgeted->intCounsSes;
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->intCounsSes)){if ($row1QActual->intCounsSes != -99){ echo $row1QActual->intCounsSes;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a) Total number of counseling sessions provided for child victims of abuse</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->totCounSes)){if ($row1QActual->totCounSes != -99){ echo $row1QActual->totCounSes;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">4) Number of child abuse cases reviewed at the CAC multidisciplinary team meetings</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->multDisTeamMeet)){if ($row1QActual->multDisTeamMeet != -99){ echo $row1QActual->multDisTeamMeet;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a) Number of cases referred for prosecution</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->prosCases)){if ($row1QActual->prosCases != -99){ echo $row1QActual->prosCases;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b) Number of children referred for medical exams</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->medExamRef)){if ($row1QActual->medExamRef != -99){ echo $row1QActual->medExamRef; }}
           echo '</td>'.
                '</tr>';
           echo '<tr><td colspan="3"><br></td></tr>';
           echo '<tr>'.
                '<td><b>Quarterly Expenditures</td>'.
                '<td colspan="2" align="center"><b>Current Quarter ending '.$Ending.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td> </td>'.
                '<td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">Number of full-time employees</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fullTimeEmp)){if ($row1QActual->fullTimeEmp != -99.99){ echo $row1QActual->fullTimeEmp;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Personnel Costs</td>'.
                '<td>';
           if(isset($row1QBudgeted->personnelCosts)){ echo number_format($row1QBudgeted->personnelCosts,2); $ExpenseBud[] = $row1QBudgeted->personnelCosts;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->personnelCosts)){if ($row1QActual->personnelCosts != -99.99){ echo number_format($row1QActual->personnelCosts,2); $ExpenseAct[] = $row1QActual->personnelCosts;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Employee Benefits</td>'.
                '<td>';
           if(isset($row1QBudgeted->empBenefits)){ echo number_format($row1QBudgeted->empBenefits,2); $ExpenseBud[] = $row1QBudgeted->empBenefits;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->empBenefits)){if ($row1QActual->empBenefits != -99.99){ echo number_format($row1QActual->empBenefits,2); $ExpenseAct[] = $row1QActual->empBenefits;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Travel-In-State</td>'.
                '<td>';
           if(isset($row1QBudgeted->travelInState)){ echo number_format($row1QBudgeted->travelInState,2); $ExpenseBud[] = $row1QBudgeted->travelInState;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->travelInState)){if ($row1QActual->travelInState != -99.99){ echo number_format($row1QActual->travelInState,2); $ExpenseAct[] = $row1QActual->travelInState;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Travel-Out-of-State</td>'.
                '<td>';
           if(isset($row1QBudgeted->travelOutState)){ echo number_format($row1QBudgeted->travelOutState,2); $ExpenseBud[] = $row1QBudgeted->travelOutState;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->travelOutState)){if ($row1QActual->travelOutState != -99.99){ echo number_format($row1QActual->travelOutState,2); $ExpenseAct[] = $row1QActual->travelOutState;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Repairs and Maintenance</td>'.
                '<td>';
           if(isset($row1QBudgeted->repairsAndMx)){ echo number_format($row1QBudgeted->repairsAndMx,2); $ExpenseBud[] = $row1QBudgeted->repairsAndMx;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->repairsAndMx)){if ($row1QActual->repairsAndMx != -99.99){ echo number_format($row1QActual->repairsAndMx,2); $ExpenseAct[] = $row1QActual->repairsAndMx;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Rentals and Leases</td>'.
                '<td>';
           if(isset($row1QBudgeted->rentalsLease)){ echo number_format($row1QBudgeted->rentalsLease,2); $ExpenseBud[] = $row1QBudgeted->rentalsLease;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->rentalsLease)){if ($row1QActual->rentalsLease != -99.99){ echo number_format($row1QActual->rentalsLease,2); $ExpenseAct[] = $row1QActual->rentalsLease;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Utilities and Communications</td>'.
                '<td>';
           if(isset($row1QBudgeted->utilComm)){ echo number_format($row1QBudgeted->utilComm,2); $ExpenseBud[] = $row1QBudgeted->utilComm;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->utilComm)){if ($row1QActual->utilComm != -99.99){ echo number_format($row1QActual->utilComm,2); $ExpenseAct[] = $row1QActual->utilComm;}}
           echo '</td>'.
                '</tr>';
            echo '<tr align="right">'.
                '<td align="left">Professional Services</td>'.
                '<td>';
            if(isset($row1QBudgeted->profServ)){ echo number_format($row1QBudgeted->profServ,2); $ExpenseBud[] = $row1QBudgeted->profServ;}
            echo '</td>'.
                '<td>';
           if(isset($row1QActual->profServ)){if ($row1QActual->profServ != -99.99){ echo number_format($row1QActual->profServ,2); $ExpenseAct[] = $row1QActual->profServ;}}
           echo '</td>'.
                '</tr>';
            echo '<tr align="right">'.
                '<td align="left">Supplies, Materials, Operations</td>'.
                '<td>';
           if(isset($row1QBudgeted->suppMatOper)){ echo number_format($row1QBudgeted->suppMatOper,2); $ExpenseBud[] = $row1QBudgeted->suppMatOper;}
            echo '</td>'.
                '<td>';
           if(isset($row1QActual->suppMatOper)){if ($row1QActual->suppMatOper != -99.99){ echo number_format($row1QActual->suppMatOper,2); $ExpenseAct[] = $row1QActual->suppMatOper;}}
           echo '</td>'.
                '</tr>';
            echo '<tr align="right">'.
                '<td align="left">Transportation Equip. Purchases</td>'.
                '<td>';
           if(isset($row1QBudgeted->tranEqpPurch)){ echo number_format($row1QBudgeted->tranEqpPurch,2); $ExpenseBud[] = $row1QBudgeted->tranEqpPurch;}
            echo '</td>'.
                '<td>';
           if(isset($row1QActual->tranEqpPurch)){if ($row1QActual->tranEqpPurch != -99.99){ echo number_format($row1QActual->tranEqpPurch,2); $ExpenseAct[] = $row1QActual->tranEqpPurch;}}
           echo '</td>'.
                '</tr>';
            echo '<tr align="right">'.
                '<td align="left">Other Equipment Purchases</td>'.
                '<td>';
           if(isset($row1QBudgeted->otherEqpPurch)){ echo number_format($row1QBudgeted->otherEqpPurch,2); $ExpenseBud[] = $row1QBudgeted->otherEqpPurch;}
            echo '</td>'.
                '<td>';
           if(isset($row1QActual->otherEqpPurch)){if ($row1QActual->otherEqpPurch != -99.99){ echo number_format($row1QActual->otherEqpPurch,2); $ExpenseAct[] = $row1QActual->otherEqpPurch;}}
           echo '</td>'.
                '</tr>';
            echo '<tr align="right">'.
                '<td align="left">Capital Outlay</td>'.
                '<td>';
           if(isset($row1QBudgeted->capOutlay)){ echo number_format($row1QBudgeted->capOutlay,2); $ExpenseBud[] = $row1QBudgeted->capOutlay;}
            echo '</td>'.
                '<td>';
           if(isset($row1QActual->capOutlay)){if ($row1QActual->capOutlay != -99.99){ echo number_format($row1QActual->capOutlay,2); $ExpenseAct[] = $row1QActual->capOutlay;}}
           echo '</td>'.
                '</tr>';
            echo '<tr align="right">'.
                '<td align="left">Debt Service</td>'.
                '<td>';
           if(isset($row1QBudgeted->debtService)){ echo number_format($row1QBudgeted->debtService,2); $ExpenseBud[] = $row1QBudgeted->debtService;}
            echo '</td>'.
                '<td>';
           if(isset($row1QActual->debtService)){if ($row1QActual->debtService != -99.99){ echo number_format($row1QActual->debtService,2); $ExpenseAct[] = $row1QActual->debtService;}}
           echo '</td>'.
                '</tr>';
            echo '<tr align="right">'.
                '<td align="left">Miscellaneous</td>'.
                '<td>';
           if(isset($row1QBudgeted->misc)){ echo number_format($row1QBudgeted->misc,2); $ExpenseBud[] = $row1QBudgeted->misc;}
            echo '</td>'.
                '<td>';
           if(isset($row1QActual->misc)){if ($row1QActual->misc != -99.99){ echo number_format($row1QActual->misc,2); $ExpenseAct[] = $row1QActual->misc;}}
           echo '</td>'.
                '</tr>';
           //check to see if they have any other expenses entered
           $sqlOE = "SELECT OExpenseID, ExpenseName FROM otherExpenseLU WHERE center = '".$_SESSION['center']."' AND fiscalyear = '".$fiscalYear."' ORDER BY OExpenseID";
           $resultOE = @mysql_query($sqlOE) or mysql_error();

           $numRecords = mysql_num_rows($resultOE);
           if ($numRecords > 0){
              while ($row = mysql_fetch_object($resultOE)) {
                 echo '<tr align="right"><td align="left">'.$row->ExpenseName.'</td>'.
                 '<td>';
                 $sqlOEValues = "SELECT oeValue FROM budgetedOtherExpense WHERE center = ".$_SESSION['center']." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = ".$currentQuarter." AND OExpenseID = ".$row->OExpenseID;
                 $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                 $rowOEValues = mysql_fetch_object($resultOEValues);
           if(isset($rowOEValues->oeValue)){ echo number_format($rowOEValues->oeValue,2); $ExpenseBud[] = $rowOEValues->oeValue;}
           echo '</td>'.
                '<td>';
                 $sqlOEValues = "SELECT oeValue FROM actualOtherExpense WHERE center = ".$_SESSION['center']." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = ".$currentQuarter." AND OExpenseID = ".$row->OExpenseID;
                 $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                 $rowOEValues = mysql_fetch_object($resultOEValues);
           if(isset($rowOEValues->oeValue)){if ($rowOEValues->oeValue != -99.99){ echo number_format($rowOEValues->oeValue,2); $ExpenseAct[] = $rowOEValues->oeValue;}}
           echo '</td>'.
                '</tr>';
                }
           }
            echo '<tr align="right">'.
                '<td align="center"><b>Total Expenditures</b></td>'.
                '<td><b>';
           $totExpendsBudget = 0;
           foreach ($ExpenseBud as $floatFund){
                     $totExpendsBudget = $totExpendsBudget + $floatFund;
                  }
           echo number_format($totExpendsBudget, 2);
           echo '</b></td>'. //for the value I will use the ISSET function and the values from the sql call at the top
                '<td><b>';
           $totExpendsActual = 0;
           foreach ($ExpenseAct as $floatFund){
                     $totExpendsActual = $totExpendsActual + $floatFund;
                  }
           echo number_format($totExpendsActual, 2);
           echo '</b></td>'.
                '</tr>';
           echo '<tr><td colspan="13"><br></td></tr>';
           echo '<tr>'.
                '<td><b>Source of Funds</td>'.
                '<td colspan="2" align="center"><b>Current Quarter ending: '.$Ending.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td> </td>'.
                '<td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">State of AL General Fund</td>'.
                '<td>';
           if(isset($row1QBudgeted->genFund)){ echo number_format($row1QBudgeted->genFund,2); $FundsBud[] = $row1QBudgeted->genFund;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->genFund)){if ($row1QActual->genFund != -99.99){ echo number_format($row1QActual->genFund,2); $FundsAct[] = $row1QActual->genFund;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">State of AL Children First Trust</td>'.
                '<td>';
           if(isset($row1QBudgeted->chilFirstTrust)){ echo number_format($row1QBudgeted->chilFirstTrust,2); $FundsBud[] = $row1QBudgeted->chilFirstTrust;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->chilFirstTrust)){if ($row1QActual->chilFirstTrust != -99.99){ echo number_format($row1QActual->chilFirstTrust,2); $FundsAct[] = $row1QActual->chilFirstTrust;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">United Way</td>'.
                '<td>';
           if(isset($row1QBudgeted->unitedWay)){ echo number_format($row1QBudgeted->unitedWay,2); $FundsBud[] = $row1QBudgeted->unitedWay;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->unitedWay)){if ($row1QActual->unitedWay != -99.99){ echo number_format($row1QActual->unitedWay,2); $FundsAct[] = $row1QActual->unitedWay;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">ADECA</td>'.
                '<td>';
           if(isset($row1QBudgeted->adeca)){ echo number_format($row1QBudgeted->adeca,2); $FundsBud[] = $row1QBudgeted->adeca;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->adeca)){if ($row1QActual->adeca != -99.99){ echo number_format($row1QActual->adeca,2); $FundsAct[] = $row1QActual->adeca;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">National Children\'s Alliance</td>'.
                '<td>';
           if(isset($row1QBudgeted->natlChilAlliance)){ echo number_format($row1QBudgeted->natlChilAlliance,2); $FundsBud[] = $row1QBudgeted->natlChilAlliance;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->natlChilAlliance)){if ($row1QActual->natlChilAlliance != -99.99){ echo number_format($row1QActual->natlChilAlliance,2); $FundsAct[] = $row1QActual->natlChilAlliance;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Children\'s Trust Fund</td>'.
                '<td>';
           if(isset($row1QBudgeted->chilTrustFund)){ echo number_format($row1QBudgeted->chilTrustFund,2); $FundsBud[] = $row1QBudgeted->chilTrustFund;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->chilTrustFund)){if ($row1QActual->chilTrustFund != -99.99){ echo number_format($row1QActual->chilTrustFund,2); $FundsAct[] = $row1QActual->chilTrustFund;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Department of Human Resources</td>'.
                '<td>';
           if(isset($row1QBudgeted->deptOfHR)){ echo number_format($row1QBudgeted->deptOfHR,2); $FundsBud[] = $row1QBudgeted->deptOfHR;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->deptOfHR)){if ($row1QActual->deptOfHR != -99.99){ echo number_format($row1QActual->deptOfHR,2); $FundsAct[] = $row1QActual->deptOfHR;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">County Commissions</td>'.
                '<td>';
           if(isset($row1QBudgeted->countyComm)){ echo number_format($row1QBudgeted->countyComm,2); $FundsBud[] = $row1QBudgeted->countyComm;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->countyComm)){if ($row1QActual->countyComm != -99.99){ echo number_format($row1QActual->countyComm,2); $FundsAct[] = $row1QActual->countyComm;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">City Councils</td>'.
                '<td>';
           if(isset($row1QBudgeted->cityCouncil)){ echo number_format($row1QBudgeted->cityCouncil,2); $FundsBud[] = $row1QBudgeted->cityCouncil;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->cityCouncil)){if ($row1QActual->cityCouncil != -99.99){ echo number_format($row1QActual->cityCouncil,2); $FundsAct[] = $row1QActual->cityCouncil;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Local Grants</td>'.
                '<td>';
           if(isset($row1QBudgeted->localGrants)){ echo number_format($row1QBudgeted->localGrants,2); $FundsBud[] = $row1QBudgeted->localGrants;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->localGrants)){if ($row1QActual->localGrants != -99.99){ echo number_format($row1QActual->localGrants,2); $FundsAct[] = $row1QActual->localGrants;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Area Schools</td>'.
                '<td>';
           if(isset($row1QBudgeted->areaSchools)){ echo number_format($row1QBudgeted->areaSchools,2); $FundsBud[] = $row1QBudgeted->areaSchools;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->areaSchools)){if ($row1QActual->areaSchools != -99.99){ echo number_format($row1QActual->areaSchools,2); $FundsAct[] = $row1QActual->areaSchools;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Corporate Donations</td>'.
                '<td>';
           if(isset($row1QBudgeted->corpDonations)){ echo number_format($row1QBudgeted->corpDonations,2); $FundsBud[] = $row1QBudgeted->corpDonations;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->corpDonations)){if ($row1QActual->corpDonations != -99.99){ echo number_format($row1QActual->corpDonations,2); $FundsAct[] = $row1QActual->corpDonations;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Private Donations</td>'.
                '<td>';
           if(isset($row1QBudgeted->privDonations)){ echo number_format($row1QBudgeted->privDonations,2); $FundsBud[] = $row1QBudgeted->privDonations;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->privDonations)){if ($row1QActual->privDonations != -99.99){ echo number_format($row1QActual->privDonations,2); $FundsAct[] = $row1QActual->privDonations;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Fundraisers</td>'.
                '<td>';
           if(isset($row1QBudgeted->fundraisers)){ echo number_format($row1QBudgeted->fundraisers,2); $FundsBud[] = $row1QBudgeted->fundraisers;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->fundraisers)){if ($row1QActual->fundraisers != -99.99){ echo number_format($row1QActual->fundraisers,2); $FundsAct[] = $row1QActual->fundraisers;}}
           echo '</td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Bank Interest</td>'.
                '<td>';
           if(isset($row1QBudgeted->bankInterest)){ echo number_format($row1QBudgeted->bankInterest,2); $FundsBud[] = $row1QBudgeted->bankInterest;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->bankInterest)){if ($row1QActual->bankInterest != -99.99){ echo number_format($row1QActual->bankInterest,2); $FundsAct[] = $row1QActual->bankInterest;}}
           echo '</td>'.
                '</tr>';
           //check to see if they have any other incomes entered
           $sqlOI = "SELECT OIncomeID, IncomeName FROM otherIncomeLU WHERE center = '".$_SESSION['center']."' AND fiscalyear = '".$fiscalYear."' ORDER BY OIncomeID";
           $resultOI = @mysql_query($sqlOI) or mysql_error();

           $numRecords = mysql_num_rows($resultOI);
           if ($numRecords > 0){
              while ($row = mysql_fetch_object($resultOI)) {
                 echo '<tr align="right"><td align="left">'.$row->IncomeName.'</td>'.
                 '<td>';
                 $sqlOIValues = "SELECT oiValue FROM budgetedOtherIncome WHERE center = ".$_SESSION['center']." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = ".$currentQuarter." AND OIncomeID = ".$row->OIncomeID;
                 $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                 $rowOIValues = mysql_fetch_object($resultOIValues);
           if(isset($rowOIValues->oiValue)){ echo number_format($rowOIValues->oiValue,2); $FundsBud[] = $rowOIValues->oiValue;}
           echo '</td>'.
                '<td>';
                 $sqlOIValues = "SELECT oiValue FROM actualOtherIncome WHERE center = ".$_SESSION['center']." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = ".$currentQuarter." AND OIncomeID = ".$row->OIncomeID;
                 $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                 $rowOIValues = mysql_fetch_object($resultOIValues);
           if(isset($rowOIValues->oiValue)){if ($rowOIValues->oiValue != -99.99){ echo number_format($rowOIValues->oiValue,2); $FundsAct[] = $rowOIValues->oiValue;}}
           echo '</td>'.
                '</tr>';
                }
           }
           echo '<tr align="right">'.
                '<td align="center"><b>Total Funds</b></td>'.
                '<td><b>';
           $totFundsBudget = 0;
           foreach ($FundsBud as $floatFund){
                     $totFundsBudget = $totFundsBudget + $floatFund;
                  }
           echo number_format($totFundsBudget, 2);
           echo '</b></td>'. //for the value I will use the ISSET function and the values from the sql call at the top
                '<td><b>';
           $totFundsActual = 0;
           foreach ($FundsAct as $floatFund){
                     $totFundsActual = $totFundsActual + $floatFund;
                  }
           echo number_format($totFundsActual, 2);
           echo '</b></td>'.
                '</tr>';
           echo '</table>';


                echo '</td></tr>';
		echo '</table>';

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


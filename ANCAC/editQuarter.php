<?
	require("./ulogin.php");
	require("/home/cluster1/data/a/p/a1224426/data/dbconn.php");
	
	require("./Variables.php");

	//set the center that is being edited for
	if($_SESSION['admin'] > 0){
                $Available = 1;
                //Center
                if (isset($_GET['C'])){
                        $centerID = $_GET['C'];
                }
                //Quarter
                if (isset($_GET['Q'])){
                        $Quarter = $_GET['Q'];
                }
                //fiscalYear probably not going to use but you never know
                if (isset($_GET['Y'])){
                        $fiscalYear = $_GET['Y'];
                }
        }
        else{
                //center
                if (isset($_SESSION['center'])){
                        $centerID = $_SESSION['center'];
                }
                //fiscalYear and Quarter
                switch (date("m")){
                        case 10:
                                $fiscalYear = date("Y");
                                $Quarter = 4;
                                if (date("j") < $Quarter4Date)
                                        $Available = 1;
                                else
                                        $Available = 0;
                                break;
                        case 11:
                        case 12:
                                $fiscalYear = date("Y");
                                $Quarter = 4;
                                $Available = 0;
                                break;
                        case 1:
                                $fiscalYear = date("Y");
                                $Quarter = 1;
                                if (date("j") < $Quarter1Date)
                                        $Available = 1;
                                else
                                        $Available = 0;
                                break;
                        case 2:
                        case 3:
                                $fiscalYear = date("Y");
                                $Quarter = 1;
                                $Available = 0;
                                break;
                        case 4:
                                $fiscalYear = date("Y");
                                $Quarter = 2;
                                if (date("j") < $Quarter2Date)
                                        $Available = 1;
                                else
                                        $Available = 0;
                                break;
                        case 5:
                        case 6:
                                $fiscalYear = date("Y");
                                $Quarter = 2;
                                $Available = 0;
                                break;
                        case 7:
                                $fiscalYear = date("Y");
                                $Quarter = 3;
                                if (date("j") < $Quarter3Date)
                                        $Available = 1;
                                else
                                        $Available = 0;
                                break;
                        case 8:
                        case 9:
                                $fiscalYear = date("Y");
                                $Quarter = 3;
                                break;
                }
        }

        switch ($Quarter){
                case 1:
                     $Ending = "Dec 31";
                     break;
                case 2:
                     $Ending = "Mar 31";
                     break;
                case 3:
                     $Ending = "Jun 30";
                     break;
                case 4:
                     $Ending = "Sep 30";
                     break;
         }

	$sqlCenter = "SELECT CenterName FROM centers ".
             "WHERE center = '".$centerID."'";
        $resultCenter = @mysql_query($sqlCenter) or mysql_error();
        $rowCenter = mysql_fetch_object($resultCenter);
        $CenterName = $rowCenter->CenterName;

	$page_title = 'ANCAC: Editing Quarter ending '.$Ending.' for '.$CenterName;
	require("./header.php");

?>

<body>
<table class='OutlineTable' align=center width="90%">
<tr>
	<td class='login-header' colspan='2' align=center><? echo $CenterName; ?> Editing Quarter ending <? echo $Ending; ?> - FY <? echo $fiscalYear; ?><br>
        </td>
</tr>
<tr>
	<td class='login' align=left>
	<center>
		<table border="0" width="100%" id="table1">
		<tr>
			<td>
			<form action="updateQuarter.php" method="post">
			<? //grab the budgeted information to display
			     $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,".
              "areaSchools,corpDonations,privDonations,fundraisers,bankInterest".
              " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
              "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
              "WHERE budgetedPerfStats.center = ".$centerID." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = ".$Quarter;

                             $result = @mysql_query($sql) or mysql_error();
                             $row1QBudgeted = mysql_fetch_object($result);

                         //grab the actual info if there is any
                              $sql = "SELECT fiTotal,fi0to6,fi7to12,fi13to18,fiMale,fiFemale,fiAfrAmerican,fiAsian,".
              "fiCauc,fiHispanic,fiOther,extForenEval,intCounsSes,totCounSes,multDisTeamMeet,prosCases,medExamRef,".
              "fullTimeEmp,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,".
              "areaSchools,corpDonations,privDonations,fundraisers,bankInterest,completed".
              " FROM actualPerfStats JOIN actualExpenditures ON actualPerfStats.center = actualExpenditures.center ".
              "AND actualPerfStats.fiscalyear = actualExpenditures.fiscalyear and actualPerfStats.quarter = actualExpenditures.quarter ".
              "JOIN actualSourceFunds ON actualPerfStats.center = actualSourceFunds.center ".
              "AND actualPerfStats.fiscalyear = actualSourceFunds.fiscalyear AND actualPerfStats.quarter = actualSourceFunds.quarter ".
              "WHERE actualPerfStats.center = ".$centerID." AND actualPerfStats.fiscalyear = ".$fiscalYear.
              " AND actualPerfStats.quarter = ".$Quarter;

                             $result = @mysql_query($sql) or mysql_error();
                             $row1QActual = mysql_fetch_object($result);
                             $Update = mysql_num_rows($result);

                             $ExpenseBud = array();
                             $ExpenseAct = array();
                        ?>

                <table width="100%" class="Admin">
                <?
	          if($_SESSION['admin'] > 1)
        	  {
        		echo '<tr><td colspan="3"><center>';
        		echo '<input type="checkbox" name="chkCompleteQuarter" value="yes" ';
                             if(isset($row1QActual->completed)) {if ($row1QActual->completed == "COM") echo 'CHECKED'; }
                        echo '/><b> Complete This Quarter?</b>';
        		echo '</center></td></tr>';
        
        	 }
                ?>
                <tr>
                        <td width="50%"><b>Performance Statistics</td>
                        <td colspan="2" align="center"><b>Current Quarter ending <? echo $Ending; ?></b></td>
                </tr>
                <tr align="center">
                        <td> </td>
                        <td width="25%"><b>Budgeted</b></td><td width="25%"><b>Actual</b></td>
                </tr>
                <tr align="center">
                        <td align="left">1) Number of children receiving an initial forensic interview at the CAC</td>
                        <td><? if(isset($row1QBudgeted->fiTotal)) echo $row1QBudgeted->fiTotal; ?></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fiTotal"
                                value="<? if(isset($row1QActual->fiTotal)){if ($row1QActual->fiTotal != -99) echo $row1QActual->fiTotal;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a) Age:&nbsp;&nbsp;0 - 6</td>
                        <td class="Disable"></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fi0to6"
                                value="<? if(isset($row1QActual->fi0to6)){if ($row1QActual->fi0to6 != -99) echo $row1QActual->fi0to6;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7 - 12</td>
                        <td class="Disable"></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fi7to12"
                                value="<? if(isset($row1QActual->fi7to12)){if ($row1QActual->fi7to12 != -99) echo $row1QActual->fi7to12;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13 - 18</td>
                        <td class="Disable"></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fi13to18"
                                value="<? if(isset($row1QActual->fi13to18)){if ($row1QActual->fi13to18 != -99) echo $row1QActual->fi13to18;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b) Gender:&nbsp;&nbsp;&nbsp;Male</td>
                        <td class="Disable"></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fiMale"
                                value="<? if(isset($row1QActual->fiMale)){if ($row1QActual->fiMale != -99) echo $row1QActual->fiMale;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Female</td>
                        <td class="Disable"></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fiFemale"
                                value="<? if(isset($row1QActual->fiFemale)){if ($row1QActual->fiFemale != -99) echo $row1QActual->fiFemale;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c) Race:&nbsp;&nbsp;&nbsp;African-American</td>
                        <td class="Disable"></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fiAfrAmerican"
                                value="<? if(isset($row1QActual->fiAfrAmerican)){if ($row1QActual->fiAfrAmerican != -99) echo $row1QActual->fiAfrAmerican;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Asian</td>
                        <td class="Disable"></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fiAsian"
                                value="<? if(isset($row1QActual->fiAsian)){if ($row1QActual->fiAsian != -99) echo $row1QActual->fiAsian;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Caucasian</td>
                        <td class="Disable"></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fiCauc"
                                value="<? if(isset($row1QActual->fiCauc)){if ($row1QActual->fiCauc != -99) echo $row1QActual->fiCauc;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hispanic</td>
                        <td class="Disable"></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fiHispanic"
                                value="<? if(isset($row1QActual->fiHispanic)){if ($row1QActual->fiHispanic != -99) echo $row1QActual->fiHispanic;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Other</td>
                        <td class="Disable"></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fiOther"
                                value="<? if(isset($row1QActual->fiOther)){if ($row1QActual->fiOther != -99) echo $row1QActual->fiOther;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">2) Number of children receiving <u>initial</u> extended forensic evaluations at the CAC</td>
                        <td><? if(isset($row1QBudgeted->extForenEval)) echo $row1QBudgeted->extForenEval; ?></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="extForenEval"
                                value="<? if(isset($row1QActual->extForenEval)){if ($row1QActual->extForenEval != -99) echo $row1QActual->extForenEval;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">3) Number of children receiving <u>initial</u> counseling sessions at the CAC</td>
                        <td><? if(isset($row1QBudgeted->intCounsSes)) echo $row1QBudgeted->intCounsSes; ?></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="intCounsSes"
                                value="<? if(isset($row1QActual->intCounsSes)){if ($row1QActual->intCounsSes != -99) echo $row1QActual->intCounsSes;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a) Total number of counseling sessions provided for child victims of abuse</td>
                        <td class="Disable"></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="totCounSes"
                                value="<? if(isset($row1QActual->totCounSes)){if ($row1QActual->totCounSes != -99) echo $row1QActual->totCounSes;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">4) Number of child abuse cases reviewed at the CAC multidisciplinary team meetings</td>
                        <td class="Disable"></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="multDisTeamMeet"
                                value="<? if(isset($row1QActual->multDisTeamMeet)){if ($row1QActual->multDisTeamMeet != -99) echo $row1QActual->multDisTeamMeet;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a) Number of cases referred for prosecution</td>
                        <td class="Disable"></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="prosCases"
                                value="<? if(isset($row1QActual->prosCases)){if ($row1QActual->prosCases != -99) echo $row1QActual->prosCases;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b) Number of children referred for medical exams</td>
                        <td class="Disable"></td>
                        <td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="medExamRef"
                                value="<? if(isset($row1QActual->medExamRef)){if ($row1QActual->medExamRef != -99) echo $row1QActual->medExamRef;} ?>" /></td>
                </tr>
                <tr>
                        <td colspan="3"><br></td>
                </tr>
                <tr>
                        <td><b>Quarterly Expenditures</td>
                        <td colspan="2" align="center"><b>Current Quarter ending <? echo $Ending; ?></b></td>
                </tr>
                <tr align="center">
                        <td> </td>
                        <td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>
                </tr>
                <tr align="center">
                        <td align="left">Number of full-time employees</td>
                        <td class="Disable"></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="fullTimeEmp"
                                value="<? if(isset($row1QActual->fullTimeEmp)){if ($row1QActual->fullTimeEmp != -99.99) echo $row1QActual->fullTimeEmp;} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Personnel Costs</td>
                        <td align="right"><? if(isset($row1QBudgeted->personnelCosts)){ echo number_format($row1QBudgeted->personnelCosts,2); $ExpenseBud[] = $row1QBudgeted->personnelCosts;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="personnelCosts"
                                value="<? if(isset($row1QActual->personnelCosts)){if ($row1QActual->personnelCosts != -99.99){ echo $row1QActual->personnelCosts; $ExpenseAct[] = $row1QActual->personnelCosts;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Employee Benefits</td>
                        <td align="right"><? if(isset($row1QBudgeted->empBenefits)){ echo number_format($row1QBudgeted->empBenefits,2); $ExpenseBud[] = $row1QBudgeted->empBenefits;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="empBenefits"
                                value="<? if(isset($row1QActual->empBenefits)){if ($row1QActual->empBenefits != -99.99){ echo $row1QActual->empBenefits; $ExpenseAct[] = $row1QActual->empBenefits;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Travel-In-State</td>
                        <td align="right"><? if(isset($row1QBudgeted->travelInState)){ echo number_format($row1QBudgeted->travelInState,2); $ExpenseBud[] = $row1QBudgeted->travelInState;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="travelInState"
                                value="<? if(isset($row1QActual->travelInState)){if ($row1QActual->travelInState != -99.99){ echo $row1QActual->travelInState; $ExpenseAct[] = $row1QActual->travelInState;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Travel-Out-of-State</td>
                        <td align="right"><? if(isset($row1QBudgeted->travelOutState)){ echo number_format($row1QBudgeted->travelOutState,2); $ExpenseBud[] = $row1QBudgeted->travelOutState;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="travelOutState"
                                value="<? if(isset($row1QActual->travelOutState)){if ($row1QActual->travelOutState != -99.99){ echo $row1QActual->travelOutState; $ExpenseAct[] = $row1QActual->travelOutState;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Repairs and Maintenance</td>
                        <td align="right"><? if(isset($row1QBudgeted->repairsAndMx)){ echo number_format($row1QBudgeted->repairsAndMx,2); $ExpenseBud[] = $row1QBudgeted->repairsAndMx;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="repairsAndMx"
                                value="<? if(isset($row1QActual->repairsAndMx)){if ($row1QActual->repairsAndMx != -99.99){ echo $row1QActual->repairsAndMx; $ExpenseAct[] = $row1QActual->repairsAndMx;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Rentals and Leases</td>
                        <td align="right"><? if(isset($row1QBudgeted->rentalsLease)){ echo number_format($row1QBudgeted->rentalsLease,2); $ExpenseBud[] = $row1QBudgeted->rentalsLease;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="rentalsLease"
                                value="<? if(isset($row1QActual->rentalsLease)){if ($row1QActual->rentalsLease != -99.99){ echo $row1QActual->rentalsLease; $ExpenseAct[] = $row1QActual->rentalsLease;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Utilities and Communications</td>
                        <td align="right"><? if(isset($row1QBudgeted->utilComm)){ echo number_format($row1QBudgeted->utilComm,2); $ExpenseBud[] = $row1QBudgeted->utilComm;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="utilComm"
                                value="<? if(isset($row1QActual->utilComm)){if ($row1QActual->utilComm != -99.99){ echo $row1QActual->utilComm; $ExpenseAct[] = $row1QActual->utilComm;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Professional Services</td>
                        <td align="right"><? if(isset($row1QBudgeted->profServ)){ echo number_format($row1QBudgeted->profServ,2); $ExpenseBud[] = $row1QBudgeted->profServ;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="profServ"
                                value="<? if(isset($row1QActual->profServ)){if ($row1QActual->profServ != -99.99){ echo $row1QActual->profServ; $ExpenseAct[] = $row1QActual->profServ;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Supplies, Materials, Operations</td>
                        <td align="right"><? if(isset($row1QBudgeted->suppMatOper)){ echo number_format($row1QBudgeted->suppMatOper,2); $ExpenseBud[] = $row1QBudgeted->suppMatOper;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="suppMatOper"
                                value="<? if(isset($row1QActual->suppMatOper)){if ($row1QActual->suppMatOper != -99.99){ echo $row1QActual->suppMatOper; $ExpenseAct[] = $row1QActual->suppMatOper;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Transportation Equip. Purchases</td>
                        <td align="right"><? if(isset($row1QBudgeted->tranEqpPurch)){ echo number_format($row1QBudgeted->tranEqpPurch,2); $ExpenseBud[] = $row1QBudgeted->tranEqpPurch;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="tranEqpPurch"
                                value="<? if(isset($row1QActual->tranEqpPurch)){if ($row1QActual->tranEqpPurch != -99.99){ echo $row1QActual->tranEqpPurch; $ExpenseAct[] = $row1QActual->tranEqpPurch;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Other Equipment Purchases</td>
                        <td align="right"><? if(isset($row1QBudgeted->otherEqpPurch)){ echo number_format($row1QBudgeted->otherEqpPurch,2); $ExpenseBud[] = $row1QBudgeted->otherEqpPurch;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="otherEqpPurch"
                                value="<? if(isset($row1QActual->otherEqpPurch)){if ($row1QActual->otherEqpPurch != -99.99){ echo $row1QActual->otherEqpPurch; $ExpenseAct[] = $row1QActual->otherEqpPurch;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Capital Outlay</td>
                        <td align="right"><? if(isset($row1QBudgeted->capOutlay)){ echo number_format($row1QBudgeted->capOutlay,2); $ExpenseBud[] = $row1QBudgeted->capOutlay;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="capOutlay"
                                value="<? if(isset($row1QActual->capOutlay)){if ($row1QActual->capOutlay != -99.99){ echo $row1QActual->capOutlay; $ExpenseAct[] = $row1QActual->capOutlay;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Debt Service</td>
                        <td align="right"><? if(isset($row1QBudgeted->debtService)){ echo number_format($row1QBudgeted->debtService,2); $ExpenseBud[] = $row1QBudgeted->debtService;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="debtService"
                                value="<? if(isset($row1QActual->debtService)){if ($row1QActual->debtService != -99.99){ echo $row1QActual->debtService; $ExpenseAct[] = $row1QActual->debtService;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Miscellaneous</td>
                        <td align="right"><? if(isset($row1QBudgeted->misc)){ echo number_format($row1QBudgeted->misc,2); $ExpenseBud[] = $row1QBudgeted->misc;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="misc"
                                value="<? if(isset($row1QActual->misc)){if ($row1QActual->misc != -99.99){ echo $row1QActual->misc; $ExpenseAct[] = $row1QActual->misc;}} ?>" /></td>
                </tr>
                <?
                        //check to see if they have any other Expense entered
                        $sqlOE = "SELECT OExpenseID, ExpenseName FROM otherExpenseLU WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ORDER BY OExpenseID";
                        $resultOE = @mysql_query($sqlOE) or mysql_error();

                        $numRecords = mysql_num_rows($resultOE);
                        if ($numRecords > 0){
                                while ($row = mysql_fetch_object($resultOE)) {
                                echo '<tr align="center"><td align="left">'.$row->ExpenseName.'</td>'.
                                        '<td align="right">';
                                        $sqlOEValues = "SELECT oeValue FROM budgetedOtherExpense WHERE center = ".$centerID." AND ".
                                                "fiscalyear = ".$fiscalYear." AND quarter = ".$Quarter." AND OExpenseID = ".$row->OExpenseID;
                                        $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                                        $rowOEValues = mysql_fetch_object($resultOEValues);
                                if(isset($rowOEValues->oeValue)){ echo number_format($rowOEValues->oeValue,2); $ExpenseBud[] = $rowOEValues->oeValue;}
                                echo '</td>'.
                                        '<td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);" onkeypress="return blockNonNumbers(this, event, true, false);"
                                        class="TextInput"  name="OE'.$row->OExpenseID.'" value="';
                                        $sqlOEValues = "SELECT oeValue FROM actualOtherExpense WHERE center = ".$centerID." AND ".
                                                "fiscalyear = ".$fiscalYear." AND quarter = ".$Quarter." AND OExpenseID = ".$row->OExpenseID;
                                        $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                                        $rowOEValues = mysql_fetch_object($resultOEValues);
                                        if(isset($rowOEValues->oeValue)){if ($rowOEValues->oeValue != -99.99){ echo $rowOEValues->oeValue; $ExpenseAct[] = $rowOEValues->oeValue;}}
                                echo '" /></td>';
                                '</tr>';
                                }
                        }
                ?>
                <!--
                <tr align="center">
                        <td align="center"><b>Total Expenditures</b></td>
                        <td align="right"><b><? $totExpendsBudget = 0;
                                foreach ($ExpenseBud as $floatFund){
                                        $totExpendsBudget = $totExpendsBudget + $floatFund;
                                }
                                echo number_format($totExpendsBudget, 2); ?></b></td>
                        <td><b><? $totExpendsActual = 0;
                                foreach ($ExpenseAct as $floatFund){
                                        $totExpendsActual = $totExpendsActual + $floatFund;
                                }
                                echo number_format($totExpendsActual, 2); ?></b></td>
                </tr>
                -->
                <tr><td colspan="13"><br></td></tr>
                <tr>
                        <td><b>Source of Funds</td>
                        <td colspan="2" align="center"><b>Current Quarter ending <? echo $Ending; ?></b></td>
                </tr>
                <tr align="center">
                        <td> </td>
                        <td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>
                </tr>
                <tr align="center">
                        <td align="left">State of AL General Fund</td>
                        <td align="right"><? if(isset($row1QBudgeted->genFund)){ echo number_format($row1QBudgeted->genFund,2); $FundsBud[] = $row1QBudgeted->genFund;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="genFund"
                                value="<? if(isset($row1QActual->genFund)){if ($row1QActual->genFund != -99.99){ echo $row1QActual->genFund; $FundsAct[] = $row1QActual->genFund;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">State of AL Children First Trust</td>
                        <td align="right"><? if(isset($row1QBudgeted->chilFirstTrust)){ echo number_format($row1QBudgeted->chilFirstTrust,2); $FundsBud[] = $row1QBudgeted->chilFirstTrust;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="chilFirstTrust"
                                value="<? if(isset($row1QActual->chilFirstTrust)){if ($row1QActual->chilFirstTrust != -99.99){ echo $row1QActual->chilFirstTrust; $FundsAct[] = $row1QActual->chilFirstTrust;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">United Way</td>
                        <td align="right"><? if(isset($row1QBudgeted->unitedWay)){ echo number_format($row1QBudgeted->unitedWay,2); $FundsBud[] = $row1QBudgeted->unitedWay;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="unitedWay"
                                value="<? if(isset($row1QActual->unitedWay)){if ($row1QActual->unitedWay != -99.99){ echo $row1QActual->unitedWay; $FundsAct[] = $row1QActual->unitedWay;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">ADECA</td>
                        <td align="right"><? if(isset($row1QBudgeted->adeca)){ echo number_format($row1QBudgeted->adeca,2); $FundsBud[] = $row1QBudgeted->adeca;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="adeca"
                                value="<? if(isset($row1QActual->adeca)){if ($row1QActual->adeca != -99.99){ echo $row1QActual->adeca; $FundsAct[] = $row1QActual->adeca;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">National Childrens Alliance</td>
                        <td align="right"><? if(isset($row1QBudgeted->natlChilAlliance)){ echo number_format($row1QBudgeted->natlChilAlliance,2); $FundsBud[] = $row1QBudgeted->natlChilAlliance;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="natlChilAlliance"
                                value="<? if(isset($row1QActual->natlChilAlliance)){if ($row1QActual->natlChilAlliance != -99.99){ echo $row1QActual->natlChilAlliance; $FundsAct[] = $row1QActual->natlChilAlliance;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Childrens Trust Fund</td>
                        <td align="right"><? if(isset($row1QBudgeted->chilTrustFund)){ echo number_format($row1QBudgeted->chilTrustFund,2); $FundsBud[] = $row1QBudgeted->chilTrustFund;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="chilTrustFund"
                                value="<? if(isset($row1QActual->chilTrustFund)){if ($row1QActual->chilTrustFund != -99.99){ echo $row1QActual->chilTrustFund; $FundsAct[] = $row1QActual->chilTrustFund;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Department of Human Resources</td>
                        <td align="right"><? if(isset($row1QBudgeted->deptOfHR)){ echo number_format($row1QBudgeted->deptOfHR,2); $FundsBud[] = $row1QBudgeted->deptOfHR;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="deptOfHR"
                                value="<? if(isset($row1QActual->deptOfHR)){if ($row1QActual->deptOfHR != -99.99){ echo $row1QActual->deptOfHR; $FundsAct[] = $row1QActual->deptOfHR;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">County Commissions</td>
                        <td align="right"><? if(isset($row1QBudgeted->countyComm)){ echo number_format($row1QBudgeted->countyComm,2); $FundsBud[] = $row1QBudgeted->countyComm;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="countyComm"
                                value="<? if(isset($row1QActual->countyComm)){if ($row1QActual->countyComm != -99.99){ echo $row1QActual->countyComm; $FundsAct[] = $row1QActual->countyComm;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">City Councils</td>
                        <td align="right"><? if(isset($row1QBudgeted->cityCouncil)){ echo number_format($row1QBudgeted->cityCouncil,2); $FundsBud[] = $row1QBudgeted->cityCouncil;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="cityCouncil"
                                value="<? if(isset($row1QActual->cityCouncil)){if ($row1QActual->cityCouncil != -99.99){ echo $row1QActual->cityCouncil; $FundsAct[] = $row1QActual->cityCouncil;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Local Grants</td>
                        <td align="right"><? if(isset($row1QBudgeted->localGrants)){ echo number_format($row1QBudgeted->localGrants,2); $FundsBud[] = $row1QBudgeted->localGrants;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="localGrants"
                                value="<? if(isset($row1QActual->localGrants)){if ($row1QActual->localGrants != -99.99){ echo $row1QActual->localGrants; $FundsAct[] = $row1QActual->localGrants;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Area Schools</td>
                        <td align="right"><? if(isset($row1QBudgeted->areaSchools)){ echo number_format($row1QBudgeted->areaSchools,2); $FundsBud[] = $row1QBudgeted->areaSchools;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="areaSchools"
                                value="<? if(isset($row1QActual->areaSchools)){if ($row1QActual->areaSchools != -99.99){ echo $row1QActual->areaSchools; $FundsAct[] = $row1QActual->areaSchools;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Corporate Donations</td>
                        <td align="right"><? if(isset($row1QBudgeted->corpDonations)){ echo number_format($row1QBudgeted->corpDonations,2); $FundsBud[] = $row1QBudgeted->corpDonations;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="corpDonations"
                                value="<? if(isset($row1QActual->corpDonations)){if ($row1QActual->corpDonations != -99.99){ echo $row1QActual->corpDonations; $FundsAct[] = $row1QActual->corpDonations;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Private Donations</td>
                        <td align="right"><? if(isset($row1QBudgeted->privDonations)){ echo number_format($row1QBudgeted->privDonations,2); $FundsBud[] = $row1QBudgeted->privDonations;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="privDonations"
                                value="<? if(isset($row1QActual->privDonations)){if ($row1QActual->privDonations != -99.99){ echo $row1QActual->privDonations; $FundsAct[] = $row1QActual->privDonations;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Fundraisers</td>
                        <td align="right"><? if(isset($row1QBudgeted->fundraisers)){ echo number_format($row1QBudgeted->fundraisers,2); $FundsBud[] = $row1QBudgeted->fundraisers;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="fundraisers"
                                value="<? if(isset($row1QActual->fundraisers)){if ($row1QActual->fundraisers != -99.99){ echo $row1QActual->fundraisers; $FundsAct[] = $row1QActual->fundraisers;}} ?>" /></td>
                </tr>
                <tr align="center">
                        <td align="left">Bank Interest</td>
                        <td align="right"><? if(isset($row1QBudgeted->bankInterest)){ echo number_format($row1QBudgeted->bankInterest,2); $FundsBud[] = $row1QBudgeted->bankInterest;} ?></td>
                        <td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);"
                                onkeypress="return blockNonNumbers(this, event, true, false);" class="TextInput" name="bankInterest"
                                value="<? if(isset($row1QActual->bankInterest)){if ($row1QActual->bankInterest != -99.99){ echo $row1QActual->bankInterest; $FundsAct[] = $row1QActual->bankInterest;}} ?>" /></td>
                </tr>
                <?
                        //check to see if they have any other incomes entered
                        $sqlOI = "SELECT OIncomeID, IncomeName FROM otherIncomeLU WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ORDER BY OIncomeID";
                        $resultOI = @mysql_query($sqlOI) or mysql_error();

                        $numRecords = mysql_num_rows($resultOI);
                        if ($numRecords > 0){
                                while ($row = mysql_fetch_object($resultOI)) {
                                echo '<tr align="center"><td align="left">'.$row->IncomeName.'</td>'.
                                        '<td align="right">';
                                        $sqlOIValues = "SELECT oiValue FROM budgetedOtherIncome WHERE center = ".$centerID." AND ".
                                                "fiscalyear = ".$fiscalYear." AND quarter = ".$Quarter." AND OIncomeID = ".$row->OIncomeID;
                                        $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                                        $rowOIValues = mysql_fetch_object($resultOIValues);
                                if(isset($rowOIValues->oiValue)){ echo number_format($rowOIValues->oiValue,2); $FundsBud[] = $rowOIValues->oiValue;}
                                echo '</td>'.
                                        '<td><input type="text" onblur="extractNumber(this,2,false);" onkeyup="extractNumber(this,2,false);" onkeypress="return blockNonNumbers(this, event, true, false);"
                                        class="TextInput"  name="OI'.$row->OIncomeID.'" value="';
                                        $sqlOIValues = "SELECT oiValue FROM actualOtherIncome WHERE center = ".$centerID." AND ".
                                                "fiscalyear = ".$fiscalYear." AND quarter = ".$Quarter." AND OIncomeID = ".$row->OIncomeID;
                                        $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                                        $rowOIValues = mysql_fetch_object($resultOIValues);
                                        if(isset($rowOIValues->oiValue)){if ($rowOIValues->oiValue != -99.99){ echo $rowOIValues->oiValue; $FundsAct[] = $rowOIValues->oiValue;}}
                                echo '" /></td>';
                                '</tr>';
                                }
                        }
                ?>
                <!--
                <tr align="center">
                        <td align="center"><b>Total Funds</b></td>
                        <td align="right"><b><? $totFundsBudget = 0;
                                foreach ($FundsBud as $floatFund){
                                        $totFundsBudget = $totFundsBudget + $floatFund;
                                }
                                echo number_format($totFundsBudget, 2); ?></b></td>
                        <td><b><? $totFundsActual = 0;
                                foreach ($FundsAct as $floatFund){
                                        $totFundsActual = $totFundsActual + $floatFund;
                                }
                                echo number_format($totFundsActual, 2); ?></b></td>
                </tr>
                -->
                </table>
                
                                <? if ($Available == 1){ if ($_SESSION['admin'] != 1) echo '<p><input type="submit" name="submit" value="Update Quarterly Report" /></p>';} ?>
                                <input type="hidden" name="centerID" value="<? echo $centerID; ?>" />
                                <input type="hidden" name="Quarter" value="<? echo $Quarter; ?>" />
                                <input type="hidden" name="fiscalYear" value="<? echo $fiscalYear; ?>" />
                                <input type="hidden" name="Update" value="<? echo $Update; ?>" />
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



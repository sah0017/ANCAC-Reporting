<?PHP
	require("ulogin.php");
	require($root."dbconn.php");
	
	require($root."Variables.php");

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
                     if (date("j") < $Quarter3Date)
                        $Available = 1;
                     else
                        $Available = 0;
                     break;
                case 8:
                case 9:
                     $fiscalYear = date("Y");
                     $currentQuarter = 3;
                     $Available = 0;
                     break;
         }

	$centerID = $_SESSION['center'];

	$error = 0;
        //Grab all the perf Stats, Expenditures, and Funds
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
              "WHERE actualPerfStats.center = ".$centerID." AND actualPerfStats.fiscalyear = ".$fiscalYear.
              " AND actualPerfStats.quarter = ".$currentQuarter;

        $result= @mysql_query($sql) or mysql_error();
        $row = mysql_fetch_object($result);

	$numRecords = mysql_num_rows($result);
        //if they have a row in the table
        if ($numRecords > 0){
                if ($row->fiTotal == -99) $error = 1;
                if ($row->fi0to6 == -99) $error = 1;
                if ($row->fi7to12 == -99) $error = 1;
                if ($row->fi13to18 == -99) $error = 1;
                if ($row->fiMale == -99) $error = 1;
                if ($row->fiFemale == -99) $error = 1;
                if ($row->fiAfrAmerican == -99) $error = 1;
                if ($row->fiAsian == -99) $error = 1;
                if ($row->fiCauc == -99) $error = 1;
                if ($row->fiHispanic == -99) $error = 1;
                if ($row->fiOther == -99) $error = 1;
                if ($row->extForenEval == -99) $error = 1;
                if ($row->intCounsSes == -99) $error = 1;
                if ($row->totCounSes == -99) $error = 1;
                if ($row->multDisTeamMeet == -99) $error = 1;
                if ($row->prosCases == -99) $error = 1;
                if ($row->medExamRef == -99) $error = 1;
                if ($row->fullTimeEmp == -99.99) $error = 1;
                if ($row->personnelCosts == -99.99) $error = 1;
                if ($row->empBenefits == -99.99) $error = 1;
                if ($row->travelInState == -99.99) $error = 1;
                if ($row->travelOutState == -99.99) $error = 1;
                if ($row->repairsAndMx == -99.99) $error = 1;
                if ($row->rentalsLease == -99.99) $error = 1;
                if ($row->utilComm == -99.99) $error = 1;
                if ($row->profServ == -99.99) $error = 1;
                if ($row->suppMatOper == -99.99) $error = 1;
                if ($row->tranEqpPurch == -99.99) $error = 1;
                if ($row->otherEqpPurch == -99.99) $error = 1;
                if ($row->debtService == -99.99) $error = 1;
                if ($row->misc == -99.99) $error = 1;
                if ($row->capOutlay == -99.99) $error = 1;
                if ($row->genFund == -99.99) $error = 1;
                if ($row->chilFirstTrust == -99.99) $error = 1;
                if ($row->unitedWay == -99.99) $error = 1;
                if ($row->adeca == -99.99) $error = 1;
                if ($row->natlChilAlliance == -99.99) $error = 1;
                if ($row->chilTrustFund == -99.99) $error = 1;
                if ($row->deptOfHR == -99.99) $error = 1;
                if ($row->countyComm == -99.99) $error = 1;
                if ($row->cityCouncil == -99.99) $error = 1;
                if ($row->localGrants == -99.99) $error = 1;
                if ($row->areaSchools == -99.99) $error = 1;
                if ($row->corpDonations == -99.99) $error = 1;
                if ($row->privDonations == -99.99) $error = 1;
                if ($row->fundraisers == -99.99) $error = 1;
                if ($row->bankInterest == -99.99) $error = 1;
        }
        else $error = 1;
        
        $sqlOE = "SELECT OExpenseID, ExpenseName FROM otherExpenseLU WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ORDER BY OExpenseID";
        $resultOE = @mysql_query($sqlOE) or mysql_error();

        $numOERecords = mysql_num_rows($resultOE);
        //if they have other expenses
        if ($numOERecords > 0){
                $sqlOECheck = "SELECT oeValue FROM actualOtherExpense WHERE center = ".$centerID." AND ".
                                                "fiscalyear = ".$fiscalYear." AND quarter = ".$currentQuarter;
                $resultOECheck = @mysql_query($sqlOECheck) or mysql_error();
                $numOECheck = mysql_num_rows($resultOECheck);
                //if they need to fill in some values.
                if ($numOERecords <> $numOECheck)
                        $error = 1;
                else{
                        while ($row = mysql_fetch_object($resultOE)) {

                                $sqlOEValues = "SELECT oeValue FROM actualOtherExpense WHERE center = ".$centerID." AND ".
                                        "fiscalyear = ".$fiscalYear." AND quarter = ".$currentQuarter." AND OExpenseID = ".$row->OExpenseID;
                                $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                                $rowOEValues = mysql_fetch_object($resultOEValues);

                                if ($rowOEValues->oeValue == -99.99) $error = 1;
                        }
                }
        }

        $sqlOI = "SELECT OIncomeID, IncomeName FROM otherIncomeLU WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ORDER BY OIncomeID";
        $resultOI = @mysql_query($sqlOI) or mysql_error();

        $numOIRecords = mysql_num_rows($resultOI);
        //if they have other incomes
        if ($numOIRecords > 0){
                $sqlOICheck = "SELECT oiValue FROM actualOtherIncome WHERE center = ".$centerID." AND ".
                                                "fiscalyear = ".$fiscalYear." AND quarter = ".$currentQuarter;
                $resultOICheck = @mysql_query($sqlOICheck) or mysql_error();
                $numOICheck = mysql_num_rows($resultOICheck);
                //if they need to fill in some values.
                if ($numOIRecords <> $numOICheck)
                        $error = 1;
                else{
                        while ($row = mysql_fetch_object($resultOI)) {

                                $sqlOIValues = "SELECT oiValue FROM actualOtherIncome WHERE center = ".$centerID." AND ".
                                        "fiscalyear = ".$fiscalYear." AND quarter = ".$currentQuarter." AND OIncomeID = ".$row->OIncomeID;
                                $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                                $rowOIValues = mysql_fetch_object($resultOIValues);

                                if ($rowOIValues->oiValue == -99.99) $error = 1;
                        }
                }
        }
        if ($_SESSION['admin'] == 1)
                header('Location: http://www.alabamacacs.org/ANCAC-Online/qreports.php');
        else{
                if (($_SESSION['admin'] == 2) || ($Available == 1)){
                        if ($error == 1)
                                echo '"<script>alert(\'Please make sure that all values have been filled in before submitted your Quarterly Report.\'); window.location.href = \'http://www.alabamacacs.org/ANCAC-Online/editQuarter.php\';</script>"';
                        else{
                                $sqlUpdate = "UPDATE actualExpenditures SET completed = 'COM', ".
                                        "username = '".$_SESSION['user']."', datemod = NOW() ".
                                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                                        "AND quarter = '".$currentQuarter."'";

                                $resultUpdate = @mysql_query($sqlUpdate);

                                header('Location: http://www.alabamacacs.org/ANCAC-Online/qreports.php');
                        }
                }
                else
                        header('Location: http://www.alabamacacs.org/ANCAC-Online/qreports.php');
        }                
?>
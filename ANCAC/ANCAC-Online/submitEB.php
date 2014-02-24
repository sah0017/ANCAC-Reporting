<?
	require("./ulogin.php");
	require("./dbconn.php");

        switch (date("m")){
                case 10:
                        if (date("j") < 11)
                                $Available = 1;
                        else
                                $Available = 0;
                        $fiscalYear = date("Y") + 1;
                        break;
                case 11:
                case 12:
                        $fiscalYear = date("Y") + 1;
                        $Available = 0;
                        break;
                case 1:
                case 2:
                case 3:
                        $fiscalYear = date("Y");
                        $Available = 0;
                        break;
                case 4:
                case 5:
                case 6:
                        $fiscalYear = date("Y");
                        $Available = 0;
                        break;
                case 7:
                case 8:
                case 9:
                        $fiscalYear = date("Y");
                        $Available = 0;
                        break;
        }

	$centerID = $_SESSION['center'];

	//Initialize the error variables
        $errMessage = '';
        $error = 0;

        //Check to make sure they have at least something in all of the boxes
        $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,".
              "areaSchools,corpDonations,privDonations,fundraisers,bankInterest".
              " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
              "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
              "WHERE budgetedPerfStats.center = ".$centerID." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 1";

         $result = @mysql_query($sql) or mysql_error();
         $row1QBudgeted = mysql_fetch_object($result);
         $Update1 = mysql_num_rows($result);

        $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,".
              "areaSchools,corpDonations,privDonations,fundraisers,bankInterest".
              " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
              "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
              "WHERE budgetedPerfStats.center = ".$centerID." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 2";

         $result = @mysql_query($sql) or mysql_error();
         $row2QBudgeted = mysql_fetch_object($result);
         $Update2 = mysql_num_rows($result);

         $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,".
              "areaSchools,corpDonations,privDonations,fundraisers,bankInterest".
              " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
              "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
              "WHERE budgetedPerfStats.center = ".$centerID." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 3";

         $result = @mysql_query($sql) or mysql_error();
         $row3QBudgeted = mysql_fetch_object($result);
         $Update3 = mysql_num_rows($result);

         $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,".
              "areaSchools,corpDonations,privDonations,fundraisers,bankInterest".
              " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
              "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
              "WHERE budgetedPerfStats.center = ".$centerID." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 4";

        $result = @mysql_query($sql) or mysql_error();
        $row4QBudgeted = mysql_fetch_object($result);
        $Update4 = mysql_num_rows($result);

        //Do they have a row for Quarter 1 and so on
        if ($Update1 == 0){
                $errMessage = $errMessage.'  *Complete Estimated Budget for Quarter 1\n';
                $error = 1;
        }        
        if ($Update2 == 0){
                $errMessage = $errMessage.'  *Complete Estimated Budget for Quarter 2\n';
                $error = 1;
        }
        if ($Update3 == 0){
                $errMessage = $errMessage.'  *Complete Estimated Budget for Quarter 3\n';
                $error = 1;
        }
        if ($Update4 == 0){
                $errMessage = $errMessage.'  *Complete Estimated Budget for Quarter 4\n';
                $error = 1;
        }

        if ($_SESSION['admin'] == 1)
                header('Location: http://www.alabamacacs.org./eoyreports.php?center='.$centerID);
        else{
                if (($_SESSION['admin'] == 2) || ($Available == 1)){
                        //No errors occurred
                        if ($error == 0){
                                $sqlUpdate = "UPDATE eoyChecks SET EstBudget = '1', ".
                                        "username = '".$_SESSION['user']."', datemod = NOW() ".
                                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."'";

                                $resultUpdate = @mysql_query($sqlUpdate);

                                header('Location: http://www.alabamacacs.org./eoyreports.php?center='.$centerID);
                        }
                        else{
                                echo '"<script>alert(\'To submit your Estimated Budget you must:\n\n'.$errMessage.'\'); window.location.href = \'http://www.alabamacacs.org./eoyreports.php?center='.$centerID.'\';</script>"';
                        }
                }
                else
                        header('Location: http://www.alabamacacs.org./eoyreports.php?center='.$centerID);
        }
?>
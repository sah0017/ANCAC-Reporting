<?PHP
	require("/ulogin.php");
	require("/dbconn.php");

	$centerID = $_POST['centerID'];
        $Quarter = $_POST['Quarter'];
        $fiscalYear = $_POST['fiscalYear'];
        $Update = $_POST['Update'];

        function set_Variable ($theValue, $theType) {
                if (is_numeric($theValue)) $returnValue = $theValue;
                else {
                  if ($theType == "float")
                        $returnValue = -99.99;
                  else
                        $returnValue = -99;
                }

                return $returnValue;
        }

        $fiTotal = set_Variable($_POST['fiTotal'], "int");
        $extForenEval = set_Variable($_POST['extForenEval'], "int");
        $intCounsSes = set_Variable($_POST['intCounsSes'], "int");
        $personnelCosts = set_Variable($_POST['personnelCosts'], "float");
        $empBenefits = set_Variable($_POST['empBenefits'], "float");
        $travelInState = set_Variable($_POST['travelInState'], "float");
        $travelOutState = set_Variable($_POST['travelOutState'], "float");
        $repairsAndMx = set_Variable($_POST['repairsAndMx'], "float");
        $rentalsLease = set_Variable($_POST['rentalsLease'], "float");
        $utilComm = set_Variable($_POST['utilComm'], "float");
        $profServ = set_Variable($_POST['profServ'], "float");
        $suppMatOper = set_Variable($_POST['suppMatOper'], "float");
        $tranEqpPurch = set_Variable($_POST['tranEqpPurch'], "float");
        $otherEqpPurch = set_Variable($_POST['otherEqpPurch'], "float");
        $capOutlay = set_Variable($_POST['capOutlay'], "float");
        $debtService = set_Variable($_POST['debtService'], "float");
        $misc = set_Variable($_POST['misc'], "float");
        $genFund = set_Variable($_POST['genFund'], "float");
        $chilFirstTrust = set_Variable($_POST['chilFirstTrust'], "float");
        $unitedWay = set_Variable($_POST['unitedWay'], "float");
        $adeca = set_Variable($_POST['adeca'], "float");
        $natlChilAlliance = set_Variable($_POST['natlChilAlliance'], "float");
        $chilTrustFund = set_Variable($_POST['chilTrustFund'], "float");
        $deptOfHR = set_Variable($_POST['deptOfHR'], "float");
        $countyComm = set_Variable($_POST['countyComm'], "float");
        $cityCouncil = set_Variable($_POST['cityCouncil'], "float");
        $localGrants = set_Variable($_POST['localGrants'], "float");
        $areaSchools = set_Variable($_POST['areaSchools'], "float");
        $corpDonations = set_Variable($_POST['corpDonations'], "float");
        $privDonations = set_Variable($_POST['privDonations'], "float");
        $fundraisers = set_Variable($_POST['fundraisers'], "float");
        $bankInterest = set_Variable($_POST['bankInterest'], "float");
        $fi0to6 = set_Variable($_POST['fi0to6'], "int");
        $fi7to12 = set_Variable($_POST['fi7to12'], "int");
        $fi13to18 = set_Variable($_POST['fi13to18'], "int");
        $fiMale = set_Variable($_POST['fiMale'], "int");
        $fiFemale = set_Variable($_POST['fiFemale'], "int");
        $fiAfrAmerican = set_Variable($_POST['fiAfrAmerican'], "int");
        $fiAsian = set_Variable($_POST['fiAsian'], "int");
        $fiCauc = set_Variable($_POST['fiCauc'], "int");
        $fiHispanic = set_Variable($_POST['fiHispanic'], "int");
        $fiOther = set_Variable($_POST['fiOther'], "int");
        $totCounSes = set_Variable($_POST['totCounSes'], "int");
        $multDisTeamMeet = set_Variable($_POST['multDisTeamMeet'], "int");
        $prosCases = set_Variable($_POST['prosCases'], "int");
        $medExamRef = set_Variable($_POST['medExamRef'], "int");
        $fullTimeEmp = set_Variable($_POST['fullTimeEmp'], "float");
        
        if ($_POST['chkCompleteQuarter'] == 'yes') $CompleteQuarter = 1;
           else $CompleteQuarter = 0;

        if ($Update == 1){//update
                $sqlExecute = "UPDATE actualExpenditures SET fullTimeEmp = '".$fullTimeEmp."', personnelCosts = '".$personnelCosts."', ".
                        "empBenefits = '".$empBenefits."', travelInState = '".$travelInState."', travelOutState = '".$travelOutState."', ".
                        "repairsAndMx = '".$repairsAndMx."', rentalsLease = '".$rentalsLease."', utilComm = '".$utilComm."', ".
                        "profServ = '".$profServ."', suppMatOper = '".$suppMatOper."', tranEqpPurch = '".$tranEqpPurch."', ".
                        "otherEqpPurch = '".$otherEqpPurch."', debtService = '".$debtService."', misc = '".$misc."', ".
                        "username = '".$_SESSION['user']."', datemod = NOW(), capOutlay = '".$capOutlay."' ".
                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                        "AND quarter = '".$Quarter."'";

                //update the actualExpenditures table
                $resultExecute = @mysql_query($sqlExecute);
                
                if($_SESSION['admin'] > 1)
                {
                        if($CompleteQuarter == 1){
                             $sqlExecute = "UPDATE actualExpenditures SET completed = 'COM' ".
                                         "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                                         "AND quarter = '".$Quarter."'"; }
                        else {
                             $sqlExecute = "UPDATE actualExpenditures SET completed = 'INC' ".
                                         "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                                         "AND quarter = '".$Quarter."'"; }
                                         
                        $resultExecute = @mysql_query($sqlExecute);
                }

                $sqlExecute = "UPDATE actualPerfStats SET fiTotal = '".$fiTotal."', fi0to6 = '".$fi0to6."', ".
                        "fi7to12 = '".$fi7to12."', fi13to18 = '".$fi13to18."', fiMale = '".$fiMale."', ".
                        "fiFemale = '".$fiFemale."', fiAfrAmerican = '".$fiAfrAmerican."', fiAsian = '".$fiAsian."', ".
                        "fiCauc = '".$fiCauc."', fiHispanic = '".$fiHispanic."', fiOther = '".$fiOther."', ".
                        "extForenEval = '".$extForenEval."', intCounsSes = '".$intCounsSes."', multDisTeamMeet = '".$multDisTeamMeet."', ".
                        "prosCases = '".$prosCases."', medExamRef = '".$medExamRef."', ".
                        "username = '".$_SESSION['user']."', datemod = NOW(), totCounSes = '".$totCounSes."' ".
                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                        "AND quarter = '".$Quarter."'";

                //update the actualPerfStats table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "UPDATE actualSourceFunds SET genFund = '".$genFund."', chilFirstTrust = '".$chilFirstTrust."', ".
                        "username = '".$_SESSION['user']."', datemod = NOW(), unitedWay = '".$unitedWay."', ".
                        "adeca = '".$adeca."', natlChilAlliance = '".$natlChilAlliance."', chilTrustFund = '".$chilTrustFund."', ".
                        "deptOfHR = '".$deptOfHR."', countyComm = '".$countyComm."', cityCouncil = '".$cityCouncil."', ".
                        "localGrants = '".$localGrants."', areaSchools = '".$areaSchools."', corpDonations = '".$corpDonations."', ".
                        "privDonations = '".$privDonations."', fundraisers = '".$fundraisers."', bankInterest = '".$bankInterest."' ".
                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                        "AND quarter = '".$Quarter."'";

                //update the actualSourceFunds table
                $resultExecute = @mysql_query($sqlExecute);
        }//insert
        else{
                $sqlExecute = "INSERT INTO `actualExpenditures` ( `center` , `fiscalyear` , `quarter` , `completed` , `username` , ".
                        "`datemod` , `fullTimeEmp` , `personnelCosts` , `empBenefits` , `travelInState` , ".
                        "`travelOutState` , `repairsAndMx` , `rentalsLease` , `utilComm` , `profServ` , ".
                        "`suppMatOper` , `tranEqpPurch` , `otherEqpPurch` , `capOutlay` , `debtService` , `misc` ) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '".$Quarter."', 'INC', '".$_SESSION['user']."', ".
                        "NOW(), '".$fullTimeEmp."', '".$personnelCosts."', '".$empBenefits."', '".$travelInState."', ".
                        "'".$travelOutState."', '".$repairsAndMx."', '".$rentalsLease."', '".$utilComm."', '".$profServ."', ".
                        "'".$suppMatOper."', '".$tranEqpPurch."', '".$otherEqpPurch."', '".$capOutlay."', '".$debtService."', '".$misc."')";

                //insert into the actualExpenditures table
                $resultExecute = @mysql_query($sqlExecute);
                
                if($_SESSION['admin'] > 1)
                {
                        if($CompleteQuarter == 1){
                             $sqlExecute = "UPDATE actualExpenditures SET completed = 'COM' ".
                                         "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                                         "AND quarter = '".$Quarter."'"; }
                        else {
                             $sqlExecute = "UPDATE actualExpenditures SET completed = 'INC' ".
                                         "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                                         "AND quarter = '".$Quarter."'"; }
                                         
                        $resultExecute = @mysql_query($sqlExecute);
                }

                //if ($resultExecute){
                //        echo '<br>Your actual expenditures was inserted successfully.';
                //}
                //else {
                //        echo 'Your actual expenditures could not be inserted';
                //        echo '<p>'.mysql_error().'<br><br>Query: '.$sqlInsert.'</p>';
                //}

                $sqlExecute = "INSERT INTO `actualPerfStats` ( `center` , `fiscalyear` , `quarter` , `username` , ".
                        "`datemod` , `fiTotal` , `fi0to6` , `fi7to12` , `fi13to18` , ".
                        "`fiMale` , `fiFemale` , `fiAfrAmerican` , `fiAsian` , `fiCauc` , ".
                        "`fiHispanic` , `fiOther` , `extForenEval` , `intCounsSes` , `totCounSes` , `multDisTeamMeet` , ".
                        "`prosCases` , `medExamRef`  ) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '".$Quarter."', '".$_SESSION['user']."', ".
                        "NOW(), '".$fiTotal."', '".$fi0to6."', '".$fi7to12."', '".$fi13to18."', ".
                        "'".$fiMale."', '".$fiFemale."', '".$fiAfrAmerican."', '".$fiAsian."', '".$fiCauc."', ".
                        "'".$fiHispanic."', '".$fiOther."', '".$extForenEval."', '".$intCounsSes."', '".$totCounSes."', '".$multDisTeamMeet."', ".
                        "'".$prosCases."', '".$medExamRef."')";

                //insert into the actualPerfStats table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "INSERT INTO `actualSourceFunds` ( `center` , `fiscalyear` , `quarter` , `username` , ".
                        "`datemod` , `genFund` , `chilFirstTrust` , `unitedWay` , `adeca` , `natlChilAlliance` , `chilTrustFund` , ".
                        "`deptOfHR` , `countyComm` , `cityCouncil` , `localGrants` , `areaSchools` , `corpDonations` , `privDonations` , ".
                        " `fundraisers` , `bankInterest` ) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '".$Quarter."', '".$_SESSION['user']."', ".
                        "NOW(), '".$genFund."', '".$chilFirstTrust."', '".$unitedWay."', '".$adeca."', ".
                        "'".$natlChilAlliance."', '".$chilTrustFund."', '".$deptOfHR."', '".$countyComm."', '".$cityCouncil."', '".$localGrants."', ".
                        "'".$areaSchools."', '".$corpDonations."', '".$privDonations."', '".$fundraisers."', '".$bankInterest."')";

                //insert into the actualSourceFunds table
                $resultExecute = @mysql_query($sqlExecute);
        }
        
        //Now update the OtherExpense stuff
        $sqlOE = "SELECT OExpenseID FROM otherExpenseLU WHERE center = '".$centerID."' and fiscalyear = '".$fiscalYear."'";
        $resultOE = @mysql_query($sqlOE) or mysql_error();

        $numRecords = mysql_num_rows($resultOE);

        if ($numRecords > 0){
              while ($row = mysql_fetch_object($resultOE)) {
                //Actual
                $oeInputBox = "OE".$row->OExpenseID;
                $oePostValue = set_Variable($_POST[$oeInputBox], "float");

                //update
                if ($Update == 1){
                        $sqlExecute = "UPDATE actualOtherExpense SET oeValue = '".$oePostValue."' ".
                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                        "AND quarter = '".$Quarter."' AND OExpenseID = '".$row->OExpenseID."'";
                }
                //insert
                else{
                        $sqlExecute = "INSERT INTO `actualOtherExpense` ( `center` , `fiscalyear` , `quarter` , `OExpenseID` , `oeValue` ) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '".$Quarter."', '".$row->OExpenseID."', '".$oePostValue."')";
                }
                //Run the Executed statement to insert the Other Expense
                $resultExecute = @mysql_query($sqlExecute);
              }
        }//END of the IF for Other Expense

        //Now update the OtherIncome stuff
        $sqlOI = "SELECT OIncomeID FROM otherIncomeLU WHERE center = '".$centerID."' and fiscalyear = '".$fiscalYear."'";
        $resultOI = @mysql_query($sqlOI) or mysql_error();

        $numRecords = mysql_num_rows($resultOI);

        if ($numRecords > 0){
              while ($row = mysql_fetch_object($resultOI)) {
                //Actual
                $oiInputBox = "OI".$row->OIncomeID;
                $oiPostValue = set_Variable($_POST[$oiInputBox], "float");

                //update
                if ($Update == 1){
                        $sqlExecute = "UPDATE actualOtherIncome SET oiValue = '".$oiPostValue."' ".
                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                        "AND quarter = '".$Quarter."' AND OIncomeID = '".$row->OIncomeID."'";
                }
                //insert
                else{
                        $sqlExecute = "INSERT INTO `actualOtherIncome` ( `center` , `fiscalyear` , `quarter` , `OIncomeID` , `oiValue` ) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '".$Quarter."', '".$row->OIncomeID."', '".$oiPostValue."')";
                }
                //Run the Executed statement to insert the Other Income
                $resultExecute = @mysql_query($sqlExecute);
              }
        }//END of the IF for Other Income

        if($_SESSION['admin'] > 0)
	{
		header('Location: http://www.alabamacacs.org/ANCAC-Online/centerReportAdmin.php?center='.$centerID.'&year='.$fiscalYear);
	}
	else
	{
                header('Location: http://www.alabamacacs.org/ANCAC-Online/qreports.php');
        }
?>
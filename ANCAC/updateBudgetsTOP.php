<?php
	require("./ulogin.php");
	require("./dbconn.php");

	$centerID = $_POST['centerID'];
        $fiscalYear = $_POST['fiscalYear'];
        $Update1 = $_POST['Update1'];
        $Update2 = $_POST['Update2'];
        $Update3 = $_POST['Update3'];
        $Update4 = $_POST['Update4'];
        $CY = $_POST['CY'];

        function set_Variable ($theValue) {
                if (is_numeric($theValue)) $returnValue = $theValue;
                else $returnValue = 0;

                return $returnValue;
        }

        $fiTotal = set_Variable($_POST['fiTotal1']);
        $extForenEval = set_Variable($_POST['extForenEval1']);
        $intCounsSes = set_Variable($_POST['intCounsSes1']);
        $personnelCosts = set_Variable($_POST['personnelCosts1']);
        $empBenefits = set_Variable($_POST['empBenefits1']);
        $travelInState = set_Variable($_POST['travelInState1']);
        $travelOutState = set_Variable($_POST['travelOutState1']);
        $repairsAndMx = set_Variable($_POST['repairsAndMx1']);
        $rentalsLease = set_Variable($_POST['rentalsLease1']);
        $utilComm = set_Variable($_POST['utilComm1']);
        $profServ = set_Variable($_POST['profServ1']);
        $suppMatOper = set_Variable($_POST['suppMatOper1']);
        $tranEqpPurch = set_Variable($_POST['tranEqpPurch1']);
        $otherEqpPurch = set_Variable($_POST['otherEqpPurch1']);
        $debtService = set_Variable($_POST['debtService1']);
        $misc = set_Variable($_POST['misc1']);
        $genFund = set_Variable($_POST['genFund1']);
        $chilFirstTrust = set_Variable($_POST['chilFirstTrust1']);
        $capOutlay = set_Variable($_POST['capOutlay1']);
        $unitedWay = set_Variable($_POST['unitedWay1']);
        $adeca = set_Variable($_POST['adeca1']);
        $natlChilAlliance = set_Variable($_POST['natlChilAlliance1']);
        $chilTrustFund = set_Variable($_POST['chilTrustFund1']);
        $deptOfHR = set_Variable($_POST['deptOfHR1']);
        $countyComm = set_Variable($_POST['countyComm1']);
        $cityCouncil = set_Variable($_POST['cityCouncil1']);
        $localGrants = set_Variable($_POST['localGrants1']);
        $areaSchools = set_Variable($_POST['areaSchools1']);
        $corpDonations = set_Variable($_POST['corpDonations1']);
        $privDonations = set_Variable($_POST['privDonations1']);
        $fundraisers = set_Variable($_POST['fundraisers1']);
        $bankInterest = set_Variable($_POST['bankInterest1']);

        if ($Update1 == 1){//update
                $sqlExecute = "UPDATE budgetedExpenditures SET personnelCosts = '".$personnelCosts."', ".
                        "empBenefits = '".$empBenefits."', travelInState = '".$travelInState."', travelOutState = '".$travelOutState."', ".
                        "repairsAndMx = '".$repairsAndMx."', rentalsLease = '".$rentalsLease."', utilComm = '".$utilComm."', ".
                        "profServ = '".$profServ."', suppMatOper = '".$suppMatOper."', tranEqpPurch = '".$tranEqpPurch."', ".
                        "otherEqpPurch = '".$otherEqpPurch."', debtService = '".$debtService."', misc = '".$misc."', ".
                        "username = '".$_SESSION['user']."', capOutlay = '".$capOutlay."', datemod = NOW() ".
                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                        "AND quarter = 1";

                //update the budgetedExpenditures table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "UPDATE budgetedPerfStats SET fiTotal = '".$fiTotal."', ".
                        "extForenEval = '".$extForenEval."', intCounsSes = '".$intCounsSes."', ".
                        "username = '".$_SESSION['user']."', datemod = NOW() ".
                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                        "AND quarter = 1";

                //update the budgetedPerfStats table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "UPDATE budgetedSourceFunds SET genFund = '".$genFund."', chilFirstTrust = '".$chilFirstTrust."', ".
                        "unitedWay = '".$unitedWay."', adeca = '".$adeca."', natlChilAlliance = '".$natlChilAlliance."', ".
                        "chilTrustFund = '".$chilTrustFund."', deptOfHR = '".$deptOfHR."', countyComm = '".$countyComm."', ".
                        "cityCouncil = '".$cityCouncil."', localGrants = '".$localGrants."', areaSchools = '".$areaSchools."', ".
                        "corpDonations = '".$corpDonations."', privDonations = '".$privDonations."', fundraisers = '".$fundraisers."', ".
                        "bankInterest = '".$bankInterest."',username = '".$_SESSION['user']."', datemod = NOW() ".
                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                        "AND quarter = 1";

                //update the budgetedSourceFunds table
                $resultExecute = @mysql_query($sqlExecute);
        }//insert
        else{
                $sqlExecute = "INSERT INTO `budgetedExpenditures` ( `center` , `fiscalyear` , `quarter` , `username` , ".
                        "`datemod` , `personnelCosts` , `empBenefits` , `travelInState` , ".
                        "`travelOutState` , `repairsAndMx` , `rentalsLease` , `utilComm` , `profServ` , ".
                        "`suppMatOper` , `tranEqpPurch` , `otherEqpPurch` , `capOutlay` , `debtService` , `misc` ) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '1', '".$_SESSION['user']."', ".
                        "NOW(), '".$personnelCosts."', '".$empBenefits."', '".$travelInState."', ".
                        "'".$travelOutState."', '".$repairsAndMx."', '".$rentalsLease."', '".$utilComm."', '".$profServ."', ".
                        "'".$suppMatOper."', '".$tranEqpPurch."', '".$otherEqpPurch."', '".$capOutlay."', '".$debtService."', '".$misc."')";

                //insert into the budgetedExpenditures table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "INSERT INTO `budgetedPerfStats` ( `center` , `fiscalyear` , `quarter` , `username` , ".
                        "`datemod` , `fiTotal` , `extForenEval` , `intCounsSes`  ) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '1', '".$_SESSION['user']."', ".
                        "NOW(), '".$fiTotal."', '".$extForenEval."', '".$intCounsSes."')";

                //insert into the budgetedPerfStats table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "INSERT INTO `budgetedSourceFunds` ( `center` , `fiscalyear` , `quarter` , `username` , ".
                        "`datemod` , `genFund` , `chilFirstTrust` , `unitedWay` , `adeca` , `natlChilAlliance` , `chilTrustFund` , ".
                        "`deptOfHR` , `countyComm` , `cityCouncil` , `localGrants` , `areaSchools` , `corpDonations` , `privDonations` , ".
                        "`fundraisers` , `bankInterest` ) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '1', '".$_SESSION['user']."', ".
                        "NOW(), '".$genFund."', '".$chilFirstTrust."', '".$unitedWay."', '".$adeca."', ".
                        "'".$natlChilAlliance."', '".$chilTrustFund."', '".$deptOfHR."', '".$countyComm."', ".
                        "'".$cityCouncil."', '".$localGrants."', '".$areaSchools."', '".$corpDonations."', ".
                        "'".$privDonations."', '".$fundraisers."', '".$bankInterest."')";

                //insert into the budgetedSourceFunds table
                $resultExecute = @mysql_query($sqlExecute);
        }

        $fiTotal = set_Variable($_POST['fiTotal2']);
        $extForenEval = set_Variable($_POST['extForenEval2']);
        $intCounsSes = set_Variable($_POST['intCounsSes2']);
        $personnelCosts = set_Variable($_POST['personnelCosts2']);
        $empBenefits = set_Variable($_POST['empBenefits2']);
        $travelInState = set_Variable($_POST['travelInState2']);
        $travelOutState = set_Variable($_POST['travelOutState2']);
        $repairsAndMx = set_Variable($_POST['repairsAndMx2']);
        $rentalsLease = set_Variable($_POST['rentalsLease2']);
        $utilComm = set_Variable($_POST['utilComm2']);
        $profServ = set_Variable($_POST['profServ2']);
        $suppMatOper = set_Variable($_POST['suppMatOper2']);
        $tranEqpPurch = set_Variable($_POST['tranEqpPurch2']);
        $otherEqpPurch = set_Variable($_POST['otherEqpPurch2']);
        $debtService = set_Variable($_POST['debtService2']);
        $misc = set_Variable($_POST['misc2']);
        $genFund = set_Variable($_POST['genFund2']);
        $chilFirstTrust = set_Variable($_POST['chilFirstTrust2']);
        $capOutlay = set_Variable($_POST['capOutlay2']);
        $unitedWay = set_Variable($_POST['unitedWay2']);
        $adeca = set_Variable($_POST['adeca2']);
        $natlChilAlliance = set_Variable($_POST['natlChilAlliance2']);
        $chilTrustFund = set_Variable($_POST['chilTrustFund2']);
        $deptOfHR = set_Variable($_POST['deptOfHR2']);
        $countyComm = set_Variable($_POST['countyComm2']);
        $cityCouncil = set_Variable($_POST['cityCouncil2']);
        $localGrants = set_Variable($_POST['localGrants2']);
        $areaSchools = set_Variable($_POST['areaSchools2']);
        $corpDonations = set_Variable($_POST['corpDonations2']);
        $privDonations = set_Variable($_POST['privDonations2']);
        $fundraisers = set_Variable($_POST['fundraisers2']);
        $bankInterest = set_Variable($_POST['bankInterest2']);

        if ($Update2 == 1){//update
                $sqlExecute = "UPDATE budgetedExpenditures SET personnelCosts = '".$personnelCosts."', ".
                        "empBenefits = '".$empBenefits."', travelInState = '".$travelInState."', travelOutState = '".$travelOutState."', ".
                        "repairsAndMx = '".$repairsAndMx."', rentalsLease = '".$rentalsLease."', utilComm = '".$utilComm."', ".
                        "profServ = '".$profServ."', suppMatOper = '".$suppMatOper."', tranEqpPurch = '".$tranEqpPurch."', ".
                        "otherEqpPurch = '".$otherEqpPurch."', debtService = '".$debtService."', misc = '".$misc."', ".
                        "username = '".$_SESSION['user']."', capOutlay = '".$capOutlay."', datemod = NOW() ".
                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                        "AND quarter = 2";

                //update the budgetedExpenditures table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "UPDATE budgetedPerfStats SET fiTotal = '".$fiTotal."', ".
                        "extForenEval = '".$extForenEval."', intCounsSes = '".$intCounsSes."', ".
                        "username = '".$_SESSION['user']."', datemod = NOW() ".
                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                        "AND quarter = 2";

                //update the budgetedPerfStats table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "UPDATE budgetedSourceFunds SET genFund = '".$genFund."', chilFirstTrust = '".$chilFirstTrust."', ".
                        "unitedWay = '".$unitedWay."', adeca = '".$adeca."', natlChilAlliance = '".$natlChilAlliance."', ".
                        "chilTrustFund = '".$chilTrustFund."', deptOfHR = '".$deptOfHR."', countyComm = '".$countyComm."', ".
                        "cityCouncil = '".$cityCouncil."', localGrants = '".$localGrants."', areaSchools = '".$areaSchools."', ".
                        "corpDonations = '".$corpDonations."', privDonations = '".$privDonations."', fundraisers = '".$fundraisers."', ".
                        "bankInterest = '".$bankInterest."',username = '".$_SESSION['user']."', datemod = NOW() ".
                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                        "AND quarter = 2";

                //update the budgetedSourceFunds table
                $resultExecute = @mysql_query($sqlExecute);
        }//insert
        else{
                $sqlExecute = "INSERT INTO `budgetedExpenditures` ( `center` , `fiscalyear` , `quarter` , `username` , ".
                        "`datemod` , `personnelCosts` , `empBenefits` , `travelInState` , ".
                        "`travelOutState` , `repairsAndMx` , `rentalsLease` , `utilComm` , `profServ` , ".
                        "`suppMatOper` , `tranEqpPurch` , `otherEqpPurch` , `capOutlay` , `debtService` , `misc` ) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '2', '".$_SESSION['user']."', ".
                        "NOW(), '".$personnelCosts."', '".$empBenefits."', '".$travelInState."', ".
                        "'".$travelOutState."', '".$repairsAndMx."', '".$rentalsLease."', '".$utilComm."', '".$profServ."', ".
                        "'".$suppMatOper."', '".$tranEqpPurch."', '".$otherEqpPurch."', '".$capOutlay."', '".$debtService."', '".$misc."')";

                //insert into the budgetedExpenditures table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "INSERT INTO `budgetedPerfStats` ( `center` , `fiscalyear` , `quarter` , `username` , ".
                        "`datemod` , `fiTotal` , `extForenEval` , `intCounsSes`  ) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '2', '".$_SESSION['user']."', ".
                        "NOW(), '".$fiTotal."', '".$extForenEval."', '".$intCounsSes."')";

                //insert into the budgetedPerfStats table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "INSERT INTO `budgetedSourceFunds` ( `center` , `fiscalyear` , `quarter` , `username` , ".
                        "`datemod` , `genFund` , `chilFirstTrust` , `unitedWay` , `adeca` , `natlChilAlliance` , `chilTrustFund` , ".
                        "`deptOfHR` , `countyComm` , `cityCouncil` , `localGrants` , `areaSchools` , `corpDonations` , `privDonations` , ".
                        "`fundraisers` , `bankInterest` ) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '2', '".$_SESSION['user']."', ".
                        "NOW(), '".$genFund."', '".$chilFirstTrust."', '".$unitedWay."', '".$adeca."', ".
                        "'".$natlChilAlliance."', '".$chilTrustFund."', '".$deptOfHR."', '".$countyComm."', ".
                        "'".$cityCouncil."', '".$localGrants."', '".$areaSchools."', '".$corpDonations."', ".
                        "'".$privDonations."', '".$fundraisers."', '".$bankInterest."')";

                //insert into the budgetedSourceFunds table
                $resultExecute = @mysql_query($sqlExecute);
        }

        $fiTotal = set_Variable($_POST['fiTotal3']);
        $extForenEval = set_Variable($_POST['extForenEval3']);
        $intCounsSes = set_Variable($_POST['intCounsSes3']);
        $personnelCosts = set_Variable($_POST['personnelCosts3']);
        $empBenefits = set_Variable($_POST['empBenefits3']);
        $travelInState = set_Variable($_POST['travelInState3']);
        $travelOutState = set_Variable($_POST['travelOutState3']);
        $repairsAndMx = set_Variable($_POST['repairsAndMx3']);
        $rentalsLease = set_Variable($_POST['rentalsLease3']);
        $utilComm = set_Variable($_POST['utilComm3']);
        $profServ = set_Variable($_POST['profServ3']);
        $suppMatOper = set_Variable($_POST['suppMatOper3']);
        $tranEqpPurch = set_Variable($_POST['tranEqpPurch3']);
        $otherEqpPurch = set_Variable($_POST['otherEqpPurch3']);
        $debtService = set_Variable($_POST['debtService3']);
        $misc = set_Variable($_POST['misc3']);
        $genFund = set_Variable($_POST['genFund3']);
        $chilFirstTrust = set_Variable($_POST['chilFirstTrust3']);
        $capOutlay = set_Variable($_POST['capOutlay3']);
        $unitedWay = set_Variable($_POST['unitedWay3']);
        $adeca = set_Variable($_POST['adeca3']);
        $natlChilAlliance = set_Variable($_POST['natlChilAlliance3']);
        $chilTrustFund = set_Variable($_POST['chilTrustFund3']);
        $deptOfHR = set_Variable($_POST['deptOfHR3']);
        $countyComm = set_Variable($_POST['countyComm3']);
        $cityCouncil = set_Variable($_POST['cityCouncil3']);
        $localGrants = set_Variable($_POST['localGrants3']);
        $areaSchools = set_Variable($_POST['areaSchools3']);
        $corpDonations = set_Variable($_POST['corpDonations3']);
        $privDonations = set_Variable($_POST['privDonations3']);
        $fundraisers = set_Variable($_POST['fundraisers3']);
        $bankInterest = set_Variable($_POST['bankInterest3']);

        if ($Update3 == 1){//update
                $sqlExecute = "UPDATE budgetedExpenditures SET personnelCosts = '".$personnelCosts."', ".
                        "empBenefits = '".$empBenefits."', travelInState = '".$travelInState."', travelOutState = '".$travelOutState."', ".
                        "repairsAndMx = '".$repairsAndMx."', rentalsLease = '".$rentalsLease."', utilComm = '".$utilComm."', ".
                        "profServ = '".$profServ."', suppMatOper = '".$suppMatOper."', tranEqpPurch = '".$tranEqpPurch."', ".
                        "otherEqpPurch = '".$otherEqpPurch."', debtService = '".$debtService."', misc = '".$misc."', ".
                        "username = '".$_SESSION['user']."', capOutlay = '".$capOutlay."', datemod = NOW() ".
                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                        "AND quarter = 3";

                //update the budgetedExpenditures table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "UPDATE budgetedPerfStats SET fiTotal = '".$fiTotal."', ".
                        "extForenEval = '".$extForenEval."', intCounsSes = '".$intCounsSes."', ".
                        "username = '".$_SESSION['user']."', datemod = NOW() ".
                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                        "AND quarter = 3";

                //update the budgetedPerfStats table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "UPDATE budgetedSourceFunds SET genFund = '".$genFund."', chilFirstTrust = '".$chilFirstTrust."', ".
                        "unitedWay = '".$unitedWay."', adeca = '".$adeca."', natlChilAlliance = '".$natlChilAlliance."', ".
                        "chilTrustFund = '".$chilTrustFund."', deptOfHR = '".$deptOfHR."', countyComm = '".$countyComm."', ".
                        "cityCouncil = '".$cityCouncil."', localGrants = '".$localGrants."', areaSchools = '".$areaSchools."', ".
                        "corpDonations = '".$corpDonations."', privDonations = '".$privDonations."', fundraisers = '".$fundraisers."', ".
                        "bankInterest = '".$bankInterest."',username = '".$_SESSION['user']."', datemod = NOW() ".
                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                        "AND quarter = 3";

                //update the budgetedSourceFunds table
                $resultExecute = @mysql_query($sqlExecute);
        }//insert
        else{
                $sqlExecute = "INSERT INTO `budgetedExpenditures` ( `center` , `fiscalyear` , `quarter` , `username` , ".
                        "`datemod` , `personnelCosts` , `empBenefits` , `travelInState` , ".
                        "`travelOutState` , `repairsAndMx` , `rentalsLease` , `utilComm` , `profServ` , ".
                        "`suppMatOper` , `tranEqpPurch` , `otherEqpPurch` , `capOutlay` , `debtService` , `misc` ) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '3', '".$_SESSION['user']."', ".
                        "NOW(), '".$personnelCosts."', '".$empBenefits."', '".$travelInState."', ".
                        "'".$travelOutState."', '".$repairsAndMx."', '".$rentalsLease."', '".$utilComm."', '".$profServ."', ".
                        "'".$suppMatOper."', '".$tranEqpPurch."', '".$otherEqpPurch."', '".$capOutlay."', '".$debtService."', '".$misc."')";

                //insert into the budgetedExpenditures table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "INSERT INTO `budgetedPerfStats` ( `center` , `fiscalyear` , `quarter` , `username` , ".
                        "`datemod` , `fiTotal` , `extForenEval` , `intCounsSes`  ) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '3', '".$_SESSION['user']."', ".
                        "NOW(), '".$fiTotal."', '".$extForenEval."', '".$intCounsSes."')";

                //insert into the budgetedPerfStats table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "INSERT INTO `budgetedSourceFunds` ( `center` , `fiscalyear` , `quarter` , `username` , ".
                        "`datemod` , `genFund` , `chilFirstTrust` , `unitedWay` , `adeca` , `natlChilAlliance` , `chilTrustFund` , ".
                        "`deptOfHR` , `countyComm` , `cityCouncil` , `localGrants` , `areaSchools` , `corpDonations` , `privDonations` , ".
                        "`fundraisers` , `bankInterest` ) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '3', '".$_SESSION['user']."', ".
                        "NOW(), '".$genFund."', '".$chilFirstTrust."', '".$unitedWay."', '".$adeca."', ".
                        "'".$natlChilAlliance."', '".$chilTrustFund."', '".$deptOfHR."', '".$countyComm."', ".
                        "'".$cityCouncil."', '".$localGrants."', '".$areaSchools."', '".$corpDonations."', ".
                        "'".$privDonations."', '".$fundraisers."', '".$bankInterest."')";

                //insert into the budgetedSourceFunds table
                $resultExecute = @mysql_query($sqlExecute);
        }

        $fiTotal = set_Variable($_POST['fiTotal4']);
        $extForenEval = set_Variable($_POST['extForenEval4']);
        $intCounsSes = set_Variable($_POST['intCounsSes4']);
        $personnelCosts = set_Variable($_POST['personnelCosts4']);
        $empBenefits = set_Variable($_POST['empBenefits4']);
        $travelInState = set_Variable($_POST['travelInState4']);
        $travelOutState = set_Variable($_POST['travelOutState4']);
        $repairsAndMx = set_Variable($_POST['repairsAndMx4']);
        $rentalsLease = set_Variable($_POST['rentalsLease4']);
        $utilComm = set_Variable($_POST['utilComm4']);
        $profServ = set_Variable($_POST['profServ4']);
        $suppMatOper = set_Variable($_POST['suppMatOper4']);
        $tranEqpPurch = set_Variable($_POST['tranEqpPurch4']);
        $otherEqpPurch = set_Variable($_POST['otherEqpPurch4']);
        $debtService = set_Variable($_POST['debtService4']);
        $misc = set_Variable($_POST['misc4']);
        $genFund = set_Variable($_POST['genFund4']);
        $chilFirstTrust = set_Variable($_POST['chilFirstTrust4']);
        $capOutlay = set_Variable($_POST['capOutlay4']);
        $unitedWay = set_Variable($_POST['unitedWay4']);
        $adeca = set_Variable($_POST['adeca4']);
        $natlChilAlliance = set_Variable($_POST['natlChilAlliance4']);
        $chilTrustFund = set_Variable($_POST['chilTrustFund4']);
        $deptOfHR = set_Variable($_POST['deptOfHR4']);
        $countyComm = set_Variable($_POST['countyComm4']);
        $cityCouncil = set_Variable($_POST['cityCouncil4']);
        $localGrants = set_Variable($_POST['localGrants4']);
        $areaSchools = set_Variable($_POST['areaSchools4']);
        $corpDonations = set_Variable($_POST['corpDonations4']);
        $privDonations = set_Variable($_POST['privDonations4']);
        $fundraisers = set_Variable($_POST['fundraisers4']);
        $bankInterest = set_Variable($_POST['bankInterest4']);

        if ($Update4 == 1){//update
                $sqlExecute = "UPDATE budgetedExpenditures SET personnelCosts = '".$personnelCosts."', ".
                        "empBenefits = '".$empBenefits."', travelInState = '".$travelInState."', travelOutState = '".$travelOutState."', ".
                        "repairsAndMx = '".$repairsAndMx."', rentalsLease = '".$rentalsLease."', utilComm = '".$utilComm."', ".
                        "profServ = '".$profServ."', suppMatOper = '".$suppMatOper."', tranEqpPurch = '".$tranEqpPurch."', ".
                        "otherEqpPurch = '".$otherEqpPurch."', debtService = '".$debtService."', misc = '".$misc."', ".
                        "username = '".$_SESSION['user']."', capOutlay = '".$capOutlay."', datemod = NOW() ".
                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                        "AND quarter = 4";

                //update the budgetedExpenditures table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "UPDATE budgetedPerfStats SET fiTotal = '".$fiTotal."', ".
                        "extForenEval = '".$extForenEval."', intCounsSes = '".$intCounsSes."', ".
                        "username = '".$_SESSION['user']."', datemod = NOW() ".
                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                        "AND quarter = 4";

                //update the budgetedPerfStats table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "UPDATE budgetedSourceFunds SET genFund = '".$genFund."', chilFirstTrust = '".$chilFirstTrust."', ".
                        "unitedWay = '".$unitedWay."', adeca = '".$adeca."', natlChilAlliance = '".$natlChilAlliance."', ".
                        "chilTrustFund = '".$chilTrustFund."', deptOfHR = '".$deptOfHR."', countyComm = '".$countyComm."', ".
                        "cityCouncil = '".$cityCouncil."', localGrants = '".$localGrants."', areaSchools = '".$areaSchools."', ".
                        "corpDonations = '".$corpDonations."', privDonations = '".$privDonations."', fundraisers = '".$fundraisers."', ".
                        "bankInterest = '".$bankInterest."',username = '".$_SESSION['user']."', datemod = NOW() ".
                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                        "AND quarter = 4";

                //update the budgetedSourceFunds table
                $resultExecute = @mysql_query($sqlExecute);
        }//insert
        else{
                $sqlExecute = "INSERT INTO `budgetedExpenditures` ( `center` , `fiscalyear` , `quarter` , `username` , ".
                        "`datemod` , `personnelCosts` , `empBenefits` , `travelInState` , ".
                        "`travelOutState` , `repairsAndMx` , `rentalsLease` , `utilComm` , `profServ` , ".
                        "`suppMatOper` , `tranEqpPurch` , `otherEqpPurch` , `capOutlay` , `debtService` , `misc` ) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '4', '".$_SESSION['user']."', ".
                        "NOW(), '".$personnelCosts."', '".$empBenefits."', '".$travelInState."', ".
                        "'".$travelOutState."', '".$repairsAndMx."', '".$rentalsLease."', '".$utilComm."', '".$profServ."', ".
                        "'".$suppMatOper."', '".$tranEqpPurch."', '".$otherEqpPurch."', '".$capOutlay."', '".$debtService."', '".$misc."')";

                //insert into the budgetedExpenditures table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "INSERT INTO `budgetedPerfStats` ( `center` , `fiscalyear` , `quarter` , `username` , ".
                        "`datemod` , `fiTotal` , `extForenEval` , `intCounsSes`  ) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '4', '".$_SESSION['user']."', ".
                        "NOW(), '".$fiTotal."', '".$extForenEval."', '".$intCounsSes."')";

                //insert into the budgetedPerfStats table
                $resultExecute = @mysql_query($sqlExecute);

                $sqlExecute = "INSERT INTO `budgetedSourceFunds` ( `center` , `fiscalyear` , `quarter` , `username` , ".
                        "`datemod` , `genFund` , `chilFirstTrust` , `unitedWay` , `adeca` , `natlChilAlliance` , `chilTrustFund` , ".
                        "`deptOfHR` , `countyComm` , `cityCouncil` , `localGrants` , `areaSchools` , `corpDonations` , `privDonations` , ".
                        "`fundraisers` , `bankInterest` ) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '4', '".$_SESSION['user']."', ".
                        "NOW(), '".$genFund."', '".$chilFirstTrust."', '".$unitedWay."', '".$adeca."', ".
                        "'".$natlChilAlliance."', '".$chilTrustFund."', '".$deptOfHR."', '".$countyComm."', ".
                        "'".$cityCouncil."', '".$localGrants."', '".$areaSchools."', '".$corpDonations."', ".
                        "'".$privDonations."', '".$fundraisers."', '".$bankInterest."')";

                //insert into the budgetedSourceFunds table
                $resultExecute = @mysql_query($sqlExecute);
        }

        //After updating redirect yo!
        if($_SESSION['admin'] > 0)
	{
                if ($CY == 1)
                      header('Location: http://www.alabamacacs.org./editBudgetsTOP.php?center='.$centerID.'&Y=1');
                else
		      header('Location: http://www.alabamacacs.org./editBudgetsTOP.php?center='.$centerID);
	}
	else
	{
                header('Location: http://www.alabamacacs.org./editBudgetsTOP.php');
        }
?>
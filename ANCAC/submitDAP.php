<?PHP
	require("/ulogin.php");
	require("/dbconn.php");

	switch (date("m")){
                case 10:
                        $Available = 1;
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
                        $fiscalYear = date("Y") ;
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

        $sqlCounty = "SELECT county".
                " FROM countyLU ".
                "WHERE center = ".$centerID;

        $resultCounty = @mysql_query($sqlCounty) or mysql_error();
        $numRecCounty = mysql_num_rows($resultCounty);
        
        //If they have Counties
        if ($numRecCounty > 0){
                //Check to make sure all slots have a value
                while ($row = mysql_fetch_object($resultCounty)) {
                        //Grab the Three values for the county
                        $sqlCountyValues = "SELECT caucasian, afrAmerican, other FROM divActCounty WHERE center = ".$centerID." AND ".
                                "fiscalyear = ".$fiscalYear." AND county = '".$row->county."'";
                        $resultCountyValues = @mysql_query($sqlCountyValues) or mysql_error();
                        $rowCountyValues = mysql_fetch_object($resultCountyValues);

                        if ($rowCountyValues->caucasian == -99) $error = 1;
                        if ($rowCountyValues->afrAmerican == -99) $error = 1;
                        if ($rowCountyValues->other == -99) $error = 1;
              }
        }
        
        //Grab the values that are common to every center
        $sqlCenterValues = "SELECT fullTimeCauc, fullTimeAfrAmer, fullTimeOther, fullTimeMale, fullTimeFemale, ".
                "partTimeCauc, partTimeAfrAmer, partTimeOther, partTimeMale, partTimeFemale, bodCauc, bodAfrAmer, ".
                "bodOther, bodMale, bodFemale, volCauc, volAfrAmer, volOther, volMale, volFemale, internCauc, ".
                "internAfrAmer, internOther, internMale, internFemale, VfullTimeCauc, VfullTimeAfrAmer, ".
                "VfullTimeOther, VfullTimeMale, VfullTimeFemale, VpartTimeCauc, VpartTimeAfrAmer, VpartTimeOther, ".
                "VpartTimeMale, VpartTimeFemale, VbodCauc, VbodAfrAmer, VbodOther, VbodMale, VbodFemale ".
                "FROM divActCenter WHERE center = ".$centerID." AND fiscalyear = ".$fiscalYear;
        $resultCenterValues = @mysql_query($sqlCenterValues) or mysql_error();
        $rowCenterValues = mysql_fetch_object($resultCenterValues);

	$numRecords = mysql_num_rows($resultCenterValues);
        //if they have a row in the table
        if ($numRecords > 0){
                if ($rowCenterValues->fullTimeCauc == -99) $error = 1;
                if ($rowCenterValues->fullTimeAfrAmer == -99) $error = 1;
                if ($rowCenterValues->fullTimeOther == -99) $error = 1;
                if ($rowCenterValues->fullTimeMale == -99) $error = 1;
                if ($rowCenterValues->fullTimeFemale == -99) $error = 1;
                if ($rowCenterValues->partTimeCauc == -99) $error = 1;
                if ($rowCenterValues->partTimeAfrAmer == -99) $error = 1;
                if ($rowCenterValues->partTimeOther == -99) $error = 1;
                if ($rowCenterValues->partTimeMale == -99) $error = 1;
                if ($rowCenterValues->partTimeFemale == -99) $error = 1;
                if ($rowCenterValues->bodCauc == -99) $error = 1;
                if ($rowCenterValues->bodAfrAmer == -99) $error = 1;
                if ($rowCenterValues->bodOther == -99) $error = 1;
                if ($rowCenterValues->bodMale == -99) $error = 1;
                if ($rowCenterValues->bodFemale == -99) $error = 1;
                if ($rowCenterValues->volCauc == -99) $error = 1;
                if ($rowCenterValues->volAfrAmer == -99) $error = 1;
                if ($rowCenterValues->volOther == -99) $error = 1;
                if ($rowCenterValues->volMale == -99) $error = 1;
                if ($rowCenterValues->volFemale == -99) $error = 1;
                if ($rowCenterValues->internCauc == -99) $error = 1;
                if ($rowCenterValues->internAfrAmer == -99) $error = 1;
                if ($rowCenterValues->internOther == -99) $error = 1;
                if ($rowCenterValues->internMale == -99) $error = 1;
                if ($rowCenterValues->internFemale == -99) $error = 1;
                if ($rowCenterValues->VfullTimeCauc == -99) $error = 1;
                if ($rowCenterValues->VfullTimeAfrAmer == -99) $error = 1;
                if ($rowCenterValues->VfullTimeOther == -99) $error = 1;
                if ($rowCenterValues->VfullTimeMale == -99) $error = 1;
                if ($rowCenterValues->VfullTimeFemale == -99) $error = 1;
                if ($rowCenterValues->VpartTimeCauc == -99) $error = 1;
                if ($rowCenterValues->VpartTimeAfrAmer == -99) $error = 1;
                if ($rowCenterValues->VpartTimeOther == -99) $error = 1;
                if ($rowCenterValues->VpartTimeMale == -99) $error = 1;
                if ($rowCenterValues->VpartTimeFemale == -99) $error = 1;
                if ($rowCenterValues->VbodCauc == -99) $error = 1;
                if ($rowCenterValues->VbodAfrAmer == -99) $error = 1;
                if ($rowCenterValues->VbodOther == -99) $error = 1;
                if ($rowCenterValues->VbodMale == -99) $error = 1;
                if ($rowCenterValues->VbodFemale == -99) $error = 1;

                //Gather the Totals for the Female + Male Checks
                $TotalfullTime = 0;
                if ($rowCenterValues->fullTimeCauc != - 99)
                        $TotalfullTime = $TotalfullTime + $rowCenterValues->fullTimeCauc;
                if ($rowCenterValues->fullTimeAfrAmer != - 99)
                        $TotalfullTime = $TotalfullTime + $rowCenterValues->fullTimeAfrAmer;
                if ($rowCenterValues->fullTimeOther != - 99)
                        $TotalfullTime = $TotalfullTime + $rowCenterValues->fullTimeOther;
                $TotalpartTime = 0;
                if ($rowCenterValues->partTimeCauc != - 99)
                        $TotalpartTime = $TotalpartTime + $rowCenterValues->partTimeCauc;
                if ($rowCenterValues->partTimeAfrAmer != - 99)
                        $TotalpartTime = $TotalpartTime + $rowCenterValues->partTimeAfrAmer;
                if ($rowCenterValues->partTimeOther != - 99)
                        $TotalpartTime = $TotalpartTime + $rowCenterValues->partTimeOther;
                $Totalbod = 0;
                if ($rowCenterValues->bodCauc != - 99)
                        $Totalbod = $Totalbod + $rowCenterValues->bodCauc;
                if ($rowCenterValues->bodAfrAmer != - 99)
                        $Totalbod = $Totalbod + $rowCenterValues->bodAfrAmer;
                if ($rowCenterValues->bodOther != - 99)
                        $Totalbod = $Totalbod + $rowCenterValues->bodOther;
                $Totalvol = 0;
                if ($rowCenterValues->volCauc != - 99)
                        $Totalvol = $Totalvol + $rowCenterValues->volCauc;
                if ($rowCenterValues->volAfrAmer != - 99)
                        $Totalvol = $Totalvol + $rowCenterValues->volAfrAmer;
                if ($rowCenterValues->volOther != - 99)
                        $Totalvol = $Totalvol + $rowCenterValues->volOther;
                $Totalintern = 0;
                if ($rowCenterValues->internCauc != - 99)
                        $Totalintern = $Totalintern + $rowCenterValues->internCauc;
                if ($rowCenterValues->internAfrAmer != - 99)
                        $Totalintern = $Totalintern + $rowCenterValues->internAfrAmer;
                if ($rowCenterValues->internOther != - 99)
                        $Totalintern = $Totalintern + $rowCenterValues->internOther;
                $TotalVfullTime = 0;
                if ($rowCenterValues->VfullTimeCauc != - 99)
                        $TotalVfullTime = $TotalVfullTime + $rowCenterValues->VfullTimeCauc;
                if ($rowCenterValues->VfullTimeAfrAmer != - 99)
                        $TotalVfullTime = $TotalVfullTime + $rowCenterValues->VfullTimeAfrAmer;
                if ($rowCenterValues->VfullTimeOther != - 99)
                        $TotalVfullTime = $TotalVfullTime + $rowCenterValues->VfullTimeOther;
                $TotalVpartTime = 0;
                if ($rowCenterValues->VpartTimeCauc != - 99)
                        $TotalVpartTime = $TotalVpartTime + $rowCenterValues->VpartTimeCauc;
                if ($rowCenterValues->VpartTimeAfrAmer != - 99)
                        $TotalVpartTime = $TotalVpartTime + $rowCenterValues->VpartTimeAfrAmer;
                if ($rowCenterValues->VpartTimeOther != - 99)
                        $TotalVpartTime = $TotalVpartTime + $rowCenterValues->VpartTimeOther;
                $TotalVbod = 0;
                if ($rowCenterValues->VbodCauc != - 99)
                        $TotalVbod = $TotalVbod + $rowCenterValues->VbodCauc;
                if ($rowCenterValues->VbodAfrAmer != - 99)
                        $TotalVbod = $TotalVbod + $rowCenterValues->VbodAfrAmer;
                if ($rowCenterValues->VbodOther != - 99)
                        $TotalVbod = $TotalVbod + $rowCenterValues->VbodOther;
        }
        else $error = 1;
        
        if($error == 0){
                //Check to make sure that Female + Male == Total
                //Full Time Employees
                if (($rowCenterValues->fullTimeMale + $rowCenterValues->fullTimeFemale) != $TotalfullTime){
                        $error = 1;
                        $errMessage = $errMessage.'  *Female and Male Counts do not add up to total (Full Time Employees)\n';
                }
                //Part Time Employees
                if (($rowCenterValues->partTimeMale + $rowCenterValues->partTimeFemale) != $TotalpartTime){
                        $error = 1;
                        $errMessage = $errMessage.'  *Female and Male Counts do not add up to total (Part Time Employees)\n';
                }
                //Board of Directors
                if (($rowCenterValues->bodMale + $rowCenterValues->bodFemale) != $Totalbod){
                        $error = 1;
                        $errMessage = $errMessage.'  *Female and Male Counts do not add up to total (Board of Directors)\n';
                }
                //Volunteers
                if (($rowCenterValues->volMale + $rowCenterValues->volFemale) != $Totalvol){
                        $error = 1;
                        $errMessage = $errMessage.'  *Female and Male Counts do not add up to total (Volunteers)\n';
                }
                //Interns
                if (($rowCenterValues->internMale + $rowCenterValues->internFemale) != $Totalintern){
                        $error = 1;
                        $errMessage = $errMessage.'  *Female and Male Counts do not add up to total (Interns)\n';
                }
                //VfullTime Employees
                if (($rowCenterValues->VfullTimeMale + $rowCenterValues->VfullTimeFemale) != $TotalVfullTime){
                        $error = 1;
                        $errMessage = $errMessage.'  *Female and Male Counts do not add up to total (Vacancies Filled - Full Time Employees)\n';
                }
                //VpartTime Employees
                if (($rowCenterValues->VpartTimeMale + $rowCenterValues->VpartTimeFemale) != $TotalVpartTime){
                        $error = 1;
                        $errMessage = $errMessage.'  *Female and Male Counts do not add up to total (Vacancies Filled - Part Time Employees)\n';
                }
                //Vbod
                if (($rowCenterValues->VbodMale + $rowCenterValues->VbodFemale) != $TotalVbod){
                        $error = 1;
                        $errMessage = $errMessage.'  *Female and Male Counts do not add up to total (Vacancies Filled - Board of Directors)\n';
                }
        }
        else
                $errMessage = $errMessage.'  *Make sure that all values have been filled in\n  *Make sure that the Female and Male Counts add up to the Total\n';

        //Send them back
        if ($_SESSION['admin'] == 1)
                header('Location: http://www.alabamacacs.org/ANCAC-Online/eoyreports.php?center='.$centerID);
        else{
                if (($_SESSION['admin'] == 2) || ($Available == 1)){
                        if ($error == 1)
                                echo '"<script>alert(\'To submit your Diversity Action Plan you must:\n\n'.$errMessage.'\'); window.location.href = \'http://www.alabamacacs.org/ANCAC-Online/divAction.php?center='.$centerID.'\';</script>"';
                        else{
                                $sqlUpdate = "UPDATE eoyChecks SET DiversityActPlan = '1', ".
                                        "username = '".$_SESSION['user']."', datemod = NOW() ".
                                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."'";

                                $resultUpdate = @mysql_query($sqlUpdate);

                                header('Location: http://www.alabamacacs.org/ANCAC-Online/eoyreports.php?center='.$centerID);
                        }
                }
                else
                        header('Location: http://www.alabamacacs.org/ANCAC-Online/eoyreports.php?center='.$centerID);
        }
?>
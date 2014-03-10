<?
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/ulogin.php");
	require("/home/cluster1/data/a/p/a1224426/data/dbconn.php");

	$centerID = $_POST['centerID'];
        $CY = $_POST['CY'];
        $fiscalYear = $_POST['fiscalYear'];
        $UpdateCenter = $_POST['UpdateCenter'];

        function set_Variable ($theValue) {
                if (is_numeric($theValue)) $returnValue = $theValue;
                else {
                        $returnValue = -99;
                }
                return $returnValue;
        }
        //Grab the values that are set for the center as a whole
        $fullTimeCauc = set_Variable($_POST['fullTimeCauc']);
        $fullTimeAfrAmer = set_Variable($_POST['fullTimeAfrAmer']);
        $fullTimeOther = set_Variable($_POST['fullTimeOther']);
        $fullTimeMale = set_Variable($_POST['fullTimeMale']);
        $fullTimeFemale = set_Variable($_POST['fullTimeFemale']);
        $partTimeCauc = set_Variable($_POST['partTimeCauc']);
        $partTimeAfrAmer = set_Variable($_POST['partTimeAfrAmer']);
        $partTimeOther = set_Variable($_POST['partTimeOther']);
        $partTimeMale = set_Variable($_POST['partTimeMale']);
        $partTimeFemale = set_Variable($_POST['partTimeFemale']);
        $bodCauc = set_Variable($_POST['bodCauc']);
        $bodAfrAmer = set_Variable($_POST['bodAfrAmer']);
        $bodOther = set_Variable($_POST['bodOther']);
        $bodMale = set_Variable($_POST['bodMale']);
        $bodFemale = set_Variable($_POST['bodFemale']);
        $volCauc = set_Variable($_POST['volCauc']);
        $volAfrAmer = set_Variable($_POST['volAfrAmer']);
        $volOther = set_Variable($_POST['volOther']);
        $volMale = set_Variable($_POST['volMale']);
        $volFemale = set_Variable($_POST['volFemale']);
        $internCauc = set_Variable($_POST['internCauc']);
        $internAfrAmer = set_Variable($_POST['internAfrAmer']);
        $internOther = set_Variable($_POST['internOther']);
        $internMale = set_Variable($_POST['internMale']);
        $internFemale = set_Variable($_POST['internFemale']);
        $VfullTimeCauc = set_Variable($_POST['VfullTimeCauc']);
        $VfullTimeAfrAmer = set_Variable($_POST['VfullTimeAfrAmer']);
        $VfullTimeOther = set_Variable($_POST['VfullTimeOther']);
        $VfullTimeMale = set_Variable($_POST['VfullTimeMale']);
        $VfullTimeFemale = set_Variable($_POST['VfullTimeFemale']);
        $VpartTimeCauc = set_Variable($_POST['VpartTimeCauc']);
        $VpartTimeAfrAmer = set_Variable($_POST['VpartTimeAfrAmer']);
        $VpartTimeOther = set_Variable($_POST['VpartTimeOther']);
        $VpartTimeMale = set_Variable($_POST['VpartTimeMale']);
        $VpartTimeFemale = set_Variable($_POST['VpartTimeFemale']);
        $VbodCauc = set_Variable($_POST['VbodCauc']);
        $VbodAfrAmer = set_Variable($_POST['VbodAfrAmer']);
        $VbodOther = set_Variable($_POST['VbodOther']);
        $VbodMale = set_Variable($_POST['VbodMale']);
        $VbodFemale = set_Variable($_POST['VbodFemale']);

        if ($UpdateCenter == 1){//update
                $sqlExecute = "UPDATE divActCenter SET fullTimeCauc = '".$fullTimeCauc."', fullTimeAfrAmer = '".$fullTimeAfrAmer."', ".
        "fullTimeOther = '".$fullTimeOther."', fullTimeMale = '".$fullTimeMale."', fullTimeFemale = '".$fullTimeFemale."', ".
        "partTimeCauc = '".$partTimeCauc."', partTimeAfrAmer = '".$partTimeAfrAmer."', partTimeOther = '".$partTimeOther."', ".
        "partTimeMale = '".$partTimeMale."', partTimeFemale = '".$partTimeFemale."', bodCauc = '".$bodCauc."', ".
        "bodAfrAmer = '".$bodAfrAmer."', bodOther = '".$bodOther."', bodMale = '".$bodMale."', ".
        "bodFemale = '".$bodFemale."', volCauc = '".$volCauc."', volAfrAmer = '".$volAfrAmer."', ".
        "volOther = '".$volOther."', volMale = '".$volMale."', volFemale = '".$volFemale."', ".
        "internCauc = '".$internCauc."', internAfrAmer = '".$internAfrAmer."', internOther = '".$internOther."', ".
        "internMale = '".$internMale."', internFemale = '".$internFemale."', VfullTimeCauc = '".$VfullTimeCauc."', ".
        "VfullTimeAfrAmer = '".$VfullTimeAfrAmer."', VfullTimeOther = '".$VfullTimeOther."', VfullTimeMale = '".$VfullTimeMale."', ".
        "VfullTimeFemale = '".$VfullTimeFemale."', VpartTimeCauc = '".$VpartTimeCauc."', VpartTimeAfrAmer = '".$VpartTimeAfrAmer."', ".
        "VpartTimeOther = '".$VpartTimeOther."', VpartTimeMale = '".$VpartTimeMale."', VpartTimeFemale = '".$VpartTimeFemale."', ".
        "VbodCauc = '".$VbodCauc."', VbodAfrAmer = '".$VbodAfrAmer."', VbodOther = '".$VbodOther."', ".
        "VbodMale = '".$VbodMale."', VbodFemale = '".$VbodFemale."', ".
        "username = '".$_SESSION['user']."', datemod = NOW() ".
        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."'";

                //update the divActCenter table
                $resultExecute = @mysql_query($sqlExecute);
        }//insert
        else{
                $sqlExecute = "INSERT INTO `divActCenter` ( `center` , `fiscalyear` , `fullTimeCauc`, `fullTimeAfrAmer`, `fullTimeOther`, `fullTimeMale`, `fullTimeFemale`, `partTimeCauc`, `partTimeAfrAmer`, `partTimeOther`, `username` , ".
"`datemod` , `partTimeMale`, `partTimeFemale`, `bodCauc`, `bodAfrAmer`, `bodOther`, `bodMale`, `bodFemale`, `volCauc`, ".
"`volAfrAmer`, `volOther`, `volMale`, `volFemale`, `internCauc`, `internAfrAmer`, `internOther`, `internMale`, ".
"`internFemale`,`VfullTimeCauc`, `VfullTimeAfrAmer`, `VfullTimeOther`, `VfullTimeMale`, `VfullTimeFemale`, `VpartTimeCauc`, `VpartTimeAfrAmer`, ".
"`VpartTimeOther`, `VpartTimeMale`, `VpartTimeFemale`, `VbodCauc`, `VbodAfrAmer`, `VbodOther`, `VbodMale`, `VbodFemale` ) ".
"VALUES ('".$centerID."', '".$fiscalYear."', '".$fullTimeCauc."', '".$fullTimeAfrAmer."', '".$fullTimeOther."', '".$fullTimeMale."', '".$fullTimeFemale."', '".$partTimeCauc."', '".$partTimeAfrAmer."', '".$partTimeOther."', '".$_SESSION['user']."', ".
"NOW(), '".$partTimeMale."', '".$partTimeFemale."', '".$bodCauc."', '".$bodAfrAmer."', '".$bodOther."', '".$bodMale."', '".$bodFemale."', '".$volCauc."', ".
"'".$volAfrAmer."', '".$volOther."', '".$volMale."', '".$volFemale."', '".$internCauc."', '".$internAfrAmer."', '".$internOther."', '".$internMale."', ".
"'".$internFemale."', '".$VfullTimeCauc."', '".$VfullTimeAfrAmer."', '".$VfullTimeOther."', '".$VfullTimeMale."', '".$VfullTimeFemale."', '".$VpartTimeCauc."', '".$VpartTimeAfrAmer."', ".
"'".$VpartTimeOther."', '".$VpartTimeMale."', '".$VpartTimeFemale."', '".$VbodCauc."', '".$VbodAfrAmer."', '".$VbodOther."', '".$VbodMale."', '".$VbodFemale."')";

                //insert into the actualExpenditures table
                $resultExecute = @mysql_query($sqlExecute);
        }

         //Now update the County Info stuff
         $sqlCounty = "SELECT county".
                " FROM countyLU ".
                "WHERE center = ".$centerID;

         $resultCounty = @mysql_query($sqlCounty) or mysql_error();
         $numRecCounty = mysql_num_rows($resultCounty);

        if ($numRecCounty > 0){
              while ($row = mysql_fetch_object($resultCounty)) {
                $caucInputBox = "cauc".$row->county;
                $caucPostValue = set_Variable($_POST[$caucInputBox]);

                $afrAmerInputBox = "afrAmer".$row->county;
                $afrAmerPostValue = set_Variable($_POST[$afrAmerInputBox]);

                $otherInputBox = "other".$row->county;
                $otherPostValue = set_Variable($_POST[$otherInputBox]);

                //Try to Update first
                $sqlExecute = "UPDATE divActCounty SET caucasian = '".$caucPostValue."', afrAmerican = '".$afrAmerPostValue."', ".
                "other = '".$otherPostValue."' WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."' ".
                "AND county = '".$row->county."'";
                //Run the Executed statement to update the County Info
                $resultExecute = @mysql_query($sqlExecute);

                $intDidUpdate = mysql_num_rows($resultExecute);

                //If it did not Update, insert
                if ($intDidUpdate == 0){
                        $sqlExecute = "INSERT INTO `divActCounty` ( `center` , `fiscalyear` , `county` , `caucasian` , `afrAmerican` , `other`) ".
                        "VALUES ('".$centerID."', '".$fiscalYear."', '".$row->county."', '".$caucPostValue."', '".$afrAmerPostValue."', '".$otherPostValue."')";

                        //Run the Executed statement to insert the County Info
                        $resultExecute = @mysql_query($sqlExecute);
                }
              }
        }//END of the IF for County Info

        if($_SESSION['admin'] > 0)
	{
		header('Location: http://www.alabamacacs.org/ANCAC-Online/divAction.php?center='.$centerID.'&year='.$fiscalYear);
	}
	else
	{
                header('Location: http://www.alabamacacs.org/ANCAC-Online/divAction.php');
        }
?>
<?php
	require("./ulogin.php");
	require("/home/cluster1/data/a/p/a1224426/data/dbconn.php");

	$page_title = 'ANCAC: All Diversity Action Plans';
	require("./header.php");

        $fiscalYear = $_POST['year'];
        
        function printPercent($TopNumber, $BottomNumber){
                $percent = ($TopNumber/$BottomNumber) * 100;
                echo number_format($percent,2).'%';
         }
?>

<?php
                $sql = "SELECT centers.center, centers.CenterName FROM `centers` JOIN `eoyChecks` ON centers.center = eoyChecks.center".
                        " AND eoyChecks.fiscalyear = '".$fiscalYear."' AND eoyChecks.DiversityActPlan = '1'".
                        "  WHERE centers.center not in (0,99) order by centers.center";
                $result = @mysql_query($sql) or mysql_error();
?>
                <center>
		<table class="OutlineTable" width="85%">
		        <tr><td class="login-header" colspan="6">All Submitted Diversity Action Plans - FY <?php echo $fiscalYear; ?></td></tr>
                        <tr align="left"><td colspan="6"><b>Date: </b><?php echo date("M d Y"); ?></td></tr>
                        <tr><td colspan="6">&nbsp;</td></tr>
                        <tr><td colspan="6">
<?php
		while ($row = mysql_fetch_object($result)) {
                        //grab all the counties for a given Center
			$sqlCounty = "SELECT county".
                                " FROM countyLU ".
                                "WHERE center = ".$row->center;

                        $resultCounty = @mysql_query($sqlCounty) or mysql_error();
                        $numRecCounty = mysql_num_rows($resultCounty);
                        $intCounter = 1;
                        //Put the Counties together in a string
                        while ($rowCounty = mysql_fetch_object($resultCounty)){
                                if ($numRecCounty == $intCounter)
                                        $Counties = $Counties.$rowCounty->county;
                                else{
                                        $Counties = $Counties.$rowCounty->county.', ';
                                        $intCounter = $intCounter + 1;
                                }
                        }

                        echo '<table width="100%" class="Admin">';
                        echo '<tr><td colspan="10" style="font-size: 14px"><b>Name of Child Advocacy Center: </b>'.$row->CenterName.'</td></tr>';
                        echo '<tr><td colspan="10"><b>County(ies) Served Per CAC Incorporation/Bylaws: </b>'.$Counties.'</td></tr>';
                        echo '<tr><td colspan="10">&nbsp;</td></tr>';
                        echo '<tr><td colspan="10" style="font-size: 14px"><b><center>Breakdown</center></b></td></tr>';
                        echo '<tr class="BoldText"><td colspan="2">&nbsp;</td><td colspan="2"><center>Caucasian</center></td><td colspan="2"><center>African American</center></td><td colspan="2"><center>Other</center></td><td colspan="2">&nbsp;</td></tr>';
                        echo '<tr class="BoldText"><td>Current Statistical Makeup</td><td><center>Total</center></td><td><center>#</center></td><td><center>%</center></td><td><center>#</center></td><td><center>%</center></td><td><center>#</center></td><td><center>%</center></td><td colspan="2">&nbsp;</td></tr>';

                        $sqlCounty = "SELECT county".
                                " FROM countyLU ".
                                "WHERE center = ".$row->center;

                        $resultCounty = @mysql_query($sqlCounty) or mysql_error();

                        while ($rowCounty = mysql_fetch_object($resultCounty)) {
                                echo '<tr align="center"><td align="left">'.$rowCounty->county.' County Population</td>';
                                        $sqlCountyValues = "SELECT caucasian, afrAmerican, other FROM divActCounty WHERE center = ".$row->center." AND ".
                                                "fiscalyear = ".$fiscalYear." AND county = '".$rowCounty->county."'";
                                        $resultCountyValues = @mysql_query($sqlCountyValues) or mysql_error();
                                        $rowCountyValues = mysql_fetch_object($resultCountyValues);
                                //Total Column
                                $TotalPeeps = 0;
                                if ($rowCountyValues->caucasian != - 99)
                                        $TotalPeeps = $TotalPeeps + $rowCountyValues->caucasian;
                                if ($rowCountyValues->afrAmerican != - 99)
                                        $TotalPeeps = $TotalPeeps + $rowCountyValues->afrAmerican;
                                if ($rowCountyValues->other != - 99)
                                        $TotalPeeps = $TotalPeeps + $rowCountyValues->other;
                                echo '<td>'.$TotalPeeps.'</td>';
                                //Caucasion Number
                                echo '<td>';
                                if(isset($rowCountyValues->caucasian) && ($rowCountyValues->caucasian != - 99)) echo $rowCountyValues->caucasian;
                                echo '</td>';
                                //Caucasion Percent
                                echo '<td>';
                                if ($TotalPeeps != 0){
                                        if(isset($rowCountyValues->caucasian) && ($rowCountyValues->caucasian != - 99)) printPercent($rowCountyValues->caucasian,$TotalPeeps);
                                        else echo 'N/A';
                                }
                                else
                                        echo 'N/A';
                                echo '</td>';
                                //African American Number
                                echo '<td>';
                                if(isset($rowCountyValues->afrAmerican) && ($rowCountyValues->afrAmerican != - 99)) echo $rowCountyValues->afrAmerican;
                                echo '</td>';
                                //African American Percent
                                echo '<td>';
                                if ($TotalPeeps != 0){
                                        if(isset($rowCountyValues->afrAmerican) && ($rowCountyValues->afrAmerican != - 99)) printPercent($rowCountyValues->afrAmerican,$TotalPeeps);
                                        else echo 'N/A';
                                }
                                else
                                        echo 'N/A';
                                echo '</td>';

                                //Other Number
                                echo '<td>';
                                if(isset($rowCountyValues->other) && ($rowCountyValues->other != - 99)) echo $rowCountyValues->other;
                                echo '</td>';
                                //Other Percent
                                echo '<td>';
                                if ($TotalPeeps != 0){
                                        if(isset($rowCountyValues->other) && ($rowCountyValues->other != - 99)) printPercent($rowCountyValues->other,$TotalPeeps);
                                        else echo 'N/A';
                                }
                                else
                                        echo 'N/A';
                                echo '</td>';
                                echo '<td colspan="2">&nbsp;</td></tr>';
                        }
                        echo '<tr><td colspan="8">&nbsp;</td><td colspan="2"><center><b>Gender Ratio</b></center></td></tr>';
                        echo '<tr class="BoldText"><td>Total County / Community Population</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><center>Female</center></td><td><center>Male</center></td></tr>';

                        $sqlCenterValues = "SELECT fullTimeCauc, fullTimeAfrAmer, fullTimeOther, fullTimeMale, fullTimeFemale, ".
                                "partTimeCauc, partTimeAfrAmer, partTimeOther, partTimeMale, partTimeFemale, bodCauc, bodAfrAmer, ".
                                "bodOther, bodMale, bodFemale, volCauc, volAfrAmer, volOther, volMale, volFemale, internCauc, ".
                                "internAfrAmer, internOther, internMale, internFemale, VfullTimeCauc, VfullTimeAfrAmer, ".
                                "VfullTimeOther, VfullTimeMale, VfullTimeFemale, VpartTimeCauc, VpartTimeAfrAmer, VpartTimeOther, ".
                                "VpartTimeMale, VpartTimeFemale, VbodCauc, VbodAfrAmer, VbodOther, VbodMale, VbodFemale ".
                                "FROM divActCenter WHERE center = ".$row->center." AND fiscalyear = ".$fiscalYear;
                        $resultCenterValues = @mysql_query($sqlCenterValues) or mysql_error();
                        $rowCenterValues = mysql_fetch_object($resultCenterValues);
                        //See whether you will need to update or not
                        $UpdateCenter = mysql_num_rows($resultCenterValues);

                        //Gather the totals
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

                        echo '<tr align="center"><td align="left">Full Time Employees</td><td>'.$TotalfullTime.'</td>';
                        echo '<td>';
                        if(isset($rowCenterValues->fullTimeCauc) && ($rowCenterValues->fullTimeCauc != - 99)) echo $rowCenterValues->fullTimeCauc;
                        echo '</td>';
                        echo '<td>';
                        if ($TotalfullTime != 0){
                                        if(isset($rowCenterValues->fullTimeCauc) && ($rowCenterValues->fullTimeCauc != - 99)) printPercent($rowCenterValues->fullTimeCauc,$TotalfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->fullTimeAfrAmer) && ($rowCenterValues->fullTimeAfrAmer != - 99)) echo $rowCenterValues->fullTimeAfrAmer;
                        echo '</td>';
                        echo '<td>';
                        if ($TotalfullTime != 0){
                                        if(isset($rowCenterValues->fullTimeAfrAmer) && ($rowCenterValues->fullTimeAfrAmer != - 99)) printPercent($rowCenterValues->fullTimeAfrAmer,$TotalfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->fullTimeOther) && ($rowCenterValues->fullTimeOther != - 99)) echo $rowCenterValues->fullTimeOther;
                        echo '</td>';
                        echo '<td>';
                        if ($TotalfullTime != 0){
                                        if(isset($rowCenterValues->fullTimeOther) && ($rowCenterValues->fullTimeOther != - 99)) printPercent($rowCenterValues->fullTimeOther,$TotalfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->fullTimeFemale) && ($rowCenterValues->fullTimeFemale != - 99)) echo $rowCenterValues->fullTimeFemale;
                        echo '</td><td>';
                        if(isset($rowCenterValues->fullTimeMale) && ($rowCenterValues->fullTimeMale != - 99)) echo $rowCenterValues->fullTimeMale;
                        echo '</td></tr>';
                        echo '<tr align="center"><td align="left">Part Time Employees</td><td>'.$TotalpartTime.'</td>';
                        echo '<td>';
                        if(isset($rowCenterValues->partTimeCauc) && ($rowCenterValues->partTimeCauc != - 99)) echo $rowCenterValues->partTimeCauc;
                        echo '</td>';
                        echo '<td>';
                        if ($TotalpartTime != 0){
                                        if(isset($rowCenterValues->partTimeCauc) && ($rowCenterValues->partTimeCauc != - 99)) printPercent($rowCenterValues->partTimeCauc,$TotalpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->partTimeAfrAmer) && ($rowCenterValues->partTimeAfrAmer != - 99)) echo $rowCenterValues->partTimeAfrAmer;
                        echo '</td>';
                        echo '<td>';
                        if ($TotalpartTime != 0){
                                        if(isset($rowCenterValues->partTimeAfrAmer) && ($rowCenterValues->partTimeAfrAmer != - 99)) printPercent($rowCenterValues->partTimeAfrAmer,$TotalpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->partTimeOther) && ($rowCenterValues->partTimeOther != - 99)) echo $rowCenterValues->partTimeOther;
                        echo '</td>';
                        echo '<td>';
                        if ($TotalpartTime != 0){
                                        if(isset($rowCenterValues->partTimeOther) && ($rowCenterValues->partTimeOther != - 99)) printPercent($rowCenterValues->partTimeOther,$TotalpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->partTimeFemale) && ($rowCenterValues->partTimeFemale != - 99)) echo $rowCenterValues->partTimeFemale;
                        echo '</td><td>';
                        if(isset($rowCenterValues->partTimeMale) && ($rowCenterValues->partTimeMale != - 99)) echo $rowCenterValues->partTimeMale;
                        echo '</td></tr>';
                        echo '<tr align="center"><td align="left">Board of Directors</td><td>'.$Totalbod.'</td>';
                        echo '<td>';
                        if(isset($rowCenterValues->bodCauc) && ($rowCenterValues->bodCauc != - 99)) echo $rowCenterValues->bodCauc;
                        echo '</td>';
                        echo '<td>';
                        if ($Totalbod != 0){
                                        if(isset($rowCenterValues->bodCauc) && ($rowCenterValues->bodCauc != - 99)) printPercent($rowCenterValues->bodCauc,$Totalbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->bodAfrAmer) && ($rowCenterValues->bodAfrAmer != - 99)) echo $rowCenterValues->bodAfrAmer;
                        echo '</td>';
                        echo '<td>';
                        if ($Totalbod != 0){
                                        if(isset($rowCenterValues->bodAfrAmer) && ($rowCenterValues->bodAfrAmer != - 99)) printPercent($rowCenterValues->bodAfrAmer,$Totalbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->bodOther) && ($rowCenterValues->bodOther != - 99)) echo $rowCenterValues->bodOther;
                        echo '</td>';
                        echo '<td>';
                        if ($Totalbod != 0){
                                        if(isset($rowCenterValues->bodOther) && ($rowCenterValues->bodOther != - 99)) printPercent($rowCenterValues->bodOther,$Totalbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->bodFemale) && ($rowCenterValues->bodFemale != - 99)) echo $rowCenterValues->bodFemale;
                        echo '</td><td>';
                        if(isset($rowCenterValues->bodMale) && ($rowCenterValues->bodMale != - 99)) echo $rowCenterValues->bodMale;
                        echo '</td></tr>';
                        echo '<tr align="center"><td align="left">Volunteers</td><td>'.$Totalvol.'</td>';
                        echo '<td>';
                        if(isset($rowCenterValues->volCauc) && ($rowCenterValues->volCauc != - 99)) echo $rowCenterValues->volCauc;
                        echo '</td>';
                        echo '<td>';
                        if ($Totalvol != 0){
                                        if(isset($rowCenterValues->volCauc) && ($rowCenterValues->volCauc != - 99)) printPercent($rowCenterValues->volCauc,$Totalvol);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->volAfrAmer) && ($rowCenterValues->volAfrAmer != - 99)) echo $rowCenterValues->volAfrAmer;
                        echo '</td>';
                        echo '<td>';
                        if ($Totalvol != 0){
                                        if(isset($rowCenterValues->volAfrAmer) && ($rowCenterValues->volAfrAmer != - 99)) printPercent($rowCenterValues->volAfrAmer,$Totalvol);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->volOther) && ($rowCenterValues->volOther != - 99)) echo $rowCenterValues->volOther;
                        echo '</td>';
                        echo '<td>';
                        if ($Totalvol != 0){
                                        if(isset($rowCenterValues->volOther) && ($rowCenterValues->volOther != - 99)) printPercent($rowCenterValues->volOther,$Totalvol);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->volFemale) && ($rowCenterValues->volFemale != - 99)) echo $rowCenterValues->volFemale;
                        echo '</td><td>';
                        if(isset($rowCenterValues->volMale) && ($rowCenterValues->volMale != - 99)) echo $rowCenterValues->volMale;
                        echo '</td></tr>';
                        echo '<tr align="center"><td align="left">Interns</td><td>'.$Totalintern.'</td>';
                        echo '<td>';
                        if(isset($rowCenterValues->internCauc) && ($rowCenterValues->internCauc != - 99)) echo $rowCenterValues->internCauc;
                        echo '</td>';
                        echo '<td>';
                        if ($Totalintern != 0){
                                        if(isset($rowCenterValues->internCauc) && ($rowCenterValues->internCauc != - 99)) printPercent($rowCenterValues->internCauc,$Totalintern);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->internAfrAmer) && ($rowCenterValues->internAfrAmer != - 99)) echo $rowCenterValues->internAfrAmer;
                        echo '</td>';
                        echo '<td>';
                        if ($Totalintern != 0){
                                        if(isset($rowCenterValues->internAfrAmer) && ($rowCenterValues->internAfrAmer != - 99)) printPercent($rowCenterValues->internAfrAmer,$Totalintern);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->internOther) && ($rowCenterValues->internOther != - 99)) echo $rowCenterValues->internOther;
                        echo '</td>';
                        echo '<td>';
                        if ($Totalintern != 0){
                                        if(isset($rowCenterValues->internOther) && ($rowCenterValues->internOther != - 99)) printPercent($rowCenterValues->internOther,$Totalintern);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->internFemale) && ($rowCenterValues->internFemale != - 99)) echo $rowCenterValues->internFemale;
                        echo '</td><td>';
                        if(isset($rowCenterValues->internMale) && ($rowCenterValues->internMale != - 99)) echo $rowCenterValues->internMale;
                        echo '</td></tr>';
                        echo '<tr><td colspan="10">&nbsp;</td></tr>';
                        echo '<tr class="BoldText"><td colspan="2">&nbsp;</td><td colspan="2"><center>Caucasian</center></td><td colspan="2"><center>African American</center></td><td colspan="2"><center>Other</center></td><td colspan="2">&nbsp;</td></tr>';
                        echo '<tr class="BoldText"><td>Vacancies Filled during Reporting Period</td><td><center>Total</center></td><td><center>#</center></td><td><center>%</center></td><td><center>#</center></td><td><center>%</center></td><td><center>#</center></td><td><center>%</center></td><td colspan="2">&nbsp;</td></tr>';
                        echo '<tr align="center"><td align="left">Full Time Employees</td><td>'.$TotalVfullTime.'</td>';
                        echo '<td>';
                        if(isset($rowCenterValues->VfullTimeCauc) && ($rowCenterValues->VfullTimeCauc != - 99)) echo $rowCenterValues->VfullTimeCauc;
                        echo '</td>';
                        echo '<td>';
                        if ($TotalVfullTime != 0){
                                        if(isset($rowCenterValues->VfullTimeCauc) && ($rowCenterValues->VfullTimeCauc != - 99)) printPercent($rowCenterValues->VfullTimeCauc,$TotalVfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->VfullTimeAfrAmer) && ($rowCenterValues->VfullTimeAfrAmer != - 99)) echo $rowCenterValues->VfullTimeAfrAmer;
                        echo '</td>';
                        echo '<td>';
                        if ($TotalVfullTime != 0){
                                        if(isset($rowCenterValues->VfullTimeAfrAmer) && ($rowCenterValues->VfullTimeAfrAmer != - 99)) printPercent($rowCenterValues->VfullTimeAfrAmer,$TotalVfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->VfullTimeOther) && ($rowCenterValues->VfullTimeOther != - 99)) echo $rowCenterValues->VfullTimeOther;
                        echo '</td>';
                        echo '<td>';
                        if ($TotalVfullTime != 0){
                                        if(isset($rowCenterValues->VfullTimeOther) && ($rowCenterValues->VfullTimeOther != - 99)) printPercent($rowCenterValues->VfullTimeOther,$TotalVfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->VfullTimeFemale) && ($rowCenterValues->VfullTimeFemale != - 99)) echo $rowCenterValues->VfullTimeFemale;
                        echo '</td><td>';
                        if(isset($rowCenterValues->VfullTimeMale) && ($rowCenterValues->VfullTimeMale != - 99)) echo $rowCenterValues->VfullTimeMale;
                        echo '</td></tr>';
                        echo '<tr align="center"><td align="left">Part Time Employees</td><td>'.$TotalVpartTime.'</td>';
                        echo '<td>';
                        if(isset($rowCenterValues->VpartTimeCauc) && ($rowCenterValues->VpartTimeCauc != - 99)) echo $rowCenterValues->VpartTimeCauc;
                        echo '</td>';
                        echo '<td>';
                        if ($TotalVpartTime != 0){
                                        if(isset($rowCenterValues->VpartTimeCauc) && ($rowCenterValues->VpartTimeCauc != - 99)) printPercent($rowCenterValues->VpartTimeCauc,$TotalVpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->VpartTimeAfrAmer) && ($rowCenterValues->VpartTimeAfrAmer != - 99)) echo $rowCenterValues->VpartTimeAfrAmer;
                        echo '</td>';
                        echo '<td>';
                        if ($TotalVpartTime != 0){
                                        if(isset($rowCenterValues->VpartTimeAfrAmer) && ($rowCenterValues->VpartTimeAfrAmer != - 99)) printPercent($rowCenterValues->VpartTimeAfrAmer,$TotalVpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->VpartTimeOther) && ($rowCenterValues->VpartTimeOther != - 99)) echo $rowCenterValues->VpartTimeOther;
                        echo '</td>';
                        echo '<td>';
                        if ($TotalVpartTime != 0){
                                        if(isset($rowCenterValues->VpartTimeOther) && ($rowCenterValues->VpartTimeOther != - 99)) printPercent($rowCenterValues->VpartTimeOther,$TotalVpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->VpartTimeFemale) && ($rowCenterValues->VpartTimeFemale != - 99)) echo $rowCenterValues->VpartTimeFemale;
                        echo '</td><td>';
                        if(isset($rowCenterValues->VpartTimeMale) && ($rowCenterValues->VpartTimeMale != - 99)) echo $rowCenterValues->VpartTimeMale;
                        echo '</td></tr>';
                        echo '<tr align="center"><td align="left">Board of Directors</td><td>'.$TotalVbod.'</td>';
                        echo '<td>';
                        if(isset($rowCenterValues->VbodCauc) && ($rowCenterValues->VbodCauc != - 99)) echo $rowCenterValues->VbodCauc;
                        echo '</td>';
                        echo '<td>';
                        if ($TotalVbod != 0){
                                        if(isset($rowCenterValues->VbodCauc) && ($rowCenterValues->VbodCauc != - 99)) printPercent($rowCenterValues->VbodCauc,$TotalVbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->VbodAfrAmer) && ($rowCenterValues->VbodAfrAmer != - 99)) echo $rowCenterValues->VbodAfrAmer;
                        echo '</td>';
                        echo '<td>';
                        if ($TotalVbod != 0){
                                        if(isset($rowCenterValues->VbodAfrAmer) && ($rowCenterValues->VbodAfrAmer != - 99)) printPercent($rowCenterValues->VbodAfrAmer,$TotalVbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->VbodOther) && ($rowCenterValues->VbodOther != - 99)) echo $rowCenterValues->VbodOther;
                        echo '</td>';
                        echo '<td>';
                        if ($TotalVbod != 0){
                                        if(isset($rowCenterValues->VbodOther) && ($rowCenterValues->VbodOther != - 99)) printPercent($rowCenterValues->VbodOther,$TotalVbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                        echo '</td><td>';
                        if(isset($rowCenterValues->VbodFemale) && ($rowCenterValues->VbodFemale != - 99)) echo $rowCenterValues->VbodFemale;
                        echo '</td><td>';
                        if(isset($rowCenterValues->VbodMale) && ($rowCenterValues->VbodMale != - 99)) echo $rowCenterValues->VbodMale;
                        echo '</td></tr>';
                        echo '</table>';
                }
?>
                </td></tr>
                </table>
                </center>



</html>


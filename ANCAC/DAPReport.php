<?php
	require("./ulogin.php");
	require("./dbconn.php");
        //set the fiscalYear
        switch (date("m")){
                case 10:
                case 11:
                case 12:
                        $fiscalYear = date("Y") + 1;
                        break;
                case 1:
                case 2:
                case 3:
                        $fiscalYear = date("Y") ;
                        break;
                case 4:
                case 5:
                case 6:
                        $fiscalYear = date("Y");
                        break;
                case 7:
                case 8:
                case 9:
                        $fiscalYear = date("Y");
                        break;
        }

        if($_SESSION['admin'] > 0){
                if(isset($_POST['center']))
                        $centerID = $_POST['center'];
                else
                        $centerID = $_GET['center'];
        }
        else{
                if (isset($_SESSION['center'])){
                        $centerID = $_SESSION['center'];
                }
        }
        
        //Get the fiscal year from the select Year page drop down
        //if(isset($_POST['year']))
        //        $fiscalYear = $_POST['year'];
        //else
        //        $fiscalYear = $_GET['year'];

	$sqlCenter = "SELECT CenterName FROM centers ".
             "WHERE center = '".$centerID."'";
        $resultCenter = @mysql_query($sqlCenter) or mysql_error();
        $rowCenter = mysql_fetch_object($resultCenter);
        $CenterName = $rowCenter->CenterName;

	$page_title = 'ANCAC: Diversity Action Plan Report for '.$CenterName;
	require("./header.php");

	function printPercent($TopNumber, $BottomNumber){
                $percent = ($TopNumber/$BottomNumber) * 100;
                echo number_format($percent,2).'%';
         }
?>

<body>
<table class='OutlineTable' align=center width="65%">
<tr>
	<td class='login-header' colspan='2' align=center><? echo $CenterName; ?> Diversity Action Plan Report - FY <? echo $fiscalYear; ?><br /></td>
</tr>
<tr>
	<td class='login' align=left>
	<center>
		<table border="0" width="100%" id="table1">
		<tr>
			<td>
			<? //grab all the counties for a given Center
			     $sqlCounty = "SELECT county".
                                " FROM countyLU ".
                                "WHERE center = ".$centerID;

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
                        ?>

                <table width="100%" class="Admin">
                <tr><td colspan="10" style="font-size: 14px"><b><center>Cultural Diversity Action Plan</center></b></td></tr>
                <tr><td colspan="10"><br />The CAC promotes policies and practices that are culturally competent.  Cultural competency is defined as the capacity to function in more than one culture, requiring the ability to appreciate, understand, and interact with members of diverse populations within our community.<br />&nbsp;</td></tr>
                <tr><td colspan="6"><b>Child Advocacy Center: </b><?php echo $CenterName; ?></td><td colspan="4"><b>Reporting Date: </b><?php echo date("M d Y"); ?></td></tr>
                <tr><td colspan="10"><b>County(ies) Served Per CAC Incorporation/Bylaws: </b><?php echo $Counties; ?></td></tr>
                <tr><td colspan="10">&nbsp;</td></tr>
                <tr><td colspan="10" style="font-size: 14px"><b><center>Breakdown</center></b></td></tr>
                <tr class="BoldText"><td colspan="2">&nbsp;</td><td colspan="2"><center>Caucasian</center></td><td colspan="2"><center>African American</center></td><td colspan="2"><center>Other</center></td><td colspan="2">&nbsp;</td></tr>
                <tr class="BoldText"><td>Current Statistical Makeup</td><td><center>Total</center></td><td><center>#</center></td><td><center>%</center></td><td><center>#</center></td><td><center>%</center></td><td><center>#</center></td><td><center>%</center></td><td colspan="2">&nbsp;</td></tr>
                <?php
                        $sqlCounty = "SELECT county".
                                " FROM countyLU ".
                                "WHERE center = ".$centerID;

                        $resultCounty = @mysql_query($sqlCounty) or mysql_error();

                        while ($rowCounty = mysql_fetch_object($resultCounty)) {
                                echo '<tr align="center"><td align="left">'.$rowCounty->county.' County Population</td>';
                                        $sqlCountyValues = "SELECT caucasian, afrAmerican, other FROM divActCounty WHERE center = ".$centerID." AND ".
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
                ?>
                <tr><td colspan="8">&nbsp;</td><td colspan="2"><center><b>Gender Ratio</b></center></td></tr>
                <tr class="BoldText"><td>Total County / Community Population</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><center>Female</center></td><td><center>Male</center></td></tr>
                <?php
                        $sqlCenterValues = "SELECT fullTimeCauc, fullTimeAfrAmer, fullTimeOther, fullTimeMale, fullTimeFemale, ".
                                "partTimeCauc, partTimeAfrAmer, partTimeOther, partTimeMale, partTimeFemale, bodCauc, bodAfrAmer, ".
                                "bodOther, bodMale, bodFemale, volCauc, volAfrAmer, volOther, volMale, volFemale, internCauc, ".
                                "internAfrAmer, internOther, internMale, internFemale, VfullTimeCauc, VfullTimeAfrAmer, ".
                                "VfullTimeOther, VfullTimeMale, VfullTimeFemale, VpartTimeCauc, VpartTimeAfrAmer, VpartTimeOther, ".
                                "VpartTimeMale, VpartTimeFemale, VbodCauc, VbodAfrAmer, VbodOther, VbodMale, VbodFemale ".
                                "FROM divActCenter WHERE center = ".$centerID." AND fiscalyear = ".$fiscalYear;
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
                ?>
                <tr align="center"><td align="left">Full Time Employees</td><td><?php echo $TotalfullTime; ?></td>
                <td><?php if(isset($rowCenterValues->fullTimeCauc) && ($rowCenterValues->fullTimeCauc != - 99)) echo $rowCenterValues->fullTimeCauc;
                    ?></td>
                <td><?php if ($TotalfullTime != 0){
                                        if(isset($rowCenterValues->fullTimeCauc) && ($rowCenterValues->fullTimeCauc != - 99)) printPercent($rowCenterValues->fullTimeCauc,$TotalfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->fullTimeAfrAmer) && ($rowCenterValues->fullTimeAfrAmer != - 99)) echo $rowCenterValues->fullTimeAfrAmer;
                         ?></td>
                <td><?php if ($TotalfullTime != 0){
                                        if(isset($rowCenterValues->fullTimeAfrAmer) && ($rowCenterValues->fullTimeAfrAmer != - 99)) printPercent($rowCenterValues->fullTimeAfrAmer,$TotalfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->fullTimeOther) && ($rowCenterValues->fullTimeOther != - 99)) echo $rowCenterValues->fullTimeOther;
                           ?></td>
                <td><?php if ($TotalfullTime != 0){
                                        if(isset($rowCenterValues->fullTimeOther) && ($rowCenterValues->fullTimeOther != - 99)) printPercent($rowCenterValues->fullTimeOther,$TotalfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->fullTimeFemale) && ($rowCenterValues->fullTimeFemale != - 99)) echo $rowCenterValues->fullTimeFemale;
                         ?></td><td><?php if(isset($rowCenterValues->fullTimeMale) && ($rowCenterValues->fullTimeMale != - 99)) echo $rowCenterValues->fullTimeMale;
                         ?></td></tr>
                <!-- Part Time Employees -->
                <tr align="center"><td align="left">Part Time Employees</td><td><?php echo $TotalpartTime; ?></td>
                <td><?php if(isset($rowCenterValues->partTimeCauc) && ($rowCenterValues->partTimeCauc != - 99)) echo $rowCenterValues->partTimeCauc;
                    ?></td>
                <td><?php if ($TotalpartTime != 0){
                                        if(isset($rowCenterValues->partTimeCauc) && ($rowCenterValues->partTimeCauc != - 99)) printPercent($rowCenterValues->partTimeCauc,$TotalpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->partTimeAfrAmer) && ($rowCenterValues->partTimeAfrAmer != - 99)) echo $rowCenterValues->partTimeAfrAmer;
                         ?></td>
                <td><?php if ($TotalpartTime != 0){
                                        if(isset($rowCenterValues->partTimeAfrAmer) && ($rowCenterValues->partTimeAfrAmer != - 99)) printPercent($rowCenterValues->partTimeAfrAmer,$TotalpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->partTimeOther) && ($rowCenterValues->partTimeOther != - 99)) echo $rowCenterValues->partTimeOther;
                           ?></td>
                <td><?php if ($TotalpartTime != 0){
                                        if(isset($rowCenterValues->partTimeOther) && ($rowCenterValues->partTimeOther != - 99)) printPercent($rowCenterValues->partTimeOther,$TotalpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->partTimeFemale) && ($rowCenterValues->partTimeFemale != - 99)) echo $rowCenterValues->partTimeFemale;
                         ?></td><td><?php if(isset($rowCenterValues->partTimeMale) && ($rowCenterValues->partTimeMale != - 99)) echo $rowCenterValues->partTimeMale;
                         ?></td></tr>
                <!-- Board of Directors -->
                <tr align="center"><td align="left">Board of Directors</td><td><?php echo $Totalbod; ?></td>
                <td><?php if(isset($rowCenterValues->bodCauc) && ($rowCenterValues->bodCauc != - 99)) echo $rowCenterValues->bodCauc;
                    ?></td>
                <td><?php if ($Totalbod != 0){
                                        if(isset($rowCenterValues->bodCauc) && ($rowCenterValues->bodCauc != - 99)) printPercent($rowCenterValues->bodCauc,$Totalbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->bodAfrAmer) && ($rowCenterValues->bodAfrAmer != - 99)) echo $rowCenterValues->bodAfrAmer;
                         ?></td>
                <td><?php if ($Totalbod != 0){
                                        if(isset($rowCenterValues->bodAfrAmer) && ($rowCenterValues->bodAfrAmer != - 99)) printPercent($rowCenterValues->bodAfrAmer,$Totalbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->bodOther) && ($rowCenterValues->bodOther != - 99)) echo $rowCenterValues->bodOther;
                           ?></td>
                <td><?php if ($Totalbod != 0){
                                        if(isset($rowCenterValues->bodOther) && ($rowCenterValues->bodOther != - 99)) printPercent($rowCenterValues->bodOther,$Totalbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->bodFemale) && ($rowCenterValues->bodFemale != -99)) echo $rowCenterValues->bodFemale;
                         ?></td><td><?php if(isset($rowCenterValues->bodMale) && ($rowCenterValues->bodMale != - 99)) echo $rowCenterValues->bodMale;
                         ?></td></tr>
                <!-- Volunteers -->
                <tr align="center"><td align="left">Volunteers</td><td><?php echo $Totalvol; ?></td>
                <td><?php if(isset($rowCenterValues->volCauc) && ($rowCenterValues->volCauc != - 99)) echo $rowCenterValues->volCauc;
                    ?></td>
                <td><?php if ($Totalvol != 0){
                                        if(isset($rowCenterValues->volCauc) && ($rowCenterValues->volCauc != - 99)) printPercent($rowCenterValues->volCauc,$Totalvol);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->volAfrAmer) && ($rowCenterValues->volAfrAmer != - 99)) echo $rowCenterValues->volAfrAmer;
                         ?></td>
                <td><?php if ($Totalvol != 0){
                                        if(isset($rowCenterValues->volAfrAmer) && ($rowCenterValues->volAfrAmer != - 99)) printPercent($rowCenterValues->volAfrAmer,$Totalvol);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->volOther) && ($rowCenterValues->volOther != - 99)) echo $rowCenterValues->volOther;
                           ?></td>
                <td><?php if ($Totalvol != 0){
                                        if(isset($rowCenterValues->volOther) && ($rowCenterValues->volOther != - 99)) printPercent($rowCenterValues->volOther,$Totalvol);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->volFemale) && ($rowCenterValues->volFemale != - 99)) echo $rowCenterValues->volFemale;
                         ?></td><td><?php if(isset($rowCenterValues->volMale) && ($rowCenterValues->volMale != - 99)) echo $rowCenterValues->volMale;
                         ?></td></tr>
                <!-- Interns -->
                <tr align="center"><td align="left">Interns</td><td><?php echo $Totalintern; ?></td>
                <td><?php if(isset($rowCenterValues->internCauc) && ($rowCenterValues->internCauc != - 99)) echo $rowCenterValues->internCauc;
                    ?></td>
                <td><?php if ($Totalintern != 0){
                                        if(isset($rowCenterValues->internCauc) && ($rowCenterValues->internCauc != - 99)) printPercent($rowCenterValues->internCauc,$Totalintern);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->internAfrAmer) && ($rowCenterValues->internAfrAmer != - 99)) echo $rowCenterValues->internAfrAmer;
                         ?></td>
                <td><?php if ($Totalintern != 0){
                                        if(isset($rowCenterValues->internAfrAmer) && ($rowCenterValues->internAfrAmer != - 99)) printPercent($rowCenterValues->internAfrAmer,$Totalintern);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->internOther) && ($rowCenterValues->internOther != - 99)) echo $rowCenterValues->internOther;
                           ?></td>
                <td><?php if ($Totalintern != 0){
                                        if(isset($rowCenterValues->internOther) && ($rowCenterValues->internOther != - 99)) printPercent($rowCenterValues->internOther,$Totalintern);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->internFemale) && ($rowCenterValues->internFemale != - 99)) echo $rowCenterValues->internFemale;
                         ?></td><td><?php if(isset($rowCenterValues->internMale) && ($rowCenterValues->internMale != - 99)) echo $rowCenterValues->internMale;
                         ?></td></tr>
                <tr><td colspan="10">&nbsp;</td></tr>
                <tr class="BoldText"><td colspan="2">&nbsp;</td><td colspan="2"><center>Caucasian</center></td><td colspan="2"><center>African American</center></td><td colspan="2"><center>Other</center></td><td colspan="2">&nbsp;</td></tr>
                <tr class="BoldText"><td>Vacancies Filled during Reporting Period</td><td><center>Total</center></td><td><center>#</center></td><td><center>%</center></td><td><center>#</center></td><td><center>%</center></td><td><center>#</center></td><td><center>%</center></td><td colspan="2">&nbsp;</td></tr>
                <!-- Full Time EMployees Vacancy -->
                <tr align="center"><td align="left">Full Time Employees</td><td><?php echo $TotalVfullTime; ?></td>
                <td><?php if(isset($rowCenterValues->VfullTimeCauc) && ($rowCenterValues->VfullTimeCauc != - 99)) echo $rowCenterValues->VfullTimeCauc;
                    ?></td>
                <td><?php if ($TotalVfullTime != 0){
                                        if(isset($rowCenterValues->VfullTimeCauc) && ($rowCenterValues->VfullTimeCauc != - 99)) printPercent($rowCenterValues->VfullTimeCauc,$TotalVfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->VfullTimeAfrAmer) && ($rowCenterValues->VfullTimeAfrAmer != - 99)) echo $rowCenterValues->VfullTimeAfrAmer;
                         ?></td>
                <td><?php if ($TotalVfullTime != 0){
                                        if(isset($rowCenterValues->VfullTimeAfrAmer) && ($rowCenterValues->VfullTimeAfrAmer != - 99)) printPercent($rowCenterValues->VfullTimeAfrAmer,$TotalVfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->VfullTimeOther) && ($rowCenterValues->VfullTimeOther != - 99)) echo $rowCenterValues->VfullTimeOther;
                           ?></td>
                <td><?php if ($TotalVfullTime != 0){
                                        if(isset($rowCenterValues->VfullTimeOther) && ($rowCenterValues->VfullTimeOther != - 99)) printPercent($rowCenterValues->VfullTimeOther,$TotalVfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->VfullTimeFemale) && ($rowCenterValues->VfullTimeFemale != - 99)) echo $rowCenterValues->VfullTimeFemale;
                         ?></td><td><?php if(isset($rowCenterValues->VfullTimeMale) && ($rowCenterValues->VfullTimeMale != - 99)) echo $rowCenterValues->VfullTimeMale;
                         ?></td></tr>
                <!-- Part Time Employees Vacancy -->
                <tr align="center"><td align="left">Part Time Employees</td><td><?php echo $TotalVpartTime; ?></td>
                <td><?php if(isset($rowCenterValues->VpartTimeCauc) && ($rowCenterValues->VpartTimeCauc != - 99)) echo $rowCenterValues->VpartTimeCauc;
                    ?></td>
                <td><?php if ($TotalVpartTime != 0){
                                        if(isset($rowCenterValues->VpartTimeCauc) && ($rowCenterValues->VpartTimeCauc != - 99)) printPercent($rowCenterValues->VpartTimeCauc,$TotalVpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->VpartTimeAfrAmer) && ($rowCenterValues->VpartTimeAfrAmer != - 99)) echo $rowCenterValues->VpartTimeAfrAmer;
                         ?></td>
                <td><?php if ($TotalVpartTime != 0){
                                        if(isset($rowCenterValues->VpartTimeAfrAmer) && ($rowCenterValues->VpartTimeAfrAmer != - 99)) printPercent($rowCenterValues->VpartTimeAfrAmer,$TotalVpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->VpartTimeOther) && ($rowCenterValues->VpartTimeOther != - 99)) echo $rowCenterValues->VpartTimeOther;
                           ?></td>
                <td><?php if ($TotalVpartTime != 0){
                                        if(isset($rowCenterValues->VpartTimeOther) && ($rowCenterValues->VpartTimeOther != - 99)) printPercent($rowCenterValues->VpartTimeOther,$TotalVpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->VpartTimeFemale) && ($rowCenterValues->VpartTimeFemale != - 99)) echo $rowCenterValues->VpartTimeFemale;
                         ?></td><td><?php if(isset($rowCenterValues->VpartTimeMale) && ($rowCenterValues->VpartTimeMale != - 99)) echo $rowCenterValues->VpartTimeMale;
                         ?></td></tr>
                <!-- Board of Directors Vacancy -->
                <tr align="center"><td align="left">Board of Directors</td><td><?php echo $TotalVbod; ?></td>
                <td><?php if(isset($rowCenterValues->VbodCauc) && ($rowCenterValues->VbodCauc != - 99)) echo $rowCenterValues->VbodCauc;
                    ?></td>
                <td><?php if ($TotalVbod != 0){
                                        if(isset($rowCenterValues->VbodCauc) && ($rowCenterValues->VbodCauc != - 99)) printPercent($rowCenterValues->VbodCauc,$TotalVbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->VbodAfrAmer) && ($rowCenterValues->VbodAfrAmer != - 99)) echo $rowCenterValues->VbodAfrAmer;
                         ?></td>
                <td><?php if ($TotalVbod != 0){
                                        if(isset($rowCenterValues->VbodAfrAmer) && ($rowCenterValues->VbodAfrAmer != - 99)) printPercent($rowCenterValues->VbodAfrAmer,$TotalVbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->VbodOther) && ($rowCenterValues->VbodOther != - 99)) echo $rowCenterValues->VbodOther;
                           ?></td>
                <td><?php if ($TotalVbod != 0){
                                        if(isset($rowCenterValues->VbodOther) && ($rowCenterValues->VbodOther != - 99)) printPercent($rowCenterValues->VbodOther,$TotalVbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php if(isset($rowCenterValues->VbodFemale) && ($rowCenterValues->VbodFemale != - 99)) echo $rowCenterValues->VbodFemale;
                         ?></td><td><?php if(isset($rowCenterValues->VbodMale) && ($rowCenterValues->VbodMale != - 99)) echo $rowCenterValues->VbodMale;
                         ?></td></tr>
                </table>
			</td>
		</tr>
		<tr>
		      <td>
		              <center><div class=nav><?php echo '<a href="eoyreports.php?center='.$centerID.'">Return to End of Year Reports Main Menu</a>'; ?></div></center>
		      </td>
		</tr>
		</table>
	</center>
	</td>
</tr>
</table>
</body>
<?php
	require("./footer.php");
?>



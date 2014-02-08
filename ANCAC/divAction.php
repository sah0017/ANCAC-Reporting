<?
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/ulogin.php");
	require("/home/cluster1/data/a/p/a1224426/data/dbconn.php");
        //set the fiscalYear
        switch (date("m")){
                case 10:
                        $EOYAvailable = 1;
                        $fiscalYear = date("Y") + 1;
                        break;
                case 11:
                case 12:
                        $fiscalYear = date("Y") + 1;
                        $EOYAvailable = 0;
                        break;
                case 1:
                case 2:
                case 3:
                        $fiscalYear = date("Y") ;
                        $EOYAvailable = 0;
                        break;
                case 4:
                case 5:
                case 6:
                        $fiscalYear = date("Y");
                        $EOYAvailable = 0;
                        break;
                case 7:
                case 8:
                case 9:
                        $fiscalYear = date("Y");
                        $EOYAvailable = 0;
                        break;
        }
        $CY = 0;
        //set the center that is being edited for
        if($_SESSION['admin'] > 0){
                //Center
                if (isset($_GET['center'])){
                        $centerID = $_GET['center'];
                }
                if (isset($_GET['Y'])){
                        if ($_GET['Y'] == 1){
                                $fiscalYear = $fiscalYear - 1;
                                $CY = 1;
                        }
                }
                $EOYAvailable = 1;
        }
        else{
                //center
                if (isset($_SESSION['center'])){
                        $centerID = $_SESSION['center'];
                }
        }

	$sqlCenter = "SELECT CenterName FROM centers ".
             "WHERE center = '".$centerID."'";
        $resultCenter = @mysql_query($sqlCenter) or mysql_error();
        $rowCenter = mysql_fetch_object($resultCenter);
        $CenterName = $rowCenter->CenterName;

	$page_title = 'ANCAC: Diversity Action Plan for '.$CenterName;
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/header.php");

	function printPercent($TopNumber, $BottomNumber){
                $percent = ($TopNumber/$BottomNumber) * 100;
                echo number_format($percent,2).'%';
         }
?>

<body>
<table class='OutlineTable' align=center width="95%">
<tr>
	<td class='login-header' colspan='2' align=center><? echo $CenterName; ?> Diversity Action Plan - FY <? echo $fiscalYear; ?><br /></td>
</tr>
<tr>
	<td class='login' align=left>
	<center>
		<table border="0" width="100%" id="table1">
		<tr>
			<td>
			<form action="updateDAP.php" method="post">
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
                                echo '<td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="cauc'.$rowCounty->county.'"
                                value="';
                                if(isset($rowCountyValues->caucasian) && ($rowCountyValues->caucasian != - 99)) echo $rowCountyValues->caucasian;
                                echo '" /></td>';
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
                                echo '<td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="afrAmer'.$rowCounty->county.'"
                                value="';
                                if(isset($rowCountyValues->afrAmerican) && ($rowCountyValues->afrAmerican != - 99)) echo $rowCountyValues->afrAmerican;
                                echo '" /></td>';
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
                                echo '<td><input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="other'.$rowCounty->county.'"
                                value="';
                                if(isset($rowCountyValues->other) && ($rowCountyValues->other != - 99)) echo $rowCountyValues->other;
                                echo '" /></td>';
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
                <td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fullTimeCauc"
                                value="';
                                if(isset($rowCenterValues->fullTimeCauc) && ($rowCenterValues->fullTimeCauc != - 99)) echo $rowCenterValues->fullTimeCauc;
                                echo '" />';
                    ?></td>
                <td><?php if ($TotalfullTime != 0){
                                        if(isset($rowCenterValues->fullTimeCauc) && ($rowCenterValues->fullTimeCauc != - 99)) printPercent($rowCenterValues->fullTimeCauc,$TotalfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fullTimeAfrAmer"
                                value="';
                                if(isset($rowCenterValues->fullTimeAfrAmer) && ($rowCenterValues->fullTimeAfrAmer != - 99)) echo $rowCenterValues->fullTimeAfrAmer;
                                echo '" />';
                         ?></td>
                <td><?php if ($TotalfullTime != 0){
                                        if(isset($rowCenterValues->fullTimeAfrAmer) && ($rowCenterValues->fullTimeAfrAmer != - 99)) printPercent($rowCenterValues->fullTimeAfrAmer,$TotalfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fullTimeOther"
                                value="';
                                if(isset($rowCenterValues->fullTimeOther) && ($rowCenterValues->fullTimeOther != - 99)) echo $rowCenterValues->fullTimeOther;
                                echo '" />';
                           ?></td>
                <td><?php if ($TotalfullTime != 0){
                                        if(isset($rowCenterValues->fullTimeOther) && ($rowCenterValues->fullTimeOther != - 99)) printPercent($rowCenterValues->fullTimeOther,$TotalfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fullTimeFemale"
                                value="';
                                if(isset($rowCenterValues->fullTimeFemale) && ($rowCenterValues->fullTimeFemale != - 99)) echo $rowCenterValues->fullTimeFemale;
                                echo '" />';
                         ?></td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="fullTimeMale"
                                value="';
                                if(isset($rowCenterValues->fullTimeMale) && ($rowCenterValues->fullTimeMale != - 99)) echo $rowCenterValues->fullTimeMale;
                                echo '" />';
                         ?></td></tr>
                <!-- Part Time Employees -->
                <tr align="center"><td align="left">Part Time Employees</td><td><?php echo $TotalpartTime; ?></td>
                <td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="partTimeCauc"
                                value="';
                                if(isset($rowCenterValues->partTimeCauc) && ($rowCenterValues->partTimeCauc != - 99)) echo $rowCenterValues->partTimeCauc;
                                echo '" />';
                    ?></td>
                <td><?php if ($TotalpartTime != 0){
                                        if(isset($rowCenterValues->partTimeCauc) && ($rowCenterValues->partTimeCauc != - 99)) printPercent($rowCenterValues->partTimeCauc,$TotalpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="partTimeAfrAmer"
                                value="';
                                if(isset($rowCenterValues->partTimeAfrAmer) && ($rowCenterValues->partTimeAfrAmer != - 99)) echo $rowCenterValues->partTimeAfrAmer;
                                echo '" />';
                         ?></td>
                <td><?php if ($TotalpartTime != 0){
                                        if(isset($rowCenterValues->partTimeAfrAmer) && ($rowCenterValues->partTimeAfrAmer != - 99)) printPercent($rowCenterValues->partTimeAfrAmer,$TotalpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="partTimeOther"
                                value="';
                                if(isset($rowCenterValues->partTimeOther) && ($rowCenterValues->partTimeOther != - 99)) echo $rowCenterValues->partTimeOther;
                                echo '" />';
                           ?></td>
                <td><?php if ($TotalpartTime != 0){
                                        if(isset($rowCenterValues->partTimeOther) && ($rowCenterValues->partTimeOther != - 99)) printPercent($rowCenterValues->partTimeOther,$TotalpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="partTimeFemale"
                                value="';
                                if(isset($rowCenterValues->partTimeFemale) && ($rowCenterValues->partTimeFemale != - 99)) echo $rowCenterValues->partTimeFemale;
                                echo '" />';
                         ?></td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="partTimeMale"
                                value="';
                                if(isset($rowCenterValues->partTimeMale) && ($rowCenterValues->partTimeMale != - 99)) echo $rowCenterValues->partTimeMale;
                                echo '" />';
                         ?></td></tr>
                <!-- Board of Directors -->
                <tr align="center"><td align="left">Board of Directors</td><td><?php echo $Totalbod; ?></td>
                <td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="bodCauc"
                                value="';
                                if(isset($rowCenterValues->bodCauc) && ($rowCenterValues->bodCauc != - 99)) echo $rowCenterValues->bodCauc;
                                echo '" />';
                    ?></td>
                <td><?php if ($Totalbod != 0){
                                        if(isset($rowCenterValues->bodCauc) && ($rowCenterValues->bodCauc != - 99)) printPercent($rowCenterValues->bodCauc,$Totalbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="bodAfrAmer"
                                value="';
                                if(isset($rowCenterValues->bodAfrAmer) && ($rowCenterValues->bodAfrAmer != - 99)) echo $rowCenterValues->bodAfrAmer;
                                echo '" />';
                         ?></td>
                <td><?php if ($Totalbod != 0){
                                        if(isset($rowCenterValues->bodAfrAmer) && ($rowCenterValues->bodAfrAmer != - 99)) printPercent($rowCenterValues->bodAfrAmer,$Totalbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="bodOther"
                                value="';
                                if(isset($rowCenterValues->bodOther) && ($rowCenterValues->bodOther != - 99)) echo $rowCenterValues->bodOther;
                                echo '" />';
                           ?></td>
                <td><?php if ($Totalbod != 0){
                                        if(isset($rowCenterValues->bodOther) && ($rowCenterValues->bodOther != - 99)) printPercent($rowCenterValues->bodOther,$Totalbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="bodFemale"
                                value="';
                                if(isset($rowCenterValues->bodFemale) && ($rowCenterValues->bodFemale != -99)) echo $rowCenterValues->bodFemale;
                                echo '" />';
                         ?></td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="bodMale"
                                value="';
                                if(isset($rowCenterValues->bodMale) && ($rowCenterValues->bodMale != - 99)) echo $rowCenterValues->bodMale;
                                echo '" />';
                         ?></td></tr>
                <!-- Volunteers -->
                <tr align="center"><td align="left">Volunteers</td><td><?php echo $Totalvol; ?></td>
                <td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="volCauc"
                                value="';
                                if(isset($rowCenterValues->volCauc) && ($rowCenterValues->volCauc != - 99)) echo $rowCenterValues->volCauc;
                                echo '" />';
                    ?></td>
                <td><?php if ($Totalvol != 0){
                                        if(isset($rowCenterValues->volCauc) && ($rowCenterValues->volCauc != - 99)) printPercent($rowCenterValues->volCauc,$Totalvol);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="volAfrAmer"
                                value="';
                                if(isset($rowCenterValues->volAfrAmer) && ($rowCenterValues->volAfrAmer != - 99)) echo $rowCenterValues->volAfrAmer;
                                echo '" />';
                         ?></td>
                <td><?php if ($Totalvol != 0){
                                        if(isset($rowCenterValues->volAfrAmer) && ($rowCenterValues->volAfrAmer != - 99)) printPercent($rowCenterValues->volAfrAmer,$Totalvol);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="volOther"
                                value="';
                                if(isset($rowCenterValues->volOther) && ($rowCenterValues->volOther != - 99)) echo $rowCenterValues->volOther;
                                echo '" />';
                           ?></td>
                <td><?php if ($Totalvol != 0){
                                        if(isset($rowCenterValues->volOther) && ($rowCenterValues->volOther != - 99)) printPercent($rowCenterValues->volOther,$Totalvol);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="volFemale"
                                value="';
                                if(isset($rowCenterValues->volFemale) && ($rowCenterValues->volFemale != - 99)) echo $rowCenterValues->volFemale;
                                echo '" />';
                         ?></td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="volMale"
                                value="';
                                if(isset($rowCenterValues->volMale) && ($rowCenterValues->volMale != - 99)) echo $rowCenterValues->volMale;
                                echo '" />';
                         ?></td></tr>
                <!-- Interns -->
                <tr align="center"><td align="left">Interns</td><td><?php echo $Totalintern; ?></td>
                <td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="internCauc"
                                value="';
                                if(isset($rowCenterValues->internCauc) && ($rowCenterValues->internCauc != - 99)) echo $rowCenterValues->internCauc;
                                echo '" />';
                    ?></td>
                <td><?php if ($Totalintern != 0){
                                        if(isset($rowCenterValues->internCauc) && ($rowCenterValues->internCauc != - 99)) printPercent($rowCenterValues->internCauc,$Totalintern);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="internAfrAmer"
                                value="';
                                if(isset($rowCenterValues->internAfrAmer) && ($rowCenterValues->internAfrAmer != - 99)) echo $rowCenterValues->internAfrAmer;
                                echo '" />';
                         ?></td>
                <td><?php if ($Totalintern != 0){
                                        if(isset($rowCenterValues->internAfrAmer) && ($rowCenterValues->internAfrAmer != - 99)) printPercent($rowCenterValues->internAfrAmer,$Totalintern);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="internOther"
                                value="';
                                if(isset($rowCenterValues->internOther) && ($rowCenterValues->internOther != - 99)) echo $rowCenterValues->internOther;
                                echo '" />';
                           ?></td>
                <td><?php if ($Totalintern != 0){
                                        if(isset($rowCenterValues->internOther) && ($rowCenterValues->internOther != - 99)) printPercent($rowCenterValues->internOther,$Totalintern);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="internFemale"
                                value="';
                                if(isset($rowCenterValues->internFemale) && ($rowCenterValues->internFemale != - 99)) echo $rowCenterValues->internFemale;
                                echo '" />';
                         ?></td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="internMale"
                                value="';
                                if(isset($rowCenterValues->internMale) && ($rowCenterValues->internMale != - 99)) echo $rowCenterValues->internMale;
                                echo '" />';
                         ?></td></tr>
                <tr><td colspan="10">&nbsp;</td></tr>
                <tr class="BoldText"><td colspan="2">&nbsp;</td><td colspan="2"><center>Caucasian</center></td><td colspan="2"><center>African American</center></td><td colspan="2"><center>Other</center></td><td colspan="2">&nbsp;</td></tr>
                <tr class="BoldText"><td>Vacancies Filled during Reporting Period</td><td><center>Total</center></td><td><center>#</center></td><td><center>%</center></td><td><center>#</center></td><td><center>%</center></td><td><center>#</center></td><td><center>%</center></td><td colspan="2">&nbsp;</td></tr>
                <!-- Full Time EMployees Vacancy -->
                <tr align="center"><td align="left">Full Time Employees</td><td><?php echo $TotalVfullTime; ?></td>
                <td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="VfullTimeCauc"
                                value="';
                                if(isset($rowCenterValues->VfullTimeCauc) && ($rowCenterValues->VfullTimeCauc != - 99)) echo $rowCenterValues->VfullTimeCauc;
                                echo '" />';
                    ?></td>
                <td><?php if ($TotalVfullTime != 0){
                                        if(isset($rowCenterValues->VfullTimeCauc) && ($rowCenterValues->VfullTimeCauc != - 99)) printPercent($rowCenterValues->VfullTimeCauc,$TotalVfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="VfullTimeAfrAmer"
                                value="';
                                if(isset($rowCenterValues->VfullTimeAfrAmer) && ($rowCenterValues->VfullTimeAfrAmer != - 99)) echo $rowCenterValues->VfullTimeAfrAmer;
                                echo '" />';
                         ?></td>
                <td><?php if ($TotalVfullTime != 0){
                                        if(isset($rowCenterValues->VfullTimeAfrAmer) && ($rowCenterValues->VfullTimeAfrAmer != - 99)) printPercent($rowCenterValues->VfullTimeAfrAmer,$TotalVfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="VfullTimeOther"
                                value="';
                                if(isset($rowCenterValues->VfullTimeOther) && ($rowCenterValues->VfullTimeOther != - 99)) echo $rowCenterValues->VfullTimeOther;
                                echo '" />';
                           ?></td>
                <td><?php if ($TotalVfullTime != 0){
                                        if(isset($rowCenterValues->VfullTimeOther) && ($rowCenterValues->VfullTimeOther != - 99)) printPercent($rowCenterValues->VfullTimeOther,$TotalVfullTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="VfullTimeFemale"
                                value="';
                                if(isset($rowCenterValues->VfullTimeFemale) && ($rowCenterValues->VfullTimeFemale != - 99)) echo $rowCenterValues->VfullTimeFemale;
                                echo '" />';
                         ?></td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="VfullTimeMale"
                                value="';
                                if(isset($rowCenterValues->VfullTimeMale) && ($rowCenterValues->VfullTimeMale != - 99)) echo $rowCenterValues->VfullTimeMale;
                                echo '" />';
                         ?></td></tr>
                <!-- Part Time Employees Vacancy -->
                <tr align="center"><td align="left">Part Time Employees</td><td><?php echo $TotalVpartTime; ?></td>
                <td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="VpartTimeCauc"
                                value="';
                                if(isset($rowCenterValues->VpartTimeCauc) && ($rowCenterValues->VpartTimeCauc != - 99)) echo $rowCenterValues->VpartTimeCauc;
                                echo '" />';
                    ?></td>
                <td><?php if ($TotalVpartTime != 0){
                                        if(isset($rowCenterValues->VpartTimeCauc) && ($rowCenterValues->VpartTimeCauc != - 99)) printPercent($rowCenterValues->VpartTimeCauc,$TotalVpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="VpartTimeAfrAmer"
                                value="';
                                if(isset($rowCenterValues->VpartTimeAfrAmer) && ($rowCenterValues->VpartTimeAfrAmer != - 99)) echo $rowCenterValues->VpartTimeAfrAmer;
                                echo '" />';
                         ?></td>
                <td><?php if ($TotalVpartTime != 0){
                                        if(isset($rowCenterValues->VpartTimeAfrAmer) && ($rowCenterValues->VpartTimeAfrAmer != - 99)) printPercent($rowCenterValues->VpartTimeAfrAmer,$TotalVpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="VpartTimeOther"
                                value="';
                                if(isset($rowCenterValues->VpartTimeOther) && ($rowCenterValues->VpartTimeOther != - 99)) echo $rowCenterValues->VpartTimeOther;
                                echo '" />';
                           ?></td>
                <td><?php if ($TotalVpartTime != 0){
                                        if(isset($rowCenterValues->VpartTimeOther) && ($rowCenterValues->VpartTimeOther != - 99)) printPercent($rowCenterValues->VpartTimeOther,$TotalVpartTime);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="VpartTimeFemale"
                                value="';
                                if(isset($rowCenterValues->VpartTimeFemale) && ($rowCenterValues->VpartTimeFemale != - 99)) echo $rowCenterValues->VpartTimeFemale;
                                echo '" />';
                         ?></td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="VpartTimeMale"
                                value="';
                                if(isset($rowCenterValues->VpartTimeMale) && ($rowCenterValues->VpartTimeMale != - 99)) echo $rowCenterValues->VpartTimeMale;
                                echo '" />';
                         ?></td></tr>
                <!-- Board of Directors Vacancy -->
                <tr align="center"><td align="left">Board of Directors</td><td><?php echo $TotalVbod; ?></td>
                <td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="VbodCauc"
                                value="';
                                if(isset($rowCenterValues->VbodCauc) && ($rowCenterValues->VbodCauc != - 99)) echo $rowCenterValues->VbodCauc;
                                echo '" />';
                    ?></td>
                <td><?php if ($TotalVbod != 0){
                                        if(isset($rowCenterValues->VbodCauc) && ($rowCenterValues->VbodCauc != - 99)) printPercent($rowCenterValues->VbodCauc,$TotalVbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="VbodAfrAmer"
                                value="';
                                if(isset($rowCenterValues->VbodAfrAmer) && ($rowCenterValues->VbodAfrAmer != - 99)) echo $rowCenterValues->VbodAfrAmer;
                                echo '" />';
                         ?></td>
                <td><?php if ($TotalVbod != 0){
                                        if(isset($rowCenterValues->VbodAfrAmer) && ($rowCenterValues->VbodAfrAmer != - 99)) printPercent($rowCenterValues->VbodAfrAmer,$TotalVbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="VbodOther"
                                value="';
                                if(isset($rowCenterValues->VbodOther) && ($rowCenterValues->VbodOther != - 99)) echo $rowCenterValues->VbodOther;
                                echo '" />';
                           ?></td>
                <td><?php if ($TotalVbod != 0){
                                        if(isset($rowCenterValues->VbodOther) && ($rowCenterValues->VbodOther != - 99)) printPercent($rowCenterValues->VbodOther,$TotalVbod);
                                        else echo 'N/A';
                          }
                          else
                                echo 'N/A';
                     ?>
                </td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="VbodFemale"
                                value="';
                                if(isset($rowCenterValues->VbodFemale) && ($rowCenterValues->VbodFemale != - 99)) echo $rowCenterValues->VbodFemale;
                                echo '" />';
                         ?></td><td><?php echo '<input type="text" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);"
                                onkeypress="return blockNonNumbers(this, event, false, false);" class="TextInput" name="VbodMale"
                                value="';
                                if(isset($rowCenterValues->VbodMale) && ($rowCenterValues->VbodMale != - 99)) echo $rowCenterValues->VbodMale;
                                echo '" />';
                         ?></td></tr>
                </table>
                                <? if ($EOYAvailable == 1){
                                        if ($_SESSION['admin'] != 1)
                                                echo '<p><input type="submit" name="submit" value="Update Diversity Action Plan" /></p>';
                                }
                                ?>
                                <input type="hidden" name="centerID" value="<? echo $centerID; ?>" />
                                <input type="hidden" name="fiscalYear" value="<? echo $fiscalYear; ?>" />
                                <input type="hidden" name="UpdateCenter" value="<? echo $UpdateCenter; ?>" />
                                <input type="hidden" name="CY" value="<? echo $CY; ?>" />
                        </form>
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
<?
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/footer.php");
?>



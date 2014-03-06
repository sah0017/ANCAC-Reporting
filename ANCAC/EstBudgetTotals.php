<?php
	require("./ulogin.php");
	require("./dbconn.php");

	$page_title = 'ANCAC: Estimated Budget Totals';
	require("./header.php");

        $fiscalYear = $_POST['year'];

         function printHeaders(){
                echo '<tr class="BoldText" align="center"><td align="left" width="28%">Center</td><td>QTR</td><td>Forensic Interviews</td><td>Extended Forensic Assessments</td>'.
                        '<td>Initial Counseling Sessions</td><td>Total Services</td></tr>';
         }
         function printTotalHeaders($Title){
                echo '<tr class="BoldText" align="center"><td align="left" width="28%" colspan="2">'.$Title.'</td><td>Forensic Interviews</td><td>Extended Forensic Assessments</td>'.
                        '<td>Initial Counseling Sessions</td><td>Total Services</td></tr>';
         }
?>

<?              //Initialze the GRAND TOTAL variables
                $GRANDTOTAL1fiTotal = 0;
                $GRANDTOTAL1extForenEval = 0;
                $GRANDTOTAL1intCounsSes = 0;
                $GRANDTOTAL1TotalService = 0;
                $GRANDTOTAL2fiTotal = 0;
                $GRANDTOTAL2extForenEval = 0;
                $GRANDTOTAL2intCounsSes = 0;
                $GRANDTOTAL2TotalService = 0;
                $GRANDTOTAL3fiTotal = 0;
                $GRANDTOTAL3extForenEval = 0;
                $GRANDTOTAL3intCounsSes = 0;
                $GRANDTOTAL3TotalService = 0;
                $GRANDTOTAL4fiTotal = 0;
                $GRANDTOTAL4extForenEval = 0;
                $GRANDTOTAL4intCounsSes = 0;
                $GRANDTOTAL4TotalService = 0;

                echo '<center><h2><b>ANCAC: Estimated Budget Totals Report for FY '.$fiscalYear.'</b></h2></center>';
                echo '<center><h3>Children\'s First Plan of Investment</h3></center>';

                //start of the Full Member Totals
                $sqlFullMember = "SELECT center, CenterName FROM `centers` WHERE center not in (0,99) AND centerlevel = 'Full Member' order by center";
                $resultFullMember = @mysql_query($sqlFullMember) or mysql_error();
                
                $numRecFullMember = mysql_num_rows($resultFullMember);
                
                echo '<center><table width="85%" class="Admin">';

                if ($numRecFullMember > 0){
                        echo '<tr class="BoldHeader"><td colspan="6" align="center"><h2>Full Members</h2></td></tr>';
                        printHeaders();
                        $FULL1fiTotal = 0;
                        $FULL1extForenEval = 0;
                        $FULL1intCounsSes = 0;
                        $FULL1TotalService = 0;
                        $FULL2fiTotal = 0;
                        $FULL2extForenEval = 0;
                        $FULL2intCounsSes = 0;
                        $FULL2TotalService = 0;
                        $FULL3fiTotal = 0;
                        $FULL3extForenEval = 0;
                        $FULL3intCounsSes = 0;
                        $FULL3TotalService = 0;
                        $FULL4fiTotal = 0;
                        $FULL4extForenEval = 0;
                        $FULL4intCounsSes = 0;
                        $FULL4TotalService = 0;
                        $counter = 0;

                        while ($rowFullMember = mysql_fetch_object($resultFullMember)) {

                                $sqlLoop = "SELECT fiTotal, extForenEval, intCounsSes, quarter".
                                        " FROM budgetedPerfStats".
                                        " WHERE center = ".$rowFullMember->center." AND".
                                        " fiscalyear = ".$fiscalYear." ORDER BY quarter";

                                $resultLoop = @mysql_query($sqlLoop) or mysql_error();
                                
                                //if ($resultLoop){
                                //        echo '<br>Success.';
                                //}
                                //else {
                                //        echo 'Failure';
                                //        echo '<p>'.mysql_error().'<br><br>Query: '.$sqlLoop.'</p>';
                                //}
                                
                                $numRecLoop = mysql_num_rows($resultLoop);
                                
                                if ($numRecLoop > 0){
                                        //clear and initialize the arrays
                                        $YearfiTotal = 0;
                                        $YearextForenEval = 0;
                                        $YearintCounsSes = 0;
                                        $YearTotalService = 0;

                                        while ($rowLoop = mysql_fetch_object($resultLoop)) {
                                                echo '<tr align="right">';
                                                //Only show the center name for the first quarter
                                                if ($rowLoop->quarter == 1)
                                                        echo '<td align="left">'.$rowFullMember->CenterName.'</td>';
                                                else
                                                        echo '<td></td>';

                                                echo '<td align="center">'.$rowLoop->quarter.'</td>';
                                                echo '<td>'.$rowLoop->fiTotal.'</td>';
                                                $YearfiTotal = $YearfiTotal + $rowLoop->fiTotal;
                                                echo '<td>'.$rowLoop->extForenEval.'</td>';
                                                $YearextForenEval = $YearextForenEval + $rowLoop->extForenEval;
                                                echo '<td>'.$rowLoop->intCounsSes.'</td>';
                                                $YearintCounsSes = $YearintCounsSes + $rowLoop->intCounsSes;
                                                $totalServices = $rowLoop->fiTotal + $rowLoop->extForenEval + $rowLoop->intCounsSes;
                                                echo '<td class="BoldTextRed">'.$totalServices.'</td>';
                                                $YearTotalService = $YearTotalService + $totalServices;
                                                
                                                //Keep track of the Quarter Totals
                                                if ($rowLoop->quarter == 1){
                                                  $FULL1fiTotal = $FULL1fiTotal + $rowLoop->fiTotal;
                                                  $FULL1extForenEval = $FULL1extForenEval + $rowLoop->extForenEval;
                                                  $FULL1intCounsSes = $FULL1intCounsSes + $rowLoop->intCounsSes;
                                                  $FULL1TotalService = $FULL1TotalService + $totalServices;
                                                }
                                                if ($rowLoop->quarter == 2){
                                                  $FULL2fiTotal = $FULL2fiTotal + $rowLoop->fiTotal;
                                                  $FULL2extForenEval = $FULL2extForenEval + $rowLoop->extForenEval;
                                                  $FULL2intCounsSes = $FULL2intCounsSes + $rowLoop->intCounsSes;
                                                  $FULL2TotalService = $FULL2TotalService + $totalServices;
                                                }
                                                if ($rowLoop->quarter == 3){
                                                  $FULL3fiTotal = $FULL3fiTotal + $rowLoop->fiTotal;
                                                  $FULL3extForenEval = $FULL3extForenEval + $rowLoop->extForenEval;
                                                  $FULL3intCounsSes = $FULL3intCounsSes + $rowLoop->intCounsSes;
                                                  $FULL3TotalService = $FULL3TotalService + $totalServices;
                                                }
                                                if ($rowLoop->quarter == 4){
                                                  $FULL4fiTotal = $FULL4fiTotal + $rowLoop->fiTotal;
                                                  $FULL4extForenEval = $FULL4extForenEval + $rowLoop->extForenEval;
                                                  $FULL4intCounsSes = $FULL4intCounsSes + $rowLoop->intCounsSes;
                                                  $FULL4TotalService = $FULL4TotalService + $totalServices;
                                                }
                                        }
                                        echo '<tr align="right" class="BoldTextRed"><td>TOTAL</td><td></td>';
                                        echo '<td>'.$YearfiTotal.'</td>';
                                        echo '<td>'.$YearextForenEval.'</td>';
                                        echo '<td>'.$YearintCounsSes.'</td>';
                                        echo '<td>'.$YearTotalService.'</td>';

                                        echo '<tr><td colspan="6"></td></tr>';
                                }
                                else{
                                        echo '<tr><td colspan="6">There is no Estimated Budget Totals information for '.$rowFullMember->CenterName.'</td></tr>';
                                }
                                $counter = $counter + 1;
                                if ($counter == 5){
                                        echo '</table><div class="page-break"></div><div class="nav"><br /></div><table width="85%" class="Admin">';
                                        printHeaders();
                                        $counter = 0;
                                }
                        }
                        echo '<tr><td colspan="6" align="center"><b><h2>Full Member Totals</h2></b></td></tr>';
                        printTotalHeaders('All Full Member Centers');
                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 1ST QTR</b></td>';
                        echo '<td>'.$FULL1fiTotal.'</td>';
                        $GRANDTOTAL1fiTotal = $GRANDTOTAL1fiTotal + $FULL1fiTotal;
                        echo '<td>'.$FULL1extForenEval.'</td>';
                        $GRANDTOTAL1extForenEval = $GRANDTOTAL1extForenEval + $FULL1extForenEval;
                        echo '<td>'.$FULL1intCounsSes.'</td>';
                        $GRANDTOTAL1intCounsSes = $GRANDTOTAL1intCounsSes + $FULL1intCounsSes;
                        echo '<td class="BoldTextRed">'.$FULL1TotalService.'</td></tr>';
                        $GRANDTOTAL1TotalService = $GRANDTOTAL1TotalService + $FULL1TotalService;
                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 2ND QTR</b></td>';
                        echo '<td>'.$FULL2fiTotal.'</td>';
                        $GRANDTOTAL2fiTotal = $GRANDTOTAL2fiTotal + $FULL2fiTotal;
                        echo '<td>'.$FULL2extForenEval.'</td>';
                        $GRANDTOTAL2extForenEval = $GRANDTOTAL2extForenEval + $FULL2extForenEval;
                        echo '<td>'.$FULL2intCounsSes.'</td>';
                        $GRANDTOTAL2intCounsSes = $GRANDTOTAL2intCounsSes + $FULL2intCounsSes;
                        echo '<td class="BoldTextRed">'.$FULL2TotalService.'</td></tr>';
                        $GRANDTOTAL2TotalService = $GRANDTOTAL2TotalService + $FULL2TotalService;
                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 3RD QTR</b></td>';
                        echo '<td>'.$FULL3fiTotal.'</td>';
                        $GRANDTOTAL3fiTotal = $GRANDTOTAL3fiTotal + $FULL3fiTotal;
                        echo '<td>'.$FULL3extForenEval.'</td>';
                        $GRANDTOTAL3extForenEval = $GRANDTOTAL3extForenEval + $FULL3extForenEval;
                        echo '<td>'.$FULL3intCounsSes.'</td>';
                        $GRANDTOTAL3intCounsSes = $GRANDTOTAL3intCounsSes + $FULL3intCounsSes;
                        echo '<td class="BoldTextRed">'.$FULL3TotalService.'</td></tr>';
                        $GRANDTOTAL3TotalService = $GRANDTOTAL3TotalService + $FULL3TotalService;
                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 4TH QTR</b></td>';
                        echo '<td>'.$FULL4fiTotal.'</td>';
                        $GRANDTOTAL4fiTotal = $GRANDTOTAL4fiTotal + $FULL4fiTotal;
                        echo '<td>'.$FULL4extForenEval.'</td>';
                        $GRANDTOTAL4extForenEval = $GRANDTOTAL4extForenEval + $FULL4extForenEval;
                        echo '<td>'.$FULL4intCounsSes.'</td>';
                        $GRANDTOTAL4intCounsSes = $GRANDTOTAL4intCounsSes + $FULL4intCounsSes;
                        echo '<td class="BoldTextRed">'.$FULL4TotalService.'</td></tr>';
                        $GRANDTOTAL4TotalService = $GRANDTOTAL4TotalService + $FULL4TotalService;
                        echo '<tr align="right" class="BoldTextRed"><td colspan="2" align="center">TOTAL</td>';
                        $FULLTOTALfiTotal = $FULL1fiTotal+$FULL2fiTotal+$FULL3fiTotal+$FULL4fiTotal;
                        echo '<td>'.$FULLTOTALfiTotal.'</td>';
                        $FULLTOTALextForenEval = $FULL1extForenEval+$FULL2extForenEval+$FULL3extForenEval+$FULL4extForenEval;
                        echo '<td>'.$FULLTOTALextForenEval.'</td>';
                        $FULLTOTALintCounsSes = $FULL1intCounsSes+$FULL2intCounsSes+$FULL3intCounsSes+$FULL4intCounsSes;
                        echo '<td>'.$FULLTOTALintCounsSes.'</td>';
                        $FULLTOTALTotalService = $FULL1TotalService+$FULL2TotalService+$FULL3TotalService+$FULL4TotalService;
                        echo '<td class="BoldTextRed">'.$FULLTOTALTotalService.'</td></tr>';
                }
                else{
                        echo '<tr class="BoldHeader"><td align="center"><h2>There are no Full Member center Estimated Budget Totals for FY - '.$fiscalYear.'</h2></td></tr>';
                }

                echo '</table></center>';
                //End of the Full Member Totals
                /* echo '<br /><br />';
                echo '<div class="page-break"></div>';
                //start of the Associate Totals
                $sqlAssociate = "SELECT center, CenterName FROM `centers` WHERE center not in (0,99) AND centerlevel = 'Associate' order by center";
                $resultAssociate = @mysql_query($sqlAssociate) or mysql_error();
                
                $numRecAssociate = mysql_num_rows($resultAssociate);
                
                echo '<center><table width="85%" class="Admin">';
                
                if ($numRecAssociate > 0){
                        echo '<tr class="BoldHeader"><td colspan="6" align="center"><h2>Associate Members</h2></td></tr>';
                        printHeaders();
                        $FULL1fiTotal = 0;
                        $FULL1extForenEval = 0;
                        $FULL1intCounsSes = 0;
                        $FULL1TotalService = 0;
                        $FULL2fiTotal = 0;
                        $FULL2extForenEval = 0;
                        $FULL2intCounsSes = 0;
                        $FULL2TotalService = 0;
                        $FULL3fiTotal = 0;
                        $FULL3extForenEval = 0;
                        $FULL3intCounsSes = 0;
                        $FULL3TotalService = 0;
                        $FULL4fiTotal = 0;
                        $FULL4extForenEval = 0;
                        $FULL4intCounsSes = 0;
                        $FULL4TotalService = 0;
                        $counter = 0;
                        while ($rowAssociate = mysql_fetch_object($resultAssociate)) {

                                //$sqlLoop = "SELECT fiTotal, fi0to6, fi7to12, fi13to18, fiMale, fiFemale, fiAfrAmerican, fiAsian, fiCauc, fiHispanic, fiOther, extForenEval, ".
                                //        "intCounsSes, totCounSes, multDisTeamMeet, prosCases, medExamRef, quarter FROM actualPerfStats WHERE center = ".$rowAssociate->center." AND ".
                                //        "fiscalyear = ".$fiscalYear." ORDER BY quarter";
                                        
                                $sqlLoop = "SELECT fiTotal, extForenEval, intCounsSes, quarter".
                                        " FROM budgetedPerfStats".
                                        " WHERE center = ".$rowAssociate->center." AND".
                                        " fiscalyear = ".$fiscalYear." ORDER BY actualPerfStats.quarter";

                                $resultLoop = @mysql_query($sqlLoop) or mysql_error();
                                
                                //if ($resultLoop){
                                //        echo '<br>Success.';
                                //}
                                //else {
                                //        echo 'Failure';
                                //        echo '<p>'.mysql_error().'<br><br>Query: '.$sqlLoop.'</p>';
                                //}
                                
                                $numRecLoop = mysql_num_rows($resultLoop);
                                
                                if ($numRecLoop > 0){
                                        //clear and initialize the arrays
                                        //clearArrays();
                                        $YearfiTotal = 0;
                                        $YearextForenEval = 0;
                                        $YearintCounsSes = 0;
                                        $YearTotalService = 0;

                                        while ($rowLoop = mysql_fetch_object($resultLoop)) {
                                                echo '<tr align="right">';
                                                //Only show the center name for the first quarter
                                                if ($rowLoop->quarter == 1)
                                                        echo '<td align="left">'.$rowAssociate->CenterName.'</td>';
                                                else
                                                        echo '<td></td>';

                                                echo '<td align="center">'.$rowLoop->quarter.'</td>';
                                                echo '<td>'.$rowLoop->fiTotal.'</td>';
                                                $YearfiTotal = $YearfiTotal + $rowLoop->fiTotal;
                                                echo '<td>'.$rowLoop->extForenEval.'</td>';
                                                $YearextForenEval = $YearextForenEval + $rowLoop->extForenEval;
                                                echo '<td>'.$rowLoop->intCounsSes.'</td>';
                                                $YearintCounsSes = $YearintCounsSes + $rowLoop->intCounsSes;
                                                $totalServices = $rowLoop->fiTotal + $rowLoop->extForenEval + $rowLoop->intCounsSes;
                                                echo '<td class="BoldTextRed">'.$totalServices.'</td>';
                                                $YearTotalService = $YearTotalService + $totalServices;
                                                
                                                //Keep track of the Quarter Totals
                                                if ($rowLoop->quarter == 1){
                                                  $FULL1fiTotal = $FULL1fiTotal + $rowLoop->fiTotal;
                                                  $FULL1extForenEval = $FULL1extForenEval + $rowLoop->extForenEval;
                                                  $FULL1intCounsSes = $FULL1intCounsSes + $rowLoop->intCounsSes;
                                                  $FULL1TotalService = $FULL1TotalService + $totalServices;
                                                }
                                                if ($rowLoop->quarter == 2){
                                                  $FULL2fiTotal = $FULL2fiTotal + $rowLoop->fiTotal;
                                                  $FULL2extForenEval = $FULL2extForenEval + $rowLoop->extForenEval;
                                                  $FULL2intCounsSes = $FULL2intCounsSes + $rowLoop->intCounsSes;
                                                  $FULL2TotalService = $FULL2TotalService + $totalServices;
                                                }
                                                if ($rowLoop->quarter == 3){
                                                  $FULL3fiTotal = $FULL3fiTotal + $rowLoop->fiTotal;
                                                  $FULL3extForenEval = $FULL3extForenEval + $rowLoop->extForenEval;
                                                  $FULL3intCounsSes = $FULL3intCounsSes + $rowLoop->intCounsSes;
                                                  $FULL3TotalService = $FULL3TotalService + $totalServices;
                                                }
                                                if ($rowLoop->quarter == 4){
                                                  $FULL4fiTotal = $FULL4fiTotal + $rowLoop->fiTotal;
                                                  $FULL4extForenEval = $FULL4extForenEval + $rowLoop->extForenEval;
                                                  $FULL4intCounsSes = $FULL4intCounsSes + $rowLoop->intCounsSes;
                                                  $FULL4TotalService = $FULL4TotalService + $totalServices;
                                                }
                                        }
                                        echo '<tr align="right" class="BoldTextRed"><td>TOTAL</td><td></td>';
                                        echo '<td>'.$YearfiTotal.'</td>';
                                        echo '<td>'.$YearextForenEval.'</td>';
                                        echo '<td>'.$YearintCounsSes.'</td>';
                                        echo '<td>'.$YearTotalService.'</td>';

                                        echo '<tr><td colspan="6"></td></tr>';
                                }
                                else{
                                        echo '<tr><td colspan="6">There is no Estimated Budget Totals information for '.$rowAssociate->CenterName.'</td></tr>';
                                }
                                $counter = $counter + 1;
                                if ($counter == 5){
                                        echo '</table><div class="page-break"></div><div class="nav"><br /></div><table width="85%" class="Admin">';
                                        printHeaders();
                                        $counter = 0;
                                }
                        }
                        echo '<tr><td colspan="6" align="center"><b><h2>Associate Member Totals</h2></b></td></tr>';
                        printTotalHeaders('All Associate Member Centers');
                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 1ST QTR</b></td>';
                        echo '<td>'.$FULL1fiTotal.'</td>';
                        $GRANDTOTAL1fiTotal = $GRANDTOTAL1fiTotal + $FULL1fiTotal;
                        echo '<td>'.$FULL1extForenEval.'</td>';
                        $GRANDTOTAL1extForenEval = $GRANDTOTAL1extForenEval + $FULL1extForenEval;
                        echo '<td>'.$FULL1intCounsSes.'</td>';
                        $GRANDTOTAL1intCounsSes = $GRANDTOTAL1intCounsSes + $FULL1intCounsSes;
                        echo '<td class="BoldTextRed">'.$FULL1TotalService.'</td></tr>';
                        $GRANDTOTAL1TotalService = $GRANDTOTAL1TotalService + $FULL1TotalService;
                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 2ND QTR</b></td>';
                        echo '<td>'.$FULL2fiTotal.'</td>';
                        $GRANDTOTAL2fiTotal = $GRANDTOTAL2fiTotal + $FULL2fiTotal;
                        echo '<td>'.$FULL2extForenEval.'</td>';
                        $GRANDTOTAL2extForenEval = $GRANDTOTAL2extForenEval + $FULL2extForenEval;
                        echo '<td>'.$FULL2intCounsSes.'</td>';
                        $GRANDTOTAL2intCounsSes = $GRANDTOTAL2intCounsSes + $FULL2intCounsSes;
                        echo '<td class="BoldTextRed">'.$FULL2TotalService.'</td></tr>';
                        $GRANDTOTAL2TotalService = $GRANDTOTAL2TotalService + $FULL2TotalService;
                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 3RD QTR</b></td>';
                        echo '<td>'.$FULL3fiTotal.'</td>';
                        $GRANDTOTAL3fiTotal = $GRANDTOTAL3fiTotal + $FULL3fiTotal;
                        echo '<td>'.$FULL3extForenEval.'</td>';
                        $GRANDTOTAL3extForenEval = $GRANDTOTAL3extForenEval + $FULL3extForenEval;
                        echo '<td>'.$FULL3intCounsSes.'</td>';
                        $GRANDTOTAL3intCounsSes = $GRANDTOTAL3intCounsSes + $FULL3intCounsSes;
                        echo '<td class="BoldTextRed">'.$FULL3TotalService.'</td></tr>';
                        $GRANDTOTAL3TotalService = $GRANDTOTAL3TotalService + $FULL3TotalService;
                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 4TH QTR</b></td>';
                        echo '<td>'.$FULL4fiTotal.'</td>';
                        $GRANDTOTAL4fiTotal = $GRANDTOTAL4fiTotal + $FULL4fiTotal;
                        echo '<td>'.$FULL4extForenEval.'</td>';
                        $GRANDTOTAL4extForenEval = $GRANDTOTAL4extForenEval + $FULL4extForenEval;
                        echo '<td>'.$FULL4intCounsSes.'</td>';
                        $GRANDTOTAL4intCounsSes = $GRANDTOTAL4intCounsSes + $FULL4intCounsSes;
                        echo '<td class="BoldTextRed">'.$FULL4TotalService.'</td></tr>';
                        $GRANDTOTAL4TotalService = $GRANDTOTAL4TotalService + $FULL4TotalService;
                        echo '<tr align="right" class="BoldTextRed"><td colspan="2" align="center">TOTAL</td>';
                        $FULLTOTALfiTotal = $FULL1fiTotal+$FULL2fiTotal+$FULL3fiTotal+$FULL4fiTotal;
                        echo '<td>'.$FULLTOTALfiTotal.'</td>';
                        $FULLTOTALextForenEval = $FULL1extForenEval+$FULL2extForenEval+$FULL3extForenEval+$FULL4extForenEval;
                        echo '<td>'.$FULLTOTALextForenEval.'</td>';
                        $FULLTOTALintCounsSes = $FULL1intCounsSes+$FULL2intCounsSes+$FULL3intCounsSes+$FULL4intCounsSes;
                        echo '<td>'.$FULLTOTALintCounsSes.'</td>';
                        $FULLTOTALTotalService = $FULL1TotalService+$FULL2TotalService+$FULL3TotalService+$FULL4TotalService;
                        echo '<td class="BoldTextRed">'.$FULLTOTALTotalService.'</td></tr>';
                }
                else{
                        echo '<tr class="BoldHeader"><td align="center"><h2>There are no Associate Member center Estimated Budget Totals for FY - '.$fiscalYear.'</h2></td></tr>';
                }
                
                echo '</table></center>';
                //End of the Associate Totals
                echo '<br /><br />';
                echo '<div class="page-break"></div>';
                //start of the PilotProjects Totals
                $sqlPilot = "SELECT center, CenterName FROM `centers` WHERE center not in (0,99) AND centerlevel = 'Pilot Project' order by center";
                $resultPilot = @mysql_query($sqlPilot) or mysql_error();
                
                $numRecPilot = mysql_num_rows($resultPilot);
                
                echo '<center><table width="85%" class="Admin">';
                
                if ($numRecPilot > 0){
                        echo '<tr class="BoldHeader"><td colspan="6" align="center"><h2>Pilot Projects</h2></td></tr>';
                        printHeaders();
                        $FULL1fiTotal = 0;
                        $FULL1extForenEval = 0;
                        $FULL1intCounsSes = 0;
                        $FULL1TotalService = 0;
                        $FULL2fiTotal = 0;
                        $FULL2extForenEval = 0;
                        $FULL2intCounsSes = 0;
                        $FULL2TotalService = 0;
                        $FULL3fiTotal = 0;
                        $FULL3extForenEval = 0;
                        $FULL3intCounsSes = 0;
                        $FULL3TotalService = 0;
                        $FULL4fiTotal = 0;
                        $FULL4extForenEval = 0;
                        $FULL4intCounsSes = 0;
                        $FULL4TotalService = 0;
                        $counter = 0;
                        while ($rowPilot = mysql_fetch_object($resultPilot)) {

                                $sqlLoop = "SELECT fiTotal, extForenEval, intCounsSes, quarter".
                                        " FROM budgetedPerfStats".
                                        " WHERE center = ".$rowPilot->center." AND".
                                        " fiscalyear = ".$fiscalYear." ORDER BY quarter";

                                $resultLoop = @mysql_query($sqlLoop) or mysql_error();
                                
                                //if ($resultLoop){
                                //        echo '<br>Success.';
                                //}
                                //else {
                                //        echo 'Failure';
                                //        echo '<p>'.mysql_error().'<br><br>Query: '.$sqlLoop.'</p>';
                                //}
                                
                                $numRecLoop = mysql_num_rows($resultLoop);
                                
                                if ($numRecLoop > 0){
                                        //clear and initialize the arrays
                                        //clearArrays();
                                        $YearfiTotal = 0;
                                        $YearextForenEval = 0;
                                        $YearintCounsSes = 0;
                                        $YearTotalService = 0;

                                        while ($rowLoop = mysql_fetch_object($resultLoop)) {
                                                echo '<tr align="right">';
                                                //Only show the center name for the first quarter
                                                if ($rowLoop->quarter == 1)
                                                        echo '<td align="left">'.$rowPilot->CenterName.'</td>';
                                                else
                                                        echo '<td></td>';

                                                echo '<td align="center">'.$rowLoop->quarter.'</td>';
                                                echo '<td>'.$rowLoop->fiTotal.'</td>';
                                                $YearfiTotal = $YearfiTotal + $rowLoop->fiTotal;
                                                echo '<td>'.$rowLoop->extForenEval.'</td>';
                                                $YearextForenEval = $YearextForenEval + $rowLoop->extForenEval;
                                                echo '<td>'.$rowLoop->intCounsSes.'</td>';
                                                $YearintCounsSes = $YearintCounsSes + $rowLoop->intCounsSes;
                                                $totalServices = $rowLoop->fiTotal + $rowLoop->extForenEval + $rowLoop->intCounsSes;
                                                echo '<td class="BoldTextRed">'.$totalServices.'</td>';
                                                $YearTotalService = $YearTotalService + $totalServices;
                                                
                                                //Keep track of the Quarter Totals
                                                if ($rowLoop->quarter == 1){
                                                  $FULL1fiTotal = $FULL1fiTotal + $rowLoop->fiTotal;
                                                  $FULL1extForenEval = $FULL1extForenEval + $rowLoop->extForenEval;
                                                  $FULL1intCounsSes = $FULL1intCounsSes + $rowLoop->intCounsSes;
                                                  $FULL1TotalService = $FULL1TotalService + $totalServices;
                                                }
                                                if ($rowLoop->quarter == 2){
                                                  $FULL2fiTotal = $FULL2fiTotal + $rowLoop->fiTotal;
                                                  $FULL2extForenEval = $FULL2extForenEval + $rowLoop->extForenEval;
                                                  $FULL2intCounsSes = $FULL2intCounsSes + $rowLoop->intCounsSes;
                                                  $FULL2TotalService = $FULL2TotalService + $totalServices;
                                                }
                                                if ($rowLoop->quarter == 3){
                                                  $FULL3fiTotal = $FULL3fiTotal + $rowLoop->fiTotal;
                                                  $FULL3extForenEval = $FULL3extForenEval + $rowLoop->extForenEval;
                                                  $FULL3intCounsSes = $FULL3intCounsSes + $rowLoop->intCounsSes;
                                                  $FULL3TotalService = $FULL3TotalService + $totalServices;
                                                }
                                                if ($rowLoop->quarter == 4){
                                                  $FULL4fiTotal = $FULL4fiTotal + $rowLoop->fiTotal;
                                                  $FULL4extForenEval = $FULL4extForenEval + $rowLoop->extForenEval;
                                                  $FULL4intCounsSes = $FULL4intCounsSes + $rowLoop->intCounsSes;
                                                  $FULL4TotalService = $FULL4TotalService + $totalServices;
                                                }
                                        }
                                        echo '<tr align="right" class="BoldTextRed"><td>TOTAL</td><td></td>';
                                        echo '<td>'.$YearfiTotal.'</td>';
                                        echo '<td>'.$YearextForenEval.'</td>';
                                        echo '<td>'.$YearintCounsSes.'</td>';
                                        echo '<td>'.$YearTotalService.'</td>';

                                        echo '<tr><td colspan="6"></td></tr>';
                                }
                                else{
                                        echo '<tr><td colspan="6">There is no Estimated Budget Totals information for '.$rowPilot->CenterName.'</td></tr>';
                                }
                                $counter = $counter + 1;
                                if ($counter == 5){
                                        echo '</table><div class="page-break"></div><div class="nav"><br /></div><table width="85%" class="Admin">';
                                        printHeaders();
                                        $counter = 0;
                                }
                        }
                        echo '<tr><td colspan="6" align="center"><b><h2>Pilot Project Totals</h2></b></td></tr>';
                        printTotalHeaders('All Pilot Project Centers');
                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 1ST QTR</b></td>';
                        echo '<td>'.$FULL1fiTotal.'</td>';
                        $GRANDTOTAL1fiTotal = $GRANDTOTAL1fiTotal + $FULL1fiTotal;
                        echo '<td>'.$FULL1extForenEval.'</td>';
                        $GRANDTOTAL1extForenEval = $GRANDTOTAL1extForenEval + $FULL1extForenEval;
                        echo '<td>'.$FULL1intCounsSes.'</td>';
                        $GRANDTOTAL1intCounsSes = $GRANDTOTAL1intCounsSes + $FULL1intCounsSes;
                        echo '<td class="BoldTextRed">'.$FULL1TotalService.'</td></tr>';
                        $GRANDTOTAL1TotalService = $GRANDTOTAL1TotalService + $FULL1TotalService;
                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 2ND QTR</b></td>';
                        echo '<td>'.$FULL2fiTotal.'</td>';
                        $GRANDTOTAL2fiTotal = $GRANDTOTAL2fiTotal + $FULL2fiTotal;
                        echo '<td>'.$FULL2extForenEval.'</td>';
                        $GRANDTOTAL2extForenEval = $GRANDTOTAL2extForenEval + $FULL2extForenEval;
                        echo '<td>'.$FULL2intCounsSes.'</td>';
                        $GRANDTOTAL2intCounsSes = $GRANDTOTAL2intCounsSes + $FULL2intCounsSes;
                        echo '<td class="BoldTextRed">'.$FULL2TotalService.'</td></tr>';
                        $GRANDTOTAL2TotalService = $GRANDTOTAL2TotalService + $FULL2TotalService;
                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 3RD QTR</b></td>';
                        echo '<td>'.$FULL3fiTotal.'</td>';
                        $GRANDTOTAL3fiTotal = $GRANDTOTAL3fiTotal + $FULL3fiTotal;
                        echo '<td>'.$FULL3extForenEval.'</td>';
                        $GRANDTOTAL3extForenEval = $GRANDTOTAL3extForenEval + $FULL3extForenEval;
                        echo '<td>'.$FULL3intCounsSes.'</td>';
                        $GRANDTOTAL3intCounsSes = $GRANDTOTAL3intCounsSes + $FULL3intCounsSes;
                        echo '<td class="BoldTextRed">'.$FULL3TotalService.'</td></tr>';
                        $GRANDTOTAL3TotalService = $GRANDTOTAL3TotalService + $FULL3TotalService;
                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 4TH QTR</b></td>';
                        echo '<td>'.$FULL4fiTotal.'</td>';
                        $GRANDTOTAL4fiTotal = $GRANDTOTAL4fiTotal + $FULL4fiTotal;
                        echo '<td>'.$FULL4extForenEval.'</td>';
                        $GRANDTOTAL4extForenEval = $GRANDTOTAL4extForenEval + $FULL4extForenEval;
                        echo '<td>'.$FULL4intCounsSes.'</td>';
                        $GRANDTOTAL4intCounsSes = $GRANDTOTAL4intCounsSes + $FULL4intCounsSes;
                        echo '<td class="BoldTextRed">'.$FULL4TotalService.'</td></tr>';
                        $GRANDTOTAL4TotalService = $GRANDTOTAL4TotalService + $FULL4TotalService;
                        echo '<tr align="right" class="BoldTextRed"><td colspan="2" align="center">TOTAL</td>';
                        $FULLTOTALfiTotal = $FULL1fiTotal+$FULL2fiTotal+$FULL3fiTotal+$FULL4fiTotal;
                        echo '<td>'.$FULLTOTALfiTotal.'</td>';
                        $FULLTOTALextForenEval = $FULL1extForenEval+$FULL2extForenEval+$FULL3extForenEval+$FULL4extForenEval;
                        echo '<td>'.$FULLTOTALextForenEval.'</td>';
                        $FULLTOTALintCounsSes = $FULL1intCounsSes+$FULL2intCounsSes+$FULL3intCounsSes+$FULL4intCounsSes;
                        echo '<td>'.$FULLTOTALintCounsSes.'</td>';
                        $FULLTOTALTotalService = $FULL1TotalService+$FULL2TotalService+$FULL3TotalService+$FULL4TotalService;
                        echo '<td class="BoldTextRed">'.$FULLTOTALTotalService.'</td></tr>';
                }
                else{
                        echo '<tr class="BoldHeader"><td align="center"><h2>There are no Pilot Project center Estimated Budget Totals for FY - '.$fiscalYear.'</h2></td></tr>';
                }
                
                echo '</table></center>';
                //End of the PilotProjects Totals
                echo '<br /><br />';
                echo '<div class="page-break"></div>';
                //GRAND TOTAL
                echo '<center><table width="85%" class="Admin">';
                echo '<tr class="BoldHeader"><td colspan="6" align="center"><h2>Grand Totals</h2></td></tr>';
                echo '<tr><td colspan="6"> </td></tr>';
                printTotalHeaders('All ANCAC Centers');
                echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 1ST QTR</b></td>';
                echo '<td>'.$GRANDTOTAL1fiTotal.'</td>';
                echo '<td>'.$GRANDTOTAL1extForenEval.'</td>';
                echo '<td>'.$GRANDTOTAL1intCounsSes.'</td>';
                echo '<td class="BoldTextRed">'.$GRANDTOTAL1TotalService.'</td></tr>';
                echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 2ND QTR</b></td>';
                echo '<td>'.$GRANDTOTAL2fiTotal.'</td>';
                echo '<td>'.$GRANDTOTAL2extForenEval.'</td>';
                echo '<td>'.$GRANDTOTAL2intCounsSes.'</td>';
                echo '<td class="BoldTextRed">'.$GRANDTOTAL2TotalService.'</td></tr>';
                echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 3RD QTR</b></td>';
                echo '<td>'.$GRANDTOTAL3fiTotal.'</td>';
                echo '<td>'.$GRANDTOTAL3extForenEval.'</td>';
                echo '<td>'.$GRANDTOTAL3intCounsSes.'</td>';
                echo '<td class="BoldTextRed">'.$GRANDTOTAL3TotalService.'</td></tr>';
                echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 4TH QTR</b></td>';
                echo '<td>'.$GRANDTOTAL4fiTotal.'</td>';
                echo '<td>'.$GRANDTOTAL4extForenEval.'</td>';
                echo '<td>'.$GRANDTOTAL4intCounsSes.'</td>';
                echo '<td class="BoldTextRed">'.$GRANDTOTAL4TotalService.'</td></tr>';
                echo '<tr align="right" class="BoldTextRed"><td colspan="2" align="center">TOTAL</td>';
                $FULLTOTALfiTotal = $GRANDTOTAL1fiTotal+$GRANDTOTAL2fiTotal+$GRANDTOTAL3fiTotal+$GRANDTOTAL4fiTotal;
                echo '<td>'.$FULLTOTALfiTotal.'</td>';
                $FULLTOTALextForenEval = $GRANDTOTAL1extForenEval+$GRANDTOTAL2extForenEval+$GRANDTOTAL3extForenEval+$GRANDTOTAL4extForenEval;
                echo '<td>'.$FULLTOTALextForenEval.'</td>';
                $FULLTOTALintCounsSes = $GRANDTOTAL1intCounsSes+$GRANDTOTAL2intCounsSes+$GRANDTOTAL3intCounsSes+$GRANDTOTAL4intCounsSes;
                echo '<td>'.$FULLTOTALintCounsSes.'</td>';
                $FULLTOTALTotalService = $GRANDTOTAL1TotalService+$GRANDTOTAL2TotalService+$GRANDTOTAL3TotalService+$GRANDTOTAL4TotalService;
                echo '<td>'.$FULLTOTALTotalService.'</td></tr>';
                echo '</table></center>';
                //End of the GRAND Totals */

?>

</html>


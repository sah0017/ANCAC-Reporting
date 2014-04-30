<?PHP
require("ulogin.php");
require($root."dbconn.php");



	$page_title = 'ANCAC: Report for FY 2014'; //3/18/14 MH

	require("header.php");



        $fiscalYear = $_POST['year'];

	echo '<table align="center" width="85%" class="legendTable"><tr align="center" class="legendHeader"><td>FI</td><td>EFA</td><td>ICS</td><td>TCS</td><td>MDT</td><td>PROS</td><td>EXAM</td></tr>'. //4/8/14
		 '<tr align="center" class="legendRow"><td>Forensic Investigation</td><td>Extended Forensic Assessment</td><td>Initial Counselling Sessions</td><td>Total Counselling Sessions</td><td>Cases Reviewed by the Multidisciplinary Team Meeting</td><td>Cases referred for Prosecution</td><td>Cases with a Medical Exam</td></tr></table>'; //4/8/14
	

        function printHeaders(){

                echo '<tr class="BoldText" align="center"><td align="left" width="28%">Center</td><td>QTR</td><td class="TotalCell"><h3>TOT. SVCS.</h3></td><td class="TotalCell">FI</td><td class="TotalCell">E.F.A.</td><td class="TotalCell">I.C.S.</td>'. //3/18/14 MH
						
			'<td>EXAM</td><td>PROS.</td><td>M.D.T.</td><td>T.C.S.</td><td>0-6</td><td>7-12</td><td>13-18</td><td>M</td><td>F</td><td>AA</td><td>ASN</td><td>CAU.</td><td>HISP.</td><td>OTHER</td></tr>'; //3/18/14 MH
		 }

	function printTotalHeaders($Title){

                echo '<tr class="BoldText" align="center"><td align="left" width="28%" colspan="2">'.$Title.'</td><td class="TotalCell"><h3>TOT. SVCS.</h3></td><td class="TotalCell">FI</td><td class="TotalCell">E.F.A.</td><td class="TotalCell">I.C.S.</td>'. //3/18/14 MH
						
			'<td>EXAM</td><td>PROS.</td><td>M.D.T.</td><td>T.C.S.</td><td>0-6</td><td>7-12</td><td>13-18</td><td>M</td><td>F</td><td>AA</td><td>ASN</td><td>CAU.</td><td>HISP.</td><td>OTHER</td></tr>'; //3/18/14 MH
		 }

         function removeDefaults($testValue){

                if ($testValue == -99)

                        return 0;

                else

                        return $testValue;

         }

?>



<?PHP              //Initialze the GRAND TOTAL variables

                $GRANDTOTAL1fiTotal = 0;

                $GRANDTOTAL1fi0to6 = 0;

                $GRANDTOTAL1fi7to12 = 0;

                $GRANDTOTAL1fi13to18 = 0;

                $GRANDTOTAL1fiMale = 0;

                $GRANDTOTAL1fiFemale = 0;

                $GRANDTOTAL1fiAfrAmerican = 0;

                $GRANDTOTAL1fiAsian = 0;

                $GRANDTOTAL1fiCauc = 0;

                $GRANDTOTAL1fiHispanic = 0;

                $GRANDTOTAL1fiOther = 0;

                $GRANDTOTAL1extForenEval = 0;

                $GRANDTOTAL1intCounsSes = 0;

                $GRANDTOTAL1totCounSes = 0;

                $GRANDTOTAL1multDisTeamMeet = 0;

                $GRANDTOTAL1prosCases = 0;

                $GRANDTOTAL1medExamRefl = 0;

                $GRANDTOTAL1TotalService = 0;

                $GRANDTOTAL2fiTotal = 0;

                $GRANDTOTAL2fi0to6 = 0;

                $GRANDTOTAL2fi7to12 = 0;

                $GRANDTOTAL2fi13to18 = 0;

                $GRANDTOTAL2fiMale = 0;

                $GRANDTOTAL2fiFemale = 0;

                $GRANDTOTAL2fiAfrAmerican = 0;

                $GRANDTOTAL2fiAsian = 0;

                $GRANDTOTAL2fiCauc = 0;

                $GRANDTOTAL2fiHispanic = 0;

                $GRANDTOTAL2fiOther = 0;

                $GRANDTOTAL2extForenEval = 0;

                $GRANDTOTAL2intCounsSes = 0;

                $GRANDTOTAL2totCounSes = 0;

                $GRANDTOTAL2multDisTeamMeet = 0;

                $GRANDTOTAL2prosCases = 0;

                $GRANDTOTAL2medExamRefl = 0;

                $GRANDTOTAL2TotalService = 0;

                $GRANDTOTAL3fiTotal = 0;

                $GRANDTOTAL3fi0to6 = 0;

                $GRANDTOTAL3fi7to12 = 0;

                $GRANDTOTAL3fi13to18 = 0;

                $GRANDTOTAL3fiMale = 0;

                $GRANDTOTAL3fiFemale = 0;

                $GRANDTOTAL3fiAfrAmerican = 0;

                $GRANDTOTAL3fiAsian = 0;

                $GRANDTOTAL3fiCauc = 0;

                $GRANDTOTAL3fiHispanic = 0;

                $GRANDTOTAL3fiOther = 0;

                $GRANDTOTAL3extForenEval = 0;

                $GRANDTOTAL3intCounsSes = 0;

                $GRANDTOTAL3totCounSes = 0;

                $GRANDTOTAL3multDisTeamMeet = 0;

                $GRANDTOTAL3prosCases = 0;

                $GRANDTOTAL3medExamRefl = 0;

                $GRANDTOTAL3TotalService = 0;

                $GRANDTOTAL4fiTotal = 0;

                $GRANDTOTAL4fi0to6 = 0;

                $GRANDTOTAL4fi7to12 = 0;

                $GRANDTOTAL4fi13to18 = 0;

                $GRANDTOTAL4fiMale = 0;

                $GRANDTOTAL4fiFemale = 0;

                $GRANDTOTAL4fiAfrAmerican = 0;

                $GRANDTOTAL4fiAsian = 0;

                $GRANDTOTAL4fiCauc = 0;

                $GRANDTOTAL4fiHispanic = 0;

                $GRANDTOTAL4fiOther = 0;

                $GRANDTOTAL4extForenEval = 0;

                $GRANDTOTAL4intCounsSes = 0;

                $GRANDTOTAL4totCounSes = 0;

                $GRANDTOTAL4multDisTeamMeet = 0;

                $GRANDTOTAL4prosCases = 0;

                $GRANDTOTAL4medExamRefl = 0;

                $GRANDTOTAL4TotalService = 0;

                

                echo '<center><h2><b>ANCAC: Report for FY '.$fiscalYear.'</b></h2></center>'; //3/18/14 MH



                //start of the Full Member Totals

                $sqlFullMember = "SELECT center, CenterName FROM `centers` WHERE center not in (0,99) AND centerlevel = 'Full Member' order by center";

                $resultFullMember = @mysql_query($sqlFullMember) or mysql_error();

                

                $numRecFullMember = mysql_num_rows($resultFullMember);

                

                echo '<center><table width="85%" class="Admin">';

                

                if ($numRecFullMember > 0){

                        echo '<tr class="BoldHeader"><td colspan="20" align="center"><h2>Full Members</h2></td></tr>';

                        printHeaders();

                        $FULL1fiTotal = 0;

                        $FULL1fi0to6 = 0;

                        $FULL1fi7to12 = 0;

                        $FULL1fi13to18 = 0;

                        $FULL1fiMale = 0;

                        $FULL1fiFemale = 0;

                        $FULL1fiAfrAmerican = 0;

                        $FULL1fiAsian = 0;

                        $FULL1fiCauc = 0;

                        $FULL1fiHispanic = 0;

                        $FULL1fiOther = 0;

                        $FULL1extForenEval = 0;

                        $FULL1intCounsSes = 0;

                        $FULL1totCounSes = 0;

                        $FULL1multDisTeamMeet = 0;

                        $FULL1prosCases = 0;

                        $FULL1medExamRef = 0;

                        $FULL1TotalService = 0;

                        $FULL2fiTotal = 0;

                        $FULL2fi0to6 = 0;

                        $FULL2fi7to12 = 0;

                        $FULL2fi13to18 = 0;

                        $FULL2fiMale = 0;

                        $FULL2fiFemale = 0;

                        $FULL2fiAfrAmerican = 0;

                        $FULL2fiAsian = 0;

                        $FULL2fiCauc = 0;

                        $FULL2fiHispanic = 0;

                        $FULL2fiOther = 0;

                        $FULL2extForenEval = 0;

                        $FULL2intCounsSes = 0;

                        $FULL2totCounSes = 0;

                        $FULL2multDisTeamMeet = 0;

                        $FULL2prosCases = 0;

                        $FULL2medExamRef = 0;

                        $FULL2TotalService = 0;

                        $FULL3fiTotal = 0;

                        $FULL3fi0to6 = 0;

                        $FULL3fi7to12 = 0;

                        $FULL3fi13to18 = 0;

                        $FULL3fiMale = 0;

                        $FULL3fiFemale = 0;

                        $FULL3fiAfrAmerican = 0;

                        $FULL3fiAsian = 0;

                        $FULL3fiCauc = 0;

                        $FULL3fiHispanic = 0;

                        $FULL3fiOther = 0;

                        $FULL3extForenEval = 0;

                        $FULL3intCounsSes = 0;

                        $FULL3totCounSes = 0;

                        $FULL3multDisTeamMeet = 0;

                        $FULL3prosCases = 0;

                        $FULL3medExamRef = 0;

                        $FULL3TotalService = 0;

                        $FULL4fiTotal = 0;

                        $FULL4fi0to6 = 0;

                        $FULL4fi7to12 = 0;

                        $FULL4fi13to18 = 0;

                        $FULL4fiMale = 0;

                        $FULL4fiFemale = 0;

                        $FULL4fiAfrAmerican = 0;

                        $FULL4fiAsian = 0;

                        $FULL4fiCauc = 0;

                        $FULL4fiHispanic = 0;

                        $FULL4fiOther = 0;

                        $FULL4extForenEval = 0;

                        $FULL4intCounsSes = 0;

                        $FULL4totCounSes = 0;

                        $FULL4multDisTeamMeet = 0;

                        $FULL4prosCases = 0;

                        $FULL4medExamRef = 0;

                        $FULL4TotalService = 0;

                        $counter = 0;



                        while ($rowFullMember = mysql_fetch_object($resultFullMember)) {



                                $sqlLoop = "SELECT fiTotal, fi0to6, fi7to12, fi13to18, fiMale, fiFemale, fiAfrAmerican, fiAsian, fiCauc, fiHispanic, fiOther, extForenEval, ".

                                        "intCounsSes, totCounSes, multDisTeamMeet, prosCases, medExamRef, actualPerfStats.quarter FROM actualPerfStats JOIN actualExpenditures ON actualPerfStats.center = actualExpenditures.center ".

                                        "AND actualPerfStats.fiscalyear = actualExpenditures.fiscalyear and actualPerfStats.quarter = actualExpenditures.quarter WHERE actualPerfStats.center = ".$rowFullMember->center." AND ".

                                        "actualPerfStats.fiscalyear = ".$fiscalYear." AND actualExpenditures.completed = 'COM' ORDER BY actualPerfStats.quarter";



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

                                        $Yearfi0to6 = 0;

                                        $Yearfi7to12 = 0;

                                        $Yearfi13to18 = 0;

                                        $YearfiMale = 0;

                                        $YearfiFemale = 0;

                                        $YearfiAfrAmerican = 0;

                                        $YearfiAsian = 0;

                                        $YearfiCauc = 0;

                                        $YearfiHispanic = 0;

                                        $YearfiOther = 0;

                                        $YearextForenEval = 0;

                                        $YearintCounsSes = 0;

                                        $YeartotCounSes = 0;

                                        $YearmultDisTeamMeet = 0;

                                        $YearprosCases = 0;

                                        $YearmedExamRef = 0;

                                        $YearTotalService = 0;



                                        while ($rowLoop = mysql_fetch_object($resultLoop)) {

                                                echo '<tr align="right">';

                                                //Only show the center name for the first quarter

                                                if ($rowLoop->quarter == 1)

                                                        echo '<td align="left">'.$rowFullMember->CenterName.'</td>';

                                                else

                                                        echo '<td></td>';



                                                echo '<td align="center">'.$rowLoop->quarter.'</td>';

                                                echo '<td class="TotalCell">'.$rowLoop->fiTotal.'</td>';

                                                $YearfiTotal = $YearfiTotal + $rowLoop->fiTotal;

                                                echo '<td>'.$rowLoop->fi0to6.'</td>';

                                                $Yearfi0to6 = $Yearfi0to6 + $rowLoop->fi0to6;

                                                echo '<td>'.$rowLoop->fi7to12.'</td>';

                                                $Yearfi7to12 = $Yearfi7to12 + $rowLoop->fi7to12;

                                                echo '<td>'.$rowLoop->fi13to18.'</td>';

                                                $Yearfi13to18 = $Yearfi13to18 + $rowLoop->fi13to18;

                                                echo '<td>'.$rowLoop->fiMale.'</td>';

                                                $YearfiMale = $YearfiMale + $rowLoop->fiMale;

                                                echo '<td>'.$rowLoop->fiFemale.'</td>';

                                                $YearfiFemale = $YearfiFemale + $rowLoop->fiFemale;

                                                echo '<td>'.$rowLoop->fiAfrAmerican.'</td>';

                                                $YearfiAfrAmerican = $YearfiAfrAmerican + $rowLoop->fiAfrAmerican;

                                                echo '<td>'.$rowLoop->fiAsian.'</td>';

                                                $YearfiAsian = $YearfiAsian + $rowLoop->fiAsian;

                                                echo '<td>'.$rowLoop->fiCauc.'</td>';

                                                $YearfiCauc = $YearfiCauc + $rowLoop->fiCauc;

                                                echo '<td>'.$rowLoop->fiHispanic.'</td>';

                                                $YearfiHispanic = $YearfiHispanic + $rowLoop->fiHispanic;

                                                echo '<td>'.$rowLoop->fiOther.'</td>';

                                                $YearfiOther = $YearfiOther + $rowLoop->fiOther;

                                                echo '<td class="">'.$rowLoop->extForenEval.'</td>';

                                                $YearextForenEval = $YearextForenEval + $rowLoop->extForenEval;

                                                echo '<td class="">'.$rowLoop->intCounsSes.'</td>';

                                                $YearintCounsSes = $YearintCounsSes + $rowLoop->intCounsSes;

                                                echo '<td>'.$rowLoop->totCounSes.'</td>';

                                                $YeartotCounSes = $YeartotCounSes + $rowLoop->totCounSes;

                                                echo '<td>'.$rowLoop->multDisTeamMeet.'</td>';

                                                $YearmultDisTeamMeet = $YearmultDisTeamMeet + $rowLoop->multDisTeamMeet;

                                                echo '<td>'.$rowLoop->prosCases.'</td>';

                                                $YearprosCases = $YearprosCases + $rowLoop->prosCases;

                                                echo '<td>'.$rowLoop->medExamRef.'</td>';

                                                $YearmedExamRef = $YearmedExamRef + $rowLoop->medExamRef;

                                                $totalServices = $rowLoop->fiTotal + $rowLoop->extForenEval + $rowLoop->intCounsSes;

                                                echo '<td class="">'.$totalServices.'</td>';

                                                $YearTotalService = $YearTotalService + $totalServices;

                                                

                                                //Keep track of the Quarter Totals

                                                if ($rowLoop->quarter == 1){

                                                  $FULL1fiTotal = $FULL1fiTotal + $rowLoop->fiTotal;

                                                  $FULL1fi0to6 = $FULL1fi0to6 + $rowLoop->fi0to6;

                                                  $FULL1fi7to12 = $FULL1fi7to12 + $rowLoop->fi7to12;

                                                  $FULL1fi13to18 = $FULL1fi13to18 + $rowLoop->fi13to18;

                                                  $FULL1fiMale = $FULL1fiMale + $rowLoop->fiMale;

                                                  $FULL1fiFemale = $FULL1fiFemale + $rowLoop->fiFemale;

                                                  $FULL1fiAfrAmerican = $FULL1fiAfrAmerican + $rowLoop->fiAfrAmerican;

                                                  $FULL1fiAsian = $FULL1fiAsian + $rowLoop->fiAsian;

                                                  $FULL1fiCauc = $FULL1fiCauc + $rowLoop->fiCauc;

                                                  $FULL1fiHispanic = $FULL1fiHispanic + $rowLoop->fiHispanic;

                                                  $FULL1fiOther = $FULL1fiOther + $rowLoop->fiOther;

                                                  $FULL1extForenEval = $FULL1extForenEval + $rowLoop->extForenEval;

                                                  $FULL1intCounsSes = $FULL1intCounsSes + $rowLoop->intCounsSes;

                                                  $FULL1totCounSes = $FULL1totCounSes + $rowLoop->totCounSes;

                                                  $FULL1multDisTeamMeet = $FULL1multDisTeamMeet + $rowLoop->multDisTeamMeet;

                                                  $FULL1prosCases = $FULL1prosCases + $rowLoop->prosCases;

                                                  $FULL1medExamRef = $FULL1medExamRef + $rowLoop->medExamRef;

                                                  $FULL1TotalService = $FULL1TotalService + $totalServices;

                                                }

                                                if ($rowLoop->quarter == 2){

                                                  $FULL2fiTotal = $FULL2fiTotal + $rowLoop->fiTotal;

                                                  $FULL2fi0to6 = $FULL2fi0to6 + $rowLoop->fi0to6;

                                                  $FULL2fi7to12 = $FULL2fi7to12 + $rowLoop->fi7to12;

                                                  $FULL2fi13to18 = $FULL2fi13to18 + $rowLoop->fi13to18;

                                                  $FULL2fiMale = $FULL2fiMale + $rowLoop->fiMale;

                                                  $FULL2fiFemale = $FULL2fiFemale + $rowLoop->fiFemale;

                                                  $FULL2fiAfrAmerican = $FULL2fiAfrAmerican + $rowLoop->fiAfrAmerican;

                                                  $FULL2fiAsian = $FULL2fiAsian + $rowLoop->fiAsian;

                                                  $FULL2fiCauc = $FULL2fiCauc + $rowLoop->fiCauc;

                                                  $FULL2fiHispanic = $FULL2fiHispanic + $rowLoop->fiHispanic;

                                                  $FULL2fiOther = $FULL2fiOther + $rowLoop->fiOther;

                                                  $FULL2extForenEval = $FULL2extForenEval + $rowLoop->extForenEval;

                                                  $FULL2intCounsSes = $FULL2intCounsSes + $rowLoop->intCounsSes;

                                                  $FULL2totCounSes = $FULL2totCounSes + $rowLoop->totCounSes;

                                                  $FULL2multDisTeamMeet = $FULL2multDisTeamMeet + $rowLoop->multDisTeamMeet;

                                                  $FULL2prosCases = $FULL2prosCases + $rowLoop->prosCases;

                                                  $FULL2medExamRef = $FULL2medExamRef + $rowLoop->medExamRef;

                                                  $FULL2TotalService = $FULL2TotalService + $totalServices;

                                                }

                                                if ($rowLoop->quarter == 3){

                                                  $FULL3fiTotal = $FULL3fiTotal + $rowLoop->fiTotal;

                                                  $FULL3fi0to6 = $FULL3fi0to6 + $rowLoop->fi0to6;

                                                  $FULL3fi7to12 = $FULL3fi7to12 + $rowLoop->fi7to12;

                                                  $FULL3fi13to18 = $FULL3fi13to18 + $rowLoop->fi13to18;

                                                  $FULL3fiMale = $FULL3fiMale + $rowLoop->fiMale;

                                                  $FULL3fiFemale = $FULL3fiFemale + $rowLoop->fiFemale;

                                                  $FULL3fiAfrAmerican = $FULL3fiAfrAmerican + $rowLoop->fiAfrAmerican;

                                                  $FULL3fiAsian = $FULL3fiAsian + $rowLoop->fiAsian;

                                                  $FULL3fiCauc = $FULL3fiCauc + $rowLoop->fiCauc;

                                                  $FULL3fiHispanic = $FULL3fiHispanic + $rowLoop->fiHispanic;

                                                  $FULL3fiOther = $FULL3fiOther + $rowLoop->fiOther;

                                                  $FULL3extForenEval = $FULL3extForenEval + $rowLoop->extForenEval;

                                                  $FULL3intCounsSes = $FULL3intCounsSes + $rowLoop->intCounsSes;

                                                  $FULL3totCounSes = $FULL3totCounSes + $rowLoop->totCounSes;

                                                  $FULL3multDisTeamMeet = $FULL3multDisTeamMeet + $rowLoop->multDisTeamMeet;

                                                  $FULL3prosCases = $FULL3prosCases + $rowLoop->prosCases;

                                                  $FULL3medExamRef = $FULL3medExamRef + $rowLoop->medExamRef;

                                                  $FULL3TotalService = $FULL3TotalService + $totalServices;

                                                }

                                                if ($rowLoop->quarter == 4){

                                                  $FULL4fiTotal = $FULL4fiTotal + $rowLoop->fiTotal;

                                                  $FULL4fi0to6 = $FULL4fi0to6 + $rowLoop->fi0to6;

                                                  $FULL4fi7to12 = $FULL4fi7to12 + $rowLoop->fi7to12;

                                                  $FULL4fi13to18 = $FULL4fi13to18 + $rowLoop->fi13to18;

                                                  $FULL4fiMale = $FULL4fiMale + $rowLoop->fiMale;

                                                  $FULL4fiFemale = $FULL4fiFemale + $rowLoop->fiFemale;

                                                  $FULL4fiAfrAmerican = $FULL4fiAfrAmerican + $rowLoop->fiAfrAmerican;

                                                  $FULL4fiAsian = $FULL4fiAsian + $rowLoop->fiAsian;

                                                  $FULL4fiCauc = $FULL4fiCauc + $rowLoop->fiCauc;

                                                  $FULL4fiHispanic = $FULL4fiHispanic + $rowLoop->fiHispanic;

                                                  $FULL4fiOther = $FULL4fiOther + $rowLoop->fiOther;

                                                  $FULL4extForenEval = $FULL4extForenEval + $rowLoop->extForenEval;

                                                  $FULL4intCounsSes = $FULL4intCounsSes + $rowLoop->intCounsSes;

                                                  $FULL4totCounSes = $FULL4totCounSes + $rowLoop->totCounSes;

                                                  $FULL4multDisTeamMeet = $FULL4multDisTeamMeet + $rowLoop->multDisTeamMeet;

                                                  $FULL4prosCases = $FULL4prosCases + $rowLoop->prosCases;

                                                  $FULL4medExamRef = $FULL4medExamRef + $rowLoop->medExamRef;

                                                  $FULL4TotalService = $FULL4TotalService + $totalServices;

                                                }

                                        }

                                        echo '<tr align="right" class="BoldText"><td>TOTAL</td><td></td>';

                                        echo '<td class="TotalCell">'.$YearfiTotal.'</td>';

                                        echo '<td>'.$Yearfi0to6.'</td>';

                                        echo '<td>'.$Yearfi7to12.'</td>';

                                        echo '<td>'.$Yearfi13to18.'</td>';

                                        echo '<td>'.$YearfiMale.'</td>';

                                        echo '<td>'.$YearfiFemale.'</td>';

                                        echo '<td>'.$YearfiAfrAmerican.'</td>';

                                        echo '<td>'.$YearfiAsian.'</td>';

                                        echo '<td>'.$YearfiCauc.'</td>';

                                        echo '<td>'.$YearfiHispanic.'</td>';

                                        echo '<td>'.$YearfiOther.'</td>';

                                        echo '<td class="">'.$YearextForenEval.'</td>';

                                        echo '<td class="">'.$YearintCounsSes.'</td>';

                                        echo '<td>'.$YeartotCounSes.'</td>';

                                        echo '<td>'.$YearmultDisTeamMeet.'</td>';

                                        echo '<td>'.$YearprosCases.'</td>';

                                        echo '<td>'.$YearmedExamRef.'</td>';

                                        echo '<td class="">'.$YearTotalService.'</td>';



                                        echo '<tr><td colspan="20"></td></tr>';

                                }

                                else{

                                        echo '<tr><td colspan="20">There is no total information for '.$rowFullMember->CenterName.'</td></tr>';

                                }

                                $counter = $counter + 1;

                                if ($counter == 5){

                                        echo '</table><div class="page-break"></div><div class="nav"><br /></div><table width="85%" class="Admin">';

                                        printHeaders();

                                        $counter = 0;

                                }

                        }

                        echo '<tr><td colspan="20" align="center"><b><h2>Full Member Totals</h2></b></td></tr>';

                        printTotalHeaders('All Full Member Centers');

                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 1ST QTR</b></td>';

                        echo '<td class="TotalCell">'.$FULL1fiTotal.'</td>';

                        $GRANDTOTAL1fiTotal = $GRANDTOTAL1fiTotal + $FULL1fiTotal;

                        echo '<td class="">'.$FULL1fi0to6.'</td>';

                        $GRANDTOTAL1fi0to6 = $GRANDTOTAL1fi0to6 + $FULL1fi0to6;

                        echo '<td class="">'.$FULL1fi7to12.'</td>';

                        $GRANDTOTAL1fi7to12 = $GRANDTOTAL1fi7to12 + $FULL1fi7to12;

                        echo '<td class="">'.$FULL1fi13to18.'</td>';

                        $GRANDTOTAL1fi13to18 = $GRANDTOTAL1fi13to18 + $FULL1fi13to18;

                        echo '<td class="">'.$FULL1fiMale.'</td>';

                        $GRANDTOTAL1fiMale = $GRANDTOTAL1fiMale + $FULL1fiMale;

                        echo '<td class="">'.$FULL1fiFemale.'</td>';

                        $GRANDTOTAL1fiFemale = $GRANDTOTAL1fiFemale + $FULL1fiFemale;

                        echo '<td class="">'.$FULL1fiAfrAmerican.'</td>';

                        $GRANDTOTAL1fiAfrAmerican = $GRANDTOTAL1fiAfrAmerican + $FULL1fiAfrAmerican;

                        echo '<td class="">'.$FULL1fiAsian.'</td>';

                        $GRANDTOTAL1fiAsian = $GRANDTOTAL1fiAsian + $FULL1fiAsian;

                        echo '<td class="">'.$FULL1fiCauc.'</td>';

                        $GRANDTOTAL1fiCauc = $GRANDTOTAL1fiCauc + $FULL1fiCauc;

                        echo '<td class="">'.$FULL1fiHispanic.'</td>';

                        $GRANDTOTAL1fiHispanic = $GRANDTOTAL1fiHispanic + $FULL1fiHispanic;

                        echo '<td class="">'.$FULL1fiOther.'</td>';

                        $GRANDTOTAL1fiOther = $GRANDTOTAL1fiOther + $FULL1fiOther;

                        echo '<td class="">'.$FULL1extForenEval.'</td>';

                        $GRANDTOTAL1extForenEval = $GRANDTOTAL1extForenEval + $FULL1extForenEval;

                        echo '<td class="">'.$FULL1intCounsSes.'</td>';

                        $GRANDTOTAL1intCounsSes = $GRANDTOTAL1intCounsSes + $FULL1intCounsSes;

                        echo '<td class="">'.$FULL1totCounSes.'</td>';

                        $GRANDTOTAL1totCounSes = $GRANDTOTAL1totCounSes + $FULL1totCounSes;

                        echo '<td class="">'.$FULL1multDisTeamMeet.'</td>';

                        $GRANDTOTAL1multDisTeamMeet = $GRANDTOTAL1multDisTeamMeet + $FULL1multDisTeamMeet;

                        echo '<td class="">'.$FULL1prosCases.'</td>';

                        $GRANDTOTAL1prosCases = $GRANDTOTAL1prosCases + $FULL1prosCases;

                        echo '<td class="">'.$FULL1medExamRef.'</td>';

                        $GRANDTOTAL1medExamRefl = $GRANDTOTAL1medExamRefl + $FULL1medExamRef;

                        echo '<td class="">'.$FULL1TotalService.'</td></tr>';

                        $GRANDTOTAL1TotalService = $GRANDTOTAL1TotalService + $FULL1TotalService;

                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 2ND QTR</b></td>';

                        echo '<td class="TotalCell">'.$FULL2fiTotal.'</td>';

                        $GRANDTOTAL2fiTotal = $GRANDTOTAL2fiTotal + $FULL2fiTotal;

                        echo '<td class="">'.$FULL2fi0to6.'</td>';

                        $GRANDTOTAL2fi0to6 = $GRANDTOTAL2fi0to6 + $FULL2fi0to6;

                        echo '<td class="">'.$FULL2fi7to12.'</td>';

                        $GRANDTOTAL2fi7to12 = $GRANDTOTAL2fi7to12 + $FULL2fi7to12;

                        echo '<td class="">'.$FULL2fi13to18.'</td>';

                        $GRANDTOTAL2fi13to18 = $GRANDTOTAL2fi13to18 + $FULL2fi13to18;

                        echo '<td class="">'.$FULL2fiMale.'</td>';

                        $GRANDTOTAL2fiMale = $GRANDTOTAL2fiMale + $FULL2fiMale;

                        echo '<td class="">'.$FULL2fiFemale.'</td>';

                        $GRANDTOTAL2fiFemale = $GRANDTOTAL2fiFemale + $FULL2fiFemale;

                        echo '<td class="">'.$FULL2fiAfrAmerican.'</td>';

                        $GRANDTOTAL2fiAfrAmerican = $GRANDTOTAL2fiAfrAmerican + $FULL2fiAfrAmerican;

                        echo '<td class="">'.$FULL2fiAsian.'</td>';

                        $GRANDTOTAL2fiAsian = $GRANDTOTAL2fiAsian + $FULL2fiAsian;

                        echo '<td class="">'.$FULL2fiCauc.'</td>';

                        $GRANDTOTAL2fiCauc = $GRANDTOTAL2fiCauc + $FULL2fiCauc;

                        echo '<td class="">'.$FULL2fiHispanic.'</td>';

                        $GRANDTOTAL2fiHispanic = $GRANDTOTAL2fiHispanic + $FULL2fiHispanic;

                        echo '<td class="">'.$FULL2fiOther.'</td>';

                        $GRANDTOTAL2fiOther = $GRANDTOTAL2fiOther + $FULL2fiOther;

                        echo '<td class="">'.$FULL2extForenEval.'</td>';

                        $GRANDTOTAL2extForenEval = $GRANDTOTAL2extForenEval + $FULL2extForenEval;

                        echo '<td class="">'.$FULL2intCounsSes.'</td>';

                        $GRANDTOTAL2intCounsSes = $GRANDTOTAL2intCounsSes + $FULL2intCounsSes;

                        echo '<td class="">'.$FULL2totCounSes.'</td>';

                        $GRANDTOTAL2totCounSes = $GRANDTOTAL2totCounSes + $FULL2totCounSes;

                        echo '<td class="">'.$FULL2multDisTeamMeet.'</td>';

                        $GRANDTOTAL2multDisTeamMeet = $GRANDTOTAL2multDisTeamMeet + $FULL2multDisTeamMeet;

                        echo '<td class="">'.$FULL2prosCases.'</td>';

                        $GRANDTOTAL2prosCases = $GRANDTOTAL2prosCases + $FULL2prosCases;

                        echo '<td class="">'.$FULL2medExamRef.'</td>';

                        $GRANDTOTAL2medExamRefl = $GRANDTOTAL2medExamRefl + $FULL2medExamRef;

                        echo '<td class="">'.$FULL2TotalService.'</td></tr>';

                        $GRANDTOTAL2TotalService = $GRANDTOTAL2TotalService + $FULL2TotalService;

                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 3RD QTR</b></td>';

                        echo '<td class="TotalCell">'.$FULL3fiTotal.'</td>';

                        $GRANDTOTAL3fiTotal = $GRANDTOTAL3fiTotal + $FULL3fiTotal;

                        echo '<td class="">'.$FULL3fi0to6.'</td>';

                        $GRANDTOTAL3fi0to6 = $GRANDTOTAL3fi0to6 + $FULL3fi0to6;

                        echo '<td class="">'.$FULL3fi7to12.'</td>';

                        $GRANDTOTAL3fi7to12 = $GRANDTOTAL3fi7to12 + $FULL3fi7to12;

                        echo '<td class="">'.$FULL3fi13to18.'</td>';

                        $GRANDTOTAL3fi13to18 = $GRANDTOTAL3fi13to18 + $FULL3fi13to18;

                        echo '<td class="">'.$FULL3fiMale.'</td>';

                        $GRANDTOTAL3fiMale = $GRANDTOTAL3fiMale + $FULL3fiMale;

                        echo '<td class="">'.$FULL3fiFemale.'</td>';

                        $GRANDTOTAL3fiFemale = $GRANDTOTAL3fiFemale + $FULL3fiFemale;

                        echo '<td class="">'.$FULL3fiAfrAmerican.'</td>';

                        $GRANDTOTAL3fiAfrAmerican = $GRANDTOTAL3fiAfrAmerican + $FULL3fiAfrAmerican;

                        echo '<td class="">'.$FULL3fiAsian.'</td>';

                        $GRANDTOTAL3fiAsian = $GRANDTOTAL3fiAsian + $FULL3fiAsian;

                        echo '<td class="">'.$FULL3fiCauc.'</td>';

                        $GRANDTOTAL3fiCauc = $GRANDTOTAL3fiCauc + $FULL3fiCauc;

                        echo '<td class="">'.$FULL3fiHispanic.'</td>';

                        $GRANDTOTAL3fiHispanic = $GRANDTOTAL3fiHispanic + $FULL3fiHispanic;

                        echo '<td class="">'.$FULL3fiOther.'</td>';

                        $GRANDTOTAL3fiOther = $GRANDTOTAL3fiOther + $FULL3fiOther;

                        echo '<td class="">'.$FULL3extForenEval.'</td>';

                        $GRANDTOTAL3extForenEval = $GRANDTOTAL3extForenEval + $FULL3extForenEval;

                        echo '<td class="">'.$FULL3intCounsSes.'</td>';

                        $GRANDTOTAL3intCounsSes = $GRANDTOTAL3intCounsSes + $FULL3intCounsSes;

                        echo '<td class="">'.$FULL3totCounSes.'</td>';

                        $GRANDTOTAL3totCounSes = $GRANDTOTAL3totCounSes + $FULL3totCounSes;

                        echo '<td class="">'.$FULL3multDisTeamMeet.'</td>';

                        $GRANDTOTAL3multDisTeamMeet = $GRANDTOTAL3multDisTeamMeet + $FULL3multDisTeamMeet;

                        echo '<td class="">'.$FULL3prosCases.'</td>';

                        $GRANDTOTAL3prosCases = $GRANDTOTAL3prosCases + $FULL3prosCases;

                        echo '<td class="">'.$FULL3medExamRef.'</td>';

                        $GRANDTOTAL3medExamRefl = $GRANDTOTAL3medExamRefl + $FULL3medExamRef;

                        echo '<td class="">'.$FULL3TotalService.'</td></tr>';

                        $GRANDTOTAL3TotalService = $GRANDTOTAL3TotalService + $FULL3TotalService;

                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 4TH QTR</b></td>';

                        echo '<td class="TotalCell">'.$FULL4fiTotal.'</td>';

                        $GRANDTOTAL4fiTotal = $GRANDTOTAL4fiTotal + $FULL4fiTotal;

                        echo '<td class="">'.$FULL4fi0to6.'</td>';

                        $GRANDTOTAL4fi0to6 = $GRANDTOTAL4fi0to6 + $FULL4fi0to6;

                        echo '<td class="">'.$FULL4fi7to12.'</td>';

                        $GRANDTOTAL4fi7to12 = $GRANDTOTAL4fi7to12 + $FULL4fi7to12;

                        echo '<td class="">'.$FULL4fi13to18.'</td>';

                        $GRANDTOTAL4fi13to18 = $GRANDTOTAL4fi13to18 + $FULL4fi13to18;

                        echo '<td class="">'.$FULL4fiMale.'</td>';

                        $GRANDTOTAL4fiMale = $GRANDTOTAL4fiMale + $FULL4fiMale;

                        echo '<td class="">'.$FULL4fiFemale.'</td>';

                        $GRANDTOTAL4fiFemale = $GRANDTOTAL4fiFemale + $FULL4fiFemale;

                        echo '<td class="">'.$FULL4fiAfrAmerican.'</td>';

                        $GRANDTOTAL4fiAfrAmerican = $GRANDTOTAL4fiAfrAmerican + $FULL4fiAfrAmerican;

                        echo '<td class="">'.$FULL4fiAsian.'</td>';

                        $GRANDTOTAL4fiAsian = $GRANDTOTAL4fiAsian + $FULL4fiAsian;

                        echo '<td class="">'.$FULL4fiCauc.'</td>';

                        $GRANDTOTAL4fiCauc = $GRANDTOTAL4fiCauc + $FULL4fiCauc;

                        echo '<td class="">'.$FULL4fiHispanic.'</td>';

                        $GRANDTOTAL4fiHispanic = $GRANDTOTAL4fiHispanic + $FULL4fiHispanic;

                        echo '<td class="">'.$FULL4fiOther.'</td>';

                        $GRANDTOTAL4fiOther = $GRANDTOTAL4fiOther + $FULL4fiOther;

                        echo '<td class="">'.$FULL4extForenEval.'</td>';

                        $GRANDTOTAL4extForenEval = $GRANDTOTAL4extForenEval + $FULL4extForenEval;

                        echo '<td class="">'.$FULL4intCounsSes.'</td>';

                        $GRANDTOTAL4intCounsSes = $GRANDTOTAL4intCounsSes + $FULL4intCounsSes;

                        echo '<td class="">'.$FULL4totCounSes.'</td>';

                        $GRANDTOTAL4totCounSes = $GRANDTOTAL4totCounSes + $FULL4totCounSes;

                        echo '<td class="">'.$FULL4multDisTeamMeet.'</td>';

                        $GRANDTOTAL4multDisTeamMeet = $GRANDTOTAL4multDisTeamMeet + $FULL4multDisTeamMeet;

                        echo '<td class="">'.$FULL4prosCases.'</td>';

                        $GRANDTOTAL4prosCases = $GRANDTOTAL4prosCases + $FULL4prosCases;

                        echo '<td class="">'.$FULL4medExamRef.'</td>';

                        $GRANDTOTAL4medExamRefl = $GRANDTOTAL4medExamRefl + $FULL4medExamRef;

                        echo '<td class="">'.$FULL4TotalService.'</td></tr>';

                        $GRANDTOTAL4TotalService = $GRANDTOTAL4TotalService + $FULL4TotalService;

                        echo '<tr align="right" class="BoldText"><td colspan="2" align="center">TOTAL</td>';

                        $FULLTOTALfiTotal = $FULL1fiTotal+$FULL2fiTotal+$FULL3fiTotal+$FULL4fiTotal;

                        echo '<td class="TotalCell">'.$FULLTOTALfiTotal.'</td>';

                        $FULLTOTALfi0to6 = $FULL1fi0to6+$FULL2fi0to6+$FULL3fi0to6+$FULL4fi0to6;

                        echo '<td>'.$FULLTOTALfi0to6.'</td>';

                        $FULLTOTALfi7to12 = $FULL1fi7to12+$FULL2fi7to12+$FULL3fi7to12+$FULL4fi7to12;

                        echo '<td>'.$FULLTOTALfi7to12.'</td>';

                        $FULLTOTALfi13to18 = $FULL1fi13to18+$FULL2fi13to18+$FULL3fi13to18+$FULL4fi13to18;

                        echo '<td>'.$FULLTOTALfi13to18.'</td>';

                        $FULLTOTALfiMale = $FULL1fiMale+$FULL2fiMale+$FULL3fiMale+$FULL4fiMale;

                        echo '<td>'.$FULLTOTALfiMale.'</td>';

                        $FULLTOTALfiFemale = $FULL1fiFemale+$FULL2fiFemale+$FULL3fiFemale+$FULL4fiFemale;

                        echo '<td>'.$FULLTOTALfiFemale.'</td>';

                        $FULLTOTALfiAfrAmerican = $FULL1fiAfrAmerican+$FULL2fiAfrAmerican+$FULL3fiAfrAmerican+$FULL4fiAfrAmerican;

                        echo '<td>'.$FULLTOTALfiAfrAmerican.'</td>';

                        $FULLTOTALfiAsian = $FULL1fiAsian+$FULL2fiAsian+$FULL3fiAsian+$FULL4fiAsian;

                        echo '<td>'.$FULLTOTALfiAsian.'</td>';

                        $FULLTOTALfiCauc = $FULL1fiCauc+$FULL2fiCauc+$FULL3fiCauc+$FULL4fiCauc;

                        echo '<td>'.$FULLTOTALfiCauc.'</td>';

                        $FULLTOTALfiHispanic = $FULL1fiHispanic+$FULL2fiHispanic+$FULL3fiHispanic+$FULL4fiHispanic;

                        echo '<td>'.$FULLTOTALfiHispanic.'</td>';

                        $FULLTOTALfiOther = $FULL1fiOther+$FULL2fiOther+$FULL3fiOther+$FULL4fiOther;

                        echo '<td>'.$FULLTOTALfiOther.'</td>';

                        $FULLTOTALextForenEval = $FULL1extForenEval+$FULL2extForenEval+$FULL3extForenEval+$FULL4extForenEval;

                        echo '<td class="">'.$FULLTOTALextForenEval.'</td>';

                        $FULLTOTALintCounsSes = $FULL1intCounsSes+$FULL2intCounsSes+$FULL3intCounsSes+$FULL4intCounsSes;

                        echo '<td class="">'.$FULLTOTALintCounsSes.'</td>';

                        $FULLTOTALtotCounSes = $FULL1totCounSes+$FULL2totCounSes+$FULL3totCounSes+$FULL4totCounSes;

                        echo '<td>'.$FULLTOTALtotCounSes.'</td>';

                        $FULLTOTALmultDisTeamMeet = $FULL1multDisTeamMeet+$FULL2multDisTeamMeet+$FULL3multDisTeamMeet+$FULL4multDisTeamMeet;

                        echo '<td>'.$FULLTOTALmultDisTeamMeet.'</td>';

                        $FULLTOTALprosCases = $FULL1prosCases+$FULL2prosCases+$FULL3prosCases+$FULL4prosCases;

                        echo '<td>'.$FULLTOTALprosCases.'</td>';

                        $FULLTOTALmedExamRef = $FULL1medExamRef+$FULL2medExamRef+$FULL3medExamRef+$FULL4medExamRef;

                        echo '<td>'.$FULLTOTALmedExamRef.'</td>';

                        $FULLTOTALTotalService = $FULL1TotalService+$FULL2TotalService+$FULL3TotalService+$FULL4TotalService;

                        echo '<td class="">'.$FULLTOTALTotalService.'</td></tr>';

                }

                else{

                        echo '<tr class="BoldHeader"><td align="center"><h2>There are no Full Member center totals for FY - '.$fiscalYear.'</h2></td></tr>';

                }



                echo '</table></center>';

                //End of the Full Member Totals

                echo '<br /><br />';

                echo '<div class="page-break"></div>';

                //start of the Associate Totals

                $sqlAssociate = "SELECT center, CenterName FROM `centers` WHERE center not in (0,99) AND centerlevel = 'Associate' order by center";

                $resultAssociate = @mysql_query($sqlAssociate) or mysql_error();

                

                $numRecAssociate = mysql_num_rows($resultAssociate);

                

                echo '<center><table width="85%" class="Admin">';

                

                if ($numRecAssociate > 0){

                        echo '<tr class="BoldHeader"><td colspan="20" align="center"><h2>Associate Members</h2></td></tr>';

                        printHeaders();

                        $FULL1fiTotal = 0;

                        $FULL1fi0to6 = 0;

                        $FULL1fi7to12 = 0;

                        $FULL1fi13to18 = 0;

                        $FULL1fiMale = 0;

                        $FULL1fiFemale = 0;

                        $FULL1fiAfrAmerican = 0;

                        $FULL1fiAsian = 0;

                        $FULL1fiCauc = 0;

                        $FULL1fiHispanic = 0;

                        $FULL1fiOther = 0;

                        $FULL1extForenEval = 0;

                        $FULL1intCounsSes = 0;

                        $FULL1totCounSes = 0;

                        $FULL1multDisTeamMeet = 0;

                        $FULL1prosCases = 0;

                        $FULL1medExamRef = 0;

                        $FULL1TotalService = 0;

                        $FULL2fiTotal = 0;

                        $FULL2fi0to6 = 0;

                        $FULL2fi7to12 = 0;

                        $FULL2fi13to18 = 0;

                        $FULL2fiMale = 0;

                        $FULL2fiFemale = 0;

                        $FULL2fiAfrAmerican = 0;

                        $FULL2fiAsian = 0;

                        $FULL2fiCauc = 0;

                        $FULL2fiHispanic = 0;

                        $FULL2fiOther = 0;

                        $FULL2extForenEval = 0;

                        $FULL2intCounsSes = 0;

                        $FULL2totCounSes = 0;

                        $FULL2multDisTeamMeet = 0;

                        $FULL2prosCases = 0;

                        $FULL2medExamRef = 0;

                        $FULL2TotalService = 0;

                        $FULL3fiTotal = 0;

                        $FULL3fi0to6 = 0;

                        $FULL3fi7to12 = 0;

                        $FULL3fi13to18 = 0;

                        $FULL3fiMale = 0;

                        $FULL3fiFemale = 0;

                        $FULL3fiAfrAmerican = 0;

                        $FULL3fiAsian = 0;

                        $FULL3fiCauc = 0;

                        $FULL3fiHispanic = 0;

                        $FULL3fiOther = 0;

                        $FULL3extForenEval = 0;

                        $FULL3intCounsSes = 0;

                        $FULL3totCounSes = 0;

                        $FULL3multDisTeamMeet = 0;

                        $FULL3prosCases = 0;

                        $FULL3medExamRef = 0;

                        $FULL3TotalService = 0;

                        $FULL4fiTotal = 0;

                        $FULL4fi0to6 = 0;

                        $FULL4fi7to12 = 0;

                        $FULL4fi13to18 = 0;

                        $FULL4fiMale = 0;

                        $FULL4fiFemale = 0;

                        $FULL4fiAfrAmerican = 0;

                        $FULL4fiAsian = 0;

                        $FULL4fiCauc = 0;

                        $FULL4fiHispanic = 0;

                        $FULL4fiOther = 0;

                        $FULL4extForenEval = 0;

                        $FULL4intCounsSes = 0;

                        $FULL4totCounSes = 0;

                        $FULL4multDisTeamMeet = 0;

                        $FULL4prosCases = 0;

                        $FULL4medExamRef = 0;

                        $FULL4TotalService = 0;

                        $counter = 0;

                        while ($rowAssociate = mysql_fetch_object($resultAssociate)) {



                                //$sqlLoop = "SELECT fiTotal, fi0to6, fi7to12, fi13to18, fiMale, fiFemale, fiAfrAmerican, fiAsian, fiCauc, fiHispanic, fiOther, extForenEval, ".

                                //        "intCounsSes, totCounSes, multDisTeamMeet, prosCases, medExamRef, quarter FROM actualPerfStats WHERE center = ".$rowAssociate->center." AND ".

                                //        "fiscalyear = ".$fiscalYear." ORDER BY quarter";

                                        

                                $sqlLoop = "SELECT fiTotal, fi0to6, fi7to12, fi13to18, fiMale, fiFemale, fiAfrAmerican, fiAsian, fiCauc, fiHispanic, fiOther, extForenEval, ".

                                        "intCounsSes, totCounSes, multDisTeamMeet, prosCases, medExamRef, actualPerfStats.quarter FROM actualPerfStats JOIN actualExpenditures ON actualPerfStats.center = actualExpenditures.center ".

                                        "AND actualPerfStats.fiscalyear = actualExpenditures.fiscalyear and actualPerfStats.quarter = actualExpenditures.quarter WHERE actualPerfStats.center = ".$rowAssociate->center." AND ".

                                        "actualPerfStats.fiscalyear = ".$fiscalYear." AND actualExpenditures.completed = 'COM' ORDER BY actualPerfStats.quarter";



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

                                        $Yearfi0to6 = 0;

                                        $Yearfi7to12 = 0;

                                        $Yearfi13to18 = 0;

                                        $YearfiMale = 0;

                                        $YearfiFemale = 0;

                                        $YearfiAfrAmerican = 0;

                                        $YearfiAsian = 0;

                                        $YearfiCauc = 0;

                                        $YearfiHispanic = 0;

                                        $YearfiOther = 0;

                                        $YearextForenEval = 0;

                                        $YearintCounsSes = 0;

                                        $YeartotCounSes = 0;

                                        $YearmultDisTeamMeet = 0;

                                        $YearprosCases = 0;

                                        $YearmedExamRef = 0;

                                        $YearTotalService = 0;



                                        while ($rowLoop = mysql_fetch_object($resultLoop)) {

                                                echo '<tr align="right">';

                                                //Only show the center name for the first quarter

                                                if ($rowLoop->quarter == 1)

                                                        echo '<td align="left">'.$rowAssociate->CenterName.'</td>';

                                                else

                                                        echo '<td></td>';



                                                echo '<td align="center">'.$rowLoop->quarter.'</td>';

                                                echo '<td class="">'.$rowLoop->fiTotal.'</td>';

                                                $YearfiTotal = $YearfiTotal + $rowLoop->fiTotal;

                                                echo '<td>'.$rowLoop->fi0to6.'</td>';

                                                $Yearfi0to6 = $Yearfi0to6 + $rowLoop->fi0to6;

                                                echo '<td>'.$rowLoop->fi7to12.'</td>';

                                                $Yearfi7to12 = $Yearfi7to12 + $rowLoop->fi7to12;

                                                echo '<td>'.$rowLoop->fi13to18.'</td>';

                                                $Yearfi13to18 = $Yearfi13to18 + $rowLoop->fi13to18;

                                                echo '<td>'.$rowLoop->fiMale.'</td>';

                                                $YearfiMale = $YearfiMale + $rowLoop->fiMale;

                                                echo '<td>'.$rowLoop->fiFemale.'</td>';

                                                $YearfiFemale = $YearfiFemale + $rowLoop->fiFemale;

                                                echo '<td>'.$rowLoop->fiAfrAmerican.'</td>';

                                                $YearfiAfrAmerican = $YearfiAfrAmerican + $rowLoop->fiAfrAmerican;

                                                echo '<td>'.$rowLoop->fiAsian.'</td>';

                                                $YearfiAsian = $YearfiAsian + $rowLoop->fiAsian;

                                                echo '<td>'.$rowLoop->fiCauc.'</td>';

                                                $YearfiCauc = $YearfiCauc + $rowLoop->fiCauc;

                                                echo '<td>'.$rowLoop->fiHispanic.'</td>';

                                                $YearfiHispanic = $YearfiHispanic + $rowLoop->fiHispanic;

                                                echo '<td>'.$rowLoop->fiOther.'</td>';

                                                $YearfiOther = $YearfiOther + $rowLoop->fiOther;

                                                echo '<td class="">'.$rowLoop->extForenEval.'</td>';

                                                $YearextForenEval = $YearextForenEval + $rowLoop->extForenEval;

                                                echo '<td class="">'.$rowLoop->intCounsSes.'</td>';

                                                $YearintCounsSes = $YearintCounsSes + $rowLoop->intCounsSes;

                                                echo '<td>'.$rowLoop->totCounSes.'</td>';

                                                $YeartotCounSes = $YeartotCounSes + $rowLoop->totCounSes;

                                                echo '<td>'.$rowLoop->multDisTeamMeet.'</td>';

                                                $YearmultDisTeamMeet = $YearmultDisTeamMeet + $rowLoop->multDisTeamMeet;

                                                echo '<td>'.$rowLoop->prosCases.'</td>';

                                                $YearprosCases = $YearprosCases + $rowLoop->prosCases;

                                                echo '<td>'.$rowLoop->medExamRef.'</td>';

                                                $YearmedExamRef = $YearmedExamRef + $rowLoop->medExamRef;

                                                $totalServices = $rowLoop->fiTotal + $rowLoop->extForenEval + $rowLoop->intCounsSes;

                                                echo '<td class="">'.$totalServices.'</td>';

                                                $YearTotalService = $YearTotalService + $totalServices;

                                                

                                                //Keep track of the Quarter Totals

                                                if ($rowLoop->quarter == 1){

                                                  $FULL1fiTotal = $FULL1fiTotal + $rowLoop->fiTotal;

                                                  $FULL1fi0to6 = $FULL1fi0to6 + $rowLoop->fi0to6;

                                                  $FULL1fi7to12 = $FULL1fi7to12 + $rowLoop->fi7to12;

                                                  $FULL1fi13to18 = $FULL1fi13to18 + $rowLoop->fi13to18;

                                                  $FULL1fiMale = $FULL1fiMale + $rowLoop->fiMale;

                                                  $FULL1fiFemale = $FULL1fiFemale + $rowLoop->fiFemale;

                                                  $FULL1fiAfrAmerican = $FULL1fiAfrAmerican + $rowLoop->fiAfrAmerican;

                                                  $FULL1fiAsian = $FULL1fiAsian + $rowLoop->fiAsian;

                                                  $FULL1fiCauc = $FULL1fiCauc + $rowLoop->fiCauc;

                                                  $FULL1fiHispanic = $FULL1fiHispanic + $rowLoop->fiHispanic;

                                                  $FULL1fiOther = $FULL1fiOther + $rowLoop->fiOther;

                                                  $FULL1extForenEval = $FULL1extForenEval + $rowLoop->extForenEval;

                                                  $FULL1intCounsSes = $FULL1intCounsSes + $rowLoop->intCounsSes;

                                                  $FULL1totCounSes = $FULL1totCounSes + $rowLoop->totCounSes;

                                                  $FULL1multDisTeamMeet = $FULL1multDisTeamMeet + $rowLoop->multDisTeamMeet;

                                                  $FULL1prosCases = $FULL1prosCases + $rowLoop->prosCases;

                                                  $FULL1medExamRef = $FULL1medExamRef + $rowLoop->medExamRef;

                                                  $FULL1TotalService = $FULL1TotalService + $totalServices;

                                                }

                                                if ($rowLoop->quarter == 2){

                                                  $FULL2fiTotal = $FULL2fiTotal + $rowLoop->fiTotal;

                                                  $FULL2fi0to6 = $FULL2fi0to6 + $rowLoop->fi0to6;

                                                  $FULL2fi7to12 = $FULL2fi7to12 + $rowLoop->fi7to12;

                                                  $FULL2fi13to18 = $FULL2fi13to18 + $rowLoop->fi13to18;

                                                  $FULL2fiMale = $FULL2fiMale + $rowLoop->fiMale;

                                                  $FULL2fiFemale = $FULL2fiFemale + $rowLoop->fiFemale;

                                                  $FULL2fiAfrAmerican = $FULL2fiAfrAmerican + $rowLoop->fiAfrAmerican;

                                                  $FULL2fiAsian = $FULL2fiAsian + $rowLoop->fiAsian;

                                                  $FULL2fiCauc = $FULL2fiCauc + $rowLoop->fiCauc;

                                                  $FULL2fiHispanic = $FULL2fiHispanic + $rowLoop->fiHispanic;

                                                  $FULL2fiOther = $FULL2fiOther + $rowLoop->fiOther;

                                                  $FULL2extForenEval = $FULL2extForenEval + $rowLoop->extForenEval;

                                                  $FULL2intCounsSes = $FULL2intCounsSes + $rowLoop->intCounsSes;

                                                  $FULL2totCounSes = $FULL2totCounSes + $rowLoop->totCounSes;

                                                  $FULL2multDisTeamMeet = $FULL2multDisTeamMeet + $rowLoop->multDisTeamMeet;

                                                  $FULL2prosCases = $FULL2prosCases + $rowLoop->prosCases;

                                                  $FULL2medExamRef = $FULL2medExamRef + $rowLoop->medExamRef;

                                                  $FULL2TotalService = $FULL2TotalService + $totalServices;

                                                }

                                                if ($rowLoop->quarter == 3){

                                                  $FULL3fiTotal = $FULL3fiTotal + $rowLoop->fiTotal;

                                                  $FULL3fi0to6 = $FULL3fi0to6 + $rowLoop->fi0to6;

                                                  $FULL3fi7to12 = $FULL3fi7to12 + $rowLoop->fi7to12;

                                                  $FULL3fi13to18 = $FULL3fi13to18 + $rowLoop->fi13to18;

                                                  $FULL3fiMale = $FULL3fiMale + $rowLoop->fiMale;

                                                  $FULL3fiFemale = $FULL3fiFemale + $rowLoop->fiFemale;

                                                  $FULL3fiAfrAmerican = $FULL3fiAfrAmerican + $rowLoop->fiAfrAmerican;

                                                  $FULL3fiAsian = $FULL3fiAsian + $rowLoop->fiAsian;

                                                  $FULL3fiCauc = $FULL3fiCauc + $rowLoop->fiCauc;

                                                  $FULL3fiHispanic = $FULL3fiHispanic + $rowLoop->fiHispanic;

                                                  $FULL3fiOther = $FULL3fiOther + $rowLoop->fiOther;

                                                  $FULL3extForenEval = $FULL3extForenEval + $rowLoop->extForenEval;

                                                  $FULL3intCounsSes = $FULL3intCounsSes + $rowLoop->intCounsSes;

                                                  $FULL3totCounSes = $FULL3totCounSes + $rowLoop->totCounSes;

                                                  $FULL3multDisTeamMeet = $FULL3multDisTeamMeet + $rowLoop->multDisTeamMeet;

                                                  $FULL3prosCases = $FULL3prosCases + $rowLoop->prosCases;

                                                  $FULL3medExamRef = $FULL3medExamRef + $rowLoop->medExamRef;

                                                  $FULL3TotalService = $FULL3TotalService + $totalServices;

                                                }

                                                if ($rowLoop->quarter == 4){

                                                  $FULL4fiTotal = $FULL4fiTotal + $rowLoop->fiTotal;

                                                  $FULL4fi0to6 = $FULL4fi0to6 + $rowLoop->fi0to6;

                                                  $FULL4fi7to12 = $FULL4fi7to12 + $rowLoop->fi7to12;

                                                  $FULL4fi13to18 = $FULL4fi13to18 + $rowLoop->fi13to18;

                                                  $FULL4fiMale = $FULL4fiMale + $rowLoop->fiMale;

                                                  $FULL4fiFemale = $FULL4fiFemale + $rowLoop->fiFemale;

                                                  $FULL4fiAfrAmerican = $FULL4fiAfrAmerican + $rowLoop->fiAfrAmerican;

                                                  $FULL4fiAsian = $FULL4fiAsian + $rowLoop->fiAsian;

                                                  $FULL4fiCauc = $FULL4fiCauc + $rowLoop->fiCauc;

                                                  $FULL4fiHispanic = $FULL4fiHispanic + $rowLoop->fiHispanic;

                                                  $FULL4fiOther = $FULL4fiOther + $rowLoop->fiOther;

                                                  $FULL4extForenEval = $FULL4extForenEval + $rowLoop->extForenEval;

                                                  $FULL4intCounsSes = $FULL4intCounsSes + $rowLoop->intCounsSes;

                                                  $FULL4totCounSes = $FULL4totCounSes + $rowLoop->totCounSes;

                                                  $FULL4multDisTeamMeet = $FULL4multDisTeamMeet + $rowLoop->multDisTeamMeet;

                                                  $FULL4prosCases = $FULL4prosCases + $rowLoop->prosCases;

                                                  $FULL4medExamRef = $FULL4medExamRef + $rowLoop->medExamRef;

                                                  $FULL4TotalService = $FULL4TotalService + $totalServices;

                                                }

                                        }

                                        echo '<tr align="right" class="BoldText"><td>TOTAL</td><td></td>';

                                        echo '<td class="">'.$YearfiTotal.'</td>';

                                        echo '<td>'.$Yearfi0to6.'</td>';

                                        echo '<td>'.$Yearfi7to12.'</td>';

                                        echo '<td>'.$Yearfi13to18.'</td>';

                                        echo '<td>'.$YearfiMale.'</td>';

                                        echo '<td>'.$YearfiFemale.'</td>';

                                        echo '<td>'.$YearfiAfrAmerican.'</td>';

                                        echo '<td>'.$YearfiAsian.'</td>';

                                        echo '<td>'.$YearfiCauc.'</td>';

                                        echo '<td>'.$YearfiHispanic.'</td>';

                                        echo '<td>'.$YearfiOther.'</td>';

                                        echo '<td class="">'.$YearextForenEval.'</td>';

                                        echo '<td class="">'.$YearintCounsSes.'</td>';

                                        echo '<td>'.$YeartotCounSes.'</td>';

                                        echo '<td>'.$YearmultDisTeamMeet.'</td>';

                                        echo '<td>'.$YearprosCases.'</td>';

                                        echo '<td>'.$YearmedExamRef.'</td>';

                                        echo '<td class="">'.$YearTotalService.'</td>';



                                        echo '<tr><td colspan="20"></td></tr>';

                                }

                                else{

                                        echo '<tr><td colspan="20">There is no total information for '.$rowAssociate->CenterName.'</td></tr>';

                                }

                                $counter = $counter + 1;

                                if ($counter == 5){

                                        echo '</table><div class="page-break"></div><div class="nav"><br /></div><table width="85%" class="Admin">';

                                        printHeaders();

                                        $counter = 0;

                                }

                        }

                        echo '<tr><td colspan="20" align="center"><b><h2>Associate Member Totals</h2></b></td></tr>';

                        printTotalHeaders('All Associate Member Centers');

                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 1ST QTR</b></td>';

                        echo '<td class="">'.$FULL1fiTotal.'</td>';

                        $GRANDTOTAL1fiTotal = $GRANDTOTAL1fiTotal + $FULL1fiTotal;

                        echo '<td class="">'.$FULL1fi0to6.'</td>';

                        $GRANDTOTAL1fi0to6 = $GRANDTOTAL1fi0to6 + $FULL1fi0to6;

                        echo '<td class="">'.$FULL1fi7to12.'</td>';

                        $GRANDTOTAL1fi7to12 = $GRANDTOTAL1fi7to12 + $FULL1fi7to12;

                        echo '<td class="">'.$FULL1fi13to18.'</td>';

                        $GRANDTOTAL1fi13to18 = $GRANDTOTAL1fi13to18 + $FULL1fi13to18;

                        echo '<td class="">'.$FULL1fiMale.'</td>';

                        $GRANDTOTAL1fiMale = $GRANDTOTAL1fiMale + $FULL1fiMale;

                        echo '<td class="">'.$FULL1fiFemale.'</td>';

                        $GRANDTOTAL1fiFemale = $GRANDTOTAL1fiFemale + $FULL1fiFemale;

                        echo '<td class="">'.$FULL1fiAfrAmerican.'</td>';

                        $GRANDTOTAL1fiAfrAmerican = $GRANDTOTAL1fiAfrAmerican + $FULL1fiAfrAmerican;

                        echo '<td class="">'.$FULL1fiAsian.'</td>';

                        $GRANDTOTAL1fiAsian = $GRANDTOTAL1fiAsian + $FULL1fiAsian;

                        echo '<td class="">'.$FULL1fiCauc.'</td>';

                        $GRANDTOTAL1fiCauc = $GRANDTOTAL1fiCauc + $FULL1fiCauc;

                        echo '<td class="">'.$FULL1fiHispanic.'</td>';

                        $GRANDTOTAL1fiHispanic = $GRANDTOTAL1fiHispanic + $FULL1fiHispanic;

                        echo '<td class="">'.$FULL1fiOther.'</td>';

                        $GRANDTOTAL1fiOther = $GRANDTOTAL1fiOther + $FULL1fiOther;

                        echo '<td class="">'.$FULL1extForenEval.'</td>';

                        $GRANDTOTAL1extForenEval = $GRANDTOTAL1extForenEval + $FULL1extForenEval;

                        echo '<td class="">'.$FULL1intCounsSes.'</td>';

                        $GRANDTOTAL1intCounsSes = $GRANDTOTAL1intCounsSes + $FULL1intCounsSes;

                        echo '<td class="">'.$FULL1totCounSes.'</td>';

                        $GRANDTOTAL1totCounSes = $GRANDTOTAL1totCounSes + $FULL1totCounSes;

                        echo '<td class="">'.$FULL1multDisTeamMeet.'</td>';

                        $GRANDTOTAL1multDisTeamMeet = $GRANDTOTAL1multDisTeamMeet + $FULL1multDisTeamMeet;

                        echo '<td class="">'.$FULL1prosCases.'</td>';

                        $GRANDTOTAL1prosCases = $GRANDTOTAL1prosCases + $FULL1prosCases;

                        echo '<td class="">'.$FULL1medExamRef.'</td>';

                        $GRANDTOTAL1medExamRefl = $GRANDTOTAL1medExamRefl + $FULL1medExamRef;

                        echo '<td class="">'.$FULL1TotalService.'</td></tr>';

                        $GRANDTOTAL1TotalService = $GRANDTOTAL1TotalService + $FULL1TotalService;

                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 2ND QTR</b></td>';

                        echo '<td class="">'.$FULL2fiTotal.'</td>';

                        $GRANDTOTAL2fiTotal = $GRANDTOTAL2fiTotal + $FULL2fiTotal;

                        echo '<td class="">'.$FULL2fi0to6.'</td>';

                        $GRANDTOTAL2fi0to6 = $GRANDTOTAL2fi0to6 + $FULL2fi0to6;

                        echo '<td class="">'.$FULL2fi7to12.'</td>';

                        $GRANDTOTAL2fi7to12 = $GRANDTOTAL2fi7to12 + $FULL2fi7to12;

                        echo '<td class="">'.$FULL2fi13to18.'</td>';

                        $GRANDTOTAL2fi13to18 = $GRANDTOTAL2fi13to18 + $FULL2fi13to18;

                        echo '<td class="">'.$FULL2fiMale.'</td>';

                        $GRANDTOTAL2fiMale = $GRANDTOTAL2fiMale + $FULL2fiMale;

                        echo '<td class="">'.$FULL2fiFemale.'</td>';

                        $GRANDTOTAL2fiFemale = $GRANDTOTAL2fiFemale + $FULL2fiFemale;

                        echo '<td class="">'.$FULL2fiAfrAmerican.'</td>';

                        $GRANDTOTAL2fiAfrAmerican = $GRANDTOTAL2fiAfrAmerican + $FULL2fiAfrAmerican;

                        echo '<td class="">'.$FULL2fiAsian.'</td>';

                        $GRANDTOTAL2fiAsian = $GRANDTOTAL2fiAsian + $FULL2fiAsian;

                        echo '<td class="">'.$FULL2fiCauc.'</td>';

                        $GRANDTOTAL2fiCauc = $GRANDTOTAL2fiCauc + $FULL2fiCauc;

                        echo '<td class="">'.$FULL2fiHispanic.'</td>';

                        $GRANDTOTAL2fiHispanic = $GRANDTOTAL2fiHispanic + $FULL2fiHispanic;

                        echo '<td class="">'.$FULL2fiOther.'</td>';

                        $GRANDTOTAL2fiOther = $GRANDTOTAL2fiOther + $FULL2fiOther;

                        echo '<td class="">'.$FULL2extForenEval.'</td>';

                        $GRANDTOTAL2extForenEval = $GRANDTOTAL2extForenEval + $FULL2extForenEval;

                        echo '<td class="">'.$FULL2intCounsSes.'</td>';

                        $GRANDTOTAL2intCounsSes = $GRANDTOTAL2intCounsSes + $FULL2intCounsSes;

                        echo '<td class="">'.$FULL2totCounSes.'</td>';

                        $GRANDTOTAL2totCounSes = $GRANDTOTAL2totCounSes + $FULL2totCounSes;

                        echo '<td class="">'.$FULL2multDisTeamMeet.'</td>';

                        $GRANDTOTAL2multDisTeamMeet = $GRANDTOTAL2multDisTeamMeet + $FULL2multDisTeamMeet;

                        echo '<td class="">'.$FULL2prosCases.'</td>';

                        $GRANDTOTAL2prosCases = $GRANDTOTAL2prosCases + $FULL2prosCases;

                        echo '<td class="">'.$FULL2medExamRef.'</td>';

                        $GRANDTOTAL2medExamRefl = $GRANDTOTAL2medExamRefl + $FULL2medExamRef;

                        echo '<td class="">'.$FULL2TotalService.'</td></tr>';

                        $GRANDTOTAL2TotalService = $GRANDTOTAL2TotalService + $FULL2TotalService;

                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 3RD QTR</b></td>';

                        echo '<td class="">'.$FULL3fiTotal.'</td>';

                        $GRANDTOTAL3fiTotal = $GRANDTOTAL3fiTotal + $FULL3fiTotal;

                        echo '<td class="">'.$FULL3fi0to6.'</td>';

                        $GRANDTOTAL3fi0to6 = $GRANDTOTAL3fi0to6 + $FULL3fi0to6;

                        echo '<td class="">'.$FULL3fi7to12.'</td>';

                        $GRANDTOTAL3fi7to12 = $GRANDTOTAL3fi7to12 + $FULL3fi7to12;

                        echo '<td class="">'.$FULL3fi13to18.'</td>';

                        $GRANDTOTAL3fi13to18 = $GRANDTOTAL3fi13to18 + $FULL3fi13to18;

                        echo '<td class="">'.$FULL3fiMale.'</td>';

                        $GRANDTOTAL3fiMale = $GRANDTOTAL3fiMale + $FULL3fiMale;

                        echo '<td class="">'.$FULL3fiFemale.'</td>';

                        $GRANDTOTAL3fiFemale = $GRANDTOTAL3fiFemale + $FULL3fiFemale;

                        echo '<td class="">'.$FULL3fiAfrAmerican.'</td>';

                        $GRANDTOTAL3fiAfrAmerican = $GRANDTOTAL3fiAfrAmerican + $FULL3fiAfrAmerican;

                        echo '<td class="">'.$FULL3fiAsian.'</td>';

                        $GRANDTOTAL3fiAsian = $GRANDTOTAL3fiAsian + $FULL3fiAsian;

                        echo '<td class="">'.$FULL3fiCauc.'</td>';

                        $GRANDTOTAL3fiCauc = $GRANDTOTAL3fiCauc + $FULL3fiCauc;

                        echo '<td class="">'.$FULL3fiHispanic.'</td>';

                        $GRANDTOTAL3fiHispanic = $GRANDTOTAL3fiHispanic + $FULL3fiHispanic;

                        echo '<td class="">'.$FULL3fiOther.'</td>';

                        $GRANDTOTAL3fiOther = $GRANDTOTAL3fiOther + $FULL3fiOther;

                        echo '<td class="">'.$FULL3extForenEval.'</td>';

                        $GRANDTOTAL3extForenEval = $GRANDTOTAL3extForenEval + $FULL3extForenEval;

                        echo '<td class="">'.$FULL3intCounsSes.'</td>';

                        $GRANDTOTAL3intCounsSes = $GRANDTOTAL3intCounsSes + $FULL3intCounsSes;

                        echo '<td class="">'.$FULL3totCounSes.'</td>';

                        $GRANDTOTAL3totCounSes = $GRANDTOTAL3totCounSes + $FULL3totCounSes;

                        echo '<td class="">'.$FULL3multDisTeamMeet.'</td>';

                        $GRANDTOTAL3multDisTeamMeet = $GRANDTOTAL3multDisTeamMeet + $FULL3multDisTeamMeet;

                        echo '<td class="">'.$FULL3prosCases.'</td>';

                        $GRANDTOTAL3prosCases = $GRANDTOTAL3prosCases + $FULL3prosCases;

                        echo '<td class="">'.$FULL3medExamRef.'</td>';

                        $GRANDTOTAL3medExamRefl = $GRANDTOTAL3medExamRefl + $FULL3medExamRef;

                        echo '<td class="">'.$FULL3TotalService.'</td></tr>';

                        $GRANDTOTAL3TotalService = $GRANDTOTAL3TotalService + $FULL3TotalService;

                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 4TH QTR</b></td>';

                        echo '<td class="">'.$FULL4fiTotal.'</td>';

                        $GRANDTOTAL4fiTotal = $GRANDTOTAL4fiTotal + $FULL4fiTotal;

                        echo '<td class="">'.$FULL4fi0to6.'</td>';

                        $GRANDTOTAL4fi0to6 = $GRANDTOTAL4fi0to6 + $FULL4fi0to6;

                        echo '<td class="">'.$FULL4fi7to12.'</td>';

                        $GRANDTOTAL4fi7to12 = $GRANDTOTAL4fi7to12 + $FULL4fi7to12;

                        echo '<td class="">'.$FULL4fi13to18.'</td>';

                        $GRANDTOTAL4fi13to18 = $GRANDTOTAL4fi13to18 + $FULL4fi13to18;

                        echo '<td class="">'.$FULL4fiMale.'</td>';

                        $GRANDTOTAL4fiMale = $GRANDTOTAL4fiMale + $FULL4fiMale;

                        echo '<td class="">'.$FULL4fiFemale.'</td>';

                        $GRANDTOTAL4fiFemale = $GRANDTOTAL4fiFemale + $FULL4fiFemale;

                        echo '<td class="">'.$FULL4fiAfrAmerican.'</td>';

                        $GRANDTOTAL4fiAfrAmerican = $GRANDTOTAL4fiAfrAmerican + $FULL4fiAfrAmerican;

                        echo '<td class="">'.$FULL4fiAsian.'</td>';

                        $GRANDTOTAL4fiAsian = $GRANDTOTAL4fiAsian + $FULL4fiAsian;

                        echo '<td class="">'.$FULL4fiCauc.'</td>';

                        $GRANDTOTAL4fiCauc = $GRANDTOTAL4fiCauc + $FULL4fiCauc;

                        echo '<td class="">'.$FULL4fiHispanic.'</td>';

                        $GRANDTOTAL4fiHispanic = $GRANDTOTAL4fiHispanic + $FULL4fiHispanic;

                        echo '<td class="">'.$FULL4fiOther.'</td>';

                        $GRANDTOTAL4fiOther = $GRANDTOTAL4fiOther + $FULL4fiOther;

                        echo '<td class="">'.$FULL4extForenEval.'</td>';

                        $GRANDTOTAL4extForenEval = $GRANDTOTAL4extForenEval + $FULL4extForenEval;

                        echo '<td class="">'.$FULL4intCounsSes.'</td>';

                        $GRANDTOTAL4intCounsSes = $GRANDTOTAL4intCounsSes + $FULL4intCounsSes;

                        echo '<td class="">'.$FULL4totCounSes.'</td>';

                        $GRANDTOTAL4totCounSes = $GRANDTOTAL4totCounSes + $FULL4totCounSes;

                        echo '<td class="">'.$FULL4multDisTeamMeet.'</td>';

                        $GRANDTOTAL4multDisTeamMeet = $GRANDTOTAL4multDisTeamMeet + $FULL4multDisTeamMeet;

                        echo '<td class="">'.$FULL4prosCases.'</td>';

                        $GRANDTOTAL4prosCases = $GRANDTOTAL4prosCases + $FULL4prosCases;

                        echo '<td class="">'.$FULL4medExamRef.'</td>';

                        $GRANDTOTAL4medExamRefl = $GRANDTOTAL4medExamRefl + $FULL4medExamRef;

                        echo '<td class="">'.$FULL4TotalService.'</td></tr>';

                        $GRANDTOTAL4TotalService = $GRANDTOTAL4TotalService + $FULL4TotalService;

                        echo '<tr align="right" class="BoldText"><td colspan="2" align="center">TOTAL</td>';

                        $FULLTOTALfiTotal = $FULL1fiTotal+$FULL2fiTotal+$FULL3fiTotal+$FULL4fiTotal;

                        echo '<td class="">'.$FULLTOTALfiTotal.'</td>';

                        $FULLTOTALfi0to6 = $FULL1fi0to6+$FULL2fi0to6+$FULL3fi0to6+$FULL4fi0to6;

                        echo '<td>'.$FULLTOTALfi0to6.'</td>';

                        $FULLTOTALfi7to12 = $FULL1fi7to12+$FULL2fi7to12+$FULL3fi7to12+$FULL4fi7to12;

                        echo '<td>'.$FULLTOTALfi7to12.'</td>';

                        $FULLTOTALfi13to18 = $FULL1fi13to18+$FULL2fi13to18+$FULL3fi13to18+$FULL4fi13to18;

                        echo '<td>'.$FULLTOTALfi13to18.'</td>';

                        $FULLTOTALfiMale = $FULL1fiMale+$FULL2fiMale+$FULL3fiMale+$FULL4fiMale;

                        echo '<td>'.$FULLTOTALfiMale.'</td>';

                        $FULLTOTALfiFemale = $FULL1fiFemale+$FULL2fiFemale+$FULL3fiFemale+$FULL4fiFemale;

                        echo '<td>'.$FULLTOTALfiFemale.'</td>';

                        $FULLTOTALfiAfrAmerican = $FULL1fiAfrAmerican+$FULL2fiAfrAmerican+$FULL3fiAfrAmerican+$FULL4fiAfrAmerican;

                        echo '<td>'.$FULLTOTALfiAfrAmerican.'</td>';

                        $FULLTOTALfiAsian = $FULL1fiAsian+$FULL2fiAsian+$FULL3fiAsian+$FULL4fiAsian;

                        echo '<td>'.$FULLTOTALfiAsian.'</td>';

                        $FULLTOTALfiCauc = $FULL1fiCauc+$FULL2fiCauc+$FULL3fiCauc+$FULL4fiCauc;

                        echo '<td>'.$FULLTOTALfiCauc.'</td>';

                        $FULLTOTALfiHispanic = $FULL1fiHispanic+$FULL2fiHispanic+$FULL3fiHispanic+$FULL4fiHispanic;

                        echo '<td>'.$FULLTOTALfiHispanic.'</td>';

                        $FULLTOTALfiOther = $FULL1fiOther+$FULL2fiOther+$FULL3fiOther+$FULL4fiOther;

                        echo '<td>'.$FULLTOTALfiOther.'</td>';

                        $FULLTOTALextForenEval = $FULL1extForenEval+$FULL2extForenEval+$FULL3extForenEval+$FULL4extForenEval;

                        echo '<td class="">'.$FULLTOTALextForenEval.'</td>';

                        $FULLTOTALintCounsSes = $FULL1intCounsSes+$FULL2intCounsSes+$FULL3intCounsSes+$FULL4intCounsSes;

                        echo '<td class="">'.$FULLTOTALintCounsSes.'</td>';

                        $FULLTOTALtotCounSes = $FULL1totCounSes+$FULL2totCounSes+$FULL3totCounSes+$FULL4totCounSes;

                        echo '<td>'.$FULLTOTALtotCounSes.'</td>';

                        $FULLTOTALmultDisTeamMeet = $FULL1multDisTeamMeet+$FULL2multDisTeamMeet+$FULL3multDisTeamMeet+$FULL4multDisTeamMeet;

                        echo '<td>'.$FULLTOTALmultDisTeamMeet.'</td>';

                        $FULLTOTALprosCases = $FULL1prosCases+$FULL2prosCases+$FULL3prosCases+$FULL4prosCases;

                        echo '<td>'.$FULLTOTALprosCases.'</td>';

                        $FULLTOTALmedExamRef = $FULL1medExamRef+$FULL2medExamRef+$FULL3medExamRef+$FULL4medExamRef;

                        echo '<td>'.$FULLTOTALmedExamRef.'</td>';

                        $FULLTOTALTotalService = $FULL1TotalService+$FULL2TotalService+$FULL3TotalService+$FULL4TotalService;

                        echo '<td class="">'.$FULLTOTALTotalService.'</td></tr>';

                }

                else{

                        echo '<tr class="BoldHeader"><td align="center"><h2>There are no Associate Member center totals for FY - '.$fiscalYear.'</h2></td></tr>';

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

                        echo '<tr class="BoldHeader"><td colspan="20" align="center"><h2>Pilot Projects</h2></td></tr>';

                        printHeaders();

                        $FULL1fiTotal = 0;

                        $FULL1fi0to6 = 0;

                        $FULL1fi7to12 = 0;

                        $FULL1fi13to18 = 0;

                        $FULL1fiMale = 0;

                        $FULL1fiFemale = 0;

                        $FULL1fiAfrAmerican = 0;

                        $FULL1fiAsian = 0;

                        $FULL1fiCauc = 0;

                        $FULL1fiHispanic = 0;

                        $FULL1fiOther = 0;

                        $FULL1extForenEval = 0;

                        $FULL1intCounsSes = 0;

                        $FULL1totCounSes = 0;

                        $FULL1multDisTeamMeet = 0;

                        $FULL1prosCases = 0;

                        $FULL1medExamRef = 0;

                        $FULL1TotalService = 0;

                        $FULL2fiTotal = 0;

                        $FULL2fi0to6 = 0;

                        $FULL2fi7to12 = 0;

                        $FULL2fi13to18 = 0;

                        $FULL2fiMale = 0;

                        $FULL2fiFemale = 0;

                        $FULL2fiAfrAmerican = 0;

                        $FULL2fiAsian = 0;

                        $FULL2fiCauc = 0;

                        $FULL2fiHispanic = 0;

                        $FULL2fiOther = 0;

                        $FULL2extForenEval = 0;

                        $FULL2intCounsSes = 0;

                        $FULL2totCounSes = 0;

                        $FULL2multDisTeamMeet = 0;

                        $FULL2prosCases = 0;

                        $FULL2medExamRef = 0;

                        $FULL2TotalService = 0;

                        $FULL3fiTotal = 0;

                        $FULL3fi0to6 = 0;

                        $FULL3fi7to12 = 0;

                        $FULL3fi13to18 = 0;

                        $FULL3fiMale = 0;

                        $FULL3fiFemale = 0;

                        $FULL3fiAfrAmerican = 0;

                        $FULL3fiAsian = 0;

                        $FULL3fiCauc = 0;

                        $FULL3fiHispanic = 0;

                        $FULL3fiOther = 0;

                        $FULL3extForenEval = 0;

                        $FULL3intCounsSes = 0;

                        $FULL3totCounSes = 0;

                        $FULL3multDisTeamMeet = 0;

                        $FULL3prosCases = 0;

                        $FULL3medExamRef = 0;

                        $FULL3TotalService = 0;

                        $FULL4fiTotal = 0;

                        $FULL4fi0to6 = 0;

                        $FULL4fi7to12 = 0;

                        $FULL4fi13to18 = 0;

                        $FULL4fiMale = 0;

                        $FULL4fiFemale = 0;

                        $FULL4fiAfrAmerican = 0;

                        $FULL4fiAsian = 0;

                        $FULL4fiCauc = 0;

                        $FULL4fiHispanic = 0;

                        $FULL4fiOther = 0;

                        $FULL4extForenEval = 0;

                        $FULL4intCounsSes = 0;

                        $FULL4totCounSes = 0;

                        $FULL4multDisTeamMeet = 0;

                        $FULL4prosCases = 0;

                        $FULL4medExamRef = 0;

                        $FULL4TotalService = 0;

                        $counter = 0;

                        while ($rowPilot = mysql_fetch_object($resultPilot)) {



                                //$sqlLoop = "SELECT fiTotal, fi0to6, fi7to12, fi13to18, fiMale, fiFemale, fiAfrAmerican, fiAsian, fiCauc, fiHispanic, fiOther, extForenEval, ".

                                //        "intCounsSes, totCounSes, multDisTeamMeet, prosCases, medExamRef, quarter FROM actualPerfStats WHERE center = ".$rowPilot->center." AND ".

                                //        "fiscalyear = ".$fiscalYear." ORDER BY quarter";

                                        

                                $sqlLoop = "SELECT fiTotal, fi0to6, fi7to12, fi13to18, fiMale, fiFemale, fiAfrAmerican, fiAsian, fiCauc, fiHispanic, fiOther, extForenEval, ".

                                        "intCounsSes, totCounSes, multDisTeamMeet, prosCases, medExamRef, actualPerfStats.quarter FROM actualPerfStats JOIN actualExpenditures ON actualPerfStats.center = actualExpenditures.center ".

                                        "AND actualPerfStats.fiscalyear = actualExpenditures.fiscalyear and actualPerfStats.quarter = actualExpenditures.quarter WHERE actualPerfStats.center = ".$rowPilot->center." AND ".

                                        "actualPerfStats.fiscalyear = ".$fiscalYear." AND actualExpenditures.completed = 'COM' ORDER BY actualPerfStats.quarter";



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

                                        $Yearfi0to6 = 0;

                                        $Yearfi7to12 = 0;

                                        $Yearfi13to18 = 0;

                                        $YearfiMale = 0;

                                        $YearfiFemale = 0;

                                        $YearfiAfrAmerican = 0;

                                        $YearfiAsian = 0;

                                        $YearfiCauc = 0;

                                        $YearfiHispanic = 0;

                                        $YearfiOther = 0;

                                        $YearextForenEval = 0;

                                        $YearintCounsSes = 0;

                                        $YeartotCounSes = 0;

                                        $YearmultDisTeamMeet = 0;

                                        $YearprosCases = 0;

                                        $YearmedExamRef = 0;

                                        $YearTotalService = 0;



                                        while ($rowLoop = mysql_fetch_object($resultLoop)) {

                                                echo '<tr align="right">';

                                                //Only show the center name for the first quarter

                                                if ($rowLoop->quarter == 1)

                                                        echo '<td align="left">'.$rowPilot->CenterName.'</td>';

                                                else

                                                        echo '<td></td>';



                                                echo '<td align="center">'.$rowLoop->quarter.'</td>';

                                                echo '<td class="TotalCell">'.$rowLoop->fiTotal.'</td>';

                                                $YearfiTotal = $YearfiTotal + $rowLoop->fiTotal;

                                                echo '<td>'.$rowLoop->fi0to6.'</td>';

                                                $Yearfi0to6 = $Yearfi0to6 + $rowLoop->fi0to6;

                                                echo '<td>'.$rowLoop->fi7to12.'</td>';

                                                $Yearfi7to12 = $Yearfi7to12 + $rowLoop->fi7to12;

                                                echo '<td>'.$rowLoop->fi13to18.'</td>';

                                                $Yearfi13to18 = $Yearfi13to18 + $rowLoop->fi13to18;

                                                echo '<td>'.$rowLoop->fiMale.'</td>';

                                                $YearfiMale = $YearfiMale + $rowLoop->fiMale;

                                                echo '<td>'.$rowLoop->fiFemale.'</td>';

                                                $YearfiFemale = $YearfiFemale + $rowLoop->fiFemale;

                                                echo '<td>'.$rowLoop->fiAfrAmerican.'</td>';

                                                $YearfiAfrAmerican = $YearfiAfrAmerican + $rowLoop->fiAfrAmerican;

                                                echo '<td>'.$rowLoop->fiAsian.'</td>';

                                                $YearfiAsian = $YearfiAsian + $rowLoop->fiAsian;

                                                echo '<td>'.$rowLoop->fiCauc.'</td>';

                                                $YearfiCauc = $YearfiCauc + $rowLoop->fiCauc;

                                                echo '<td>'.$rowLoop->fiHispanic.'</td>';

                                                $YearfiHispanic = $YearfiHispanic + $rowLoop->fiHispanic;

                                                echo '<td>'.$rowLoop->fiOther.'</td>';

                                                $YearfiOther = $YearfiOther + $rowLoop->fiOther;

                                                echo '<td class="">'.$rowLoop->extForenEval.'</td>';

                                                $YearextForenEval = $YearextForenEval + $rowLoop->extForenEval;

                                                echo '<td class="">'.$rowLoop->intCounsSes.'</td>';

                                                $YearintCounsSes = $YearintCounsSes + $rowLoop->intCounsSes;

                                                echo '<td>'.$rowLoop->totCounSes.'</td>';

                                                $YeartotCounSes = $YeartotCounSes + $rowLoop->totCounSes;

                                                echo '<td>'.$rowLoop->multDisTeamMeet.'</td>';

                                                $YearmultDisTeamMeet = $YearmultDisTeamMeet + $rowLoop->multDisTeamMeet;

                                                echo '<td>'.$rowLoop->prosCases.'</td>';

                                                $YearprosCases = $YearprosCases + $rowLoop->prosCases;

                                                echo '<td>'.$rowLoop->medExamRef.'</td>';

                                                $YearmedExamRef = $YearmedExamRef + $rowLoop->medExamRef;

                                                $totalServices = $rowLoop->fiTotal + $rowLoop->extForenEval + $rowLoop->intCounsSes;

                                                echo '<td class="">'.$totalServices.'</td>';

                                                $YearTotalService = $YearTotalService + $totalServices;

                                                

                                                //Keep track of the Quarter Totals

                                                if ($rowLoop->quarter == 1){

                                                  $FULL1fiTotal = $FULL1fiTotal + $rowLoop->fiTotal;

                                                  $FULL1fi0to6 = $FULL1fi0to6 + $rowLoop->fi0to6;

                                                  $FULL1fi7to12 = $FULL1fi7to12 + $rowLoop->fi7to12;

                                                  $FULL1fi13to18 = $FULL1fi13to18 + $rowLoop->fi13to18;

                                                  $FULL1fiMale = $FULL1fiMale + $rowLoop->fiMale;

                                                  $FULL1fiFemale = $FULL1fiFemale + $rowLoop->fiFemale;

                                                  $FULL1fiAfrAmerican = $FULL1fiAfrAmerican + $rowLoop->fiAfrAmerican;

                                                  $FULL1fiAsian = $FULL1fiAsian + $rowLoop->fiAsian;

                                                  $FULL1fiCauc = $FULL1fiCauc + $rowLoop->fiCauc;

                                                  $FULL1fiHispanic = $FULL1fiHispanic + $rowLoop->fiHispanic;

                                                  $FULL1fiOther = $FULL1fiOther + $rowLoop->fiOther;

                                                  $FULL1extForenEval = $FULL1extForenEval + $rowLoop->extForenEval;

                                                  $FULL1intCounsSes = $FULL1intCounsSes + $rowLoop->intCounsSes;

                                                  $FULL1totCounSes = $FULL1totCounSes + $rowLoop->totCounSes;

                                                  $FULL1multDisTeamMeet = $FULL1multDisTeamMeet + $rowLoop->multDisTeamMeet;

                                                  $FULL1prosCases = $FULL1prosCases + $rowLoop->prosCases;

                                                  $FULL1medExamRef = $FULL1medExamRef + $rowLoop->medExamRef;

                                                  $FULL1TotalService = $FULL1TotalService + $totalServices;

                                                }

                                                if ($rowLoop->quarter == 2){

                                                  $FULL2fiTotal = $FULL2fiTotal + $rowLoop->fiTotal;

                                                  $FULL2fi0to6 = $FULL2fi0to6 + $rowLoop->fi0to6;

                                                  $FULL2fi7to12 = $FULL2fi7to12 + $rowLoop->fi7to12;

                                                  $FULL2fi13to18 = $FULL2fi13to18 + $rowLoop->fi13to18;

                                                  $FULL2fiMale = $FULL2fiMale + $rowLoop->fiMale;

                                                  $FULL2fiFemale = $FULL2fiFemale + $rowLoop->fiFemale;

                                                  $FULL2fiAfrAmerican = $FULL2fiAfrAmerican + $rowLoop->fiAfrAmerican;

                                                  $FULL2fiAsian = $FULL2fiAsian + $rowLoop->fiAsian;

                                                  $FULL2fiCauc = $FULL2fiCauc + $rowLoop->fiCauc;

                                                  $FULL2fiHispanic = $FULL2fiHispanic + $rowLoop->fiHispanic;

                                                  $FULL2fiOther = $FULL2fiOther + $rowLoop->fiOther;

                                                  $FULL2extForenEval = $FULL2extForenEval + $rowLoop->extForenEval;

                                                  $FULL2intCounsSes = $FULL2intCounsSes + $rowLoop->intCounsSes;

                                                  $FULL2totCounSes = $FULL2totCounSes + $rowLoop->totCounSes;

                                                  $FULL2multDisTeamMeet = $FULL2multDisTeamMeet + $rowLoop->multDisTeamMeet;

                                                  $FULL2prosCases = $FULL2prosCases + $rowLoop->prosCases;

                                                  $FULL2medExamRef = $FULL2medExamRef + $rowLoop->medExamRef;

                                                  $FULL2TotalService = $FULL2TotalService + $totalServices;

                                                }

                                                if ($rowLoop->quarter == 3){

                                                  $FULL3fiTotal = $FULL3fiTotal + $rowLoop->fiTotal;

                                                  $FULL3fi0to6 = $FULL3fi0to6 + $rowLoop->fi0to6;

                                                  $FULL3fi7to12 = $FULL3fi7to12 + $rowLoop->fi7to12;

                                                  $FULL3fi13to18 = $FULL3fi13to18 + $rowLoop->fi13to18;

                                                  $FULL3fiMale = $FULL3fiMale + $rowLoop->fiMale;

                                                  $FULL3fiFemale = $FULL3fiFemale + $rowLoop->fiFemale;

                                                  $FULL3fiAfrAmerican = $FULL3fiAfrAmerican + $rowLoop->fiAfrAmerican;

                                                  $FULL3fiAsian = $FULL3fiAsian + $rowLoop->fiAsian;

                                                  $FULL3fiCauc = $FULL3fiCauc + $rowLoop->fiCauc;

                                                  $FULL3fiHispanic = $FULL3fiHispanic + $rowLoop->fiHispanic;

                                                  $FULL3fiOther = $FULL3fiOther + $rowLoop->fiOther;

                                                  $FULL3extForenEval = $FULL3extForenEval + $rowLoop->extForenEval;

                                                  $FULL3intCounsSes = $FULL3intCounsSes + $rowLoop->intCounsSes;

                                                  $FULL3totCounSes = $FULL3totCounSes + $rowLoop->totCounSes;

                                                  $FULL3multDisTeamMeet = $FULL3multDisTeamMeet + $rowLoop->multDisTeamMeet;

                                                  $FULL3prosCases = $FULL3prosCases + $rowLoop->prosCases;

                                                  $FULL3medExamRef = $FULL3medExamRef + $rowLoop->medExamRef;

                                                  $FULL3TotalService = $FULL3TotalService + $totalServices;

                                                }

                                                if ($rowLoop->quarter == 4){

                                                  $FULL4fiTotal = $FULL4fiTotal + $rowLoop->fiTotal;

                                                  $FULL4fi0to6 = $FULL4fi0to6 + $rowLoop->fi0to6;

                                                  $FULL4fi7to12 = $FULL4fi7to12 + $rowLoop->fi7to12;

                                                  $FULL4fi13to18 = $FULL4fi13to18 + $rowLoop->fi13to18;

                                                  $FULL4fiMale = $FULL4fiMale + $rowLoop->fiMale;

                                                  $FULL4fiFemale = $FULL4fiFemale + $rowLoop->fiFemale;

                                                  $FULL4fiAfrAmerican = $FULL4fiAfrAmerican + $rowLoop->fiAfrAmerican;

                                                  $FULL4fiAsian = $FULL4fiAsian + $rowLoop->fiAsian;

                                                  $FULL4fiCauc = $FULL4fiCauc + $rowLoop->fiCauc;

                                                  $FULL4fiHispanic = $FULL4fiHispanic + $rowLoop->fiHispanic;

                                                  $FULL4fiOther = $FULL4fiOther + $rowLoop->fiOther;

                                                  $FULL4extForenEval = $FULL4extForenEval + $rowLoop->extForenEval;

                                                  $FULL4intCounsSes = $FULL4intCounsSes + $rowLoop->intCounsSes;

                                                  $FULL4totCounSes = $FULL4totCounSes + $rowLoop->totCounSes;

                                                  $FULL4multDisTeamMeet = $FULL4multDisTeamMeet + $rowLoop->multDisTeamMeet;

                                                  $FULL4prosCases = $FULL4prosCases + $rowLoop->prosCases;

                                                  $FULL4medExamRef = $FULL4medExamRef + $rowLoop->medExamRef;

                                                  $FULL4TotalService = $FULL4TotalService + $totalServices;

                                                }

                                        }

                                        echo '<tr align="right" class="BoldText"><td>TOTAL</td><td></td>';

                                        echo '<td class="TotalCell">'.$YearfiTotal.'</td>';

                                        echo '<td>'.$Yearfi0to6.'</td>';

                                        echo '<td>'.$Yearfi7to12.'</td>';

                                        echo '<td>'.$Yearfi13to18.'</td>';

                                        echo '<td>'.$YearfiMale.'</td>';

                                        echo '<td>'.$YearfiFemale.'</td>';

                                        echo '<td>'.$YearfiAfrAmerican.'</td>';

                                        echo '<td>'.$YearfiAsian.'</td>';

                                        echo '<td>'.$YearfiCauc.'</td>';

                                        echo '<td>'.$YearfiHispanic.'</td>';

                                        echo '<td>'.$YearfiOther.'</td>';

                                        echo '<td class="">'.$YearextForenEval.'</td>';

                                        echo '<td class="">'.$YearintCounsSes.'</td>';

                                        echo '<td>'.$YeartotCounSes.'</td>';

                                        echo '<td>'.$YearmultDisTeamMeet.'</td>';

                                        echo '<td>'.$YearprosCases.'</td>';

                                        echo '<td>'.$YearmedExamRef.'</td>';

                                        echo '<td class="">'.$YearTotalService.'</td>';



                                        echo '<tr><td colspan="20"></td></tr>';

                                }

                                else{

                                        echo '<tr><td colspan="20">There is no total information for '.$rowPilot->CenterName.'</td></tr>';

                                }

                                $counter = $counter + 1;

                                if ($counter == 5){

                                        echo '</table><div class="page-break"></div><div class="nav"><br /></div><table width="85%" class="Admin">';

                                        printHeaders();

                                        $counter = 0;

                                }

                        }

                        echo '<tr><td colspan="20" align="center"><b><h2>Pilot Project Totals</h2></b></td></tr>';

                        printTotalHeaders('All Pilot Project Centers');

                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 1ST QTR</b></td>';

                        echo '<td class="TotalCell">'.$FULL1fiTotal.'</td>';

                        $GRANDTOTAL1fiTotal = $GRANDTOTAL1fiTotal + $FULL1fiTotal;

                        echo '<td class="">'.$FULL1fi0to6.'</td>';

                        $GRANDTOTAL1fi0to6 = $GRANDTOTAL1fi0to6 + $FULL1fi0to6;

                        echo '<td class="">'.$FULL1fi7to12.'</td>';

                        $GRANDTOTAL1fi7to12 = $GRANDTOTAL1fi7to12 + $FULL1fi7to12;

                        echo '<td class="">'.$FULL1fi13to18.'</td>';

                        $GRANDTOTAL1fi13to18 = $GRANDTOTAL1fi13to18 + $FULL1fi13to18;

                        echo '<td class="">'.$FULL1fiMale.'</td>';

                        $GRANDTOTAL1fiMale = $GRANDTOTAL1fiMale + $FULL1fiMale;

                        echo '<td class="">'.$FULL1fiFemale.'</td>';

                        $GRANDTOTAL1fiFemale = $GRANDTOTAL1fiFemale + $FULL1fiFemale;

                        echo '<td class="">'.$FULL1fiAfrAmerican.'</td>';

                        $GRANDTOTAL1fiAfrAmerican = $GRANDTOTAL1fiAfrAmerican + $FULL1fiAfrAmerican;

                        echo '<td class="">'.$FULL1fiAsian.'</td>';

                        $GRANDTOTAL1fiAsian = $GRANDTOTAL1fiAsian + $FULL1fiAsian;

                        echo '<td class="">'.$FULL1fiCauc.'</td>';

                        $GRANDTOTAL1fiCauc = $GRANDTOTAL1fiCauc + $FULL1fiCauc;

                        echo '<td class="">'.$FULL1fiHispanic.'</td>';

                        $GRANDTOTAL1fiHispanic = $GRANDTOTAL1fiHispanic + $FULL1fiHispanic;

                        echo '<td class="">'.$FULL1fiOther.'</td>';

                        $GRANDTOTAL1fiOther = $GRANDTOTAL1fiOther + $FULL1fiOther;

                        echo '<td class="">'.$FULL1extForenEval.'</td>';

                        $GRANDTOTAL1extForenEval = $GRANDTOTAL1extForenEval + $FULL1extForenEval;

                        echo '<td class="">'.$FULL1intCounsSes.'</td>';

                        $GRANDTOTAL1intCounsSes = $GRANDTOTAL1intCounsSes + $FULL1intCounsSes;

                        echo '<td class="">'.$FULL1totCounSes.'</td>';

                        $GRANDTOTAL1totCounSes = $GRANDTOTAL1totCounSes + $FULL1totCounSes;

                        echo '<td class="">'.$FULL1multDisTeamMeet.'</td>';

                        $GRANDTOTAL1multDisTeamMeet = $GRANDTOTAL1multDisTeamMeet + $FULL1multDisTeamMeet;

                        echo '<td class="">'.$FULL1prosCases.'</td>';

                        $GRANDTOTAL1prosCases = $GRANDTOTAL1prosCases + $FULL1prosCases;

                        echo '<td class="">'.$FULL1medExamRef.'</td>';

                        $GRANDTOTAL1medExamRefl = $GRANDTOTAL1medExamRefl + $FULL1medExamRef;

                        echo '<td class="">'.$FULL1TotalService.'</td></tr>';

                        $GRANDTOTAL1TotalService = $GRANDTOTAL1TotalService + $FULL1TotalService;

                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 2ND QTR</b></td>';

                        echo '<td class="TotalCell">'.$FULL2fiTotal.'</td>';

                        $GRANDTOTAL2fiTotal = $GRANDTOTAL2fiTotal + $FULL2fiTotal;

                        echo '<td class="">'.$FULL2fi0to6.'</td>';

                        $GRANDTOTAL2fi0to6 = $GRANDTOTAL2fi0to6 + $FULL2fi0to6;

                        echo '<td class="">'.$FULL2fi7to12.'</td>';

                        $GRANDTOTAL2fi7to12 = $GRANDTOTAL2fi7to12 + $FULL2fi7to12;

                        echo '<td class="">'.$FULL2fi13to18.'</td>';

                        $GRANDTOTAL2fi13to18 = $GRANDTOTAL2fi13to18 + $FULL2fi13to18;

                        echo '<td class="">'.$FULL2fiMale.'</td>';

                        $GRANDTOTAL2fiMale = $GRANDTOTAL2fiMale + $FULL2fiMale;

                        echo '<td class="">'.$FULL2fiFemale.'</td>';

                        $GRANDTOTAL2fiFemale = $GRANDTOTAL2fiFemale + $FULL2fiFemale;

                        echo '<td class="">'.$FULL2fiAfrAmerican.'</td>';

                        $GRANDTOTAL2fiAfrAmerican = $GRANDTOTAL2fiAfrAmerican + $FULL2fiAfrAmerican;

                        echo '<td class="">'.$FULL2fiAsian.'</td>';

                        $GRANDTOTAL2fiAsian = $GRANDTOTAL2fiAsian + $FULL2fiAsian;

                        echo '<td class="">'.$FULL2fiCauc.'</td>';

                        $GRANDTOTAL2fiCauc = $GRANDTOTAL2fiCauc + $FULL2fiCauc;

                        echo '<td class="">'.$FULL2fiHispanic.'</td>';

                        $GRANDTOTAL2fiHispanic = $GRANDTOTAL2fiHispanic + $FULL2fiHispanic;

                        echo '<td class="">'.$FULL2fiOther.'</td>';

                        $GRANDTOTAL2fiOther = $GRANDTOTAL2fiOther + $FULL2fiOther;

                        echo '<td class="">'.$FULL2extForenEval.'</td>';

                        $GRANDTOTAL2extForenEval = $GRANDTOTAL2extForenEval + $FULL2extForenEval;

                        echo '<td class="">'.$FULL2intCounsSes.'</td>';

                        $GRANDTOTAL2intCounsSes = $GRANDTOTAL2intCounsSes + $FULL2intCounsSes;

                        echo '<td class="">'.$FULL2totCounSes.'</td>';

                        $GRANDTOTAL2totCounSes = $GRANDTOTAL2totCounSes + $FULL2totCounSes;

                        echo '<td class="">'.$FULL2multDisTeamMeet.'</td>';

                        $GRANDTOTAL2multDisTeamMeet = $GRANDTOTAL2multDisTeamMeet + $FULL2multDisTeamMeet;

                        echo '<td class="">'.$FULL2prosCases.'</td>';

                        $GRANDTOTAL2prosCases = $GRANDTOTAL2prosCases + $FULL2prosCases;

                        echo '<td class="">'.$FULL2medExamRef.'</td>';

                        $GRANDTOTAL2medExamRefl = $GRANDTOTAL2medExamRefl + $FULL2medExamRef;

                        echo '<td class="">'.$FULL2TotalService.'</td></tr>';

                        $GRANDTOTAL2TotalService = $GRANDTOTAL2TotalService + $FULL2TotalService;

                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 3RD QTR</b></td>';

                        echo '<td class="TotalCell">'.$FULL3fiTotal.'</td>';

                        $GRANDTOTAL3fiTotal = $GRANDTOTAL3fiTotal + $FULL3fiTotal;

                        echo '<td class="">'.$FULL3fi0to6.'</td>';

                        $GRANDTOTAL3fi0to6 = $GRANDTOTAL3fi0to6 + $FULL3fi0to6;

                        echo '<td class="">'.$FULL3fi7to12.'</td>';

                        $GRANDTOTAL3fi7to12 = $GRANDTOTAL3fi7to12 + $FULL3fi7to12;

                        echo '<td class="">'.$FULL3fi13to18.'</td>';

                        $GRANDTOTAL3fi13to18 = $GRANDTOTAL3fi13to18 + $FULL3fi13to18;

                        echo '<td class="">'.$FULL3fiMale.'</td>';

                        $GRANDTOTAL3fiMale = $GRANDTOTAL3fiMale + $FULL3fiMale;

                        echo '<td class="">'.$FULL3fiFemale.'</td>';

                        $GRANDTOTAL3fiFemale = $GRANDTOTAL3fiFemale + $FULL3fiFemale;

                        echo '<td class="">'.$FULL3fiAfrAmerican.'</td>';

                        $GRANDTOTAL3fiAfrAmerican = $GRANDTOTAL3fiAfrAmerican + $FULL3fiAfrAmerican;

                        echo '<td class="">'.$FULL3fiAsian.'</td>';

                        $GRANDTOTAL3fiAsian = $GRANDTOTAL3fiAsian + $FULL3fiAsian;

                        echo '<td class="">'.$FULL3fiCauc.'</td>';

                        $GRANDTOTAL3fiCauc = $GRANDTOTAL3fiCauc + $FULL3fiCauc;

                        echo '<td class="">'.$FULL3fiHispanic.'</td>';

                        $GRANDTOTAL3fiHispanic = $GRANDTOTAL3fiHispanic + $FULL3fiHispanic;

                        echo '<td class="">'.$FULL3fiOther.'</td>';

                        $GRANDTOTAL3fiOther = $GRANDTOTAL3fiOther + $FULL3fiOther;

                        echo '<td class="">'.$FULL3extForenEval.'</td>';

                        $GRANDTOTAL3extForenEval = $GRANDTOTAL3extForenEval + $FULL3extForenEval;

                        echo '<td class="">'.$FULL3intCounsSes.'</td>';

                        $GRANDTOTAL3intCounsSes = $GRANDTOTAL3intCounsSes + $FULL3intCounsSes;

                        echo '<td class="">'.$FULL3totCounSes.'</td>';

                        $GRANDTOTAL3totCounSes = $GRANDTOTAL3totCounSes + $FULL3totCounSes;

                        echo '<td class="">'.$FULL3multDisTeamMeet.'</td>';

                        $GRANDTOTAL3multDisTeamMeet = $GRANDTOTAL3multDisTeamMeet + $FULL3multDisTeamMeet;

                        echo '<td class="">'.$FULL3prosCases.'</td>';

                        $GRANDTOTAL3prosCases = $GRANDTOTAL3prosCases + $FULL3prosCases;

                        echo '<td class="">'.$FULL3medExamRef.'</td>';

                        $GRANDTOTAL3medExamRefl = $GRANDTOTAL3medExamRefl + $FULL3medExamRef;

                        echo '<td class="">'.$FULL3TotalService.'</td></tr>';

                        $GRANDTOTAL3TotalService = $GRANDTOTAL3TotalService + $FULL3TotalService;

                        echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 4TH QTR</b></td>';

                        echo '<td class="TotalCell">'.$FULL4fiTotal.'</td>';

                        $GRANDTOTAL4fiTotal = $GRANDTOTAL4fiTotal + $FULL4fiTotal;

                        echo '<td class="">'.$FULL4fi0to6.'</td>';

                        $GRANDTOTAL4fi0to6 = $GRANDTOTAL4fi0to6 + $FULL4fi0to6;

                        echo '<td class="">'.$FULL4fi7to12.'</td>';

                        $GRANDTOTAL4fi7to12 = $GRANDTOTAL4fi7to12 + $FULL4fi7to12;

                        echo '<td class="">'.$FULL4fi13to18.'</td>';

                        $GRANDTOTAL4fi13to18 = $GRANDTOTAL4fi13to18 + $FULL4fi13to18;

                        echo '<td class="">'.$FULL4fiMale.'</td>';

                        $GRANDTOTAL4fiMale = $GRANDTOTAL4fiMale + $FULL4fiMale;

                        echo '<td class="">'.$FULL4fiFemale.'</td>';

                        $GRANDTOTAL4fiFemale = $GRANDTOTAL4fiFemale + $FULL4fiFemale;

                        echo '<td class="">'.$FULL4fiAfrAmerican.'</td>';

                        $GRANDTOTAL4fiAfrAmerican = $GRANDTOTAL4fiAfrAmerican + $FULL4fiAfrAmerican;

                        echo '<td class="">'.$FULL4fiAsian.'</td>';

                        $GRANDTOTAL4fiAsian = $GRANDTOTAL4fiAsian + $FULL4fiAsian;

                        echo '<td class="">'.$FULL4fiCauc.'</td>';

                        $GRANDTOTAL4fiCauc = $GRANDTOTAL4fiCauc + $FULL4fiCauc;

                        echo '<td class="">'.$FULL4fiHispanic.'</td>';

                        $GRANDTOTAL4fiHispanic = $GRANDTOTAL4fiHispanic + $FULL4fiHispanic;

                        echo '<td class="">'.$FULL4fiOther.'</td>';

                        $GRANDTOTAL4fiOther = $GRANDTOTAL4fiOther + $FULL4fiOther;

                        echo '<td class="">'.$FULL4extForenEval.'</td>';

                        $GRANDTOTAL4extForenEval = $GRANDTOTAL4extForenEval + $FULL4extForenEval;

                        echo '<td class="">'.$FULL4intCounsSes.'</td>';

                        $GRANDTOTAL4intCounsSes = $GRANDTOTAL4intCounsSes + $FULL4intCounsSes;

                        echo '<td class="">'.$FULL4totCounSes.'</td>';

                        $GRANDTOTAL4totCounSes = $GRANDTOTAL4totCounSes + $FULL4totCounSes;

                        echo '<td class="">'.$FULL4multDisTeamMeet.'</td>';

                        $GRANDTOTAL4multDisTeamMeet = $GRANDTOTAL4multDisTeamMeet + $FULL4multDisTeamMeet;

                        echo '<td class="">'.$FULL4prosCases.'</td>';

                        $GRANDTOTAL4prosCases = $GRANDTOTAL4prosCases + $FULL4prosCases;

                        echo '<td class="">'.$FULL4medExamRef.'</td>';

                        $GRANDTOTAL4medExamRefl = $GRANDTOTAL4medExamRefl + $FULL4medExamRef;

                        echo '<td class="">'.$FULL4TotalService.'</td></tr>';

                        $GRANDTOTAL4TotalService = $GRANDTOTAL4TotalService + $FULL4TotalService;

                        echo '<tr align="right" class="BoldText"><td colspan="2" align="center">TOTAL</td>';

                        $FULLTOTALfiTotal = $FULL1fiTotal+$FULL2fiTotal+$FULL3fiTotal+$FULL4fiTotal;

                        echo '<td class="TotalCell">'.$FULLTOTALfiTotal.'</td>';

                        $FULLTOTALfi0to6 = $FULL1fi0to6+$FULL2fi0to6+$FULL3fi0to6+$FULL4fi0to6;

                        echo '<td>'.$FULLTOTALfi0to6.'</td>';

                        $FULLTOTALfi7to12 = $FULL1fi7to12+$FULL2fi7to12+$FULL3fi7to12+$FULL4fi7to12;

                        echo '<td>'.$FULLTOTALfi7to12.'</td>';

                        $FULLTOTALfi13to18 = $FULL1fi13to18+$FULL2fi13to18+$FULL3fi13to18+$FULL4fi13to18;

                        echo '<td>'.$FULLTOTALfi13to18.'</td>';

                        $FULLTOTALfiMale = $FULL1fiMale+$FULL2fiMale+$FULL3fiMale+$FULL4fiMale;

                        echo '<td>'.$FULLTOTALfiMale.'</td>';

                        $FULLTOTALfiFemale = $FULL1fiFemale+$FULL2fiFemale+$FULL3fiFemale+$FULL4fiFemale;

                        echo '<td>'.$FULLTOTALfiFemale.'</td>';

                        $FULLTOTALfiAfrAmerican = $FULL1fiAfrAmerican+$FULL2fiAfrAmerican+$FULL3fiAfrAmerican+$FULL4fiAfrAmerican;

                        echo '<td>'.$FULLTOTALfiAfrAmerican.'</td>';

                        $FULLTOTALfiAsian = $FULL1fiAsian+$FULL2fiAsian+$FULL3fiAsian+$FULL4fiAsian;

                        echo '<td>'.$FULLTOTALfiAsian.'</td>';

                        $FULLTOTALfiCauc = $FULL1fiCauc+$FULL2fiCauc+$FULL3fiCauc+$FULL4fiCauc;

                        echo '<td>'.$FULLTOTALfiCauc.'</td>';

                        $FULLTOTALfiHispanic = $FULL1fiHispanic+$FULL2fiHispanic+$FULL3fiHispanic+$FULL4fiHispanic;

                        echo '<td>'.$FULLTOTALfiHispanic.'</td>';

                        $FULLTOTALfiOther = $FULL1fiOther+$FULL2fiOther+$FULL3fiOther+$FULL4fiOther;

                        echo '<td>'.$FULLTOTALfiOther.'</td>';

                        $FULLTOTALextForenEval = $FULL1extForenEval+$FULL2extForenEval+$FULL3extForenEval+$FULL4extForenEval;

                        echo '<td class="">'.$FULLTOTALextForenEval.'</td>';

                        $FULLTOTALintCounsSes = $FULL1intCounsSes+$FULL2intCounsSes+$FULL3intCounsSes+$FULL4intCounsSes;

                        echo '<td class="">'.$FULLTOTALintCounsSes.'</td>';

                        $FULLTOTALtotCounSes = $FULL1totCounSes+$FULL2totCounSes+$FULL3totCounSes+$FULL4totCounSes;

                        echo '<td>'.$FULLTOTALtotCounSes.'</td>';

                        $FULLTOTALmultDisTeamMeet = $FULL1multDisTeamMeet+$FULL2multDisTeamMeet+$FULL3multDisTeamMeet+$FULL4multDisTeamMeet;

                        echo '<td>'.$FULLTOTALmultDisTeamMeet.'</td>';

                        $FULLTOTALprosCases = $FULL1prosCases+$FULL2prosCases+$FULL3prosCases+$FULL4prosCases;

                        echo '<td>'.$FULLTOTALprosCases.'</td>';

                        $FULLTOTALmedExamRef = $FULL1medExamRef+$FULL2medExamRef+$FULL3medExamRef+$FULL4medExamRef;

                        echo '<td>'.$FULLTOTALmedExamRef.'</td>';

                        $FULLTOTALTotalService = $FULL1TotalService+$FULL2TotalService+$FULL3TotalService+$FULL4TotalService;

                        echo '<td class="">'.$FULLTOTALTotalService.'</td></tr>';

                }

                else{

                        echo '<tr class="BoldHeader"><td align="center"><h2>There are no Pilot Project center totals for FY - '.$fiscalYear.'</h2></td></tr>';

                }

                

                echo '</table></center>';

                //End of the PilotProjects Totals

                echo '<br /><br />';

                echo '<div class="page-break"></div>';

                //GRAND TOTAL

                echo '<center><table width="85%" class="Admin">';

                echo '<tr class="BoldHeader"><td colspan="20" align="center"><h2>Grand Totals</h2></td></tr>';

                echo '<tr><td colspan="20"> </td></tr>';

                printTotalHeaders('All ANCAC Centers');

                echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 1ST QTR</b></td>';

                echo '<td class="TotalCell">'.$GRANDTOTAL1fiTotal.'</td>';

                echo '<td class="">'.$GRANDTOTAL1fi0to6.'</td>';

                echo '<td class="">'.$GRANDTOTAL1fi7to12.'</td>';

                echo '<td class="">'.$GRANDTOTAL1fi13to18.'</td>';

                echo '<td class="">'.$GRANDTOTAL1fiMale.'</td>';

                echo '<td class="">'.$GRANDTOTAL1fiFemale.'</td>';

                echo '<td class="">'.$GRANDTOTAL1fiAfrAmerican.'</td>';

                echo '<td class="">'.$GRANDTOTAL1fiAsian.'</td>';

                echo '<td class="">'.$GRANDTOTAL1fiCauc.'</td>';

                echo '<td class="">'.$GRANDTOTAL1fiHispanic.'</td>';

                echo '<td class="">'.$GRANDTOTAL1fiOther.'</td>';

                echo '<td class="">'.$GRANDTOTAL1extForenEval.'</td>';

                echo '<td class="">'.$GRANDTOTAL1intCounsSes.'</td>';

                echo '<td class="">'.$GRANDTOTAL1totCounSes.'</td>';

                echo '<td class="">'.$GRANDTOTAL1multDisTeamMeet.'</td>';

                echo '<td class="">'.$GRANDTOTAL1prosCases.'</td>';

                echo '<td class="">'.$GRANDTOTAL1medExamRefl.'</td>';

                echo '<td class="">'.$GRANDTOTAL1TotalService.'</td></tr>';

                echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 2ND QTR</b></td>';

                echo '<td class="TotalCell">'.$GRANDTOTAL2fiTotal.'</td>';

                echo '<td class="">'.$GRANDTOTAL2fi0to6.'</td>';

                echo '<td class="">'.$GRANDTOTAL2fi7to12.'</td>';

                echo '<td class="">'.$GRANDTOTAL2fi13to18.'</td>';

                echo '<td class="">'.$GRANDTOTAL2fiMale.'</td>';

                echo '<td class="">'.$GRANDTOTAL2fiFemale.'</td>';

                echo '<td class="">'.$GRANDTOTAL2fiAfrAmerican.'</td>';

                echo '<td class="">'.$GRANDTOTAL2fiAsian.'</td>';

                echo '<td class="">'.$GRANDTOTAL2fiCauc.'</td>';

                echo '<td class="">'.$GRANDTOTAL2fiHispanic.'</td>';

                echo '<td class="">'.$GRANDTOTAL2fiOther.'</td>';

                echo '<td class="">'.$GRANDTOTAL2extForenEval.'</td>';

                echo '<td class="">'.$GRANDTOTAL2intCounsSes.'</td>';

                echo '<td class="">'.$GRANDTOTAL2totCounSes.'</td>';

                echo '<td class="">'.$GRANDTOTAL2multDisTeamMeet.'</td>';

                echo '<td class="">'.$GRANDTOTAL2prosCases.'</td>';

                echo '<td class="">'.$GRANDTOTAL2medExamRefl.'</td>';

                echo '<td class="">'.$GRANDTOTAL2TotalService.'</td></tr>';

                echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 3RD QTR</b></td>';

                echo '<td class="TotalCell">'.$GRANDTOTAL3fiTotal.'</td>';

                echo '<td class="">'.$GRANDTOTAL3fi0to6.'</td>';

                echo '<td class="">'.$GRANDTOTAL3fi7to12.'</td>';

                echo '<td class="">'.$GRANDTOTAL3fi13to18.'</td>';

                echo '<td class="">'.$GRANDTOTAL3fiMale.'</td>';

                echo '<td class="">'.$GRANDTOTAL3fiFemale.'</td>';

                echo '<td class="">'.$GRANDTOTAL3fiAfrAmerican.'</td>';

                echo '<td class="">'.$GRANDTOTAL3fiAsian.'</td>';

                echo '<td class="">'.$GRANDTOTAL3fiCauc.'</td>';

                echo '<td class="">'.$GRANDTOTAL3fiHispanic.'</td>';

                echo '<td class="">'.$GRANDTOTAL3fiOther.'</td>';

                echo '<td class="">'.$GRANDTOTAL3extForenEval.'</td>';

                echo '<td class="">'.$GRANDTOTAL3intCounsSes.'</td>';

                echo '<td class="">'.$GRANDTOTAL3totCounSes.'</td>';

                echo '<td class="">'.$GRANDTOTAL3multDisTeamMeet.'</td>';

                echo '<td class="">'.$GRANDTOTAL3prosCases.'</td>';

                echo '<td class="">'.$GRANDTOTAL3medExamRefl.'</td>';

                echo '<td class="">'.$GRANDTOTAL3TotalService.'</td></tr>';

                echo '<tr align="right"><td colspan="2" align="left"><b>TOTAL 4TH QTR</b></td>';

                echo '<td class="TotalCell">'.$GRANDTOTAL4fiTotal.'</td>';

                echo '<td class="">'.$GRANDTOTAL4fi0to6.'</td>';

                echo '<td class="">'.$GRANDTOTAL4fi7to12.'</td>';

                echo '<td class="">'.$GRANDTOTAL4fi13to18.'</td>';

                echo '<td class="">'.$GRANDTOTAL4fiMale.'</td>';

                echo '<td class="">'.$GRANDTOTAL4fiFemale.'</td>';

                echo '<td class="">'.$GRANDTOTAL4fiAfrAmerican.'</td>';

                echo '<td class="">'.$GRANDTOTAL4fiAsian.'</td>';

                echo '<td class="">'.$GRANDTOTAL4fiCauc.'</td>';

                echo '<td class="">'.$GRANDTOTAL4fiHispanic.'</td>';

                echo '<td class="">'.$GRANDTOTAL4fiOther.'</td>';

                echo '<td class="">'.$GRANDTOTAL4extForenEval.'</td>';

                echo '<td class="">'.$GRANDTOTAL4intCounsSes.'</td>';

                echo '<td class="">'.$GRANDTOTAL4totCounSes.'</td>';

                echo '<td class="">'.$GRANDTOTAL4multDisTeamMeet.'</td>';

                echo '<td class="">'.$GRANDTOTAL4prosCases.'</td>';

                echo '<td class="">'.$GRANDTOTAL4medExamRefl.'</td>';

                echo '<td class="">'.$GRANDTOTAL4TotalService.'</td></tr>';

                echo '<tr align="right" class="BoldText"><td colspan="2" align="center">TOTAL</td>';

                $FULLTOTALfiTotal = $GRANDTOTAL1fiTotal+$GRANDTOTAL2fiTotal+$GRANDTOTAL3fiTotal+$GRANDTOTAL4fiTotal;

                echo '<td class="TotalCell">'.$FULLTOTALfiTotal.'</td>';

                $FULLTOTALfi0to6 = $GRANDTOTAL1fi0to6+$GRANDTOTAL2fi0to6+$GRANDTOTAL3fi0to6+$GRANDTOTAL4fi0to6;

                echo '<td>'.$FULLTOTALfi0to6.'</td>';

                $FULLTOTALfi7to12 = $GRANDTOTAL1fi7to12+$GRANDTOTAL2fi7to12+$GRANDTOTAL3fi7to12+$GRANDTOTAL4fi7to12;

                echo '<td>'.$FULLTOTALfi7to12.'</td>';

                $FULLTOTALfi13to18 = $GRANDTOTAL1fi13to18+$GRANDTOTAL2fi13to18+$GRANDTOTAL3fi13to18+$GRANDTOTAL4fi13to18;

                echo '<td>'.$FULLTOTALfi13to18.'</td>';

                $FULLTOTALfiMale = $GRANDTOTAL1fiMale+$GRANDTOTAL2fiMale+$GRANDTOTAL3fiMale+$GRANDTOTAL4fiMale;

                echo '<td>'.$FULLTOTALfiMale.'</td>';

                $FULLTOTALfiFemale = $GRANDTOTAL1fiFemale+$GRANDTOTAL2fiFemale+$GRANDTOTAL3fiFemale+$GRANDTOTAL4fiFemale;

                echo '<td>'.$FULLTOTALfiFemale.'</td>';

                $FULLTOTALfiAfrAmerican = $GRANDTOTAL1fiAfrAmerican+$GRANDTOTAL2fiAfrAmerican+$GRANDTOTAL3fiAfrAmerican+$GRANDTOTAL4fiAfrAmerican;

                echo '<td>'.$FULLTOTALfiAfrAmerican.'</td>';

                $FULLTOTALfiAsian = $GRANDTOTAL1fiAsian+$GRANDTOTAL2fiAsian+$GRANDTOTAL3fiAsian+$GRANDTOTAL4fiAsian;

                echo '<td>'.$FULLTOTALfiAsian.'</td>';

                $FULLTOTALfiCauc = $GRANDTOTAL1fiCauc+$GRANDTOTAL2fiCauc+$GRANDTOTAL3fiCauc+$GRANDTOTAL4fiCauc;

                echo '<td>'.$FULLTOTALfiCauc.'</td>';

                $FULLTOTALfiHispanic = $GRANDTOTAL1fiHispanic+$GRANDTOTAL2fiHispanic+$GRANDTOTAL3fiHispanic+$GRANDTOTAL4fiHispanic;

                echo '<td>'.$FULLTOTALfiHispanic.'</td>';

                $FULLTOTALfiOther = $GRANDTOTAL1fiOther+$GRANDTOTAL2fiOther+$GRANDTOTAL3fiOther+$GRANDTOTAL4fiOther;

                echo '<td>'.$FULLTOTALfiOther.'</td>';

                $FULLTOTALextForenEval = $GRANDTOTAL1extForenEval+$GRANDTOTAL2extForenEval+$GRANDTOTAL3extForenEval+$GRANDTOTAL4extForenEval;

                echo '<td class="">'.$FULLTOTALextForenEval.'</td>';

                $FULLTOTALintCounsSes = $GRANDTOTAL1intCounsSes+$GRANDTOTAL2intCounsSes+$GRANDTOTAL3intCounsSes+$GRANDTOTAL4intCounsSes;

                echo '<td class="">'.$FULLTOTALintCounsSes.'</td>';

                $FULLTOTALtotCounSes = $GRANDTOTAL1totCounSes+$GRANDTOTAL2totCounSes+$GRANDTOTAL3totCounSes+$GRANDTOTAL4totCounSes;

                echo '<td>'.$FULLTOTALtotCounSes.'</td>';

                $FULLTOTALmultDisTeamMeet = $GRANDTOTAL1multDisTeamMeet+$GRANDTOTAL2multDisTeamMeet+$GRANDTOTAL3multDisTeamMeet+$GRANDTOTAL4multDisTeamMeet;

                echo '<td>'.$FULLTOTALmultDisTeamMeet.'</td>';

                $FULLTOTALprosCases = $GRANDTOTAL1prosCases+$GRANDTOTAL2prosCases+$GRANDTOTAL3prosCases+$GRANDTOTAL4prosCases;

                echo '<td>'.$FULLTOTALprosCases.'</td>';

                $FULLTOTALmedExamRef = $GRANDTOTAL1medExamRefl+$GRANDTOTAL2medExamRefl+$GRANDTOTAL3medExamRefl+$GRANDTOTAL4medExamRefl;

                echo '<td>'.$FULLTOTALmedExamRef.'</td>';

                $FULLTOTALTotalService = $GRANDTOTAL1TotalService+$GRANDTOTAL2TotalService+$GRANDTOTAL3TotalService+$GRANDTOTAL4TotalService;

                echo '<td class="">'.$FULLTOTALTotalService.'</td></tr>';

                echo '</table></center>';

                //End of the GRAND Totals



?>



</html>




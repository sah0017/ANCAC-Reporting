<?php
  //require("/home/cust1/user1224426/data/dbconn.php");

//$TrnType = either 'FULL' or 'CURRENT'
function buildReport($TrnType, $theCenter, $fiscalYear, $YTD, $Width){
   //get the current fiscal year and quarter

  	 $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,areaSchools,".
              "corpDonations,privDonations,fundraisers,bankInterest".
              " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
              "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
              "WHERE budgetedPerfStats.center = ".$theCenter." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 1";
          $result = @mysql_query($sql) or mysql_error();
          $row1QBudgeted = mysql_fetch_object($result);

          $sql = "SELECT fiTotal,fi0to6,fi7to12,fi13to18,fiMale,fiFemale,fiAfrAmerican,fiAsian,".
              "fiCauc,fiHispanic,fiOther,extForenEval,intCounsSes,totCounSes,multDisTeamMeet,prosCases,medExamRef,".
              "fullTimeEmp,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,areaSchools,".
              "corpDonations,privDonations,fundraisers,bankInterest".
              " FROM actualPerfStats JOIN actualExpenditures ON actualPerfStats.center = actualExpenditures.center ".
              "AND actualPerfStats.fiscalyear = actualExpenditures.fiscalyear and actualPerfStats.quarter = actualExpenditures.quarter ".
              "JOIN actualSourceFunds ON actualPerfStats.center = actualSourceFunds.center ".
              "AND actualPerfStats.fiscalyear = actualSourceFunds.fiscalyear AND actualPerfStats.quarter = actualSourceFunds.quarter ".
              "WHERE actualPerfStats.center = ".$theCenter." AND actualPerfStats.fiscalyear = ".$fiscalYear.
              " AND actualPerfStats.quarter = 1";
          $result = @mysql_query($sql) or mysql_error();
          $row1QActual = mysql_fetch_object($result);

          $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,areaSchools,".
              "corpDonations,privDonations,fundraisers,bankInterest".
              " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
              "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
              "WHERE budgetedPerfStats.center = ".$theCenter." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 2";
          $result = @mysql_query($sql) or mysql_error();
          $row2QBudgeted = mysql_fetch_object($result);

          $sql = "SELECT fiTotal,fi0to6,fi7to12,fi13to18,fiMale,fiFemale,fiAfrAmerican,fiAsian,".
              "fiCauc,fiHispanic,fiOther,extForenEval,intCounsSes,totCounSes,multDisTeamMeet,prosCases,medExamRef,".
              "fullTimeEmp,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,areaSchools,".
              "corpDonations,privDonations,fundraisers,bankInterest".
              " FROM actualPerfStats JOIN actualExpenditures ON actualPerfStats.center = actualExpenditures.center ".
              "AND actualPerfStats.fiscalyear = actualExpenditures.fiscalyear and actualPerfStats.quarter = actualExpenditures.quarter ".
              "JOIN actualSourceFunds ON actualPerfStats.center = actualSourceFunds.center ".
              "AND actualPerfStats.fiscalyear = actualSourceFunds.fiscalyear AND actualPerfStats.quarter = actualSourceFunds.quarter ".
              "WHERE actualPerfStats.center = ".$theCenter." AND actualPerfStats.fiscalyear = ".$fiscalYear.
              " AND actualPerfStats.quarter = 2";
          $result = @mysql_query($sql) or mysql_error();
          $row2QActual = mysql_fetch_object($result);

          $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,areaSchools,".
              "corpDonations,privDonations,fundraisers,bankInterest".
              " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
              "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
              "WHERE budgetedPerfStats.center = ".$theCenter." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 3";
          $result = @mysql_query($sql) or mysql_error();
          $row3QBudgeted = mysql_fetch_object($result);

          $sql = "SELECT fiTotal,fi0to6,fi7to12,fi13to18,fiMale,fiFemale,fiAfrAmerican,fiAsian,".
              "fiCauc,fiHispanic,fiOther,extForenEval,intCounsSes,totCounSes,multDisTeamMeet,prosCases,medExamRef,".
              "fullTimeEmp,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,areaSchools,".
              "corpDonations,privDonations,fundraisers,bankInterest".
              " FROM actualPerfStats JOIN actualExpenditures ON actualPerfStats.center = actualExpenditures.center ".
              "AND actualPerfStats.fiscalyear = actualExpenditures.fiscalyear and actualPerfStats.quarter = actualExpenditures.quarter ".
              "JOIN actualSourceFunds ON actualPerfStats.center = actualSourceFunds.center ".
              "AND actualPerfStats.fiscalyear = actualSourceFunds.fiscalyear AND actualPerfStats.quarter = actualSourceFunds.quarter ".
              "WHERE actualPerfStats.center = ".$theCenter." AND actualPerfStats.fiscalyear = ".$fiscalYear.
              " AND actualPerfStats.quarter = 3";
          $result = @mysql_query($sql) or mysql_error();
          $row3QActual = mysql_fetch_object($result);

          $sql = "SELECT fiTotal,extForenEval,intCounsSes,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,areaSchools,".
              "corpDonations,privDonations,fundraisers,bankInterest".
              " FROM budgetedPerfStats JOIN budgetedExpenditures ON budgetedPerfStats.center = budgetedExpenditures.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedExpenditures.fiscalyear and budgetedPerfStats.quarter = budgetedExpenditures.quarter ".
              "JOIN budgetedSourceFunds ON budgetedPerfStats.center = budgetedSourceFunds.center ".
              "AND budgetedPerfStats.fiscalyear = budgetedSourceFunds.fiscalyear AND budgetedPerfStats.quarter = budgetedSourceFunds.quarter ".
              "WHERE budgetedPerfStats.center = ".$theCenter." AND budgetedPerfStats.fiscalyear = ".$fiscalYear.
              " AND budgetedPerfStats.quarter = 4";
          $result = @mysql_query($sql) or mysql_error();
          $row4QBudgeted = mysql_fetch_object($result);

          $sql = "SELECT fiTotal,fi0to6,fi7to12,fi13to18,fiMale,fiFemale,fiAfrAmerican,fiAsian,".
              "fiCauc,fiHispanic,fiOther,extForenEval,intCounsSes,totCounSes,multDisTeamMeet,prosCases,medExamRef,".
              "fullTimeEmp,personnelCosts,empBenefits,travelInState,travelOutState,repairsAndMx,".
              "rentalsLease,utilComm,profServ,suppMatOper,tranEqpPurch,otherEqpPurch,debtService,misc,genFund,chilFirstTrust,".
              "capOutlay,unitedWay,adeca,natlChilAlliance,chilTrustFund,deptOfHR,countyComm,cityCouncil,localGrants,areaSchools,".
              "corpDonations,privDonations,fundraisers,bankInterest".
              " FROM actualPerfStats JOIN actualExpenditures ON actualPerfStats.center = actualExpenditures.center ".
              "AND actualPerfStats.fiscalyear = actualExpenditures.fiscalyear and actualPerfStats.quarter = actualExpenditures.quarter ".
              "JOIN actualSourceFunds ON actualPerfStats.center = actualSourceFunds.center ".
              "AND actualPerfStats.fiscalyear = actualSourceFunds.fiscalyear AND actualPerfStats.quarter = actualSourceFunds.quarter ".
              "WHERE actualPerfStats.center = ".$theCenter." AND actualPerfStats.fiscalyear = ".$fiscalYear.
              " AND actualPerfStats.quarter = 4";
          $result = @mysql_query($sql) or mysql_error();
          $row4QActual = mysql_fetch_object($result);

         //Depending on the TrnType either build a table for the current Quarter or the YTD
         if ($TrnType == "FULL"){
           //ADD THE FORM TAG STUFF TO HANDLE THE CODE
           echo '<table width="'.$Width.'" class="Admin">'.
                '<tr>'.
                '<td width="30%"><b>Performance Statistics</td>'.
                '<td colspan="2" align="center"><b>First Quarter</b></td>'.
                '<td colspan="2" align="center"><b>Second Quarter</b></td>'.
                '<td colspan="2" align="center"><b>Third Quarter</b></td>'.
                '<td colspan="2" align="center"><b>Fourth Quarter</b></td>'.
                '<td colspan="2" align="center"><b>Annual Total</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td> </td>'.
                '<td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>'.
                '<td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>'.
                '<td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>'.
                '<td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>'.
                '<td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>'.
                '</tr>';
           if($_SESSION['admin'] == 2){
             if ($YTD == "NO"){
                echo '<tr align="center" class="nav">'.
                        '<td> </td>'.
                        '<td colspan="2"><p class="SpecialLink"><a href="editQuarter.php?Q=1&C='.$theCenter.'&Y='.$fiscalYear.'">Edit</a></p></td>'.
                        '<td colspan="2"><p class="SpecialLink"><a href="editQuarter.php?Q=2&C='.$theCenter.'&Y='.$fiscalYear.'">Edit</a></p></td>'.
                        '<td colspan="2"><p class="SpecialLink"><a href="editQuarter.php?Q=3&C='.$theCenter.'&Y='.$fiscalYear.'">Edit</a></p></td>'.
                        '<td colspan="2"><p class="SpecialLink"><a href="editQuarter.php?Q=4&C='.$theCenter.'&Y='.$fiscalYear.'">Edit</a></p></td>'.
                        '<td colspan="2"></td>'.
                        '</tr>';
             }
           }
           echo '<tr align="center">'.
                '<td align="left">1) Number of children receiving an initial forensic interview at the CAC</td>'.
                '<td>';
           if(isset($row1QBudgeted->fiTotal)) echo $row1QBudgeted->fiTotal;
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->fiTotal)) {
                if ($row1QActual->fiTotal != -99){
                  echo $row1QActual->fiTotal;
                  $Q1Act = $row1QActual->fiTotal;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->fiTotal)) echo $row2QBudgeted->fiTotal;
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->fiTotal)) {
                if ($row2QActual->fiTotal != -99){
                  echo $row2QActual->fiTotal;
                  $Q2Act = $row2QActual->fiTotal;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->fiTotal)) echo $row3QBudgeted->fiTotal;
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->fiTotal)) {
                if ($row3QActual->fiTotal != -99){
                  echo $row3QActual->fiTotal;
                  $Q3Act = $row3QActual->fiTotal;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->fiTotal)) echo $row4QBudgeted->fiTotal;
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->fiTotal)) {
                if ($row4QActual->fiTotal != -99){
                  echo $row4QActual->fiTotal;
                  $Q4Act = $row4QActual->fiTotal;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $fiHeaderBudTot = $row1QBudgeted->fiTotal + $row2QBudgeted->fiTotal + $row3QBudgeted->fiTotal + $row4QBudgeted->fiTotal;
           $fiHeaderActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           echo '<td><b>'.$fiHeaderBudTot.'</b></td>'.
                '<td><b>'.$fiHeaderActTot.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a) Age:&nbsp;&nbsp;0 - 6</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fi0to6)) {
                if ($row1QActual->fi0to6 != -99){
                  echo $row1QActual->fi0to6;
                  $Q1Act = $row1QActual->fi0to6;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row2QActual->fi0to6)) {
                if ($row2QActual->fi0to6 != -99){
                  echo $row2QActual->fi0to6;
                  $Q2Act = $row2QActual->fi0to6;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row3QActual->fi0to6)) {
                if ($row3QActual->fi0to6 != -99){
                  echo $row3QActual->fi0to6;
                  $Q3Act = $row3QActual->fi0to6;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row4QActual->fi0to6)) {
                if ($row4QActual->fi0to6 != -99){
                  echo $row4QActual->fi0to6;
                  $Q4Act = $row4QActual->fi0to6;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>';
                //'<td><input type="text" class="DisableInput" disabled="true" name="fi0to6BudTot" value="" /></td>'.
           $fi0to6ActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           echo '<td><b>'.$fi0to6ActTot.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7 - 12</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fi7to12)) {
                if ($row1QActual->fi7to12 != -99){
                  echo $row1QActual->fi7to12;
                  $Q1Act = $row1QActual->fi7to12;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row2QActual->fi7to12)) {
                if ($row2QActual->fi7to12 != -99){
                  echo $row2QActual->fi7to12;
                  $Q2Act = $row2QActual->fi7to12;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row3QActual->fi7to12)) {
                if ($row3QActual->fi7to12 != -99){
                  echo $row3QActual->fi7to12;
                  $Q3Act = $row3QActual->fi7to12;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row4QActual->fi7to12)) {
                if ($row4QActual->fi7to12 != -99){
                  echo $row4QActual->fi7to12;
                  $Q4Act = $row4QActual->fi7to12;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>';
                //'<td><input type="text" class="DisableInput" disabled="true" name="fi7to12BudTot" value="" /></td>'.
           $fi7to12ActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           echo '<td><b>'.$fi7to12ActTot.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;13 - 18</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fi13to18)) {
                if ($row1QActual->fi13to18 != -99){
                  echo $row1QActual->fi13to18;
                  $Q1Act = $row1QActual->fi13to18;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row2QActual->fi13to18)) {
                if ($row2QActual->fi13to18 != -99){
                  echo $row2QActual->fi13to18;
                  $Q2Act = $row2QActual->fi13to18;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row3QActual->fi13to18)) {
                if ($row3QActual->fi13to18 != -99){
                  echo $row3QActual->fi13to18;
                  $Q3Act = $row3QActual->fi13to18;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row4QActual->fi13to18)) {
                if ($row4QActual->fi13to18 != -99){
                  echo $row4QActual->fi13to18;
                  $Q4Act = $row4QActual->fi13to18;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>';
                //'<td><input type="text" class="DisableInput" disabled="true" name="fi13to18BudTot" value="" /></td>'.
           $fi13to18ActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           echo '<td><b>'.$fi13to18ActTot.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b) Gender:&nbsp;&nbsp;&nbsp;Male</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fiMale)) {
                if ($row1QActual->fiMale != -99){
                  echo $row1QActual->fiMale;
                  $Q1Act = $row1QActual->fiMale;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row2QActual->fiMale)) {
                if ($row2QActual->fiMale != -99){
                  echo $row2QActual->fiMale;
                  $Q2Act = $row2QActual->fiMale;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row3QActual->fiMale)) {
                if ($row3QActual->fiMale != -99){
                  echo $row3QActual->fiMale;
                  $Q3Act = $row3QActual->fiMale;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row4QActual->fiMale)) {
                if ($row4QActual->fiMale != -99){
                  echo $row4QActual->fiMale;
                  $Q4Act = $row4QActual->fiMale;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>';
                //'<td><input type="text" class="DisableInput" disabled="true" name="fiMaleBudTot" value="" /></td>'.
           $fiMaleActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           echo '<td><b>'.$fiMaleActTot.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Female</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fiFemale)) {
                if ($row1QActual->fiFemale != -99){
                  echo $row1QActual->fiFemale;
                  $Q1Act = $row1QActual->fiFemale;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row2QActual->fiFemale)) {
                if ($row2QActual->fiFemale != -99){
                  echo $row2QActual->fiFemale;
                  $Q2Act = $row2QActual->fiFemale;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row3QActual->fiFemale)) {
                if ($row3QActual->fiFemale != -99){
                  echo $row3QActual->fiFemale;
                  $Q3Act = $row3QActual->fiFemale;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row4QActual->fiFemale)) {
                if ($row4QActual->fiFemale != -99){
                  echo $row4QActual->fiFemale;
                  $Q4Act = $row4QActual->fiFemale;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>';
                //'<td><input type="text" class="DisableInput" disabled="true" name="fiFemaleBudTot" value="" /></td>'.
           $fiFemaleActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           echo '<td><b>'.$fiFemaleActTot.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c) Race:&nbsp;&nbsp;&nbsp;African-American</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fiAfrAmerican)) {
                if ($row1QActual->fiAfrAmerican != -99){
                  echo $row1QActual->fiAfrAmerican;
                  $Q1Act = $row1QActual->fiAfrAmerican;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row2QActual->fiAfrAmerican)) {
                if ($row2QActual->fiAfrAmerican != -99){
                  echo $row2QActual->fiAfrAmerican;
                  $Q2Act = $row2QActual->fiAfrAmerican;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row3QActual->fiAfrAmerican)) {
                if ($row3QActual->fiAfrAmerican != -99){
                  echo $row3QActual->fiAfrAmerican;
                  $Q3Act = $row3QActual->fiAfrAmerican;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row4QActual->fiAfrAmerican)) {
                if ($row4QActual->fiAfrAmerican != -99){
                  echo $row4QActual->fiAfrAmerican;
                  $Q4Act = $row4QActual->fiAfrAmerican;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>';
                //'<td><input type="text" class="DisableInput" disabled="true" name="fiAfrAmericanBudTot" value="" /></td>'.
           $fiAfrAmericanActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           echo '<td><b>'.$fiAfrAmericanActTot.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Asian</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fiAsian)) {
                if ($row1QActual->fiAsian != -99){
                  echo $row1QActual->fiAsian;
                  $Q1Act = $row1QActual->fiAsian;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row2QActual->fiAsian)) {
                if ($row2QActual->fiAsian != -99){
                  echo $row2QActual->fiAsian;
                  $Q2Act = $row2QActual->fiAsian;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row3QActual->fiAsian)) {
                if ($row3QActual->fiAsian != -99){
                  echo $row3QActual->fiAsian;
                  $Q3Act = $row3QActual->fiAsian;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row4QActual->fiAsian)) {
                if ($row4QActual->fiAsian != -99){
                  echo $row4QActual->fiAsian;
                  $Q4Act = $row4QActual->fiAsian;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>';
                //'<td><input type="text" class="DisableInput" disabled="true" name="fiAsianBudTot" value="" /></td>'.
           $fiAsianActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           echo '<td><b>'.$fiAsianActTot.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Caucasian</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fiCauc)) {
                if ($row1QActual->fiCauc != -99){
                  echo $row1QActual->fiCauc;
                  $Q1Act = $row1QActual->fiCauc;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row2QActual->fiCauc)) {
                if ($row2QActual->fiCauc != -99){
                  echo $row2QActual->fiCauc;
                  $Q2Act = $row2QActual->fiCauc;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row3QActual->fiCauc)) {
                if ($row3QActual->fiCauc != -99){
                  echo $row3QActual->fiCauc;
                  $Q3Act = $row3QActual->fiCauc;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row4QActual->fiCauc)) {
                if ($row4QActual->fiCauc != -99){
                  echo $row4QActual->fiCauc;
                  $Q4Act = $row4QActual->fiCauc;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>';
                //'<td><input type="text" class="DisableInput" disabled="true" name="fiCaucBudTot" value="" /></td>'.
           $fiCaucActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           echo '<td><b>'.$fiCaucActTot.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hispanic</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fiHispanic)) {
                if ($row1QActual->fiHispanic != -99){
                  echo $row1QActual->fiHispanic;
                  $Q1Act = $row1QActual->fiHispanic;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row2QActual->fiHispanic)) {
                if ($row2QActual->fiHispanic != -99){
                  echo $row2QActual->fiHispanic;
                  $Q2Act = $row2QActual->fiHispanic;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row3QActual->fiHispanic)) {
                if ($row3QActual->fiHispanic != -99){
                  echo $row3QActual->fiHispanic;
                  $Q3Act = $row3QActual->fiHispanic;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row4QActual->fiHispanic)) {
                if ($row4QActual->fiHispanic != -99){
                  echo $row4QActual->fiHispanic;
                  $Q4Act = $row4QActual->fiHispanic;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>';
                //'<td><input type="text" class="DisableInput" disabled="true" name="fiHispanicBudTot" value="" /></td>'.
           $fiHispanicActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           echo '<td><b>'.$fiHispanicActTot.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Other</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fiOther)) {
                if ($row1QActual->fiOther != -99){
                  echo $row1QActual->fiOther;
                  $Q1Act = $row1QActual->fiOther;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row2QActual->fiOther)) {
                if ($row2QActual->fiOther != -99){
                  echo $row2QActual->fiOther;
                  $Q2Act = $row2QActual->fiOther;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row3QActual->fiOther)) {
                if ($row3QActual->fiOther != -99){
                  echo $row3QActual->fiOther;
                  $Q3Act = $row3QActual->fiOther;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row4QActual->fiOther)) {
                if ($row4QActual->fiOther != -99){
                  echo $row4QActual->fiOther;
                  $Q4Act = $row4QActual->fiOther;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>';
                //'<td><input type="text" class="DisableInput" disabled="true" name="fiOtherBudTot" value="" /></td>'.
           $fiOtherActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           echo '<td><b>'.$fiOtherActTot.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">2) Number of children receiving <u>initial</u> extended forensic evaluations at the CAC</td>'.
                '<td>';
           if(isset($row1QBudgeted->extForenEval)) echo $row1QBudgeted->extForenEval;
           echo'</td>'.
                '<td>';
           if(isset($row1QActual->extForenEval)) {
                if ($row1QActual->extForenEval != -99){
                  echo $row1QActual->extForenEval;
                  $Q1Act = $row1QActual->extForenEval;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->extForenEval)) echo $row2QBudgeted->extForenEval;
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->extForenEval)) {
                if ($row2QActual->extForenEval != -99){
                  echo $row2QActual->extForenEval;
                  $Q2Act = $row2QActual->extForenEval;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->extForenEval)) echo $row3QBudgeted->extForenEval;
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->extForenEval)) {
                if ($row3QActual->extForenEval != -99){
                  echo $row3QActual->extForenEval;
                  $Q3Act = $row3QActual->extForenEval;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->extForenEval)) echo $row4QBudgeted->extForenEval;
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->extForenEval)) {
                if ($row4QActual->extForenEval != -99){
                  echo $row4QActual->extForenEval;
                  $Q4Act = $row4QActual->extForenEval;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $extForenEvalBudTot = $row1QBudgeted->extForenEval + $row2QBudgeted->extForenEval + $row3QBudgeted->extForenEval + $row4QBudgeted->extForenEval;
           $extForenEvalActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           echo '<td><b>'.$extForenEvalBudTot.'</b></td>'.
                '<td><b>'.$extForenEvalActTot.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">3) Number of children receiving <u>initial</u> counseling sessions at the CAC</td>'.
                '<td>';
           if(isset($row1QBudgeted->intCounsSes)) echo $row1QBudgeted->intCounsSes;
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->intCounsSes)) {
                if ($row1QActual->intCounsSes != -99){
                  echo $row1QActual->intCounsSes;
                  $Q1Act = $row1QActual->intCounsSes;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->intCounsSes)) echo $row2QBudgeted->intCounsSes;
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->intCounsSes)) {
                if ($row2QActual->intCounsSes != -99){
                  echo $row2QActual->intCounsSes;
                  $Q2Act = $row2QActual->intCounsSes;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->intCounsSes)) echo $row3QBudgeted->intCounsSes;
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->intCounsSes)) {
                if ($row3QActual->intCounsSes != -99){
                  echo $row3QActual->intCounsSes;
                  $Q3Act = $row3QActual->intCounsSes;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->intCounsSes)) echo $row4QBudgeted->intCounsSes;
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->intCounsSes)) {
                if ($row4QActual->intCounsSes != -99){
                  echo $row4QActual->intCounsSes;
                  $Q4Act = $row4QActual->intCounsSes;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $intCounsSesBudTot = $row1QBudgeted->intCounsSes + $row2QBudgeted->intCounsSes + $row3QBudgeted->intCounsSes + $row4QBudgeted->intCounsSes;
           $intCounsSesActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           echo '<td><b>'.$intCounsSesBudTot.'</b></td>'.
                '<td><b>'.$intCounsSesActTot.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a) Total number of counseling sessions provided for child victims of abuse</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->totCounSes)) {
                if ($row1QActual->totCounSes != -99){
                  echo $row1QActual->totCounSes;
                  $Q1Act = $row1QActual->totCounSes;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row2QActual->totCounSes)) {
                if ($row2QActual->totCounSes != -99){
                  echo $row2QActual->totCounSes;
                  $Q2Act = $row2QActual->totCounSes;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row3QActual->totCounSes)) {
                if ($row3QActual->totCounSes != -99){
                  echo $row3QActual->totCounSes;
                  $Q3Act = $row3QActual->totCounSes;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row4QActual->totCounSes)) {
                if ($row4QActual->totCounSes != -99){
                  echo $row4QActual->totCounSes;
                  $Q4Act = $row4QActual->totCounSes;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>';
                //'<td><input type="text" class="DisableInput" disabled="true" name="totCounSesBudTot" value="" /></td>'.
           $totCounSesActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           echo '<td><b>'.$totCounSesActTot.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">4) Number of child abuse cases reviewed at the CAC multidisciplinary team meetings</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->multDisTeamMeet)) {
                if ($row1QActual->multDisTeamMeet != -99){
                  echo $row1QActual->multDisTeamMeet;
                  $Q1Act = $row1QActual->multDisTeamMeet;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row2QActual->multDisTeamMeet)) {
                if ($row2QActual->multDisTeamMeet != -99){
                  echo $row2QActual->multDisTeamMeet;
                  $Q2Act = $row2QActual->multDisTeamMeet;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row3QActual->multDisTeamMeet)) {
                if ($row3QActual->multDisTeamMeet != -99){
                  echo $row3QActual->multDisTeamMeet;
                  $Q3Act = $row3QActual->multDisTeamMeet;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row4QActual->multDisTeamMeet)) {
                if ($row4QActual->multDisTeamMeet != -99){
                  echo $row4QActual->multDisTeamMeet;
                  $Q4Act = $row4QActual->multDisTeamMeet;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>';
                //'<td><input type="text" class="DisableInput" disabled="true" name="multDisTeamMeetBudTot" value="" /></td>'.
           $multDisTeamMeetActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           echo '<td><b>'.$multDisTeamMeetActTot.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a) Number of cases referred for prosecution</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->prosCases)) {
                if ($row1QActual->prosCases != -99){
                  echo $row1QActual->prosCases;
                  $Q1Act = $row1QActual->prosCases;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row2QActual->prosCases)) {
                if ($row2QActual->prosCases != -99){
                  echo $row2QActual->prosCases;
                  $Q2Act = $row2QActual->prosCases;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row3QActual->prosCases)) {
                if ($row3QActual->prosCases != -99){
                  echo $row3QActual->prosCases;
                  $Q3Act = $row3QActual->prosCases;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row4QActual->prosCases)) {
                if ($row4QActual->prosCases != -99){
                  echo $row4QActual->prosCases;
                  $Q4Act = $row4QActual->prosCases;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>';
                //'<td><input type="text" class="DisableInput" disabled="true" name="prosCasesBudTot" value="" /></td>'.
           $prosCasesActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           echo '<td><b>'.$prosCasesActTot.'</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b) Number of children referred for medical exams</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->medExamRef)) {
                if ($row1QActual->medExamRef != -99){
                  echo $row1QActual->medExamRef;
                  $Q1Act = $row1QActual->medExamRef;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row2QActual->medExamRef)) {
                if ($row2QActual->medExamRef != -99){
                  echo $row2QActual->medExamRef;
                  $Q2Act = $row2QActual->medExamRef;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row3QActual->medExamRef)) {
                if ($row3QActual->medExamRef != -99){
                  echo $row3QActual->medExamRef;
                  $Q3Act = $row3QActual->medExamRef;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row4QActual->medExamRef)) {
                if ($row4QActual->medExamRef != -99){
                  echo $row4QActual->medExamRef;
                  $Q4Act = $row4QActual->medExamRef;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>'.
                '<td class="Disable"></td>';
                //'<td><input type="text" class="DisableInput" disabled="true" name="medExamRefBudTot" value="" /></td>'.
           $medExamRefActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           echo '<td><b>'.$medExamRefActTot.'</b></td>'.
                '</tr>';

           //Initialize the error array
           $Expense1QBud = array();
           $Expense1QAct = array();
           $Expense2QBud = array();
           $Expense2QAct = array();
           $Expense3QBud = array();
           $Expense3QAct = array();
           $Expense4QBud = array();
           $Expense4QAct = array();
           $ExpenseTotBud = array();
           $ExpenseTotAct = array();

           echo '<tr><td colspan="11"><br></td></tr>';   //TODO
           echo '<tr>'.
                '<td><b>Quarterly Expenditures</td>'.
                '<td colspan="2" align="center"><b>First Quarter</b></td>'.
                '<td colspan="2" align="center"><b>Second Quarter</b></td>'.
                '<td colspan="2" align="center"><b>Third Quarter</b></td>'.
                '<td colspan="2" align="center"><b>Fourth Quarter</b></td>'.
                '<td colspan="2" align="center"><b>Annual Total</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td> </td>'.
                '<td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>'.
                '<td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>'.
                '<td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>'.
                '<td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>'.
                '<td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Number of full-time employees</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row1QActual->fullTimeEmp)) {
                if ($row1QActual->fullTimeEmp != -99.99){
                  echo number_format($row1QActual->fullTimeEmp,2);
                }
           }
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row2QActual->fullTimeEmp)) {
                if ($row2QActual->fullTimeEmp != -99.99){
                  echo number_format($row2QActual->fullTimeEmp,2);
                }
           }
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row3QActual->fullTimeEmp)) {
                if ($row3QActual->fullTimeEmp != -99.99){
                  echo number_format($row3QActual->fullTimeEmp,2);
                }
           }
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td>';
           if(isset($row4QActual->fullTimeEmp)) {
                if ($row4QActual->fullTimeEmp != -99.99){
                  echo number_format($row4QActual->fullTimeEmp,2);
                }
           }
           echo '</td>'.
                '<td class="Disable"></td>'.
                '<td class="Disable"></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Personnel Costs</td>'.
                '<td>';
           if(isset($row1QBudgeted->personnelCosts)){ echo number_format($row1QBudgeted->personnelCosts,2); $Expense1QBud[] = $row1QBudgeted->personnelCosts;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->personnelCosts)) {
                if ($row1QActual->personnelCosts != -99.99){
                  echo number_format($row1QActual->personnelCosts,2);
                  $Expense1QAct[] = $row1QActual->personnelCosts;
                  $Q1Act = $row1QActual->personnelCosts;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->personnelCosts)){ echo number_format($row2QBudgeted->personnelCosts,2); $Expense2QBud[] = $row2QBudgeted->personnelCosts;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->personnelCosts)) {
                if ($row2QActual->personnelCosts != -99.99){
                  echo number_format($row2QActual->personnelCosts,2);
                  $Expense2QAct[] = $row2QActual->personnelCosts;
                  $Q2Act = $row2QActual->personnelCosts;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->personnelCosts)){ echo number_format($row3QBudgeted->personnelCosts,2); $Expense3QBud[] = $row3QBudgeted->personnelCosts;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->personnelCosts)) {
                if ($row3QActual->personnelCosts != -99.99){
                  echo number_format($row3QActual->personnelCosts,2);
                  $Expense3QAct[] = $row3QActual->personnelCosts;
                  $Q3Act = $row3QActual->personnelCosts;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->personnelCosts)){ echo number_format($row4QBudgeted->personnelCosts,2); $Expense4QBud[] = $row4QBudgeted->personnelCosts;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->personnelCosts)) {
                if ($row4QActual->personnelCosts != -99.99){
                  echo number_format($row4QActual->personnelCosts,2);
                  $Expense4QAct[] = $row4QActual->personnelCosts;
                  $Q4Act = $row4QActual->personnelCosts;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $personnelCostsBudTot = $row1QBudgeted->personnelCosts + $row2QBudgeted->personnelCosts + $row3QBudgeted->personnelCosts + $row4QBudgeted->personnelCosts;
           $personnelCostsActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $ExpenseTotBud[] = $personnelCostsBudTot;
           $ExpenseTotAct[] = $personnelCostsActTot;
           echo '<td><b>'.number_format($personnelCostsBudTot,2).'</b></td>'.
                '<td><b>'.number_format($personnelCostsActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Employee Benefits</td>'.
                '<td>';
           if(isset($row1QBudgeted->empBenefits)){ echo number_format($row1QBudgeted->empBenefits,2); $Expense1QBud[] = $row1QBudgeted->empBenefits;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->empBenefits)) {
                if ($row1QActual->empBenefits != -99.99){
                  echo number_format($row1QActual->empBenefits,2);
                  $Expense1QAct[] = $row1QActual->empBenefits;
                  $Q1Act = $row1QActual->empBenefits;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->empBenefits)){ echo number_format($row2QBudgeted->empBenefits,2); $Expense2QBud[] = $row2QBudgeted->empBenefits;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->empBenefits)) {
                if ($row2QActual->empBenefits != -99.99){
                  echo number_format($row2QActual->empBenefits,2);
                  $Expense2QAct[] = $row2QActual->empBenefits;
                  $Q2Act = $row2QActual->empBenefits;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->empBenefits)){ echo number_format($row3QBudgeted->empBenefits,2); $Expense3QBud[] = $row3QBudgeted->empBenefits;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->empBenefits)) {
                if ($row3QActual->empBenefits != -99.99){
                  echo number_format($row3QActual->empBenefits,2);
                  $Expense3QAct[] = $row3QActual->empBenefits;
                  $Q3Act = $row3QActual->empBenefits;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->empBenefits)){ echo number_format($row4QBudgeted->empBenefits,2); $Expense4QBud[] = $row4QBudgeted->empBenefits;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->empBenefits)) {
                if ($row4QActual->empBenefits != -99.99){
                  echo number_format($row4QActual->empBenefits,2);
                  $Expense4QAct[] = $row4QActual->empBenefits;
                  $Q4Act = $row4QActual->empBenefits;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $empBenefitsBudTot = $row1QBudgeted->empBenefits + $row2QBudgeted->empBenefits + $row3QBudgeted->empBenefits + $row4QBudgeted->empBenefits;
           $empBenefitsActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $ExpenseTotBud[] = $empBenefitsBudTot;
           $ExpenseTotAct[] = $empBenefitsActTot;
           echo '<td><b>'.number_format($empBenefitsBudTot,2).'</b></td>'.
                '<td><b>'.number_format($empBenefitsActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Travel-In-State</td>'.
                '<td>';
           if(isset($row1QBudgeted->travelInState)){ echo number_format($row1QBudgeted->travelInState,2); $Expense1QBud[] = $row1QBudgeted->travelInState;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->travelInState)) {
                if ($row1QActual->travelInState != -99.99){
                  echo number_format($row1QActual->travelInState,2);
                  $Expense1QAct[] = $row1QActual->travelInState;
                  $Q1Act = $row1QActual->travelInState;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->travelInState)){ echo number_format($row2QBudgeted->travelInState,2); $Expense2QBud[] = $row2QBudgeted->travelInState;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->travelInState)) {
                if ($row2QActual->travelInState != -99.99){
                  echo number_format($row2QActual->travelInState,2);
                  $Expense2QAct[] = $row2QActual->travelInState;
                  $Q2Act = $row2QActual->travelInState;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->travelInState)){ echo number_format($row3QBudgeted->travelInState,2); $Expense3QBud[] = $row3QBudgeted->travelInState;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->travelInState)) {
                if ($row3QActual->travelInState != -99.99){
                  echo number_format($row3QActual->travelInState,2);
                  $Expense3QAct[] = $row3QActual->travelInState;
                  $Q3Act = $row3QActual->travelInState;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->travelInState)){ echo number_format($row4QBudgeted->travelInState,2); $Expense4QBud[] = $row4QBudgeted->travelInState;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->travelInState)) {
                if ($row4QActual->travelInState != -99.99){
                  echo number_format($row4QActual->travelInState,2);
                  $Expense4QAct[] = $row4QActual->travelInState;
                  $Q4Act = $row4QActual->travelInState;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $travelInStateBudTot = $row1QBudgeted->travelInState + $row2QBudgeted->travelInState + $row3QBudgeted->travelInState + $row4QBudgeted->travelInState;
           $travelInStateActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $ExpenseTotBud[] = $travelInStateBudTot;
           $ExpenseTotAct[] = $travelInStateActTot;
           echo '<td><b>'.number_format($travelInStateBudTot,2).'</b></td>'.
                '<td><b>'.number_format($travelInStateActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Travel-Out-of-State</td>'.
                '<td>';
           if(isset($row1QBudgeted->travelOutState)){ echo number_format($row1QBudgeted->travelOutState,2); $Expense1QBud[] = $row1QBudgeted->travelOutState;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->travelOutState)) {
                if ($row1QActual->travelOutState != -99.99){
                  echo number_format($row1QActual->travelOutState,2);
                  $Expense1QAct[] = $row1QActual->travelOutState;
                  $Q1Act = $row1QActual->travelOutState;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->travelOutState)){ echo number_format($row2QBudgeted->travelOutState,2); $Expense2QBud[] = $row2QBudgeted->travelOutState;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->travelOutState)) {
                if ($row2QActual->travelOutState != -99.99){
                  echo number_format($row2QActual->travelOutState,2);
                  $Expense2QAct[] = $row2QActual->travelOutState;
                  $Q2Act = $row2QActual->travelOutState;
                }
                else
                  $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->travelOutState)){ echo number_format($row3QBudgeted->travelOutState,2); $Expense3QBud[] = $row3QBudgeted->travelOutState;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->travelOutState)) {
                if ($row3QActual->travelOutState != -99.99){
                  echo number_format($row3QActual->travelOutState,2);
                  $Expense3QAct[] = $row3QActual->travelOutState;
                  $Q3Act = $row3QActual->travelOutState;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->travelOutState)){ echo number_format($row4QBudgeted->travelOutState,2); $Expense4QBud[] = $row4QBudgeted->travelOutState;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->travelOutState)) {
                if ($row4QActual->travelOutState != -99.99){
                  echo number_format($row4QActual->travelOutState,2);
                  $Expense4QAct[] = $row4QActual->travelOutState;
                  $Q4Act = $row4QActual->travelOutState;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $travelOutStateBudTot = $row1QBudgeted->travelOutState + $row2QBudgeted->travelOutState + $row3QBudgeted->travelOutState + $row4QBudgeted->travelOutState;
           $travelOutStateActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $ExpenseTotBud[] = $travelOutStateBudTot;
           $ExpenseTotAct[] = $travelOutStateActTot;
           echo '<td><b>'.number_format($travelOutStateBudTot,2).'</b></td>'.
                '<td><b>'.number_format($travelOutStateActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Repairs and Maintenance</td>'.
                '<td>';
           if(isset($row1QBudgeted->repairsAndMx)){ echo number_format($row1QBudgeted->repairsAndMx,2); $Expense1QBud[] = $row1QBudgeted->repairsAndMx;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->repairsAndMx)) {
                if ($row1QActual->repairsAndMx != -99.99){
                  echo number_format($row1QActual->repairsAndMx,2);
                  $Expense1QAct[] = $row1QActual->repairsAndMx;
                  $Q1Act = $row1QActual->repairsAndMx;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->repairsAndMx)){ echo number_format($row2QBudgeted->repairsAndMx,2); $Expense2QBud[] = $row2QBudgeted->repairsAndMx;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->repairsAndMx)) {
                if ($row2QActual->repairsAndMx != -99.99){
                  echo number_format($row2QActual->repairsAndMx,2);
                  $Expense2QAct[] = $row2QActual->repairsAndMx;
                  $Q2Act = $row2QActual->repairsAndMx;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->repairsAndMx)){ echo number_format($row3QBudgeted->repairsAndMx,2); $Expense3QBud[] = $row3QBudgeted->repairsAndMx;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->repairsAndMx)) {
                if ($row3QActual->repairsAndMx != -99.99){
                  echo number_format($row3QActual->repairsAndMx,2);
                  $Expense3QAct[] = $row3QActual->repairsAndMx;
                  $Q3Act = $row3QActual->repairsAndMx;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->repairsAndMx)){ echo number_format($row4QBudgeted->repairsAndMx,2); $Expense4QBud[] = $row4QBudgeted->repairsAndMx;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->repairsAndMx)) {
                if ($row4QActual->repairsAndMx != -99.99){
                  echo number_format($row4QActual->repairsAndMx,2);
                  $Expense4QAct[] = $row4QActual->repairsAndMx;
                  $Q4Act = $row4QActual->repairsAndMx;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $repairsAndMxBudTot = $row1QBudgeted->repairsAndMx + $row2QBudgeted->repairsAndMx + $row3QBudgeted->repairsAndMx + $row4QBudgeted->repairsAndMx;
           $repairsAndMxActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $ExpenseTotBud[] = $repairsAndMxBudTot;
           $ExpenseTotAct[] = $repairsAndMxActTot;
           echo '<td><b>'.number_format($repairsAndMxBudTot,2).'</b></td>'.
                '<td><b>'.number_format($repairsAndMxActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Rentals and Leases</td>'.
                '<td>';
           if(isset($row1QBudgeted->rentalsLease)){ echo number_format($row1QBudgeted->rentalsLease,2); $Expense1QBud[] = $row1QBudgeted->rentalsLease;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->rentalsLease)) {
                if ($row1QActual->rentalsLease != -99.99){
                  echo number_format($row1QActual->rentalsLease,2);
                  $Expense1QAct[] = $row1QActual->rentalsLease;
                  $Q1Act = $row1QActual->rentalsLease;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->rentalsLease)){ echo number_format($row2QBudgeted->rentalsLease,2); $Expense2QBud[] = $row2QBudgeted->rentalsLease;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->rentalsLease)) {
                if ($row2QActual->rentalsLease != -99.99){
                  echo number_format($row2QActual->rentalsLease,2);
                  $Expense2QAct[] = $row2QActual->rentalsLease;
                  $Q2Act = $row2QActual->rentalsLease;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->rentalsLease)){ echo number_format($row3QBudgeted->rentalsLease,2); $Expense3QBud[] = $row3QBudgeted->rentalsLease;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->rentalsLease)) {
                if ($row3QActual->rentalsLease != -99.99){
                  echo number_format($row3QActual->rentalsLease,2);
                  $Expense3QAct[] = $row3QActual->rentalsLease;
                  $Q3Act = $row3QActual->rentalsLease;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->rentalsLease)){ echo number_format($row4QBudgeted->rentalsLease,2); $Expense4QBud[] = $row4QBudgeted->rentalsLease;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->rentalsLease)) {
                if ($row4QActual->rentalsLease != -99.99){
                  echo number_format($row4QActual->rentalsLease,2);
                  $Expense4QAct[] = $row4QActual->rentalsLease;
                  $Q4Act = $row4QActual->rentalsLease;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $rentalsLeaseBudTot = $row1QBudgeted->rentalsLease + $row2QBudgeted->rentalsLease + $row3QBudgeted->rentalsLease + $row4QBudgeted->rentalsLease;
           $rentalsLeaseActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $ExpenseTotBud[] = $rentalsLeaseBudTot;
           $ExpenseTotAct[] = $rentalsLeaseActTot;
           echo '<td><b>'.number_format($rentalsLeaseBudTot,2).'</b></td>'.
                '<td><b>'.number_format($rentalsLeaseActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Utilities and Communications</td>'.
                '<td>';
           if(isset($row1QBudgeted->utilComm)){ echo number_format($row1QBudgeted->utilComm,2); $Expense1QBud[] = $row1QBudgeted->utilComm;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->utilComm)) {
                if ($row1QActual->utilComm != -99.99){
                  echo number_format($row1QActual->utilComm,2);
                  $Expense1QAct[] = $row1QActual->utilComm;
                  $Q1Act = $row1QActual->utilComm;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->utilComm)){ echo number_format($row2QBudgeted->utilComm,2); $Expense2QBud[] = $row2QBudgeted->utilComm;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->utilComm)) {
                if ($row2QActual->utilComm != -99.99){
                  echo number_format($row2QActual->utilComm,2);
                  $Expense2QAct[] = $row2QActual->utilComm;
                  $Q2Act = $row2QActual->utilComm;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->utilComm)){ echo number_format($row3QBudgeted->utilComm,2); $Expense3QBud[] = $row3QBudgeted->utilComm;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->utilComm)) {
                if ($row3QActual->utilComm != -99.99){
                  echo number_format($row3QActual->utilComm,2);
                  $Expense3QAct[] = $row3QActual->utilComm;
                  $Q3Act = $row3QActual->utilComm;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->utilComm)){ echo number_format($row4QBudgeted->utilComm,2); $Expense4QBud[] = $row4QBudgeted->utilComm;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->utilComm)) {
                if ($row4QActual->utilComm != -99.99){
                  echo number_format($row4QActual->utilComm,2);
                  $Expense4QAct[] = $row4QActual->utilComm;
                  $Q4Act = $row4QActual->utilComm;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $utilCommBudTot = $row1QBudgeted->utilComm + $row2QBudgeted->utilComm + $row3QBudgeted->utilComm + $row4QBudgeted->utilComm;
           $utilCommActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $ExpenseTotBud[] = $utilCommBudTot;
           $ExpenseTotAct[] = $utilCommActTot;
           echo '<td><b>'.number_format($utilCommBudTot,2).'</b></td>'.
                '<td><b>'.number_format($utilCommActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Professional Services</td>'.
                '<td>';
           if(isset($row1QBudgeted->profServ)){ echo number_format($row1QBudgeted->profServ,2); $Expense1QBud[] = $row1QBudgeted->profServ;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->profServ)) {
                if ($row1QActual->profServ != -99.99){
                  echo number_format($row1QActual->profServ,2);
                  $Expense1QAct[] = $row1QActual->profServ;
                  $Q1Act = $row1QActual->profServ;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->profServ)){ echo number_format($row2QBudgeted->profServ,2); $Expense2QBud[] = $row2QBudgeted->profServ;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->profServ)) {
                if ($row2QActual->profServ != -99.99){
                  echo number_format($row2QActual->profServ,2);
                  $Expense2QAct[] = $row2QActual->profServ;
                  $Q2Act = $row2QActual->profServ;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->profServ)){ echo number_format($row3QBudgeted->profServ,2); $Expense3QBud[] = $row3QBudgeted->profServ;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->profServ)) {
                if ($row3QActual->profServ != -99.99){
                  echo number_format($row3QActual->profServ,2);
                  $Expense3QAct[] = $row3QActual->profServ;
                  $Q3Act = $row3QActual->profServ;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->profServ)){ echo number_format($row4QBudgeted->profServ,2); $Expense4QBud[] = $row4QBudgeted->profServ;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->profServ)) {
                if ($row4QActual->profServ != -99.99){
                  echo number_format($row4QActual->profServ,2);
                  $Expense4QAct[] = $row4QActual->profServ;
                  $Q4Act = $row4QActual->profServ;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $profServBudTot = $row1QBudgeted->profServ + $row2QBudgeted->profServ + $row3QBudgeted->profServ + $row4QBudgeted->profServ;
           $profServActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $ExpenseTotBud[] = $profServBudTot;
           $ExpenseTotAct[] = $profServActTot;
           echo '<td><b>'.number_format($profServBudTot,2).'</b></td>'.
                '<td><b>'.number_format($profServActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Supplies, Materials, Operations</td>'.
                '<td>';
           if(isset($row1QBudgeted->suppMatOper)){ echo number_format($row1QBudgeted->suppMatOper,2); $Expense1QBud[] = $row1QBudgeted->suppMatOper;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->suppMatOper)) {
                if ($row1QActual->suppMatOper != -99.99){
                  echo number_format($row1QActual->suppMatOper,2);
                  $Expense1QAct[] = $row1QActual->suppMatOper;
                  $Q1Act = $row1QActual->suppMatOper;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->suppMatOper)){ echo number_format($row2QBudgeted->suppMatOper,2); $Expense2QBud[] = $row2QBudgeted->suppMatOper;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->suppMatOper)) {
                if ($row2QActual->suppMatOper != -99.99){
                  echo number_format($row2QActual->suppMatOper,2);
                  $Expense2QAct[] = $row2QActual->suppMatOper;
                  $Q2Act = $row2QActual->suppMatOper;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->suppMatOper)){ echo number_format($row3QBudgeted->suppMatOper,2); $Expense3QBud[] = $row3QBudgeted->suppMatOper;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->suppMatOper)) {
                if ($row3QActual->suppMatOper != -99.99){
                  echo number_format($row3QActual->suppMatOper,2);
                  $Expense3QAct[] = $row3QActual->suppMatOper;
                  $Q3Act = $row3QActual->suppMatOper;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->suppMatOper)){ echo number_format($row4QBudgeted->suppMatOper,2); $Expense4QBud[] = $row4QBudgeted->suppMatOper;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->suppMatOper)) {
                if ($row4QActual->suppMatOper != -99.99){
                  echo number_format($row4QActual->suppMatOper,2);
                  $Expense4QAct[] = $row4QActual->suppMatOper;
                  $Q4Act = $row4QActual->suppMatOper;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $suppMatOperBudTot = $row1QBudgeted->suppMatOper + $row2QBudgeted->suppMatOper + $row3QBudgeted->suppMatOper + $row4QBudgeted->suppMatOper;
           $suppMatOperActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $ExpenseTotBud[] = $suppMatOperBudTot;
           $ExpenseTotAct[] = $suppMatOperActTot;
           echo '<td><b>'.number_format($suppMatOperBudTot,2).'</b></td>'.
                '<td><b>'.number_format($suppMatOperActTot,2).'</b></td>'.
                '</tr>';
            echo '<tr align="right">'.
                '<td align="left">Transportation Equip. Purchases</td>'.
                '<td>';
           if(isset($row1QBudgeted->tranEqpPurch)){ echo number_format($row1QBudgeted->tranEqpPurch,2); $Expense1QBud[] = $row1QBudgeted->tranEqpPurch;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->tranEqpPurch)) {
                if ($row1QActual->tranEqpPurch != -99.99){
                  echo number_format($row1QActual->tranEqpPurch,2);
                  $Expense1QAct[] = $row1QActual->tranEqpPurch;
                  $Q1Act = $row1QActual->tranEqpPurch;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->tranEqpPurch)){ echo number_format($row2QBudgeted->tranEqpPurch,2); $Expense2QBud[] = $row2QBudgeted->tranEqpPurch;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->tranEqpPurch)) {
                if ($row2QActual->tranEqpPurch != -99.99){
                  echo number_format($row2QActual->tranEqpPurch,2);
                  $Expense2QAct[] = $row2QActual->tranEqpPurch;
                  $Q2Act = $row2QActual->tranEqpPurch;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->tranEqpPurch)){ echo number_format($row3QBudgeted->tranEqpPurch,2); $Expense3QBud[] = $row3QBudgeted->tranEqpPurch;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->tranEqpPurch)) {
                if ($row3QActual->tranEqpPurch != -99.99){
                  echo number_format($row3QActual->tranEqpPurch,2);
                  $Expense3QAct[] = $row3QActual->tranEqpPurch;
                  $Q3Act = $row3QActual->tranEqpPurch;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->tranEqpPurch)){ echo number_format($row4QBudgeted->tranEqpPurch,2); $Expense4QBud[] = $row4QBudgeted->tranEqpPurch;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->tranEqpPurch)) {
                if ($row4QActual->tranEqpPurch != -99.99){
                  echo number_format($row4QActual->tranEqpPurch,2);
                  $Expense4QAct[] = $row4QActual->tranEqpPurch;
                  $Q4Act = $row4QActual->tranEqpPurch;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $tranEqpPurchBudTot = $row1QBudgeted->tranEqpPurch + $row2QBudgeted->tranEqpPurch + $row3QBudgeted->tranEqpPurch + $row4QBudgeted->tranEqpPurch;
           $tranEqpPurchActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $ExpenseTotBud[] = $tranEqpPurchBudTot;
           $ExpenseTotAct[] = $tranEqpPurchActTot;
           echo '<td><b>'.number_format($tranEqpPurchBudTot,2).'</b></td>'.
                '<td><b>'.number_format($tranEqpPurchActTot,2).'</b></td>'.
                '</tr>';
            echo '<tr align="right">'.
                '<td align="left">Other Equipment Purchases</td>'.
                '<td>';
           if(isset($row1QBudgeted->otherEqpPurch)){ echo number_format($row1QBudgeted->otherEqpPurch,2); $Expense1QBud[] = $row1QBudgeted->otherEqpPurch;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->otherEqpPurch)) {
                if ($row1QActual->otherEqpPurch != -99.99){
                  echo number_format($row1QActual->otherEqpPurch,2);
                  $Expense1QAct[] = $row1QActual->otherEqpPurch;
                  $Q1Act = $row1QActual->otherEqpPurch;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->otherEqpPurch)){ echo number_format($row2QBudgeted->otherEqpPurch,2); $Expense2QBud[] = $row2QBudgeted->otherEqpPurch;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->otherEqpPurch)) {
                if ($row2QActual->otherEqpPurch != -99.99){
                  echo number_format($row2QActual->otherEqpPurch,2);
                  $Expense2QAct[] = $row2QActual->otherEqpPurch;
                  $Q2Act = $row2QActual->otherEqpPurch;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->otherEqpPurch)){ echo number_format($row3QBudgeted->otherEqpPurch,2); $Expense3QBud[] = $row3QBudgeted->otherEqpPurch;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->otherEqpPurch)) {
                if ($row3QActual->otherEqpPurch != -99.99){
                  echo number_format($row3QActual->otherEqpPurch,2);
                  $Expense3QAct[] = $row3QActual->otherEqpPurch;
                  $Q3Act = $row3QActual->otherEqpPurch;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->otherEqpPurch)){ echo number_format($row4QBudgeted->otherEqpPurch,2); $Expense4QBud[] = $row4QBudgeted->otherEqpPurch;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->otherEqpPurch)) {
                if ($row4QActual->otherEqpPurch != -99.99){
                  echo number_format($row4QActual->otherEqpPurch,2);
                  $Expense4QAct[] = $row4QActual->otherEqpPurch;
                  $Q4Act = $row4QActual->otherEqpPurch;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $otherEqpPurchBudTot = $row1QBudgeted->otherEqpPurch + $row2QBudgeted->otherEqpPurch + $row3QBudgeted->otherEqpPurch + $row4QBudgeted->otherEqpPurch;
           $otherEqpPurchActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $ExpenseTotBud[] = $otherEqpPurchBudTot;
           $ExpenseTotAct[] = $otherEqpPurchActTot;
           echo '<td><b>'.number_format($otherEqpPurchBudTot,2).'</b></td>'.
                '<td><b>'.number_format($otherEqpPurchActTot,2).'</b></td>'.
                '</tr>';
            echo '<tr align="right">'.
                '<td align="left">Capital Outlay</td>'.
                '<td>';
           if(isset($row1QBudgeted->capOutlay)){ echo number_format($row1QBudgeted->capOutlay,2); $Expense1QBud[] = $row1QBudgeted->capOutlay;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->capOutlay)) {
                if ($row1QActual->capOutlay != -99.99){
                  echo number_format($row1QActual->capOutlay,2);
                  $Expense1QAct[] = $row1QActual->capOutlay;
                  $Q1Act = $row1QActual->capOutlay;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->capOutlay)){ echo number_format($row2QBudgeted->capOutlay,2); $Expense2QBud[] = $row2QBudgeted->capOutlay;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->capOutlay)) {
                if ($row2QActual->capOutlay != -99.99){
                  echo number_format($row2QActual->capOutlay,2);
                  $Expense2QAct[] = $row2QActual->capOutlay;
                  $Q2Act = $row2QActual->capOutlay;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->capOutlay)){ echo number_format($row3QBudgeted->capOutlay,2); $Expense3QBud[] = $row3QBudgeted->capOutlay;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->capOutlay)) {
                if ($row3QActual->capOutlay != -99.99){
                  echo number_format($row3QActual->capOutlay,2);
                  $Expense3QAct[] = $row3QActual->capOutlay;
                  $Q3Act = $row3QActual->capOutlay;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->capOutlay)){ echo number_format($row4QBudgeted->capOutlay,2); $Expense4QBud[] = $row4QBudgeted->capOutlay;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->capOutlay)) {
                if ($row4QActual->capOutlay != -99.99){
                  echo number_format($row4QActual->capOutlay,2);
                  $Expense4QAct[] = $row4QActual->capOutlay;
                  $Q4Act = $row4QActual->capOutlay;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $capOutlayBudTot = $row1QBudgeted->capOutlay + $row2QBudgeted->capOutlay + $row3QBudgeted->capOutlay + $row4QBudgeted->capOutlay;
           $capOutlayActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $ExpenseTotBud[] = $capOutlayBudTot;
           $ExpenseTotAct[] = $capOutlayActTot;
           echo '<td><b>'.number_format($capOutlayBudTot,2).'</b></td>'.
                '<td><b>'.number_format($capOutlayActTot,2).'</b></td>'.
                '</tr>';
            echo '<tr align="right">'.
                '<td align="left">Debt Service</td>'.
                '<td>';
           if(isset($row1QBudgeted->debtService)){ echo number_format($row1QBudgeted->debtService,2); $Expense1QBud[] = $row1QBudgeted->debtService;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->debtService)) {
                if ($row1QActual->debtService != -99.99){
                  echo number_format($row1QActual->debtService,2);
                  $Expense1QAct[] = $row1QActual->debtService;
                  $Q1Act = $row1QActual->debtService;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->debtService)){ echo number_format($row2QBudgeted->debtService,2); $Expense2QBud[] = $row2QBudgeted->debtService;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->debtService)) {
                if ($row2QActual->debtService != -99.99){
                  echo number_format($row2QActual->debtService,2);
                  $Expense2QAct[] = $row2QActual->debtService;
                  $Q2Act = $row2QActual->debtService;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->debtService)){ echo number_format($row3QBudgeted->debtService,2); $Expense3QBud[] = $row3QBudgeted->debtService;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->debtService)) {
                if ($row3QActual->debtService != -99.99){
                  echo number_format($row3QActual->debtService,2);
                  $Expense3QAct[] = $row3QActual->debtService;
                  $Q3Act = $row3QActual->debtService;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->debtService)){ echo number_format($row4QBudgeted->debtService,2); $Expense4QBud[] = $row4QBudgeted->debtService;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->debtService)) {
                if ($row4QActual->debtService != -99.99){
                  echo number_format($row4QActual->debtService,2);
                  $Expense4QAct[] = $row4QActual->debtService;
                  $Q4Act = $row4QActual->debtService;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $debtServiceBudTot = $row1QBudgeted->debtService + $row2QBudgeted->debtService + $row3QBudgeted->debtService + $row4QBudgeted->debtService;
           $debtServiceActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $ExpenseTotBud[] = $debtServiceBudTot;
           $ExpenseTotAct[] = $debtServiceActTot;
           echo '<td><b>'.number_format($debtServiceBudTot,2).'</b></td>'.
                '<td><b>'.number_format($debtServiceActTot,2).'</b></td>'.
                '</tr>';
            echo '<tr align="right">'.
                '<td align="left">Miscellaneous</td>'.
               '<td>';
           if(isset($row1QBudgeted->misc)){ echo number_format($row1QBudgeted->misc,2); $Expense1QBud[] = $row1QBudgeted->misc;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->misc)) {
                if ($row1QActual->misc != -99.99){
                  echo number_format($row1QActual->misc,2);
                  $Expense1QAct[] = $row1QActual->misc;
                  $Q1Act = $row1QActual->misc;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->misc)){ echo number_format($row2QBudgeted->misc,2); $Expense2QBud[] = $row2QBudgeted->misc;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->misc)) {
                if ($row2QActual->misc != -99.99){
                  echo number_format($row2QActual->misc,2);
                  $Expense2QAct[] = $row2QActual->misc;
                  $Q2Act = $row2QActual->misc;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->misc)){ echo number_format($row3QBudgeted->misc,2); $Expense3QBud[] = $row3QBudgeted->misc;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->misc)) {
                if ($row3QActual->misc != -99.99){
                  echo number_format($row3QActual->misc,2);
                  $Expense3QAct[] = $row3QActual->misc;
                  $Q3Act = $row3QActual->misc;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->misc)){ echo number_format($row4QBudgeted->misc,2); $Expense4QBud[] = $row4QBudgeted->misc;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->misc)) {
                if ($row4QActual->misc != -99.99){
                  echo number_format($row4QActual->misc,2);
                  $Expense4QAct[] = $row4QActual->misc;
                  $Q4Act = $row4QActual->misc;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $miscBudTot = $row1QBudgeted->misc + $row2QBudgeted->misc + $row3QBudgeted->misc + $row4QBudgeted->misc;
           $miscActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $ExpenseTotBud[] = $miscBudTot;
           $ExpenseTotAct[] = $miscActTot;
           echo '<td><b>'.number_format($miscBudTot,2).'</b></td>'.
                '<td><b>'.number_format($miscActTot,2).'</b></td>'.
                '</tr>';
           //check to see if they have any other expenses entered
           $sqlOE = "SELECT OExpenseID, ExpenseName FROM otherExpenseLU WHERE center = '".$theCenter."' AND fiscalyear = '".$fiscalYear."' ORDER BY OExpenseID";
           $resultOE = @mysql_query($sqlOE) or mysql_error();

           $numRecords = mysql_num_rows($resultOE);
           if ($numRecords > 0){
              while ($row = mysql_fetch_object($resultOE)) {
                $oeValue1QBud = 0;
                $oeValue1QAct = 0;
                $oeValue2QBud = 0;
                $oeValue2QAct = 0;
                $oeValue3QBud = 0;
                $oeValue3QAct = 0;
                $oeValue4QBud = 0;
                $oeValue4QAct = 0;
                 echo '<tr align="right"><td align="left">'.$row->ExpenseName.'</td>'.
                 '<td>';
                        $sqlOEValues = "SELECT oeValue FROM budgetedOtherExpense WHERE center = ".$theCenter." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = 1 AND OExpenseID = ".$row->OExpenseID;
                        $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                        $rowOEValues = mysql_fetch_object($resultOEValues);
                 if(isset($rowOEValues->oeValue)){ echo number_format($rowOEValues->oeValue,2); $Expense1QBud[] = $rowOEValues->oeValue; $oeValue1QBud = $rowOEValues->oeValue;}
                 echo '</td>'.  //1QBud
                '<td>';
                        $sqlOEValues = "SELECT oeValue FROM actualOtherExpense WHERE center = ".$theCenter." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = 1 AND OExpenseID = ".$row->OExpenseID;
                        $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                        $rowOEValues = mysql_fetch_object($resultOEValues);
                 if(isset($rowOEValues->oeValue)) {
                        if ($rowOEValues->oeValue != -99.99){
                                echo number_format($rowOEValues->oeValue,2);
                                $Expense1QAct[] = $rowOEValues->oeValue;
                                $Q1Act = $rowOEValues->oeValue;
                        }else $Q1Act = 0;
                 }else $Q1Act = 0;
                 echo '</td>'.  //1QAct
                '<td>';
                        $sqlOEValues = "SELECT oeValue FROM budgetedOtherExpense WHERE center = ".$theCenter." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = 2 AND OExpenseID = ".$row->OExpenseID;
                        $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                        $rowOEValues = mysql_fetch_object($resultOEValues);
                 if(isset($rowOEValues->oeValue)){ echo number_format($rowOEValues->oeValue,2); $Expense2QBud[] = $rowOEValues->oeValue; $oeValue2QBud = $rowOEValues->oeValue;}
                 echo '</td>'.  //2QBud
                '<td>';
                        $sqlOEValues = "SELECT oeValue FROM actualOtherExpense WHERE center = ".$theCenter." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = 2 AND OExpenseID = ".$row->OExpenseID;
                        $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                        $rowOEValues = mysql_fetch_object($resultOEValues);
                 if(isset($rowOEValues->oeValue)) {
                        if ($rowOEValues->oeValue != -99.99){
                                echo number_format($rowOEValues->oeValue,2);
                                $Expense2QAct[] = $rowOEValues->oeValue;
                                $Q2Act = $rowOEValues->oeValue;
                        }else $Q2Act = 0;
                 }else $Q2Act = 0;
                 echo '</td>'.  //2QAct
                '<td>';
                        $sqlOEValues = "SELECT oeValue FROM budgetedOtherExpense WHERE center = ".$theCenter." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = 3 AND OExpenseID = ".$row->OExpenseID;
                        $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                        $rowOEValues = mysql_fetch_object($resultOEValues);
                 if(isset($rowOEValues->oeValue)){ echo number_format($rowOEValues->oeValue,2); $Expense3QBud[] = $rowOEValues->oeValue; $oeValue3QBud = $rowOEValues->oeValue;}
                 echo '</td>'.  //3QBud
                '<td>';
                        $sqlOEValues = "SELECT oeValue FROM actualOtherExpense WHERE center = ".$theCenter." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = 3 AND OExpenseID = ".$row->OExpenseID;
                        $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                        $rowOEValues = mysql_fetch_object($resultOEValues);
                 if(isset($rowOEValues->oeValue)) {
                        if ($rowOEValues->oeValue != -99.99){
                                echo number_format($rowOEValues->oeValue,2);
                                $Expense3QAct[] = $rowOEValues->oeValue;
                                $Q3Act = $rowOEValues->oeValue;
                        }else $Q3Act = 0;
                 }else $Q3Act = 0;
                 echo '</td>'.  //3QAct
                '<td>';
                        $sqlOEValues = "SELECT oeValue FROM budgetedOtherExpense WHERE center = ".$theCenter." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = 4 AND OExpenseID = ".$row->OExpenseID;
                        $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                        $rowOEValues = mysql_fetch_object($resultOEValues);
                 if(isset($rowOEValues->oeValue)){ echo number_format($rowOEValues->oeValue,2); $Expense4QBud[] = $rowOEValues->oeValue; $oeValue4QBud = $rowOEValues->oeValue;}
                 echo '</td>'.  //4QBud
                '<td>';
                        $sqlOEValues = "SELECT oeValue FROM actualOtherExpense WHERE center = ".$theCenter." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = 4 AND OExpenseID = ".$row->OExpenseID;
                        $resultOEValues = @mysql_query($sqlOEValues) or mysql_error();
                        $rowOEValues = mysql_fetch_object($resultOEValues);
                 if(isset($rowOEValues->oeValue)) {
                        if ($rowOEValues->oeValue != -99.99){
                                echo number_format($rowOEValues->oeValue,2);
                                $Expense4QAct[] = $rowOEValues->oeValue;
                                $Q4Act = $rowOEValues->oeValue;
                        }else $Q4Act = 0;
                 }else $Q4Act = 0;
                 echo '</td>';  //4QAct
                 $oeValueTotBud = $oeValue1QBud + $oeValue2QBud + $oeValue3QBud + $oeValue4QBud;
                 $oeValueTotAct = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
                 $ExpenseTotBud[] = $oeValueTotBud;
                 $ExpenseTotAct[] = $oeValueTotAct;
                 echo '<td><b>'.number_format($oeValueTotBud,2).'</b></td>'.//TotBud
                '<td><b>'.number_format($oeValueTotAct,2).'</b></td>'.//TotAct
                '</tr>';
                }
           }
           $totExpends1QBudget = 0;
           foreach ($Expense1QBud as $floatFund){
                     $totExpends1QBudget = $totExpends1QBudget + $floatFund;
                  }
           $totExpends2QBudget = 0;
           foreach ($Expense2QBud as $floatFund){
                     $totExpends2QBudget = $totExpends2QBudget + $floatFund;
                  }
           $totExpends3QBudget = 0;
           foreach ($Expense3QBud as $floatFund){
                     $totExpends3QBudget = $totExpends3QBudget + $floatFund;
                  }
           $totExpends4QBudget = 0;
           foreach ($Expense4QBud as $floatFund){
                     $totExpends4QBudget = $totExpends4QBudget + $floatFund;
                  }
           $totExpendsTotBudget = 0;
           foreach ($ExpenseTotBud as $floatFund){
                     $totExpendsTotBudget = $totExpendsTotBudget + $floatFund;
                  }
           $totExpends1QActual = 0;
           foreach ($Expense1QAct as $floatFund){
                     $totExpends1QActual = $totExpends1QActual + $floatFund;
                  }
           $totExpends2QActual = 0;
           foreach ($Expense2QAct as $floatFund){
                     $totExpends2QActual = $totExpends2QActual + $floatFund;
                  }
           $totExpends3QActual = 0;
           foreach ($Expense3QAct as $floatFund){
                     $totExpends3QActual = $totExpends3QActual + $floatFund;
                  }
           $totExpends4QActual = 0;
           foreach ($Expense4QAct as $floatFund){
                     $totExpends4QActual = $totExpends4QActual + $floatFund;
                  }
           $totExpendsTotActual = 0;
           foreach ($ExpenseTotAct as $floatFund){
                     $totExpendsTotActual = $totExpendsTotActual + $floatFund;
                  }
            echo '<tr align="right">'.
                '<td align="center"><b>Total Expenditures</b></td>'.
                '<td><b>'.number_format($totExpends1QBudget,2).'</b></td>'. //for the value I will use the ISSET function and the values from the sql call at the top
                '<td><b>'.number_format($totExpends1QActual,2).'</b></td>'.
                '<td><b>'.number_format($totExpends2QBudget,2).'</b></td>'.
                '<td><b>'.number_format($totExpends2QActual,2).'</b></td>'.
                '<td><b>'.number_format($totExpends3QBudget,2).'</b></td>'.
                '<td><b>'.number_format($totExpends3QActual,2).'</b></td>'.
                '<td><b>'.number_format($totExpends4QBudget,2).'</b></td>'.
                '<td><b>'.number_format($totExpends4QActual,2).'</b></td>'.
                '<td><b>'.number_format($totExpendsTotBudget,2).'</b></td>'.
                '<td><b>'.number_format($totExpendsTotActual,2).'</b></td>'.
                '</tr>';
           echo '<tr><td colspan="11"><br></td></tr>'; //THIS WAS 13

           $Funds1QBud = array();
           $Funds1QAct = array();
           $Funds2QBud = array();
           $Funds2QAct = array();
           $Funds3QBud = array();
           $Funds3QAct = array();
           $Funds4QBud = array();
           $Funds4QAct = array();
           $FundsTotBud = array();
           $FundsTotAct = array();

           echo '<tr>'.
                '<td><b>Source of Funds</td>'.
                '<td colspan="2" align="center"><b>First Quarter</b></td>'.
                '<td colspan="2" align="center"><b>Second Quarter</b></td>'.
                '<td colspan="2" align="center"><b>Third Quarter</b></td>'.
                '<td colspan="2" align="center"><b>Fourth Quarter</b></td>'.
                '<td colspan="2" align="center"><b>Annual Total</b></td>'.
                '</tr>';
           echo '<tr align="center">'.
                '<td> </td>'.
                '<td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>'.
                '<td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>'.
                '<td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>'.
                '<td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>'.
                '<td width="7%"><b>Budgeted</b></td><td width="7%"><b>Actual</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">State of AL General Fund</td>'.
                '<td>';
           if(isset($row1QBudgeted->genFund)){ echo number_format($row1QBudgeted->genFund,2); $Funds1QBud[] = $row1QBudgeted->genFund;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->genFund)) {
                if ($row1QActual->genFund != -99.99){
                  echo number_format($row1QActual->genFund,2);
                  $Funds1QAct[] = $row1QActual->genFund;
                  $Q1Act = $row1QActual->genFund;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->genFund)){ echo number_format($row2QBudgeted->genFund,2); $Funds2QBud[] = $row2QBudgeted->genFund;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->genFund)) {
                if ($row2QActual->genFund != -99.99){
                  echo number_format($row2QActual->genFund,2);
                  $Funds2QAct[] = $row2QActual->genFund;
                  $Q2Act = $row2QActual->genFund;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->genFund)){ echo number_format($row3QBudgeted->genFund,2); $Funds3QBud[] = $row3QBudgeted->genFund;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->genFund)) {
                if ($row3QActual->genFund != -99.99){
                  echo number_format($row3QActual->genFund,2);
                  $Funds3QAct[] = $row3QActual->genFund;
                  $Q3Act = $row3QActual->genFund;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->genFund)){ echo number_format($row4QBudgeted->genFund,2); $Funds4QBud[] = $row4QBudgeted->genFund;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->genFund)) {
                if ($row4QActual->genFund != -99.99){
                  echo number_format($row4QActual->genFund,2);
                  $Funds4QAct[] = $row4QActual->genFund;
                  $Q4Act = $row4QActual->genFund;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $genFundBudTot = $row1QBudgeted->genFund + $row2QBudgeted->genFund + $row3QBudgeted->genFund + $row4QBudgeted->genFund;
           $genFundActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $FundsTotBud[] = $genFundBudTot;
           $FundsTotAct[] = $genFundActTot;
           echo '<td><b>'.number_format($genFundBudTot,2).'</b></td>'.
                '<td><b>'.number_format($genFundActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">State of AL Children First Trust</td>'.
                '<td>';
           if(isset($row1QBudgeted->chilFirstTrust)){ echo number_format($row1QBudgeted->chilFirstTrust,2); $Funds1QBud[] = $row1QBudgeted->chilFirstTrust;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->chilFirstTrust)) {
                if ($row1QActual->chilFirstTrust != -99.99){
                  echo number_format($row1QActual->chilFirstTrust,2);
                  $Funds1QAct[] = $row1QActual->chilFirstTrust;
                  $Q1Act = $row1QActual->chilFirstTrust;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->chilFirstTrust)){ echo number_format($row2QBudgeted->chilFirstTrust,2); $Funds2QBud[] = $row2QBudgeted->chilFirstTrust;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->chilFirstTrust)) {
                if ($row2QActual->chilFirstTrust != -99.99){
                  echo number_format($row2QActual->chilFirstTrust,2);
                  $Funds2QAct[] = $row2QActual->chilFirstTrust;
                  $Q2Act = $row2QActual->chilFirstTrust;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->chilFirstTrust)){ echo number_format($row3QBudgeted->chilFirstTrust,2); $Funds3QBud[] = $row3QBudgeted->chilFirstTrust;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->chilFirstTrust)) {
                if ($row3QActual->chilFirstTrust != -99.99){
                  echo number_format($row3QActual->chilFirstTrust,2);
                  $Funds3QAct[] = $row3QActual->chilFirstTrust;
                  $Q3Act = $row3QActual->chilFirstTrust;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->chilFirstTrust)){ echo number_format($row4QBudgeted->chilFirstTrust,2); $Funds4QBud[] = $row4QBudgeted->chilFirstTrust;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->chilFirstTrust)) {
                if ($row4QActual->chilFirstTrust != -99.99){
                  echo number_format($row4QActual->chilFirstTrust,2);
                  $Funds4QAct[] = $row4QActual->chilFirstTrust;
                  $Q4Act = $row4QActual->chilFirstTrust;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $chilFirstTrustBudTot = $row1QBudgeted->chilFirstTrust + $row2QBudgeted->chilFirstTrust + $row3QBudgeted->chilFirstTrust + $row4QBudgeted->chilFirstTrust;
           $chilFirstTrustActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $FundsTotBud[] = $chilFirstTrustBudTot;
           $FundsTotAct[] = $chilFirstTrustActTot;
           echo '<td><b>'.number_format($chilFirstTrustBudTot,2).'</b></td>'.
                '<td><b>'.number_format($chilFirstTrustActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">United Way</td>'.
                '<td>';
           if(isset($row1QBudgeted->unitedWay)){ echo number_format($row1QBudgeted->unitedWay,2); $Funds1QBud[] = $row1QBudgeted->unitedWay;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->unitedWay)) {
                if ($row1QActual->unitedWay != -99.99){
                  echo number_format($row1QActual->unitedWay,2);
                  $Funds1QAct[] = $row1QActual->unitedWay;
                  $Q1Act = $row1QActual->unitedWay;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->unitedWay)){ echo number_format($row2QBudgeted->unitedWay,2); $Funds2QBud[] = $row2QBudgeted->unitedWay;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->unitedWay)) {
                if ($row2QActual->unitedWay != -99.99){
                  echo number_format($row2QActual->unitedWay,2);
                  $Funds2QAct[] = $row2QActual->unitedWay;
                  $Q2Act = $row2QActual->unitedWay;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->unitedWay)){ echo number_format($row3QBudgeted->unitedWay,2); $Funds3QBud[] = $row3QBudgeted->unitedWay;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->unitedWay)) {
                if ($row3QActual->unitedWay != -99.99){
                  echo number_format($row3QActual->unitedWay,2);
                  $Funds3QAct[] = $row3QActual->unitedWay;
                  $Q3Act = $row3QActual->unitedWay;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->unitedWay)){ echo number_format($row4QBudgeted->unitedWay,2); $Funds4QBud[] = $row4QBudgeted->unitedWay;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->unitedWay)) {
                if ($row4QActual->unitedWay != -99.99){
                  echo number_format($row4QActual->unitedWay,2);
                  $Funds4QAct[] = $row4QActual->unitedWay;
                  $Q4Act = $row4QActual->unitedWay;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $unitedWayBudTot = $row1QBudgeted->unitedWay + $row2QBudgeted->unitedWay + $row3QBudgeted->unitedWay + $row4QBudgeted->unitedWay;
           $unitedWayActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $FundsTotBud[] = $unitedWayBudTot;
           $FundsTotAct[] = $unitedWayActTot;
           echo '<td><b>'.number_format($unitedWayBudTot,2).'</b></td>'.
                '<td><b>'.number_format($unitedWayActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">ADECA</td>'.
                '<td>';
           if(isset($row1QBudgeted->adeca)){ echo number_format($row1QBudgeted->adeca,2); $Funds1QBud[] = $row1QBudgeted->adeca;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->adeca)) {
                if ($row1QActual->adeca != -99.99){
                  echo number_format($row1QActual->adeca,2);
                  $Funds1QAct[] = $row1QActual->adeca;
                  $Q1Act = $row1QActual->adeca;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->adeca)){ echo number_format($row2QBudgeted->adeca,2); $Funds2QBud[] = $row2QBudgeted->adeca;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->adeca)) {
                if ($row2QActual->adeca != -99.99){
                  echo number_format($row2QActual->adeca,2);
                  $Funds2QAct[] = $row2QActual->adeca;
                  $Q2Act = $row2QActual->adeca;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->adeca)){ echo number_format($row3QBudgeted->adeca,2); $Funds3QBud[] = $row3QBudgeted->adeca;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->adeca)) {
                if ($row3QActual->adeca != -99.99){
                  echo number_format($row3QActual->adeca,2);
                  $Funds3QAct[] = $row3QActual->adeca;
                  $Q3Act = $row3QActual->adeca;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->adeca)){ echo number_format($row4QBudgeted->adeca,2); $Funds4QBud[] = $row4QBudgeted->adeca;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->adeca)) {
                if ($row4QActual->adeca != -99.99){
                  echo number_format($row4QActual->adeca,2);
                  $Funds4QAct[] = $row4QActual->adeca;
                  $Q4Act = $row4QActual->adeca;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $adecaBudTot = $row1QBudgeted->adeca + $row2QBudgeted->adeca + $row3QBudgeted->adeca + $row4QBudgeted->adeca;
           $adecaActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $FundsTotBud[] = $adecaBudTot;
           $FundsTotAct[] = $adecaActTot;
           echo '<td><b>'.number_format($adecaBudTot,2).'</b></td>'.
                '<td><b>'.number_format($adecaActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">National Children\'s Alliance</td>'.
                '<td>';
           if(isset($row1QBudgeted->natlChilAlliance)){ echo number_format($row1QBudgeted->natlChilAlliance,2); $Funds1QBud[] = $row1QBudgeted->natlChilAlliance;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->natlChilAlliance)) {
                if ($row1QActual->natlChilAlliance != -99.99){
                  echo number_format($row1QActual->natlChilAlliance,2);
                  $Funds1QAct[] = $row1QActual->natlChilAlliance;
                  $Q1Act = $row1QActual->natlChilAlliance;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->natlChilAlliance)){ echo number_format($row2QBudgeted->natlChilAlliance,2); $Funds2QBud[] = $row2QBudgeted->natlChilAlliance;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->natlChilAlliance)) {
                if ($row2QActual->natlChilAlliance != -99.99){
                  echo number_format($row2QActual->natlChilAlliance,2);
                  $Funds2QAct[] = $row2QActual->natlChilAlliance;
                  $Q2Act = $row2QActual->natlChilAlliance;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->natlChilAlliance)){ echo number_format($row3QBudgeted->natlChilAlliance,2); $Funds3QBud[] = $row3QBudgeted->natlChilAlliance;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->natlChilAlliance)) {
                if ($row3QActual->natlChilAlliance != -99.99){
                  echo number_format($row3QActual->natlChilAlliance,2);
                  $Funds3QAct[] = $row3QActual->natlChilAlliance;
                  $Q3Act = $row3QActual->natlChilAlliance;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->natlChilAlliance)){ echo number_format($row4QBudgeted->natlChilAlliance,2); $Funds4QBud[] = $row4QBudgeted->natlChilAlliance;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->natlChilAlliance)) {
                if ($row4QActual->natlChilAlliance != -99.99){
                  echo number_format($row4QActual->natlChilAlliance,2);
                  $Funds4QAct[] = $row4QActual->natlChilAlliance;
                  $Q4Act = $row4QActual->natlChilAlliance;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $natlChilAllianceBudTot = $row1QBudgeted->natlChilAlliance + $row2QBudgeted->natlChilAlliance + $row3QBudgeted->natlChilAlliance + $row4QBudgeted->natlChilAlliance;
           $natlChilAllianceActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $FundsTotBud[] = $natlChilAllianceBudTot;
           $FundsTotAct[] = $natlChilAllianceActTot;
           echo '<td><b>'.number_format($natlChilAllianceBudTot,2).'</b></td>'.
                '<td><b>'.number_format($natlChilAllianceActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Children\'s Trust Fund</td>'.
                '<td>';
           if(isset($row1QBudgeted->chilTrustFund)){ echo number_format($row1QBudgeted->chilTrustFund,2); $Funds1QBud[] = $row1QBudgeted->chilTrustFund;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->chilTrustFund)) {
                if ($row1QActual->chilTrustFund != -99.99){
                  echo number_format($row1QActual->chilTrustFund,2);
                  $Funds1QAct[] = $row1QActual->chilTrustFund;
                  $Q1Act = $row1QActual->chilTrustFund;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->chilTrustFund)){ echo number_format($row2QBudgeted->chilTrustFund,2); $Funds2QBud[] = $row2QBudgeted->chilTrustFund;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->chilTrustFund)) {
                if ($row2QActual->chilTrustFund != -99.99){
                  echo number_format($row2QActual->chilTrustFund,2);
                  $Funds2QAct[] = $row2QActual->chilTrustFund;
                  $Q2Act = $row2QActual->chilTrustFund;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->chilTrustFund)){ echo number_format($row3QBudgeted->chilTrustFund,2); $Funds3QBud[] = $row3QBudgeted->chilTrustFund;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->chilTrustFund)) {
                if ($row3QActual->chilTrustFund != -99.99){
                  echo number_format($row3QActual->chilTrustFund,2);
                  $Funds3QAct[] = $row3QActual->chilTrustFund;
                  $Q3Act = $row3QActual->chilTrustFund;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->chilTrustFund)){ echo number_format($row4QBudgeted->chilTrustFund,2); $Funds4QBud[] = $row4QBudgeted->chilTrustFund;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->chilTrustFund)) {
                if ($row4QActual->chilTrustFund != -99.99){
                  echo number_format($row4QActual->chilTrustFund,2);
                  $Funds4QAct[] = $row4QActual->chilTrustFund;
                  $Q4Act = $row4QActual->chilTrustFund;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $chilTrustFundBudTot = $row1QBudgeted->chilTrustFund + $row2QBudgeted->chilTrustFund + $row3QBudgeted->chilTrustFund + $row4QBudgeted->chilTrustFund;
           $chilTrustFundActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $FundsTotBud[] = $chilTrustFundBudTot;
           $FundsTotAct[] = $chilTrustFundActTot;
           echo '<td><b>'.number_format($chilTrustFundBudTot,2).'</b></td>'.
                '<td><b>'.number_format($chilTrustFundActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Department of Human Resources</td>'.
                '<td>';
           if(isset($row1QBudgeted->deptOfHR)){ echo number_format($row1QBudgeted->deptOfHR,2); $Funds1QBud[] = $row1QBudgeted->deptOfHR;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->deptOfHR)) {
                if ($row1QActual->deptOfHR != -99.99){
                  echo number_format($row1QActual->deptOfHR,2);
                  $Funds1QAct[] = $row1QActual->deptOfHR;
                  $Q1Act = $row1QActual->deptOfHR;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->deptOfHR)){ echo number_format($row2QBudgeted->deptOfHR,2); $Funds2QBud[] = $row2QBudgeted->deptOfHR;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->deptOfHR)) {
                if ($row2QActual->deptOfHR != -99.99){
                  echo number_format($row2QActual->deptOfHR,2);
                  $Funds2QAct[] = $row2QActual->deptOfHR;
                  $Q2Act = $row2QActual->deptOfHR;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->deptOfHR)){ echo number_format($row3QBudgeted->deptOfHR,2); $Funds3QBud[] = $row3QBudgeted->deptOfHR;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->deptOfHR)) {
                if ($row3QActual->deptOfHR != -99.99){
                  echo number_format($row3QActual->deptOfHR,2);
                  $Funds3QAct[] = $row3QActual->deptOfHR;
                  $Q3Act = $row3QActual->deptOfHR;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->deptOfHR)){ echo number_format($row4QBudgeted->deptOfHR,2); $Funds4QBud[] = $row4QBudgeted->deptOfHR;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->deptOfHR)) {
                if ($row4QActual->deptOfHR != -99.99){
                  echo number_format($row4QActual->deptOfHR,2);
                  $Funds4QAct[] = $row4QActual->deptOfHR;
                  $Q4Act = $row4QActual->deptOfHR;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $deptOfHRBudTot = $row1QBudgeted->deptOfHR + $row2QBudgeted->deptOfHR + $row3QBudgeted->deptOfHR + $row4QBudgeted->deptOfHR;
           $deptOfHRActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $FundsTotBud[] = $deptOfHRBudTot;
           $FundsTotAct[] = $deptOfHRActTot;
           echo '<td><b>'.number_format($deptOfHRBudTot,2).'</b></td>'.
                '<td><b>'.number_format($deptOfHRActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">County Commissions</td>'.
                '<td>';
           if(isset($row1QBudgeted->countyComm)){ echo number_format($row1QBudgeted->countyComm,2); $Funds1QBud[] = $row1QBudgeted->countyComm;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->countyComm)) {
                if ($row1QActual->countyComm != -99.99){
                  echo number_format($row1QActual->countyComm,2);
                  $Funds1QAct[] = $row1QActual->countyComm;
                  $Q1Act = $row1QActual->countyComm;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->countyComm)){ echo number_format($row2QBudgeted->countyComm,2); $Funds2QBud[] = $row2QBudgeted->countyComm;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->countyComm)) {
                if ($row2QActual->countyComm != -99.99){
                  echo number_format($row2QActual->countyComm,2);
                  $Funds2QAct[] = $row2QActual->countyComm;
                  $Q2Act = $row2QActual->countyComm;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->countyComm)){ echo number_format($row3QBudgeted->countyComm,2); $Funds3QBud[] = $row3QBudgeted->countyComm;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->countyComm)) {
                if ($row3QActual->countyComm != -99.99){
                  echo number_format($row3QActual->countyComm,2);
                  $Funds3QAct[] = $row3QActual->countyComm;
                  $Q3Act = $row3QActual->countyComm;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->countyComm)){ echo number_format($row4QBudgeted->countyComm,2); $Funds4QBud[] = $row4QBudgeted->countyComm;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->countyComm)) {
                if ($row4QActual->countyComm != -99.99){
                  echo number_format($row4QActual->countyComm,2);
                  $Funds4QAct[] = $row4QActual->countyComm;
                  $Q4Act = $row4QActual->countyComm;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $countyCommBudTot = $row1QBudgeted->countyComm + $row2QBudgeted->countyComm + $row3QBudgeted->countyComm + $row4QBudgeted->countyComm;
           $countyCommActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $FundsTotBud[] = $countyCommBudTot;
           $FundsTotAct[] = $countyCommActTot;
           echo '<td><b>'.number_format($countyCommBudTot,2).'</b></td>'.
                '<td><b>'.number_format($countyCommActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">City Councils</td>'.
                '<td>';
           if(isset($row1QBudgeted->cityCouncil)){ echo number_format($row1QBudgeted->cityCouncil,2); $Funds1QBud[] = $row1QBudgeted->cityCouncil;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->cityCouncil)) {
                if ($row1QActual->cityCouncil != -99.99){
                  echo number_format($row1QActual->cityCouncil,2);
                  $Funds1QAct[] = $row1QActual->cityCouncil;
                  $Q1Act = $row1QActual->cityCouncil;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->cityCouncil)){ echo number_format($row2QBudgeted->cityCouncil,2); $Funds2QBud[] = $row2QBudgeted->cityCouncil;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->cityCouncil)) {
                if ($row2QActual->cityCouncil != -99.99){
                  echo number_format($row2QActual->cityCouncil,2);
                  $Funds2QAct[] = $row2QActual->cityCouncil;
                  $Q2Act = $row2QActual->cityCouncil;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->cityCouncil)){ echo number_format($row3QBudgeted->cityCouncil,2); $Funds3QBud[] = $row3QBudgeted->cityCouncil;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->cityCouncil)) {
                if ($row3QActual->cityCouncil != -99.99){
                  echo number_format($row3QActual->cityCouncil,2);
                  $Funds3QAct[] = $row3QActual->cityCouncil;
                  $Q3Act = $row3QActual->cityCouncil;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->cityCouncil)){ echo number_format($row4QBudgeted->cityCouncil,2); $Funds4QBud[] = $row4QBudgeted->cityCouncil;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->cityCouncil)) {
                if ($row4QActual->cityCouncil != -99.99){
                  echo number_format($row4QActual->cityCouncil,2);
                  $Funds4QAct[] = $row4QActual->cityCouncil;
                  $Q4Act = $row4QActual->cityCouncil;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $cityCouncilBudTot = $row1QBudgeted->cityCouncil + $row2QBudgeted->cityCouncil + $row3QBudgeted->cityCouncil + $row4QBudgeted->cityCouncil;
           $cityCouncilActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $FundsTotBud[] = $cityCouncilBudTot;
           $FundsTotAct[] = $cityCouncilActTot;
           echo '<td><b>'.number_format($cityCouncilBudTot,2).'</b></td>'.
                '<td><b>'.number_format($cityCouncilActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Local Grants</td>'.
                '<td>';
           if(isset($row1QBudgeted->localGrants)){ echo number_format($row1QBudgeted->localGrants,2); $Funds1QBud[] = $row1QBudgeted->localGrants;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->localGrants)) {
                if ($row1QActual->localGrants != -99.99){
                  echo number_format($row1QActual->localGrants,2);
                  $Funds1QAct[] = $row1QActual->localGrants;
                  $Q1Act = $row1QActual->localGrants;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->localGrants)){ echo number_format($row2QBudgeted->localGrants,2); $Funds2QBud[] = $row2QBudgeted->localGrants;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->localGrants)) {
                if ($row2QActual->localGrants != -99.99){
                  echo number_format($row2QActual->localGrants,2);
                  $Funds2QAct[] = $row2QActual->localGrants;
                  $Q2Act = $row2QActual->localGrants;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->localGrants)){ echo number_format($row3QBudgeted->localGrants,2); $Funds3QBud[] = $row3QBudgeted->localGrants;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->localGrants)) {
                if ($row3QActual->localGrants != -99.99){
                  echo number_format($row3QActual->localGrants,2);
                  $Funds3QAct[] = $row3QActual->localGrants;
                  $Q3Act = $row3QActual->localGrants;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->localGrants)){ echo number_format($row4QBudgeted->localGrants,2); $Funds4QBud[] = $row4QBudgeted->localGrants;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->localGrants)) {
                if ($row4QActual->localGrants != -99.99){
                  echo number_format($row4QActual->localGrants,2);
                  $Funds4QAct[] = $row4QActual->localGrants;
                  $Q4Act = $row4QActual->localGrants;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $localGrantsBudTot = $row1QBudgeted->localGrants + $row2QBudgeted->localGrants + $row3QBudgeted->localGrants + $row4QBudgeted->localGrants;
           $localGrantsActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $FundsTotBud[] = $localGrantsBudTot;
           $FundsTotAct[] = $localGrantsActTot;
           echo '<td><b>'.number_format($localGrantsBudTot,2).'</b></td>'.
                '<td><b>'.number_format($localGrantsActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Area Schools</td>'.
                '<td>';
           if(isset($row1QBudgeted->areaSchools)){ echo number_format($row1QBudgeted->areaSchools,2); $Funds1QBud[] = $row1QBudgeted->areaSchools;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->areaSchools)) {
                if ($row1QActual->areaSchools != -99.99){
                  echo number_format($row1QActual->areaSchools,2);
                  $Funds1QAct[] = $row1QActual->areaSchools;
                  $Q1Act = $row1QActual->areaSchools;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->areaSchools)){ echo number_format($row2QBudgeted->areaSchools,2); $Funds2QBud[] = $row2QBudgeted->areaSchools;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->areaSchools)) {
                if ($row2QActual->areaSchools != -99.99){
                  echo number_format($row2QActual->areaSchools,2);
                  $Funds2QAct[] = $row2QActual->areaSchools;
                  $Q2Act = $row2QActual->areaSchools;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->areaSchools)){ echo number_format($row3QBudgeted->areaSchools,2); $Funds3QBud[] = $row3QBudgeted->areaSchools;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->areaSchools)) {
                if ($row3QActual->areaSchools != -99.99){
                  echo number_format($row3QActual->areaSchools,2);
                  $Funds3QAct[] = $row3QActual->areaSchools;
                  $Q3Act = $row3QActual->areaSchools;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->areaSchools)){ echo number_format($row4QBudgeted->areaSchools,2); $Funds4QBud[] = $row4QBudgeted->areaSchools;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->areaSchools)) {
                if ($row4QActual->areaSchools != -99.99){
                  echo number_format($row4QActual->areaSchools,2);
                  $Funds4QAct[] = $row4QActual->areaSchools;
                  $Q4Act = $row4QActual->areaSchools;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $areaSchoolsBudTot = $row1QBudgeted->areaSchools + $row2QBudgeted->areaSchools + $row3QBudgeted->areaSchools + $row4QBudgeted->areaSchools;
           $areaSchoolsActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $FundsTotBud[] = $areaSchoolsBudTot;
           $FundsTotAct[] = $areaSchoolsActTot;
           echo '<td><b>'.number_format($areaSchoolsBudTot,2).'</b></td>'.
                '<td><b>'.number_format($areaSchoolsActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Corporate Donations</td>'.
                '<td>';
           if(isset($row1QBudgeted->corpDonations)){ echo number_format($row1QBudgeted->corpDonations,2); $Funds1QBud[] = $row1QBudgeted->corpDonations;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->corpDonations)) {
                if ($row1QActual->corpDonations != -99.99){
                  echo number_format($row1QActual->corpDonations,2);
                  $Funds1QAct[] = $row1QActual->corpDonations;
                  $Q1Act = $row1QActual->corpDonations;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->corpDonations)){ echo number_format($row2QBudgeted->corpDonations,2); $Funds2QBud[] = $row2QBudgeted->corpDonations;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->corpDonations)) {
                if ($row2QActual->corpDonations != -99.99){
                  echo number_format($row2QActual->corpDonations,2);
                  $Funds2QAct[] = $row2QActual->corpDonations;
                  $Q2Act = $row2QActual->corpDonations;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->corpDonations)){ echo number_format($row3QBudgeted->corpDonations,2); $Funds3QBud[] = $row3QBudgeted->corpDonations;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->corpDonations)) {
                if ($row3QActual->corpDonations != -99.99){
                  echo number_format($row3QActual->corpDonations,2);
                  $Funds3QAct[] = $row3QActual->corpDonations;
                  $Q3Act = $row3QActual->corpDonations;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->corpDonations)){ echo number_format($row4QBudgeted->corpDonations,2); $Funds4QBud[] = $row4QBudgeted->corpDonations;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->corpDonations)) {
                if ($row4QActual->corpDonations != -99.99){
                  echo number_format($row4QActual->corpDonations,2);
                  $Funds4QAct[] = $row4QActual->corpDonations;
                  $Q4Act = $row4QActual->corpDonations;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $corpDonationsBudTot = $row1QBudgeted->corpDonations + $row2QBudgeted->corpDonations + $row3QBudgeted->corpDonations + $row4QBudgeted->corpDonations;
           $corpDonationsActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $FundsTotBud[] = $corpDonationsBudTot;
           $FundsTotAct[] = $corpDonationsActTot;
           echo '<td><b>'.number_format($corpDonationsBudTot,2).'</b></td>'.
                '<td><b>'.number_format($corpDonationsActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Private Donations</td>'.
                '<td>';
           if(isset($row1QBudgeted->privDonations)){ echo number_format($row1QBudgeted->privDonations,2); $Funds1QBud[] = $row1QBudgeted->privDonations;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->privDonations)) {
                if ($row1QActual->privDonations != -99.99){
                  echo number_format($row1QActual->privDonations,2);
                  $Funds1QAct[] = $row1QActual->privDonations;
                  $Q1Act = $row1QActual->privDonations;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->privDonations)){ echo number_format($row2QBudgeted->privDonations,2); $Funds2QBud[] = $row2QBudgeted->privDonations;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->privDonations)) {
                if ($row2QActual->privDonations != -99.99){
                  echo number_format($row2QActual->privDonations,2);
                  $Funds2QAct[] = $row2QActual->privDonations;
                  $Q2Act = $row2QActual->privDonations;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->privDonations)){ echo number_format($row3QBudgeted->privDonations,2); $Funds3QBud[] = $row3QBudgeted->privDonations;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->privDonations)) {
                if ($row3QActual->privDonations != -99.99){
                  echo number_format($row3QActual->privDonations,2);
                  $Funds3QAct[] = $row3QActual->privDonations;
                  $Q3Act = $row3QActual->privDonations;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->privDonations)){ echo number_format($row4QBudgeted->privDonations,2); $Funds4QBud[] = $row4QBudgeted->privDonations;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->privDonations)) {
                if ($row4QActual->privDonations != -99.99){
                  echo number_format($row4QActual->privDonations,2);
                  $Funds4QAct[] = $row4QActual->privDonations;
                  $Q4Act = $row4QActual->privDonations;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $privDonationsBudTot = $row1QBudgeted->privDonations + $row2QBudgeted->privDonations + $row3QBudgeted->privDonations + $row4QBudgeted->privDonations;
           $privDonationsActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $FundsTotBud[] = $privDonationsBudTot;
           $FundsTotAct[] = $privDonationsActTot;
           echo '<td><b>'.number_format($privDonationsBudTot,2).'</b></td>'.
                '<td><b>'.number_format($privDonationsActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Fundraisers</td>'.
                '<td>';
           if(isset($row1QBudgeted->fundraisers)){ echo number_format($row1QBudgeted->fundraisers,2); $Funds1QBud[] = $row1QBudgeted->fundraisers;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->fundraisers)) {
                if ($row1QActual->fundraisers != -99.99){
                  echo number_format($row1QActual->fundraisers,2);
                  $Funds1QAct[] = $row1QActual->fundraisers;
                  $Q1Act = $row1QActual->fundraisers;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->fundraisers)){ echo number_format($row2QBudgeted->fundraisers,2); $Funds2QBud[] = $row2QBudgeted->fundraisers;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->fundraisers)) {
                if ($row2QActual->fundraisers != -99.99){
                  echo number_format($row2QActual->fundraisers,2);
                  $Funds2QAct[] = $row2QActual->fundraisers;
                  $Q2Act = $row2QActual->fundraisers;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->fundraisers)){ echo number_format($row3QBudgeted->fundraisers,2); $Funds3QBud[] = $row3QBudgeted->fundraisers;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->fundraisers)) {
                if ($row3QActual->fundraisers != -99.99){
                  echo number_format($row3QActual->fundraisers,2);
                  $Funds3QAct[] = $row3QActual->fundraisers;
                  $Q3Act = $row3QActual->fundraisers;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->fundraisers)){ echo number_format($row4QBudgeted->fundraisers,2); $Funds4QBud[] = $row4QBudgeted->fundraisers;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->fundraisers)) {
                if ($row4QActual->fundraisers != -99.99){
                  echo number_format($row4QActual->fundraisers,2);
                  $Funds4QAct[] = $row4QActual->fundraisers;
                  $Q4Act = $row4QActual->fundraisers;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $fundraisersBudTot = $row1QBudgeted->fundraisers + $row2QBudgeted->fundraisers + $row3QBudgeted->fundraisers + $row4QBudgeted->fundraisers;
           $fundraisersActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $FundsTotBud[] = $fundraisersBudTot;
           $FundsTotAct[] = $fundraisersActTot;
           echo '<td><b>'.number_format($fundraisersBudTot,2).'</b></td>'.
                '<td><b>'.number_format($fundraisersActTot,2).'</b></td>'.
                '</tr>';
           echo '<tr align="right">'.
                '<td align="left">Bank Interest</td>'.
                '<td>';
           if(isset($row1QBudgeted->bankInterest)){ echo number_format($row1QBudgeted->bankInterest,2); $Funds1QBud[] = $row1QBudgeted->bankInterest;}
           echo '</td>'.
                '<td>';
           if(isset($row1QActual->bankInterest)) {
                if ($row1QActual->bankInterest != -99.99){
                  echo number_format($row1QActual->bankInterest,2);
                  $Funds1QAct[] = $row1QActual->bankInterest;
                  $Q1Act = $row1QActual->bankInterest;
                }else $Q1Act = 0;
           }else $Q1Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row2QBudgeted->bankInterest)){ echo number_format($row2QBudgeted->bankInterest,2); $Funds2QBud[] = $row2QBudgeted->bankInterest;}
           echo '</td>'.
                '<td>';
           if(isset($row2QActual->bankInterest)) {
                if ($row2QActual->bankInterest != -99.99){
                  echo number_format($row2QActual->bankInterest,2);
                  $Funds2QAct[] = $row2QActual->bankInterest;
                  $Q2Act = $row2QActual->bankInterest;
                }else $Q2Act = 0;
           }else $Q2Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row3QBudgeted->bankInterest)){ echo number_format($row3QBudgeted->bankInterest,2); $Funds3QBud[] = $row3QBudgeted->bankInterest;}
           echo '</td>'.
                '<td>';
           if(isset($row3QActual->bankInterest)) {
                if ($row3QActual->bankInterest != -99.99){
                  echo number_format($row3QActual->bankInterest,2);
                  $Funds3QAct[] = $row3QActual->bankInterest;
                  $Q3Act = $row3QActual->bankInterest;
                }else $Q3Act = 0;
           }else $Q3Act = 0;
           echo '</td>'.
                '<td>';
           if(isset($row4QBudgeted->bankInterest)){ echo number_format($row4QBudgeted->bankInterest,2); $Funds4QBud[] = $row4QBudgeted->bankInterest;}
           echo '</td>'.
                '<td>';
           if(isset($row4QActual->bankInterest)) {
                if ($row4QActual->bankInterest != -99.99){
                  echo number_format($row4QActual->bankInterest,2);
                  $Funds4QAct[] = $row4QActual->bankInterest;
                  $Q4Act = $row4QActual->bankInterest;
                }else $Q4Act = 0;
           }else $Q4Act = 0;
           echo '</td>';
           $bankInterestBudTot = $row1QBudgeted->bankInterest + $row2QBudgeted->bankInterest + $row3QBudgeted->bankInterest + $row4QBudgeted->bankInterest;
           $bankInterestActTot = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
           $FundsTotBud[] = $bankInterestBudTot;
           $FundsTotAct[] = $bankInterestActTot;
           echo '<td><b>'.number_format($bankInterestBudTot,2).'</b></td>'.
                '<td><b>'.number_format($bankInterestActTot,2).'</b></td>'.
                '</tr>';
           //check to see if they have any other incomes entered
           $sqlOI = "SELECT OIncomeID, IncomeName FROM otherIncomeLU WHERE center = '".$theCenter."' AND fiscalyear = '".$fiscalYear."' ORDER BY OIncomeID";
           $resultOI = @mysql_query($sqlOI) or mysql_error();

           $numRecords = mysql_num_rows($resultOI);
           if ($numRecords > 0){
              while ($row = mysql_fetch_object($resultOI)) {
                $oiValue1QBud = 0;
                $oiValue1QAct = 0;
                $oiValue2QBud = 0;
                $oiValue2QAct = 0;
                $oiValue3QBud = 0;
                $oiValue3QAct = 0;
                $oiValue4QBud = 0;
                $oiValue4QAct = 0;
                 echo '<tr align="right"><td align="left">'.$row->IncomeName.'</td>'.
                 '<td>';
                        $sqlOIValues = "SELECT oiValue FROM budgetedOtherIncome WHERE center = ".$theCenter." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = 1 AND OIncomeID = ".$row->OIncomeID;
                        $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                        $rowOIValues = mysql_fetch_object($resultOIValues);
                 if(isset($rowOIValues->oiValue)){ echo number_format($rowOIValues->oiValue,2); $Funds1QBud[] = $rowOIValues->oiValue; $oiValue1QBud = $rowOIValues->oiValue;}
                 echo '</td>'.  //1QBud
                '<td>';
                        $sqlOIValues = "SELECT oiValue FROM actualOtherIncome WHERE center = ".$theCenter." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = 1 AND OIncomeID = ".$row->OIncomeID;
                        $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                        $rowOIValues = mysql_fetch_object($resultOIValues);
                 if(isset($rowOIValues->oiValue)) {
                        if ($rowOIValues->oiValue != -99.99){
                                echo number_format($rowOIValues->oiValue,2);
                                $Funds1QAct[] = $rowOIValues->oiValue;
                                $Q1Act = $rowOIValues->oiValue;
                        }else $Q1Act = 0;
                 }else $Q1Act = 0;
                 echo '</td>'.  //1QAct
                '<td>';
                        $sqlOIValues = "SELECT oiValue FROM budgetedOtherIncome WHERE center = ".$theCenter." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = 2 AND OIncomeID = ".$row->OIncomeID;
                        $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                        $rowOIValues = mysql_fetch_object($resultOIValues);
                 if(isset($rowOIValues->oiValue)){ echo number_format($rowOIValues->oiValue,2); $Funds2QBud[] = $rowOIValues->oiValue; $oiValue2QBud = $rowOIValues->oiValue;}
                 echo '</td>'.  //2QBud
                '<td>';
                        $sqlOIValues = "SELECT oiValue FROM actualOtherIncome WHERE center = ".$theCenter." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = 2 AND OIncomeID = ".$row->OIncomeID;
                        $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                        $rowOIValues = mysql_fetch_object($resultOIValues);
                 if(isset($rowOIValues->oiValue)) {
                        if ($rowOIValues->oiValue != -99.99){
                                echo number_format($rowOIValues->oiValue,2);
                                $Funds2QAct[] = $rowOIValues->oiValue;
                                $Q2Act = $rowOIValues->oiValue;
                        }else $Q2Act = 0;
                 }else $Q2Act = 0;
                 echo '</td>'.  //2QAct
                '<td>';
                        $sqlOIValues = "SELECT oiValue FROM budgetedOtherIncome WHERE center = ".$theCenter." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = 3 AND OIncomeID = ".$row->OIncomeID;
                        $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                        $rowOIValues = mysql_fetch_object($resultOIValues);
                 if(isset($rowOIValues->oiValue)){ echo number_format($rowOIValues->oiValue,2); $Funds3QBud[] = $rowOIValues->oiValue; $oiValue3QBud = $rowOIValues->oiValue;}
                 echo '</td>'.  //3QBud
                '<td>';
                        $sqlOIValues = "SELECT oiValue FROM actualOtherIncome WHERE center = ".$theCenter." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = 3 AND OIncomeID = ".$row->OIncomeID;
                        $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                        $rowOIValues = mysql_fetch_object($resultOIValues);
                 if(isset($rowOIValues->oiValue)) {
                        if ($rowOIValues->oiValue != -99.99){
                                echo number_format($rowOIValues->oiValue,2);
                                $Funds3QAct[] = $rowOIValues->oiValue;
                                $Q3Act = $rowOIValues->oiValue;
                        }else $Q3Act = 0;
                 }else $Q3Act = 0;
                 echo '</td>'.  //3QAct
                '<td>';
                        $sqlOIValues = "SELECT oiValue FROM budgetedOtherIncome WHERE center = ".$theCenter." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = 4 AND OIncomeID = ".$row->OIncomeID;
                        $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                        $rowOIValues = mysql_fetch_object($resultOIValues);
                 if(isset($rowOIValues->oiValue)){ echo number_format($rowOIValues->oiValue,2); $Funds4QBud[] = $rowOIValues->oiValue; $oiValue4QBud = $rowOIValues->oiValue;}
                 echo '</td>'.  //4QBud
                '<td>';
                        $sqlOIValues = "SELECT oiValue FROM actualOtherIncome WHERE center = ".$theCenter." AND ".
                        "fiscalyear = ".$fiscalYear." AND quarter = 4 AND OIncomeID = ".$row->OIncomeID;
                        $resultOIValues = @mysql_query($sqlOIValues) or mysql_error();
                        $rowOIValues = mysql_fetch_object($resultOIValues);
                 if(isset($rowOIValues->oiValue)) {
                        if ($rowOIValues->oiValue != -99.99){
                                echo number_format($rowOIValues->oiValue,2);
                                $Funds4QAct[] = $rowOIValues->oiValue;
                                $Q4Act = $rowOIValues->oiValue;
                        }else $Q4Act = 0;
                 }else $Q4Act = 0;
                 echo '</td>';  //4QAct
                 $oiValueTotBud = $oiValue1QBud + $oiValue2QBud + $oiValue3QBud + $oiValue4QBud;
                 $oiValueTotAct = $Q1Act + $Q2Act + $Q3Act + $Q4Act;
                 $FundsTotBud[] = $oiValueTotBud;
                 $FundsTotAct[] = $oiValueTotAct;
                 echo '<td><b>'.number_format($oiValueTotBud,2).'</b></td>'.//TotBud
                '<td><b>'.number_format($oiValueTotAct,2).'</b></td>'.//TotAct
                '</tr>';
                }
           }
           $totFunds1QBudget = 0;
           foreach ($Funds1QBud as $floatFund){
                     $totFunds1QBudget = $totFunds1QBudget + $floatFund;
                  }
           $totFunds2QBudget = 0;
           foreach ($Funds2QBud as $floatFund){
                     $totFunds2QBudget = $totFunds2QBudget + $floatFund;
                  }
           $totFunds3QBudget = 0;
           foreach ($Funds3QBud as $floatFund){
                     $totFunds3QBudget = $totFunds3QBudget + $floatFund;
                  }
           $totFunds4QBudget = 0;
           foreach ($Funds4QBud as $floatFund){
                     $totFunds4QBudget = $totFunds4QBudget + $floatFund;
                  }
           $totFundsTotBudget = 0;
           foreach ($FundsTotBud as $floatFund){
                     $totFundsTotBudget = $totFundsTotBudget + $floatFund;
                  }
           $totFunds1QActual = 0;
           foreach ($Funds1QAct as $floatFund){
                     $totFunds1QActual = $totFunds1QActual + $floatFund;
                  }
           $totFunds2QActual = 0;
           foreach ($Funds2QAct as $floatFund){
                     $totFunds2QActual = $totFunds2QActual + $floatFund;
                  }
           $totFunds3QActual = 0;
           foreach ($Funds3QAct as $floatFund){
                     $totFunds3QActual = $totFunds3QActual + $floatFund;
                  }
           $totFunds4QActual = 0;
           foreach ($Funds4QAct as $floatFund){
                     $totFunds4QActual = $totFunds4QActual + $floatFund;
                  }
           $totFundsTotActual = 0;
           foreach ($FundsTotAct as $floatFund){
                     $totFundsTotActual = $totFundsTotActual + $floatFund;
                  }
           echo '<tr align="right">'.
                '<td align="center"><b>Total Funds</b></td>'.
                '<td><b>'.number_format($totFunds1QBudget,2).'</b></td>'. //for the value I will use the ISSET function and the values from the sql call at the top
                '<td><b>'.number_format($totFunds1QActual,2).'</b></td>'.
                '<td><b>'.number_format($totFunds2QBudget,2).'</b></td>'.
                '<td><b>'.number_format($totFunds2QActual,2).'</b></td>'.
                '<td><b>'.number_format($totFunds3QBudget,2).'</b></td>'.
                '<td><b>'.number_format($totFunds3QActual,2).'</b></td>'.
                '<td><b>'.number_format($totFunds4QBudget,2).'</b></td>'.
                '<td><b>'.number_format($totFunds4QActual,2).'</b></td>'.
                '<td><b>'.number_format($totFundsTotBudget,2).'</b></td>'.
                '<td><b>'.number_format($totFundsTotActual,2).'</b></td>'.
                '</tr>';
           echo '</table>';

         }
         elseif ($TrnType == "CURRENT"){
         }
}
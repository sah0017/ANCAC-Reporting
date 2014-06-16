<?php
/**
 * @author TL
 * @date 3/16/2014
 * 
 * Page creates and sends the browser the .csv file to be downloaded 
 */
//NR 04/11/14 moved all db connections to dbconn
if(file_exists("./Variables.php"))
	require("./Variables.php");
else
	require("../Variables.php");
require($root."dbconn.php");
	
	$format = 'GrandTotalReport%d';
//TL 04/22/2014 removed the space from the file name because Firefox does not like spaces
	$filename = sprintf($format, $_POST['year']);
	

//TL 4/7/2014 Updated to more properly meet the requirements, now downloads a .csv file of the sql queries 
	$fiscalYear = $_POST['year'];

	$fp = fopen($filename, 'w');
         
	$emptyArray = array();
	//$memberArray = array();

        //Add headers from GrandTotal to the Excel Export
        $grandTotalheader = array( ' ', 'Center' , 'QTR' , 'Tot.SVCS.' , 'FI' , 'E.F.A' , 'I.C.S' , 'Exam' , 'Pros.' , 'M.D.T.' , 'T.C.S.' , '0-6' , '7-12' , '13-18' , 'M' , 'F' , 'AA' , 'ASN' , 'CAU.' , 'HISP.');
        
       fputcsv($fp, (array)$grandTotalheader);
       fputcsv($fp, $emptyArray);
        /* foreach($grandTotalheader as $columheader)
         {
        
             fputcsv($fp, (array)$columheader);
		
                
		$resultLoop = $db->get_row($columheader);
		fputcsv($fp, (array)$resultLoop);
		fputcsv($fp, $emptyArray);
        
        }//end of foreach
       */
       
//sql to pull the information on all 'Full Member' centers

       
	$sqlFullMember = "SELECT center, CenterName FROM centers WHERE center not in (0,99) AND centerlevel = 'Full Member' order by center";

	$numRecFullMember = $db->get_results($sqlFullMember);
	       
                
	foreach ($numRecFullMember as $rowFullMember) 
	{
          
            //put quater in the first colum
		$sqlLoop =  "SELECT actualPerfStats.quarter , fiTotal, fi0to6, fi7to12, fi13to18, fiMale, fiFemale, fiAfrAmerican, fiAsian, fiCauc, fiHispanic, fiOther, extForenEval, ".
					"intCounsSes, totCounSes, multDisTeamMeet, prosCases, medExamRef FROM actualPerfStats JOIN actualExpenditures
					 		ON actualPerfStats.center = actualExpenditures.center AND actualPerfStats.fiscalyear = actualExpenditures.fiscalyear AND 
							actualPerfStats.quarter = actualExpenditures.quarter WHERE actualPerfStats.center = '$rowFullMember->center' 
									AND actualPerfStats.fiscalyear = '$fiscalYear' AND actualExpenditures.completed = 'COM' ORDER BY actualPerfStats.quarter";
		/*$sqlLoop =  "SELECT fiTotal, fi0to6, fi7to12, fi13to18, fiMale, fiFemale, fiAfrAmerican, fiAsian, fiCauc, fiHispanic, fiOther, extForenEval, ".
					"intCounsSes, totCounSes, multDisTeamMeet, prosCases, medExamRef, actualPerfStats.quarter FROM actualPerfStats JOIN actualExpenditures
					 		ON actualPerfStats.center = actualExpenditures.center AND actualPerfStats.fiscalyear = actualExpenditures.fiscalyear AND 
							actualPerfStats.quarter = actualExpenditures.quarter WHERE actualPerfStats.center = '$rowFullMember->center' 
									AND actualPerfStats.fiscalyear = '$fiscalYear' AND actualExpenditures.completed = 'COM' ORDER BY actualPerfStats.quarter";
		//echo $sqlLoop."<br>";
		*/
		//fputcsv($fp, (array)$rowFullMember);
		
		$resultLoop = $db->get_row($sqlLoop);
                //name and result in same line
		fputcsv($fp,(array)$rowFullMember + (array)$resultLoop);
		fputcsv($fp, $emptyArray);
	}
	fputcsv($fp, $emptyArray);

//------------------------------
//sql to pull the information on all 'Associate' centers

	$sqlAssociate = "SELECT center, CenterName FROM centers WHERE center not in (0,99) AND centerlevel = 'Associate' order by center";
		
	$numRecAssociate = $db->get_results($sqlAssociate);
		
	foreach ($numRecAssociate as $rowAssociate) 
	{
            
            $sqlLoop =  "SELECT actualPerfStats.quarter, fiTotal, fi0to6, fi7to12, fi13to18, fiMale, fiFemale, fiAfrAmerican, fiAsian, fiCauc, fiHispanic, fiOther, extForenEval, ".
					"intCounsSes, totCounSes, multDisTeamMeet, prosCases, medExamRef FROM actualPerfStats JOIN actualExpenditures
					 		ON actualPerfStats.center = actualExpenditures.center AND actualPerfStats.fiscalyear = actualExpenditures.fiscalyear AND 
							actualPerfStats.quarter = actualExpenditures.quarter WHERE actualPerfStats.center = '$rowAssociate->center' 
									AND actualPerfStats.fiscalyear = '$fiscalYear' AND actualExpenditures.completed = 'COM' ORDER BY actualPerfStats.quarter";
		
		/*$sqlLoop =  "SELECT fiTotal, fi0to6, fi7to12, fi13to18, fiMale, fiFemale, fiAfrAmerican, fiAsian, fiCauc, fiHispanic, fiOther, extForenEval, ".
					"intCounsSes, totCounSes, multDisTeamMeet, prosCases, medExamRef, actualPerfStats.quarter FROM actualPerfStats JOIN actualExpenditures
					 		ON actualPerfStats.center = actualExpenditures.center AND actualPerfStats.fiscalyear = actualExpenditures.fiscalyear AND 
							actualPerfStats.quarter = actualExpenditures.quarter WHERE actualPerfStats.center = '$rowAssociate->center' 
									AND actualPerfStats.fiscalyear = '$fiscalYear' AND actualExpenditures.completed = 'COM' ORDER BY actualPerfStats.quarter";
		//echo $sqlLoop."<br>";
                */
		//fputcsv($fp, (array)$rowAssociate);
		
		$resultLoop = $db->get_row($sqlLoop);
		fputcsv($fp,(array)$rowAssociate + (array)$resultLoop);
		fputcsv($fp, $emptyArray);

	}
	fputcsv($fp, $emptyArray);
		
//------------------------------
//sql to pull the information on all 'Pilot Project' centers

	$sqlPilot = "SELECT center, CenterName FROM centers WHERE center not in (0,99) AND centerlevel = 'Pilot Project' order by center";
			
	$numRecPilot = $db->get_results($sqlPilot);
			
	foreach ($numRecPilot as $rowPilot) 
	{
            $sqlLoop =  "SELECT actualPerfStats.quarter , fiTotal, fi0to6, fi7to12, fi13to18, fiMale, fiFemale, fiAfrAmerican, fiAsian, fiCauc, fiHispanic, fiOther, extForenEval, ".
					"intCounsSes, totCounSes, multDisTeamMeet, prosCases, medExamRef FROM actualPerfStats JOIN actualExpenditures
					 		ON actualPerfStats.center = actualExpenditures.center AND actualPerfStats.fiscalyear = actualExpenditures.fiscalyear AND 
							actualPerfStats.quarter = actualExpenditures.quarter WHERE actualPerfStats.center = '$rowPilot->center' 
									AND actualPerfStats.fiscalyear = '$fiscalYear' AND actualExpenditures.completed = 'COM' ORDER BY actualPerfStats.quarter";
            
		/*$sqlLoop =  "SELECT fiTotal, fi0to6, fi7to12, fi13to18, fiMale, fiFemale, fiAfrAmerican, fiAsian, fiCauc, fiHispanic, fiOther, extForenEval, ".
					"intCounsSes, totCounSes, multDisTeamMeet, prosCases, medExamRef, actualPerfStats.quarter FROM actualPerfStats JOIN actualExpenditures
					 		ON actualPerfStats.center = actualExpenditures.center AND actualPerfStats.fiscalyear = actualExpenditures.fiscalyear AND 
							actualPerfStats.quarter = actualExpenditures.quarter WHERE actualPerfStats.center = '$rowPilot->center' 
									AND actualPerfStats.fiscalyear = '$fiscalYear' AND actualExpenditures.completed = 'COM' ORDER BY actualPerfStats.quarter";
			*/
		//fputcsv($fp, (array)$rowPilot);
		
		$resultLoop = $db->get_row($sqlLoop);
		fputcsv($fp,(array)$rowPilot + (array)$resultLoop);
		fputcsv($fp, $emptyArray);
	}
			
			header("Cache-Control: must-revalidate");
			header("Pragma: must-revalidate");
			
			header("Content-type: application/csv");
			header("Content-disposition: attachment; filename=$filename.csv");
			
			readfile($filename);
			
			fclose($fp);
				
?>
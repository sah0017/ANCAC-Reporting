<?PHP
	require("ulogin.php");
	require($root."dbconn.php");
	
	if($_SESSION['admin'] > 0){
		if(isset($_GET['center']))
			$center = $_GET['center'];
		else
			$center = $_SESSION['center'];
		$availible = 1;
	}
	else{
		$center = $_SESSION['center'];
	}
	
	$sqlCenter = "SELECT CenterName FROM centers WHERE center = '".$center."'";
	$CenterName = $db->get_var($sqlCenter);
	$page_title = 'Board of Directors List for '.$CenterName;
	require($root."header.php");
	
	//Note: the header info is entered on the edit page. We pass the fiscal year and center to the page to do this
	
	//set the fiscalYear
	switch (date("m")){
		case 10:
			$availible = 1;
			$fiscalYear = date("Y") + 1;
			$lastYear = date("Y");
			break;
		case 11:
		case 12:
			$fiscalYear = date("Y") + 1;
			$lastYear = date("Y");
			$availible = 0;
			break;
		case 1:
		case 2:
		case 3:
			$fiscalYear = date("Y") ;
			$lastYear = date("Y") - 1;
			$availible = 0;
			break;
		case 4:
		case 5:
		case 6:
			$fiscalYear = date("Y");
			$lastYear = date("Y") - 1;
			$availible = 0;
			break;
		case 7:
		case 8:
		case 9:
			$fiscalYear = date("Y");
			$lastYear = date("Y") - 1;
			$availible = 0;
			break;
	}
	
	//get header info
	$sqlInfo = "SELECT boardMeet, termLength, whenElected FROM boardOfDirHeader WHERE center = '".$center."' AND fiscalyear = '".$fiscalYear."'";
	$info = $db->get_row($sqlInfo);
	if(!isset($info)){
		//initialize the "default" variables for header to ""
		$info = (object) array("boardMeet" => "Undefined", "termLength" => "Undefined", "whenElected" => "Undefined");
	}
	
	$output = "<div class='emailForm basic-grey boardOfDirDiv'>
					<h1>Board of Directors for ".$CenterName." for FY ".$fiscalYear."</h1>
					<h2>Board meetings: ".$info->boardMeet." | Elections: ".$info->whenElected."| Term length: ".$info->termLength." | <a href='editBoardOfDirInfo.php?center=".$center."&fiscalYear=".$fiscalYear."'>Edit Info</a></h2>
					<table class='boardOfDirTable'>
						<thead>
							<tr><th colspan='8' class='centerText'><a href='editBoardOfDir.php?action=add&center=".$center."&fiscalYear=".$fiscalYear."'>Add a Board Member</a></th></tr>
							<tr><th class='name'>Member Name</th><th class='pos'>Position</th><th class='address'>Address</th><th class='phone'>Phone</th><th class='occupation'>Occupation</th><th class='yearsOnBoard centerText'>Years on Board</th><th class='centerText'>Edit</th><th class='centerText'>Delete</th></tr></thead>
						<tbody>";
	
	$sql = "SELECT * FROM boardOfDirItem WHERE center ='".$center."' AND fiscalyear='".$fiscalYear."'";
	$board = $db->get_results($sql);
	
	$a=0;
	foreach($board as $member){
		//Check to see if we have a valid center
		if($member->center){
			//alt row styling
			$altRowStyle=$a%2==0?' trEven':' trOdd';
			$a++;
			$output .="<tr class='centerInfo ".$altRowStyle."'><td class='name'>".$member->name."</td><td class='pos'>".$member->boardPosition."</td>";
			$output .="<td class='address'>".$member->address."</td><td class='phone'>".$member->phone."</td>";
			$output .="<td class='occupation'>".$member->occupation."</td><td class='centerText yearsOnBoard'>".$member->yearsOnBoard."</td>";
			$output .= "<td class='centerText'><a href='editBoardOfDir.php?action=edit&BODID=".$member->BODID."&center=".$center."&fiscalYear=".$fiscalYear."'>Edit Member Info</a></td>";
			$output .= "<td class='centerText'><a href='editBoardOfDir.php?action=delete&BODID=".$member->BODID."&center=".$center."&fiscalYear=".$fiscalYear."'>Delete Member</a></td></tr>";
		}//end if
	}
	
	$output .="</tbody></table>";
	
	//admins can import any time
	if($availible == 1 || $_SESSION['admin'] > 0 ){
		$output .= "<h1 class='previousYear'>Board of Directors for ".$CenterName." for FY ".$lastYear."</h1>
						<table class='boardOfDirTable'>
							<thead>
								<tr><th class='importAll' colspan='7'><a href='editBoardOfDir.php?action=importAll&center=".$center."&fiscalYear=".$fiscalYear."&previousFiscalYear=".$lastYear."'>Import All</a> (Only do this once)</th></tr>
								<tr><th class='name'>Member Name</th><th class='pos'>Position</th><th class='address'>Address</th><th class='phone'>Phone</th><th class='occupation'>Occupation</th><th class='yearsOnBoard'>Years on Board</th><th class='centerText'>Import to Current Year</th></tr></thead>
							<tbody>";
		
		$sql = "SELECT * FROM boardOfDirItem WHERE center ='".$center."' AND fiscalyear='".$lastYear."'";
		$board = $db->get_results($sql);
		
		$a=0;
		if(!empty($board)){
			foreach($board as $member){
				//Check to see if we have a valid center
				if($member->center){
					//alt row styling
					$altRowStyle=$a%2==0?' trEven':' trOdd';
					$a++;
					$output .="<tr class='centerInfo ".$altRowStyle."'><td class='name'>".$member->name."</td><td class='pos'>".$member->boardPosition."</td>";
					$output .="<td class='address'>".$member->address."</td><td class='phone'>".$member->phone."</td>";
					$output .="<td class='occupation'>".$member->occupation."</td><td class='centerText yearsOnBoard'>".$member->yearsOnBoard."</td>";
					$output .= "<td class='centerText'><a href='editBoardOfDir.php?action=import&BODID=".$member->BODID."&center=".$center."&fiscalYear=".$fiscalYear."&previousFiscalYear=".$lastYear."'>Import</a></td></tr>";
				}//end if
			}//end foreach
		}
		else
			$output .="<tr class='centerInfo centerText'><td colspan='7'>There are no board members for the previous year</td>";
		
		$output .="</tbody></table>";
	}
	
	$output .="</div>";
	
	echo $output;
	

  	require($root."footer.php");
?>
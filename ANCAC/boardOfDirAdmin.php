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
			$EOYAvailable = 1;
			$fiscalYear = date("Y") + 1;
			break;
		case 11:
		case 12:
			$fiscalYear = date("Y") + 1;
			$availible = 0;
			break;
		case 1:
		case 2:
		case 3:
			$fiscalYear = date("Y") ;
			$availible = 0;
			break;
		case 4:
		case 5:
		case 6:
			$fiscalYear = date("Y");
			$availible = 0;
			break;
		case 7:
		case 8:
		case 9:
			$fiscalYear = date("Y");
			$availible = 0;
			break;
	}
	
	$output = "<div class='emailForm basic-grey boardOfDirDiv'>
					<h1>Board of Directors for ".$CenterName."</h1>
					<table class='boardOfDirTable'>
						<thead>
							<tr><th colspan='8' class='centerText'><a href='editBoardOfDir.php?action=add&center=".$center."&fiscalYear=".$fiscalYear."'>Add a Board Member</a></th></tr>
							<tr><th class='name'>Member Name</th><th class='pos'>Position</th><th class='address'>Address</th><th class='phone'>Phone</th><th class='occupation'>Occupation</th><th class='yearsOnBoard'>Years on Board</th><th>Edit</th><th>Delete</th></tr></thead>
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
	
	$output .="</tbody></table></div>";
	
	echo $output;
	

  	require($root."footer.php");
?>
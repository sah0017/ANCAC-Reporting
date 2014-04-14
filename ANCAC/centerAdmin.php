<?PHP
	require("ulogin.php");
	require($root."dbconn.php");
	$page_title = 'ANCAC: Center Administration';
	require($root."header.php");
	
	$output = "<div class='emailForm basic-grey centerInfoDiv'>
					<h1>Center Info</h1>
					<table class='centerInfoTable'>
						<thead>
							<tr><th colspan='4' class='centerText'><a href='editCenter.php?action=add'>Add a Center</a></th></tr>
							<tr><th>Center Name</th><th>Center Level</th><th>Counties served</th><th>Edit</th></tr></thead>
						<tbody>";
	
	if($_SESSION['admin'] > 0)
	{
		$sql = "SELECT center FROM centers WHERE center NOT IN ('0, 99')";
		$centers = $db->get_results($sql);
		$a=0;
		foreach($centers as $center){
			//Check to see if we have a valid center
			if($center->center){
				//alt row styling
				$altRowStyle=$a%2==0?' trEven':' trOdd';
				$a++;
				//Print the name and level
				$sql = "SELECT center, centerName, centerlevel FROM centers WHERE centers.center = ".$center->center."";
				$result = $db->get_row($sql);
				$output .="<tr class='centerInfo ".$altRowStyle."'><td>".$result->centerName."</td><td class='centerText'>".$result->centerlevel."</td>";
			
				
				//Print the counties associated with the center
				$sql = "SELECT county from centers INNER JOIN countylu on centers.center = countylu.center WHERE centers.center = ".$center->center."";
				$counties = $db->get_results($sql);
				$output .= "<td>";
				foreach($counties as $centerCounty){
					$output .= $centerCounty->county.", ";
				}
				
				//Remove trailing "," and " "
				$output = substr($output, 0, -2);
				$output .= "</td>";
				
				$output .= "<td class='centerText'><a href='editCenter.php?action=edit&centerNumber=".$center->center."'>Edit Center</a></td></tr>";
			}//end if
		}
		
		$output .="</tbody></table></div>";
		
		echo $output;
	}
	else
	{
                echo "<div class='emailForm basic-grey'>
						<h1>Center Info
							<span>You do not have access to this page.</span>
						</h1>
					</div>";
	}

  	require($root."footer.php");
?>
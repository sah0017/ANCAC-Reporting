<?php
	require("ulogin.php");
	if($_GET['action'] == 'add'){
		$action = "Add";
		$redirectURL = "editCenter.php?action=add";
		$goBack = "<a href='".$webroot."centerAdmin.php'>Back to Center Admin</a>";
	}
	elseif($_GET['action'] == 'edit' && $_SESSION['admin'] == 0){
		$action = "Edit";
		$redirectURL = "editCenter.php?action=edit&centerNumber=".$_GET['centerNumber'];
		$goBack = "<a href='".$webroot."index.php'>Back to Home</a>";
	}
	else{
		$action = "Edit";
		$redirectURL = "editCenter.php?action=edit&centerNumber=".$_GET['centerNumber'];
		$goBack = "<a href='".$webroot."centerAdmin.php'>Back to Center Admin</a>";
	}
	$page_title = 'ANCAC: '.$action.' Center';
	require($root."header.php");

	
	//They've subbmitted the form
	if(isset($_POST['centerName'])){
		$errors = array();
		
		//Validate that they did enter some info\
		//Optional values are tested and set to '' if they don't exist
		if (empty($_POST['centerName'])){
			$errors[] = 'You did not enter a Center Name.';
		}
		if (empty($_POST['centerLevel']) && $_SESSION['admin'] > 0){
			$errors[] = 'You did not enter a Center Level.';
		}
		if (empty($_POST['email'])){
			$_POST['email'] = "";
		}
		if (empty($_POST['phone'])){
			$_POST['phone'] = "";
		}
		if (empty($_POST['addressLine1'])){
			$_POST['addressLine1'] = "";
		}
		if (empty($_POST['addressLine2'])){
			$_POST['addressLine2'] = "";
		}
		if (empty($_POST['city'])){
			$_POST['city'] = "";
		}
		if (empty($_POST['zip'])){
			$_POST['zip'] = "";
		}
		
		if (empty($errors)){ // No errors
			if($_GET['action'] == 'add'){
				//Since the center #'s were hard coded, we have to find the largest center # and increment by one to use as the new center #
				$sql = "SELECT center from centers WHERE center NOT IN ('99')";
				$centerNums = $db->get_results($sql);
				$centerNumsArray = array();
				foreach ($centerNums as $key => $value) {
					$centerNumsArray[] = $value->center;
				}
				$topCenterNum = max($centerNumsArray);
				$topCenterNum++;
				if($topCenterNum == 99) //99 is reserved
					$topCenterNum++;
				
				$centerNumber = $topCenterNum;
				
				$sql = "INSERT INTO centers (center, CenterName, centerLevel, centerEmail, centerPhone, centerAddressLine1, centerAddressLine2, centerCity, centerZip) 
						VALUES ( '".$centerNumber."', '".htmlspecialchars_decode($_POST['centerName'])."', '".htmlspecialchars_decode($_POST['centerLevel'])."',
						'".htmlspecialchars_decode($_POST['email'])."', '".htmlspecialchars_decode($_POST['phone'])."',
						'".htmlspecialchars_decode($_POST['addressLine1'])."', '".htmlspecialchars_decode($_POST['addressLine2'])."',
						'".htmlspecialchars_decode($_POST['city'])."', '".htmlspecialchars_decode($_POST['zip'])."')";
				$db->query($sql);
				
			}elseif($_GET['action'] == 'edit' && $_SESSION['admin'] == 0){
					
				$sql = "UPDATE centers SET CenterName = '".htmlspecialchars_decode($_POST['centerName'])."',
								centerEmail = '".htmlspecialchars_decode($_POST['email'])."',
								centerPhone = '".htmlspecialchars_decode($_POST['phone'])."',
								centerAddressLine1 = '".htmlspecialchars_decode($_POST['addressLine1'])."',
								centerAddressLine2 = '".htmlspecialchars_decode($_POST['addressLine2'])."',
								centerCity = '".htmlspecialchars_decode($_POST['city'])."',
								centerZip = '".htmlspecialchars_decode($_POST['zip'])."'
								WHERE center = '".$_GET['centerNumber']."'";
				$db->query($sql);
				$centerNumber = $_GET['centerNumber'];
			}
			else{
				$sql = "UPDATE centers SET CenterName = '".htmlspecialchars_decode($_POST['centerName'])."',
								centerLevel = '".htmlspecialchars_decode($_POST['centerLevel'])."',
								centerEmail = '".htmlspecialchars_decode($_POST['email'])."',
								centerPhone = '".htmlspecialchars_decode($_POST['phone'])."',
								centerAddressLine1 = '".htmlspecialchars_decode($_POST['addressLine1'])."',
								centerAddressLine2 = '".htmlspecialchars_decode($_POST['addressLine2'])."',
								centerCity = '".htmlspecialchars_decode($_POST['city'])."',
								centerZip = '".htmlspecialchars_decode($_POST['zip'])."'
								WHERE center = '".$_GET['centerNumber']."'";
				$db->query($sql);
				$centerNumber = $_GET['centerNumber'];
			}
			//Now we deal with the counties. We will first find if any counties we are about to modify are
			//currently assgined. We will save their centers names for use later. Then we will delete the records
			//and replace them with the new ones
			//Only done if they are an admin
			if($_SESSION['admin'] > 0){
				$counties = rtrim(implode(',', $_POST['counties']), ',');
				$sql = "SELECT CenterName, countyLU.center, county FROM countyLU INNER JOIN centers ON countyLU.center = centers.center WHERE county IN (";
				foreach ($_POST['counties'] as $county)
					$sql .= "'".$county."', ";
				//Remove trailing "," and " "
				$sql = substr($sql, 0, -2).") AND countyLU.center NOT IN ('".$centerNumber."')";
				$currentlyAssignedCounties = $db->get_results($sql);

/* commented out to allow multiple centers to serve the same county		
 * 		
				//drop the current rows that have our counties
				$sql = "DELETE FROM countyLU WHERE county IN (";
				foreach ($_POST['counties'] as $county)
					$sql .= "'".$county."', ";
				//Remove trailing "," and " "
				$sql = substr($sql, 0, -2).")";
				$db->query($sql);
*
*/
				
				//drop our current counties
				$sql = "DELETE FROM countyLU WHERE center = '".$centerNumber."'";
				$db->query($sql);
				
				//add the correct rows
				foreach ($_POST['counties'] as $county){
					$sql = "INSERT INTO countyLU (center, county) VALUES ('".$centerNumber."', '".$county."')";
					$db->query($sql);
				}
			
			}
			
			$output = "<div class=' basic-grey'>
						<h1>".$action." Center
							<span>Center ".$action."ed sucessfully!</span>
							".$goBack."
						</h1>";
			if(!empty($currentlyAssignedCounties)){
				$output .= "<div style='margin-bottom:5px'>The following counties were reassigned: </div>";
				foreach ($currentlyAssignedCounties as $county)
					$output .="<div class='message'>".$county->county." from ".$county->CenterName."</div>";
			}
			$output .= "</div>";
		}//end if (empty($errors))
		else{ //There were errors
			$output ='<p class="Error"> The following error(s) occurred:<br>';
			
			foreach ($errors as $msg)
				$output .= " - $msg<br>\n";
	
			$output .= "<br><a href='".$redirectURL."'>Please try again.</p><br>";
		}
		
		
	}
	//They need the form
	else{
		
		if($_GET['action'] == 'edit'){
			//get current center info to populate the form
			$sql = "SELECT * from centers WHERE center = '".$_GET['centerNumber']."'";
			$centerInfo = $db->get_row($sql);
			
			//Print the counties associated with the center
			$sql = "SELECT county from centers INNER JOIN countyLU on centers.center = countyLU.center WHERE centers.center = ".$_GET['centerNumber']."";
			$counties = $db->get_results($sql);
			$countyOutput = "<label>
							<span>* Counties Served:</span>";
			if($counties){
				foreach($counties as $centerCounty){
					$countyOutput .= "<div class='tinyWidth'>".$centerCounty->county."</div>";
				}
			}
			$countyOutput .= "</label>";
		}
		else{
			//initialize the "default" variables to ""
			$centerInfo = (object) array("CenterName" => "", "centerAddressLine1" => "", "centerAddressLine2" => "", "centerCity" => "",
				"centerZip" => "", "centerPhone" => "", "centerEmail" => "");
			$countyOutput = "";
		}
		$output = "<div class='emailForm basic-grey'>
						<form action='' method='post' name='editCenter'>
							<h1>".$action." Center
								<span>* Denotes required info</span>
							</h1>
							<label>
								<span>* Center Name:</span>
								<input type='text' name='centerName' value='".$centerInfo->CenterName."'/>
							</label>
							<label>
								<span>Address Line 1:</span>
								<input type='text' name='addressLine1' value='".$centerInfo->centerAddressLine1."'/>
							</label>
							<label>
								<span>Address Line 2:</span>
								<input type='text' name='addressLine2' value='".$centerInfo->centerAddressLine2."'/>
							</label>
							<label class=''>
								<span>City:</span>
								<input type='text' name='city' value='".$centerInfo->centerCity."'/>
							</label>
							<label class=''>
								<span>Zip:</span>
								<input type='text' name='zip' value='".$centerInfo->centerZip."'/>
							</label>
							<label>
								<span>Phone #:</span>
								<input type='text' name='phone' value='".$centerInfo->centerPhone."'/>
							</label>
							<label>
								<span>Email Address:</span>
								<input type='text' name='email' value='".$centerInfo->centerEmail."'/>
							</label>";
		
		if($_SESSION['admin'] > 0){
			$output .= "<label>
							<span>* Center Level</span>
							<select name='centerLevel'>
									<option value='Full Member'>Full Member</option>
									<option value='Pilot Project'>Pilot Project</option>
									<option value='Associate'>Associate</option>
								</select>
						</label>";
			
			$listOfCounties = array("Autauga", "Baldwin", "Barbour", "Bibb", "Blount", "Bullock", "Butler", "Calhoun", "Chambers", "Cherokee",
					"Chilton", "Choctaw", "Clarke", "Clay", "Cleburne", "Coffee", "Colbert", "Conecuh", "Coosa", "Covington", "Crenshaw", 
					"Cullman", "Dale", "Dallas", "De Kalb", "Elmore", "Escambia", "Etowah", "Fayette", "Franklin", "Geneva", "Greene", 
					"Hale", "Henry", "Houston", "Jackson", "Jefferson", "Lamar", "Lauderdale", "Lawrence", "Lee", "Limestone", "Lowndes", 
					"Macon", "Madison-", "Marengo", "Marion", "Marshall", "Mobile", "Monroe", "Montgomery", "Morgan", "Perry", "Pickens", 
					"Pike", "Randolph", "Russell", "St. Clair", "Shelby", "Sumter", "Talladega", "Tallapoosa", "Tuscaloosa", "Walker", 
					"Washington", "Wilcox", "Winston");
			
			$output .= "<label>
							<span>* Counties Served:</span>
						</label>";
			foreach($listOfCounties as $county){
				$output .= "<div class='tinyWidth'><input type='checkbox' name='counties[]' value='".$county."'";
				
				//show counties served as checked
				foreach($counties as $centerCounty){
					if ($centerCounty->county == $county)
						$output .= " checked ";
				}
				
				$output .= "/>".$county."</div>";
			}
		}
		else{
			$output .= $countyOutput;
		}
		
		$output .= "<label>
						<input type='submit' value='Submit'>
					</label>
				</form>
			</div>";
	}
	
	echo $output;
	
	require($root."footer.php");
?> 
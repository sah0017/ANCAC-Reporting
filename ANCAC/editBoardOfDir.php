<?php
	require("ulogin.php");
	if($_GET['action'] == 'add'){
		$action = "Add";
		$redirectURL = "editBoardOfDir.php?action=add&center=".$_GET['center']."&fiscalYear=".$_GET['fiscalYear'];
	}
	elseif($_GET['action'] == 'delete'){
		$action = "Delete";
	}
	else{
		$action = "Edit";
		$redirectURL = "editBoardOfDir.php?action=edit&BODID=".$_GET['BODID']."&center=".$_GET['center']."&fiscalYear=".$_GET['fiscalYear'];
	}
	$page_title = 'ANCAC: '.$action.' Member';
	require($root."header.php");

	
	//They've subbmitted the form
	if(isset($_POST['name'])){
		$errors = array();
		
		//Validate that they did enter some info
		if (empty($_POST['name'])){
			$errors[] = 'You did not enter a Member Name.';
		}
		//Header info must be entered
		if (empty($_POST['boardMeet'])){
			$errors[] = 'You did not enter how often the Board meets.';
		}
		if (empty($_POST['termLength'])){
			$errors[] = 'You did not enter the length of each term.';
		}
		if (empty($_POST['whenElected'])){
			$errors[] = 'You did not enter when new officers are elected.';
		}
		
		if (empty($errors)){ // No errors
			if($_GET['action'] == 'add'){
				
				//Board Member Info
				$sql = "INSERT INTO boardOfDirItem (center , fiscalyear , name , boardPosition , occupation , address , phone , yearsOnBoard , username , datemod) 
						VALUES ( '".$_GET['center']."', '".$_GET['fiscalYear']."', '".htmlspecialchars_decode($_POST['name'])."',
						'".htmlspecialchars_decode($_POST['position'])."', '".htmlspecialchars_decode($_POST['occupation'])."',
						'".htmlspecialchars_decode($_POST['address'])."', '".htmlspecialchars_decode($_POST['phone'])."',
						'".htmlspecialchars_decode($_POST['yearsOnBoard'])."', '".$_SESSION['user']."', NOW())";
				$db->query($sql);
				
			}else{
					
				$sql = "UPDATE boardOfDirItem SET name = '".htmlspecialchars_decode($_POST['name'])."',
								boardPosition = '".htmlspecialchars_decode($_POST['position'])."',
								address = '".htmlspecialchars_decode($_POST['address'])."',
								phone = '".htmlspecialchars_decode($_POST['phone'])."',
								occupation = '".htmlspecialchars_decode($_POST['occupation'])."',
								yearsOnBoard = '".htmlspecialchars_decode($_POST['yearsOnBoard'])."'
								WHERE BODID = '".$_GET['BODID']."'";
				$db->query($sql);
			}
			
			//Header Info is updated no matter what
			
			//First we delete the current info (just to be safe)
			//drop the current rows that have our counties
			$sql = "DELETE FROM boardOfDirHeader WHERE center='".$_GET['center']."' AND fiscalYear='".$_GET['fiscalYear']."'";
			$db->query($sql);
			
			$sql = "INSERT INTO boardOfDirHeader (center , fiscalyear, boardMeet, termLength, whenElected, username, datemod)
						VALUES ( '".$_GET['center']."', '".$_GET['fiscalYear']."', '".htmlspecialchars_decode($_POST['boardMeet'])."',
						'".htmlspecialchars_decode($_POST['termLength'])."', '".htmlspecialchars_decode($_POST['whenElected'])."',
						'".$_SESSION['user']."', NOW())";
			$db->query($sql);
			
			$output = "<div class=' basic-grey'>
						<h1>".$action." Member
							<span>Member ".$action."ed sucessfully!</span>
						</h1>
						<a href=".$webroot."boardOfDirAdmin.php?&center=".$_GET['center'].">Back to Board of Directors</a>
					</div>";
		}//end if (empty($errors))
		else{ //There were errors
			$output ='<p class="Error"> The following error(s) occurred:<br>';
			
			foreach ($errors as $msg)
				$output .= " - $msg<br>\n";
	
			$output .= "<br><a href=".$webroot.$redirectURL."'>Please try again.</p><br>";
		}
		
		
	}
	//They want to delete a member
	elseif($_GET['action'] == 'delete'){
		//drop the current rows that have our counties
		$sql = "DELETE FROM boardOfDirItem WHERE center='".$_GET['center']."' AND fiscalYear='".$_GET['fiscalYear']."' AND BODID='".$_GET['BODID']."'";
		$db->query($sql);
		
		$output = "<div class=' basic-grey'>
						<h1>".$action." Member
							<span>Member Deleted sucessfully!</span>
						</h1>
						<a href=".$webroot."boardOfDirAdmin.php?&center=".$_GET['center'].">Back to Board of Directors</a>
					</div>";
	}
	//They need the form
	else{
		
		if($_GET['action'] == 'edit'){
			//get current center info to populate the form
			$sql = "SELECT * from boardOfDirItem WHERE BODID = '".$_GET['BODID']."'";
			$memberInfo = $db->get_row($sql);
		}
		else{
			//initialize the "default" variables to ""
			$memberInfo = (object) array("name" => "", "address" => "", "occupation" => "", "phone" => "",
				"boardPosition" => "", "yearsOnBoard" => "");
		}

		//get header info
		$sqlHeader = "SELECT center, fiscalYear, boardMeet, termLength, whenElected FROM boardOfDirHeader WHERE center = '".$_GET['center']."' AND fiscalyear = '".$_GET['fiscalYear']."'";
		$header = $db->get_row($sqlHeader);
		if(!isset($header)){
			//initialize the "default" variables for header to ""
			$header = (object) array("center" => "", "fiscalYear" => "", "boardMeet" => "", "termLength" => "",
					"whenElected" => "");
		}

		$output = "<div class='emailForm basic-grey'>
						<form action='' method='post' name='editCenter'>
							<h1>".$action." Member
								<span>* Denotes required info</span>
							</h1>
							<label>
								<span>* Member Name:</span>
								<input type='text' name='name' value='".$memberInfo->name."'/>
							</label>
							<label>
								<span>Address:</span>
								<input type='text' name='address' value='".$memberInfo->address."'/>
							</label>
							<label>
								<span>Occupation:</span>
								<input type='text' name='occupation' value='".$memberInfo->occupation."'/>
							</label>
							<label class=''>
								<span>Phone:</span>
								<input type='text' name='phone' value='".$memberInfo->phone."'/>
							</label>
							<label class=''>
								<span>Position on Board:</span>
								<input type='text' name='position' value='".$memberInfo->boardPosition."'/>
							</label>
							<label>
								<span>Years on Board:</span>
								<input type='text' name='yearsOnBoard' value='".$memberInfo->yearsOnBoard."'/>
							</label>
							";
		//Header stuff
		$output .= "<label class='emptyFormDivider'>
					</label>
					<label>
						<span>* How often does the board meet:</span>
						<input type='text' name='boardMeet' value='".$header->boardMeet."'/>
					</label>
					<label>
						<span>* What is the length of each term:</span>
						<input type='text' name='termLength' value='".$header->termLength."'/>
					</label>
					<label class=''>
						<span>* When are new officers elected:</span>
						<input type='text' name='whenElected' value='".$header->whenElected."'/>
					</label>";
		
		$output .= "<label>
						<input type='submit' value='Submit'>
					</label>
				</form>
			</div>";
	}
	
	echo $output;
	
	require($root."footer.php");
?> 
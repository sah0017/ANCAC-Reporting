<?php
	require("ulogin.php");
	if($_GET['action'] == 'add'){
		$action = "Add";
		$redirectURL = "editBoardOfDir.php?action=add&center=".$_GET['center']."&fiscalYear=".$_GET['fiscalYear'];
	}
	elseif($_GET['action'] == 'delete'){
		$action = "Delete";
	}
	elseif($_GET['action'] == 'import'){
		$action = "Import";
	}
	elseif($_GET['action'] == 'importAll'){
		$action = "Import All";
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
		//Optional values are tested and set to '' if they don't exist
		if (empty($_POST['position'])){
			$_POST['position'] = "";
		}
		if (empty($_POST['occupation'])){
			$_POST['occupation'] = "";
		}
		if (empty($_POST['address'])){
			$_POST['address'] = "";
		}
		if (empty($_POST['phone'])){
			$_POST['phone'] = "";
		}
		if (empty($_POST['yearsOnBoard'])){
			$_POST['yearsOnBoard'] = "";
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
		//drop the current director
		$sql = "DELETE FROM boardOfDirItem WHERE center='".$_GET['center']."' AND fiscalYear='".$_GET['fiscalYear']."' AND BODID='".$_GET['BODID']."'";
		$db->query($sql);
		
		$output = "<div class=' basic-grey'>
						<h1>".$action." Member
							<span>Member Deleted sucessfully!</span>
						</h1>
						<a href=".$webroot."boardOfDirAdmin.php?&center=".$_GET['center'].">Back to Board of Directors</a>
					</div>";
	}
	//They want to import a member
	elseif($_GET['action'] == 'import'){
		//move the director to the current year
		//Get thier current info
		$sql = "SELECT * FROM boardOfDirItem WHERE center ='".$_GET['center']."' AND fiscalyear='".$_GET['previousFiscalYear']."' AND BODID='".$_GET['BODID']."'";
		$boardMember = $db->get_row($sql);
		
		//insert as new row with updated fiscal year
		$boardMember->yearsOnBoard++;
		$sql = "INSERT INTO boardOfDirItem (center , fiscalyear , name , boardPosition , occupation , address , phone , yearsOnBoard , username , datemod) 
				VALUES ( '".$_GET['center']."', '".$_GET['fiscalYear']."', '".$boardMember->name."',
				'".$boardMember->boardPosition."', '".$boardMember->occupation."',
				'".$boardMember->address."', '".$boardMember->phone."',
				'".$boardMember->yearsOnBoard."', '".$_SESSION['user']."', NOW())";
		$db->query($sql);
		
		$output = "<div class='basic-grey'>
						<h1>".$action." Member
							<span>Member Imported sucessfully!</span>
						</h1>
						<a href=".$webroot."boardOfDirAdmin.php?&center=".$_GET['center'].">Back to Board of Directors</a>
					</div>";
	}
	//They want to import all old members
	elseif($_GET['action'] == 'importAll'){
		//move the director to the current year
		//Get thier current info
		$sql = "SELECT * FROM boardOfDirItem WHERE center ='".$_GET['center']."' AND fiscalyear='".$_GET['previousFiscalYear']."'";
		$boardMembers = $db->get_results($sql);
		
		foreach($boardMembers as $boardMember){
			//insert as new row with updated fiscal year
			$boardMember->yearsOnBoard++;
			$sql = "INSERT INTO boardOfDirItem (center , fiscalyear , name , boardPosition , occupation , address , phone , yearsOnBoard , username , datemod)
					VALUES ( '".$_GET['center']."', '".$_GET['fiscalYear']."', '".$boardMember->name."',
					'".$boardMember->boardPosition."', '".$boardMember->occupation."',
					'".$boardMember->address."', '".$boardMember->phone."',
					'".$boardMember->yearsOnBoard."', '".$_SESSION['user']."', NOW())";
			
			$db->query($sql);
		}
		
		$output = "<div class='basic-grey'>
						<h1>".$action." Member
							<span>All Directors Imported sucessfully!</span>
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
		
		$output .= "<label>
						<input type='submit' value='Submit'>
					</label>
				</form>
			</div>";
	}
	
	echo $output;
	
	require($root."footer.php");
?> 
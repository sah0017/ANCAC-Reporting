<?php
	require("ulogin.php");

	$redirectURL = "editBoardOfDirInfo.php?center=".$_GET['center']."&fiscalYear=".$_GET['fiscalYear'];
	$page_title = 'ANCAC: Edit Board Information';
	require($root."header.php");

	
	//They've subbmitted the form
	if(isset($_POST['boardMeet'])||isset($_POST['termLength'])||isset($_POST['whenElected'])){
		$errors = array();
		
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
						<h1>Edit Board Information
							<span>Information edited sucessfully!</span>
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

	//They need the form
	else{

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
							<h1>Edit Board Information
								<span>All fields required.</span>
							</h1>
					<label>
						<span>How often does the board meet:</span>
						<input type='text' name='boardMeet' value='".$header->boardMeet."'/>
					</label>
					<label>
						<span>What is the length of each term:</span>
						<input type='text' name='termLength' value='".$header->termLength."'/>
					</label>
					<label class=''>
						<span>When are new officers elected:</span>
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
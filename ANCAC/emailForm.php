<?php
	require("ulogin.php");
	$page_title = 'ANCAC: Reminder Email Administration';
	require($root."header.php");
	
//	echo "<pre>";
//	print_r($_POST);
//	echo "</pre>";
	
	//They've subbmitted the form
	if(isset($_POST['emailToChange'])){
		//$sql = "INSERT INTO reminderEmail (messageSubject, messageBody) VALUES ( '".htmlspecialchars_decode($_POST['reminderEmailSubject'])."', '".htmlspecialchars_decode($_POST['reminderEmailBody'])."')";
		
		switch($_POST['emailToChange']){
			case "2DaysPriorToOpening":
				$subjectColumn = "twoDaysPriorToOpeningSubject"; 
				$bodyColumn = "twoDaysPriorToOpeningBody";
				break;
			case "systemOpening":
				$subjectColumn = "systemOpeningSubject";
				$bodyColumn = "systemOpeningBody";
				break;
			case "5DaysPriorToDeadline":
				$subjectColumn = "fiveDaysPriorToDeadlineSubject";
				$bodyColumn = "fiveDaysPriorToDeadlineBody";
				break;
			case "countdownToDeadline":
				$subjectColumn = "countdownToDeadlineSubject";
				$bodyColumn = "countdownToDeadlineBody";
				break;
		}
		$sql = "UPDATE reminderEmail SET ".$subjectColumn." = '".htmlspecialchars_decode($_POST['emailSubject'])."', ".$bodyColumn." = '".htmlspecialchars_decode($_POST['emailBody'])."'"; 
		
		$db->query($sql);
		
		if($_POST['emailFrom']){
			
			$sql = "UPDATE reminderEmail SET fromAddress = '".htmlspecialchars_decode($_POST['emailFrom'])."'";
			$db->query($sql);
		}
		
		$output = "<div class='emailForm basic-grey'>
						<h1>Remider Email Form
							<span>Email message updated sucessfully!</span>
						</h1>
					</div>";
	}
	//They need the form
	else{
		
		$output = "<div class='emailForm basic-grey'>
						<form action='' method='post' name='updateEmailMessageForm'>
							<h1>Remider Email Form
								<span>* Denotes required info</span>
							</h1>
							<label>
								<span>* Email to Modify:</span>
								<select name='emailToChange'>
									<option value='2DaysPriorToOpening'>Two Days Prior to System Opening</option>
									<option value='systemOpening'>System Opening</option>
									<option value='5DaysPriorToDeadline'>5 Days Prior To Deadline</option>
									<option value='countdownToDeadline'>Countdown From 5 days out to Day of Deadline</option>
								</select>
							</label>
							<label>
								<span>* Message Subject line:</span>
								<textarea name='emailSubject' class='emailSubject'></textarea>
							</label>
							<label>
								<span>* Message Body:</span>
								<textarea name='emailBody' class='emailBody'></textarea>
							</label>
							<label>
								<span>'From' Address:</span>
								<input type='text' name='emailFrom' class='emailFrom' />
							</label>
							<label>
								<span>&nbsp;</span>
								<input type='submit' value='Submit'>
							</label>
						</form>
					</div>";
	}
	
	echo $output;
	
	require($root."footer.php");
?> 
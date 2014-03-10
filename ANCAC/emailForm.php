<?php
	require("ulogin.php");

	//The page is called by the cron job to send a message
	if($_GET['emailToSend']){
		//sendTo denites who will receive the email. 1 = all, 0 = people who have not yet entered information
		switch($_GET['emailToSend']){
			case "2DaysPriorToOpening":
				$subjectColumn = "twoDaysPriorToOpeningSubject";
				$bodyColumn = "twoDaysPriorToOpeningBody";
				$sendTo = 1;
				break;
			case "systemOpening":
				$subjectColumn = "systemOpeningSubject";
				$bodyColumn = "systemOpeningBody";
				$sendTo = 1;
				break;
			case "5DaysPriorToDeadline":
				$subjectColumn = "fiveDaysPriorToDeadlineSubject";
				$bodyColumn = "fiveDaysPriorToDeadlineBody";
				$sendTo = 0;
				break;
			case "countdownToDeadline":
				$subjectColumn = "countdownToDeadlineSubject";
				$bodyColumn = "countdownToDeadlineBody";
				$sendTo = 0;
				break;
		}
		
		$sql = "SELECT ".$subjectColumn.", ".$bodyColumn." FROM reminderEmail";
			
		$result = $db->get_row($sql);
		
		//echo "Subject: ".$result->$subjectColumn." ; Body: ".$result->$bodyColumn;
		
		$subject = $result->$subjectColumn;
		
		$body = $result->$bodyColumn;
		
		
	}
	//This page allows the user to input the info they want sent out in the reminder email for end of year reports
	else{
		require("/ulogin.php");
		$page_title = 'ANCAC: Account Administration';
		require("/header.php");
		
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
		
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
			
			$output = "Email message updated sucessfully!";
		}
		//They need the form
		else{
			
			$output = "<div class=''>
							<form action='' method='post' name='updateEmailMessageForm'>
								<label for='emailToChange'><span class='label'>Email you wish to modify</span></label>
								<select name='emailToChange'>
									<option value='2DaysPriorToOpening'>Two Days Prior to System Opening</option>
									<option value='systemOpening'>System Opening</option>
									<option value='5DaysPriorToDeadline'>5 Days Prior To Deadline</option>
									<option value='countdownToDeadline'>Countdown From 5 days out to Day of Deadline</option>
								</select>
								<label for='emailSubject'><span class='label'>Message Subject line</span></label>
								<input type='textarea' name='emailSubject' class='emailSubject' />
								<label for='emailBody'><span class='label'>Message Body</span></label>
								<input type='textarea' name='emailBody' class='emailBody' />
								<input type='submit' value='Submit'>
							</form>";
		}
		
		echo $output;
		
		require("/footer.php");
	}
?> 
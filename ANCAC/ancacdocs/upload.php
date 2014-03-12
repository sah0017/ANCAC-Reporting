<?php
	require("../Variables.php");
	require($root."ulogin.php");

	$page_title = 'ANCAC: Shared Documents Menu';

	require($root."header.php");


	$self = $_SERVER['PHP_SELF'];
	
		if ($_GET['d']=="1")
			$target_path = "files/fundingbills/";
		elseif ($_GET['d']=="2")
			$target_path = "files/general/";
		elseif ($_GET['d']=="3")
			$target_path = "files/minutes/";
		elseif ($_GET['d']=="4")
			$target_path = "files/newsletters/";
		else
			$target_path = "";
		
		if ($target_path != ""){

		if($_SESSION['admin'] > 0){
				$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
				
				if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
				    echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
				    " has been uploaded";
				} else{
				    echo "There was an error uploading the file, please try again!";
				}
			}

		else {
		echo '<tr><td>';
		echo '<p>You do not have Administration access</p></td></tr>';
		}
	}
	else{
	echo("An error occured");
	}
?>
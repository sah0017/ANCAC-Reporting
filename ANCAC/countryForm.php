<?php
	require("ulogin.php");
	$page_title = 'ANCAC: Add Country';
	require($root."header.php");
	

	
	//They've subbmitted the form
	if(isset($_POST['name'])){
		$sql = "INSERT INTO originCountries (name) VALUES ( '".$_POST['name']."')";
		
		$db->query($sql);
		
		
		$output = "<div class='countryForm basic-grey'>
						<h1>Add Country Form
							<span>Country list updated successfully!</span>
						</h1>
						<span><a href=countryForm.php>Add another country</a></span>
				</div>";
	}
	//They need the form
	else{
		
		$output = "<div class='countryForm basic-grey'>
						<form action='' method='post' name='updateCountryListForm'>
							<h1>Add Country Form
							</h1>
							<label>
								<span>* Country name:</span>
								<input type=text name='name' align='left'>
							</label>
							<label>
								<span>&nbsp;</span>
								<input type='submit' value='Submit'>
							</label>
						</form>
				<h1>Countries currently in list
				</h1>";
				$sql="SELECT name FROM originCountries";
				$countries = $db->get_results($sql);
				foreach ($countries as $country){
					$output .= $country->name."</br>";
				}
				$output .= "</div>";
	}
	
	echo $output;
	
	require($root."footer.php");
?> 

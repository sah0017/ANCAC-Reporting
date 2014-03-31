<?PHP
	require("ulogin.php");
	$page_title = 'ANCAC: Main Menu';
	require($root."header.php");

	switch (date("m")){
                case 10:
                        $EOYAvailable = 1;
                        //The below was commented out since they say they want it to be good for the rest of October
//                        if (date("j") < 11)
 //                               $EOYAvailable = 1;
  //                      else
   //                             $EOYAvailable = 0;
                        break;
                case 1:
                case 2:
                case 3:
                case 4:
                case 5:
                case 6:
                case 7:
                case 8:
                case 9:
                case 11:
                case 12:
                        $EOYAvailable = 0;
                        break;
        }
?>

<?PHP
//adding of logo jpeg
	//if($_SESSION['admin'] > 0)
	//{
		echo "<img src=".$webroot.'"Unshaded ANCAC Logo.jpg" width="333" height="300">';
	//}

?>

<?PHP
	require($root."footer.php");
?>
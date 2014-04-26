<?PHP

require("ulogin.php");

require($root."dbconn.php");



$t=getdate();

        $today=date('F d, Y H:i A',$t[0]);
        
        
        // ATR 4/25/2014 Added if/else in attempt to have different page tile depeding upon what link was chosen. "Add A New User: " NOT WORKING. Else is fine.

        

        //set the center that is being edited for
		// ATR 4/24/2014 Changed to -1 to allow if statement to run for centers
        if($_SESSION['admin'] > -1){

                //User

                if (isset($_GET['RID'])){

                        $RID = $_GET['RID'];
				        if($RID < 0){
				        	$page_title = 'Add A New User';
				        	
				        	$sqlSelect="SELECT MAX(RID)+1 AS RID FROM `directors`";
				        	$resultRID = @mysql_query($sqlSelect) or mysql_error();
				        	$rowRID = mysql_fetch_object($resultRID);
				        	$RID = $rowRID->RID;
				        	
				        	$sqlInsert="INSERT INTO `directors` (`RID`, `name`, `username`, `email`, `center`, `user_level`, `password`, `lastlogin`, `mailing_address`) VALUES ($RID, '', '', '', '99', '0', '', '0000-00-00 00:00:00', '');";
				        	$resultInsert = @mysql_query($sqlInsert);
				        	
				        	
				        } // end if
                }

                else{

                   $RID = $_POST['RID'];

                }

        }

        

        $sqlUser = "SELECT name, username, email, user_level, password, center FROM directors ".

             "WHERE RID = '".$RID."'";

        $resultUser = @mysql_query($sqlUser) or mysql_error();

        $rowUser = mysql_fetch_object($resultUser);

        $UserName = $rowUser->username;

        $page_title = 'Update User Information: '.$UserName;
        

require($root."header.php");

?>



<body>

<table class='OutlineTable' align=center width="640px">

<tr>

<td class='login-header' colspan='2' align=center><?php echo $page_title; ?><br></td>

</tr>

<tr>

<td class='login' align=left><br>

<div align="center">

<table border="0" width="100%" id="table1">

<tr>

<td>

<?PHP

        if (isset($_POST['submitted'])){

             //Initialize the error array

             $errors = array();



             //Validate that they did enter some info

             if (empty($_POST['User_Name'])){

                $errors[] = 'You did not enter a Name for this User.';

                }

             else{

                $sub_User_Name = $_POST['User_Name'];

             }

             

             if (empty($_POST['User_UserName'])){

                $errors[] = 'You did not enter a User Name for this User.';

                }

             else{

                $sub_User_UserName = $_POST['User_UserName'];

             }

             

             if (empty($_POST['User_Email'])){

                $errors[] = 'You did not enter an Email for this User.';

                }

             else{

                $sub_User_Email = $_POST['User_Email'];

             }


//             if (empty($_POST['User_Password'])){

//                $errors[] = 'You did not enter a Password for this User.';

//                }

//             else{

//                $sub_User_Password = $_POST['User_Password'];

//             }

               
               
               //Validate info
               $Hasher = new PasswordHash(8, false);
                
				if ($_SESSION['admin'] > 0)
					$checkpass = true;
				else
	               $checkpass = $Hasher->CheckPassword($_POST['User_Password'],$rowUser->password);
                
                
               if (!$checkpass){
               
               	$errors[] = 'Your current password was incorrect.';
               
               }
                
               //if (empty($_POST['User_NewPassword'])){
               
               	//$errors[] = 'You did not enter a new password.';
               
               //}
                
               elseif ($_POST['User_NewPassword'] != $_POST['User_NewPassword2']){
               	 
               	$errors[] = 'New password entries did not match.';
               	 
               }
               
               elseif (!empty($_POST['User_NewPassword'])){
               	 
               	$hash=$Hasher->HashPassword($_POST['User_NewPassword']);
               	 
               }
               
               	if(!empty($_POST['User_UserLevel']))
               	{
	                $sub_User_UserLevel = $_POST['User_UserLevel'];
               	}
               	else
               	{
               		$sub_User_UserLevel = $rowUser->user_level;
               	}            
               	
                if (!empty($_POST['User_Center'])){
	                $sub_User_Center = $_POST['User_Center'];
    			}
    			else
    			{
    				$sub_User_Center = $rowUser->center;
    			}        



             if (empty($errors)){

                 //Do the Update
				if (!empty($_POST['User_NewPassword'])){
                 $sqlExecute = "UPDATE directors SET name = '".$sub_User_Name."', ".

                        "username = '".$sub_User_UserName."', email = '".$sub_User_Email."', user_level = ".$sub_User_UserLevel.", center = ".$sub_User_Center." ".

                        "password = '".$hash."' ".

                        "WHERE RID = ".$RID." ;";
                 
                 }
                 else{
					$sqlExecute = "UPDATE directors SET name = '".$sub_User_Name."', ".

						"username = '".$sub_User_UserName."', email = '".$sub_User_Email."', user_level = ".$sub_User_UserLevel.", center = ".$sub_User_Center." ".

						"WHERE RID = ".$RID." ;";
					
				 }



                //update the budgetedExpenditures table
				//echo $sqlExecute;
                $resultExecute = mysql_query($sqlExecute) or mysql_error();
                echo $resultExecute;

              }

              else{//report the errors

                  echo '<br>';

                  echo '<p class="Error"> The following error(s) occurred:<br>';



                  foreach ($errors as $msg){

                     echo " - $msg<br>\n";

                  }

                  echo '<br>Please try again.</p><br>';

               }
        }

        

?>



</td>

</tr>

<tr>

<td>

<?PHP
				// ATR 4/24/2014 Changed to -1 to allow if statement to run for centers
				if($_SESSION['admin'] > -1){

                                  echo '<form action="editAccount.php" method="post">';

                                  echo '<p><b>Name:</b> <input type="text" name="User_Name" maxlength="40" size="75" value="';

                                       if(isset($_POST['User_Name'])) echo $_POST['User_Name']; else echo $rowUser->name;

                                  echo '" /></p>';



                                  echo '<p><b>UserName:</b> <input type="text" name="User_UserName" maxlength="12" size="75" value="';

                                       if(isset($_POST['User_UserName'])) echo $_POST['User_UserName']; else echo $rowUser->username;

                                  echo '" /></p>';

                                  

                                  echo '<p><b>Email:</b> <input type="text" name="User_Email" maxlength="100" size="75" value="';

                                       if(isset($_POST['User_Email'])) echo $_POST['User_Email']; else echo $rowUser->email;

                                  echo '" /></p>';
                                  
                                  // ATR 4/24/2014 Added if statement to prevent centers from viewing user level; only admins
                                  if($_SESSION['admin'] > 0){
                                  

                                  		echo '<p><b>User Level:</b> <select name="User_UserLevel" id="User_UserLevel">';

										echo '<option value="--Select--">--Select--</option>';
										
										echo '<option value="2" '. (($rowUser->user_level == 2) ? "selected='selected'":"").'>2 - Super Admin</option>';
										
										echo '<option value="1" '. (($rowUser->user_level == 1) ? "selected='selected'":"").'>1 - Admin</option>';
										
										echo '<option value="0" '. (($rowUser->user_level == 0) ? "selected='selected'":"").'>0 - User</option>';
										
										echo '</select></p>';
										
										
										echo '<p><b>Center:</b> <select name="User_Center" id="User_Center">';
										
										$sqlCenters = "SELECT center, CenterName FROM centers";
										
										$resultCenters = $db->get_results($sqlCenters);
										
										foreach ($resultCenters as $rowCenter){
											
											echo '<option value="'.$rowCenter->center.'" '. (($rowUser->center == $rowCenter->center) ? "selected='selected'":"").'>'.$rowCenter->CenterName.'</option>';

										}
										
										
										echo '</select></p>';
										
								
                                  } // end if
                                  

                                  
                                  
                                  

                                  echo '<p><b>New Password:</b> <input type="text" name="User_NewPassword" maxlength="15" size="75" value="" /></p>';
                                  
                                  echo '<p><b>Repeat New Password:</b> <input type="text" name="User_NewPassword2" maxlength="15" size="75" value="" /></p>';
                                  
                                  
                                  if ($_SESSION['admin'] == 0)
                                  	echo '<p><b>Current Password (REQUIRED):</b> <input type="text" name="User_Password" maxlength="15" size="75" value="" /></p>';
                                  

                                  echo '<p><input type="submit" name="submit" value="Update User Information" onclick="javascript:return confirm(\'Are you sure you want to update this user?\')" /></p>';

                                  echo '<input type="hidden" name="submitted" value="TRUE" />';

                                  echo '<input type="hidden" name="RID" value="'.$RID.'" />';

                                  echo '</form>';

                                }

                                else

                                echo '<p>You do not have Administration access</p>';

                        ?>

</td>

</tr>

</table>

</div>

</td>

</tr>

</table></div>

</body>

<?PHP

require($root."footer.php");

?>
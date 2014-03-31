<?PHP
	require("ulogin.php");
	require($root."dbconn.php");	
	$page_title = 'Change User Password';
	require($root."header.php");
?>

<body>
<table class='OutlineTable' align=center width="640px">
<tr>
	<td class='login-header' colspan='2' align=center>Change User Password<br></td>
</tr>
<tr>
	<td class='login' align=left><br>
	<div align="center">
		<table border="0" width="100%" id="table1">
		<tr>
			<td>
<?PHP		$Hasher = new PasswordHash(8, false);

        if (isset($_POST['submitted'])){
             //Initialize the error array
             $errors = array();

             //Validate info                                           $sql = "SELECT password FROM directors WHERE username = '".$_SESSION['user']."'";
           	 	 $result = @mysql_query($sql) or mysql_error();            	 $row = mysql_fetch_object($result);            	 $checkpass = $Hasher->CheckPassword($_POST['User_Password'],$row->password);
             
                          if (!$checkpass){
             	
             	$errors[] = 'Your current password was incorrect.';
             	
             }
             	              if (empty($_POST['User_NewPassword'])){
                $errors[] = 'You did not enter a new password.';
             }                          elseif ($_POST['User_NewPassword'] != $_POST['User_NewPassword2']){
             
             	$errors[] = 'New password entries did not match.';
             
	         }	             	         else{	             		            $hash=$Hasher->HashPassword($_POST['User_NewPassword']);	             		         }	             	             }
             
             

             if (empty($errors)){
                 //Do the Update             	$sqlUpdate = "UPDATE directors SET password = '".$hash."' WHERE password = '".$row->password."'";

                $resultUpdate = @mysql_query($sqlUpdate);                                echo 'Password changed sucessfuly.<br>';
              }
              else{//report the errors
                  echo '<br>';
                  echo '<p class="Error"> The following error(s) occurred:<br>';

                  foreach ($errors as $msg){
                     echo " - $msg<br>\n";
                  }
                  echo '<br>Please try again.</p><br> <a href="javascript:history.go(-1)">Go Back</a> </br';
               }
?>

			</td>
		</tr>
		<tr>
		    <td>
		        <?PHP		        if (!isset($_POST['submitted'])){
		        

                                  echo '<form action="editPassword.php" method="post">';
                                  echo '<p><b>Current Password:</b> <input type="text" name="User_Password" maxlength="15" size="75" value="" /></p>';                                  echo '<p><b>New Password:</b> <input type="text" name="User_NewPassword" maxlength="15" size="75" value="" /></p>';
                                                                    echo '<p><b>Repeat New Password:</b> <input type="text" name="User_NewPassword2" maxlength="15" size="75" value="" /></p>';
                                                                    
                                  echo '<p><input type="submit" name="submit" value="Update User Information" onclick="javascript:return confirm(\'Are you sure you want to update your password?\')" /></p>';
                                  echo '<input type="hidden" name="submitted" value="TRUE" />';
                                  echo '</form>';				}
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


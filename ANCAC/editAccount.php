<?PHP
	require("ulogin.php");
	require($root."dbconn.php");

	$t=getdate();
        $today=date('F d, Y H:i A',$t[0]);
        
        //set the center that is being edited for
        if($_SESSION['admin'] > 0){
                //Center
                if (isset($_GET['RID'])){
                        $RID = $_GET['RID'];
                }
                else{
                   $RID = $_POST['RID'];
                }
        }
        
        $sqlCenter = "SELECT name, username, email, user_level, password FROM directors ".
             "WHERE RID = '".$RID."'";
        $resultCenter = @mysql_query($sqlCenter) or mysql_error();
        $rowCenter = mysql_fetch_object($resultCenter);
        $CenterName = $rowCenter->username;

	$page_title = 'Update Center Information for UserName: '.$CenterName;
	
	require($root."header.php");
?>

<body>
<table class='OutlineTable' align=center width="640px">
<tr>
	<td class='login-header' colspan='2' align=center>Update Center Information<br></td>
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

               //Make sure they gave a valid userlevel, (2,1,0,-1)
               if ($_POST['User_UserLevel'] != 2 && $_POST['User_UserLevel'] != 1 && $_POST['User_UserLevel'] != 0 && $_POST['User_UserLevel'] != -1){
                   $errors[] = 'The only valid User Levels are 2, 1, 0, or -1.';
               }
               else{
                $sub_User_UserLevel = $_POST['User_UserLevel'];
               }

             
             if (empty($_POST['User_Password'])){
                $errors[] = 'You did not enter a Password for this User.';
                }
             else{
                $sub_User_Password = $_POST['User_Password'];
             }

             if (empty($errors)){
                 //Do the Update
                 $sqlExecute = "UPDATE directors SET name = '".$sub_User_Name."', ".
                        "username = '".$sub_User_UserName."', email = '".$sub_User_Email."', user_level = ".$sub_User_UserLevel.", ".
                        "password = '".$sub_User_Password."' ".
                        "WHERE RID = ".$RID." ";

                //update the budgetedExpenditures table
                $resultExecute = @mysql_query($sqlExecute);
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
		              if($_SESSION['admin'] > 0){
                                  echo '<form action="editAccount.php" method="post">';
                                  echo '<p><b>Name:</b> <input type="text" name="User_Name" maxlength="40" size="75" value="';
                                       if(isset($_POST['User_Name'])) echo $_POST['User_Name']; else echo $rowCenter->name;
                                  echo '" /></p>';

                                  echo '<p><b>UserName:</b> <input type="text" name="User_UserName" maxlength="12" size="75" value="';
                                       if(isset($_POST['User_UserName'])) echo $_POST['User_UserName']; else echo $rowCenter->username;
                                  echo '" /></p>';
                                  
                                  echo '<p><b>Email:</b> <input type="text" name="User_Email" maxlength="100" size="75" value="';
                                       if(isset($_POST['User_Email'])) echo $_POST['User_Email']; else echo $rowCenter->email;
                                  echo '" /></p>';
                                  
                                  echo '<p><b>User Level:</b> <input type="text" name="User_UserLevel" maxlength="2" size="75" value="';
                                       if(isset($_POST['User_UserLevel'])) echo $_POST['User_UserLevel']; else echo $rowCenter->user_level;
                                  echo '" /><br />(2=Super Admin, 1=Admin, 0=Center, -1=Inactive Account)</p>';
                                  
                                  echo '<p><b>Password:</b> <input type="text" name="User_Password" maxlength="15" size="75" value="';
                                       if(isset($_POST['User_Password'])) echo $_POST['User_Password']; else echo $rowCenter->password;
                                  echo '" /></p>';

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


<?PHP
	require("ulogin.php");
	require($root."dbconn.php");

	$t=getdate();
        $today=date('F d, Y H:i A',$t[0]);

	$page_title = 'Add an ANCAC Log-In';
	
	require($root."header.php");
?>

<body>
<table class='OutlineTable' align=center width="640px">
<tr>
	<td class='login-header' colspan='2' align=center>Add Log-In<br></td>
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

              if ($_POST['User_UserLevel'] == "--Select--"){
                $errors[] = 'You did not select a User Level for this User.';
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
             
             if ($_POST['User_Center'] == "--Select--"){
                $errors[] = 'You did not select a Center for this User.';
             }
             else{
                  $sub_User_Center = $_POST['User_Center'];
             }


             if (empty($errors)){
                 //Do the Insert
                 $sqlExecute = "INSERT INTO `directors` ( `name` , `username` , `email` , `center` , ".
                        "`user_level` , `password` ) ".
                        "VALUES ('".$sub_User_Name."', '".$sub_User_UserName."', '".$sub_User_Email."', ".$sub_User_Center.", ".
                        " ".$sub_User_UserLevel.", '".$sub_User_Password."')";

                //insert into the budgetedExpenditures table
                $resultExecute = @mysql_query($sqlExecute);
                
                if($resultExecute)
                  echo '<p>This log-in was added successfully.</p>';
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
                                  echo '<form action="AddAccount.php" method="post">';
                                  echo '<p><b>Name:</b> <input type="text" name="User_Name" maxlength="40" size="75" value="';
                                       if(isset($_POST['User_Name'])) echo $_POST['User_Name'];
                                  echo '" /></p>';

                                  echo '<p><b>UserName:</b> <input type="text" name="User_UserName" maxlength="12" size="75" value="';
                                       if(isset($_POST['User_UserName'])) echo $_POST['User_UserName'];
                                  echo '" /></p>';
                                  
                                  echo '<p><b>Email:</b> <input type="text" name="User_Email" maxlength="100" size="75" value="';
                                       if(isset($_POST['User_Email'])) echo $_POST['User_Email'];
                                  echo '" /></p>';
                                  
                                  echo '<p><b>User Level:</b> <select name="User_UserLevel" id="User_UserLevel">';
                                  echo '<option value="--Select--" selected>--Select--</option>';
                                  echo '<option value="2">2 - Super Admin</option>';
                                  echo '<option value="1">1 - Admin</option>';
                                  echo '<option value="0">0 - Center</option>';
                                  echo '</select></p>';
                                  
                                  echo '<p><b>Password:</b> <input type="text" name="User_Password" maxlength="15" size="75" value="';
                                       if(isset($_POST['User_Password'])) echo $_POST['User_Password'];
                                  echo '" /></p>';
                                  
                                  $sql = 'SELECT center, concat(CenterName, " (", centerlevel, ")") as CenterName FROM centers';
	                          $result= @mysql_query($sql) or mysql_error();
	                          
	                          echo '<p><b>Center:</b> <select name="User_Center" id="User_Center">';
                                  echo '<option value="--Select--" selected>--Select--</option>';

                                  //Add all centers
                                  while ($row = mysql_fetch_object($result)) {
                                    echo '<option value="'.$row->center.'">'.$row->CenterName.'</option>';
                                  }

                                  echo '</select></p>';

                                  echo '<p><input type="submit" name="submit" value="Add Log-In" onclick="javascript:return confirm(\'Are you sure you want to add this user?\')" /></p>';
                                  echo '<input type="hidden" name="submitted" value="TRUE" />';
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


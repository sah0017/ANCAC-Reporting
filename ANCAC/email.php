<?PHP
	require("/ulogin.php");
	require("/dbconn.php");

	$page_title = 'Email Entire Network';
	require("/header.php");
	
	$t=getdate();
        $today=date('F d, Y H:i A',$t[0]);
	
	$emailFooter = 'Notice: This email came from the ANCAC-Online website because you are member of ANCAC in Alabama. The information contained in this email is confidential and only intended for the person to which it was sent. If you are not the intended recipient, you are hereby notified that the disclosure, copying, distribution, or taking of any action in regards to the contents of this email - except its direct delivery to the intended recipient - is strictly prohibited. If you have received this email in error, please notify ANCAC immediately and destroy this email along with its contents, and delete it from your system, if applicable. '.$_SESSION['name'].' '.$today.'.';

?>

<body>
<table class='OutlineTable' align=center width="640px">
<tr>
	<td class='login-header' colspan='2' align=center>Email Entire Network<br></td>
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
             if (empty($_POST['email_subject'])){
                $errors[] = 'You did not enter a Subject for your email.';
                }
             else{
                $email_subject = 'ANCAC-Online: '.$_POST['email_subject'];
             }

             if (empty($_POST['email_body'])){
                $errors[] = 'You did not enter a body for your email.';
                }
             else{
                $email_body = '
'.'Subject: '.$email_subject.'
'.'Date: '.$today;
                $email_body = $email_body.'

'.stripslashes($_POST['email_body']);
                $email_body = $email_body.'


'.$emailFooter;
             }

             if (empty($errors)){
                 $sqlEmails = "SELECT email FROM directors WHERE RID not in (999)";
                 $resultEmails = @mysql_query($sqlEmails) or mysql_error();

                 $to = '';

                 $numRecords = mysql_num_rows($resultEmails);

                 if ($numRecords > 0){
                        $counter = 1;
                        while ($rowEmails = mysql_fetch_object($resultEmails)) {
                                if ($counter == 1)
                                        $to = $rowEmails->email;
                                else{
                                        $to = $to.','.$rowEmails->email;
                                }
                                $counter = $counter + 1;
                        }
                 }

                 $from = "ANCAC_DONOTREPLY@alabamacacs.org";
                 $fromName = "ANCAC Online";

                 //For testing purpose
                 //$to = "coopetd@gmail.com,jrandall@quasartechgroup.com";

                 $success = mail($from,$email_subject,$email_body, "From: \"".$fromName."\" <".$from.">\r\nReply-To:ANCAC_DONOTREPLY@alabamacacs.org\r\nBcc:$to");

                 if ($success == 1)
                        echo 'Your email was sent to the entire network successfully.';
                 else
                        echo 'Your email was NOT sent.  Please try again.';
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
		              if($_SESSION['admin'] == 2){
                                echo '<form action="email.php" method="post">';
                                echo '<p><b>Subject Line:</b><br />ANCAC-Online: <input type="text" name="email_subject" maxlength="50" size="75" value="';
                                if(isset($_POST['email_subject'])) echo $_POST['email_subject'];
                                echo '" /></p>';
                                echo '<p><b>Body of Email:</b><br /><textarea rows="10" cols="75" name="email_body">';
                                if(isset($_POST['email_body'])) echo $_POST['email_body']; 
                                echo '</textarea>';
                                echo '<p><input type="submit" name="submit" value="Send Email" onclick="javascript:return confirm(\'Are you sure you want to send this email?\')" /></p>';
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
	require("/footer.php");
?>


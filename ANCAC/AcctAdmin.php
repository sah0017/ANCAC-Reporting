<?PHP
	require("ulogin.php");
	require($root."dbconn.php");
	$page_title = 'ANCAC: Account Administration';
	require($root."header.php");

?>

<table class='login' align=center width="293">
       <tr>
           <td class='login-header' colspan='2' align=center>ANCAC: Account Administration<br></td>
       </tr>
       <tr>
           <td class='login' align=left><br>
               <div align="center">
	            <table border="0" width="80%" id="table1" class="Admin">
<?PHP
	if($_SESSION['admin'] > 0)
	{
             $sql = "SELECT directors.RID,directors.name,directors.username,directors.email,directors.center,directors.user_level,directors.password, centers.CenterName FROM directors left join centers on directors.center = centers.center";
	     $result= @mysql_query($sql) or mysql_error();
	     
	     echo '<tr><td colspan="6" align="center"><a href="editAccount.php?RID=-1">Add a new log in</a></td></tr>';

	     echo '<tr><td><b>Center</b></td><td><b>Name</b></td><td><b>User Name</b></td><td><b>Email</b></td><td><b>Password</b></td><td>&nbsp;</td></tr>';

	     while ($row = mysql_fetch_object($result)) {
	           echo '<tr align="left">';
	           echo '<td>'.$row->CenterName.'</td>';
	           echo '<td>'.$row->name.'</td>';
	           echo '<td>'.$row->username.'</td>';
	           echo '<td>'.$row->email.'</td>';
                   echo '<td>'.$row->password.'</td>';
                   echo '<td><a href="editAccount.php?RID='.$row->RID.'">Edit Account</a></td>';
                   echo '</tr>';
		}
	}
	else
	{
                echo '<tr><td>';
		echo '<p>You do not have Administration access</p></td></tr>';
	}
?>
	           </table>
            </div>
         </td>
      </tr>
</table>

<?PHP
  	require($root."footer.php");
?>

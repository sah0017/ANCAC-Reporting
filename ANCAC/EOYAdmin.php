<?PHP
	require("/ulogin.php");
	$page_title = 'ANCAC: EOY Admin Menu';
	require("/header.php");

?>

<table class='login' align=center width="293">
       <tr>
           <td class='login-header' colspan='2' align=center>ANCAC: EOY Admin Menu<br></td>
       </tr>
       <tr>
           <td class='login' align=left><br>
               <div align="center">
	            <table border="0" width="80%" id="table1">
		           <tr><br>
<?PHP
	if($_SESSION['admin'] > 1)
	{
		echo '<td>';
		echo '<p>1. <a href=qreportAdmin.php?from=8>Received Snail-Mail Documents (EOY)</a></p>';
		echo '<p>2. <a href="selectYearGT.php?from=4">Print submitted BOD Lists (all Centers)</a></p>';
		echo '<p>3. <a href="selectYearGT.php?from=5">Print submitted Estimated Budget for all 4 quarters (all Centers)</a></p>';
		echo '<p>4. <a href="selectYearGT.php?from=6">Print submitted Budget Request (all Centers)</a></p>';
		echo '<p>5. <a href="selectYearGT.php?from=7">Print submitted Diversity Action Plans (all Centers)</a></p>';
		echo '<p>&nbsp;</p>';
		echo '<p>0. <a href="/ANCAC-Online/index.php">Return to Main Menu</p>';
		echo '<p>&nbsp;</p>';
	}
	else
	{
                echo '<td>';
		echo '<p>You do not have Administration access</p></td>';
	}
?>
                             </tr>
	           </table>
            </div>
         </td>
      </tr>
</table>

<?PHP
  	require("/footer.php");
?>
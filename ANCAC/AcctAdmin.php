<?PHP
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/ulogin.php");
	$page_title = 'ANCAC: Account Administration';
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/header.php");

?>

<table class='login' align=center width="293">
       <tr>
           <td class='login-header' colspan='2' align=center>ANCAC: Account Administration<br></td>
       </tr>
       <tr>
           <td class='login' align=left><br>
               <div align="center">
	            <table border="0" width="80%" id="table1">
		           <tr><br>
<?PHP
	if($_SESSION['admin'] > 0)
	{
		echo '<td>';
		echo '<p>1. Will add items here<br><br></p>';
		echo '<p>&nbsp;</p>';
		echo '<p>0. <a href="/ANCAC-Online/index.php">Return to Main Menu</p>';
		echo '<p>&nbsp;</p>';
		echo '</td>';
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
  	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/footer.php");
?>
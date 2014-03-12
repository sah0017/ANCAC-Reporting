<?	require("../Variables.php");

	require($root."ulogin.php");
	$page_title = 'ANCAC: Shared Documents Menu';
	require($root."header.php");
?>

<table class='login' align=center width="293"><tr>
<td class='login-header' colspan='2' align=center>ANCAC: Shared Documents<br></td></tr> <tr>
<td class='login' align=left><br>
&nbsp;<div align="center">
	<table border="0" width="80%" id="table1">
		<tr>
			<td>
			<br><b>ANCAC FUNDING BILLS</b><br><br><br>
			<?php			foreach(glob('files/fundingbills/*.*') as $file){			echo ("<p><a href=".str_replace(' ','%20',$file)." target=2>".basename($file)."</a></p>");			}			?>

			<p>&nbsp;</p>
			<p>0. <a href="index.php">Return to Documents Menu</a></p>
			<p>&nbsp;</p>

			</td>
		</tr>
	</table>
</div>
<p>&nbsp;</td></tr> </table></div>

</html>

<?php
	require("../Variables.php");
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
			<br><b>ANCAC BOARD MINUTES</b><br><br><br>

<?php
			foreach(glob('files/minutes/*.*') as $file){
			echo ("<p><a href=".str_replace(' ','%20',$file).' download target="_blank">'.basename($file)."</a>");
		
				echo "&nbsp&nbsp&nbsp<a href=\"delete.php?f=".basename($file)."&d=3\">Delete</a></p>";
			
			}
?>

			<p>&nbsp;</p>
			
			<p>&nbsp;</p>

			<?php 		
		
				echo('<form enctype="multipart/form-data" action="upload.php?d=3" method="POST">
				Add a file: <input name="uploadedfile" type="file" /><input type="submit" value="Upload" />
				</form>');
			
			?>
			
			</td>
		</tr>
	</table>
</div>
<p>&nbsp;</td></tr> </table></div>

</html>

<?
	require("./ulogin.php");
	$page_title = 'ANCAC-Online Forums';
	require("./header.php");

?>

<table class='login' align=center width="293">
       <tr>
           <td class='login-header' colspan='2' align=center>ANCAC-Online Forums<br></td>
       </tr>
       <tr>
           <td class='login' align=left><br>
               <div align="center">
	            <table border="0" width="80%" id="table1">
		           <tr><br>

                           <center>
                            Welcome to the ANCAC-Online Forums.   <br><br><br>  Please remember to respect each other and<br>respect the privacy of your clients.<br><br><br>

                            <form action='/ANCAC-Online/messageboard/index.php?a=login&amp;s=on' method='post'>
                                   <?
                                   echo "<input type='hidden' name='user' value=".$_SESSION['U1'].">";
                                   echo "<input type='hidden' name='pass' value=".$_SESSION['P1'].">";
                                  ?>
                                  <input type='hidden' name='request_uri' value='/ANCAC-Online/messageboard/index.php'>
                                  <input type='submit' name='submit' value='Click Here to Enter Forums'>
                            </form>

                              <br><br><br>
                             </tr>
	           </table>
            </div>
         </td>
      </tr>
</table>

<?
  	require("./footer.php");
?>
<?
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/ulogin.php");
	$page_title = 'ANCAC: Last Login';
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/header.php");
	
	$sql = "SELECT centers.CenterName, directors.name, directors.lastlogin FROM centers JOIN directors ON centers.center = directors.center WHERE centers.center not in (0,99)";
        $result = @mysql_query($sql) or mysql_error();
        
        $t=getdate();
        $today=date('Y-m-d H:i',$t[0]);
?>

<table class='loginWidth' align=center width='95%'>
       <tr>
           <td class='login-header' colspan='2' align=center>ANCAC: Last Login<br></td>
       </tr>
       <tr>
           <td class='login' align=left><br>
               <div align="center">
	            <table border="0" width="100%" id="table1" class="Admin">
	                   <tr align="center">
	                       <td colspan="3"><b>Date: </b><? echo $today; ?></td>
	                   </tr>
		           <tr>
		              <td><b>Center</b></td><td><center><b>Director Name</b></center></td><td><center><b>Last Login</b></center></td>
		           </tr>
<?
	if($_SESSION['admin'] > 0)
	{
		while ($row = mysql_fetch_object($result)) {
                        if ($row->lastlogin == "0000-00-00 00:00:00")
                                $LastLogin = "NONE";
                        else
                                $LastLogin = $row->lastlogin;

                        echo '<tr><td>'.$row->CenterName.'</td><td><center>'.$row->name.'</center></td><td><center>'.$LastLogin.'</center></td></tr>';
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

<?
  	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/footer.php");
?>
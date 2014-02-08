<?
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/ulogin.php");
	//require("/home/cust1/user1224426/data/dbconn.php");
	
	if(isset($_GET['from']))
	       $From = $_GET['from'];
	else
	       $From = 1;

	if($_SESSION['admin'] > 0){
                $center = $_GET['center'];

        }
        else{
                $center = $_SESSION['center'];
        }
        
        if($From == 1)
	         $page_title = 'Select a Year: Year to Date Report';
        if($From == 2)
                 $page_title = 'Select a Year: Board of Directors Report';

	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/header.php");

?>

<body>
<table class='OutlineTable' align=center width="300px">
<tr>
	<td class='login-header' colspan='2' align=center>Select a Year<br></td>
</tr>
<tr>
	<td class='login' align=left><br>
	<div align="center">
		<table border="0" width="300px" id="table1">
		<tr>
		    <td>
		        <? if($From == 1) echo '<form action="centerReportAdmin.php" method="post">';
                           if($From == 2) echo '<form action="BODReport.php" method="post">';
                        ?>

                                <p>Select Year:  <select name="year" id="year">
                                                  <?php
                                                       switch (date("m")){
                                                        case 10:
                                                        case 11:
                                                        case 12:
                                                             $year = date("Y") + 1;
                                                             break;
                                                        case 1:
                                                        case 2:
                                                        case 3:
                                                             $year = date("Y");
                                                             break;
                                                        case 4:
                                                        case 5:
                                                        case 6:
                                                             $year = date("Y");
                                                             break;
                                                        case 7:
                                                        case 8:
                                                        case 9:
                                                             $year = date("Y");
                                                             break;
                                                 }
                                                        for($i=$year;$i>2007;$i--)
                                                        {
                                                                if($year == $i)
                                                                        echo "<option value='$i' selected>Current Year - $i</option>";
                                                                else
                                                                        echo "<option value='$i'>$i</option>";
                                                  }
                                                  ?>
                                                </select></p>
                                <p><input type="submit" name="submit" value="View Report" /></p>
                                <input type="hidden" name="center" value="<? echo $center; ?>" />
                          </form>
		    </td>
		</tr>
		</table>
	</div>
	</td>
</tr>
</table></div>
</body>
<?
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/footer.php");
?>


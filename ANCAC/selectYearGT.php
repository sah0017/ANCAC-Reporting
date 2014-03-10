<?PHP
	require("ulogin.php");
	//require("/home/cust1/user1224426/data/dbconn.php");
	
	$From = $_GET['from'];
	if($From == 2)
	         $page_title = 'Select a Year: Grand Total Report';
        if($From == 3)
                 $page_title = 'Select a Year: Estimated Budget Totals Report';
        if($From == 4)
                 $page_title = 'Select a Year: Board of Directors List';
        if($From == 5)
                 $page_title = 'Select a Year: Estimated Budget for all 4 Quarters';
        if($From == 6)
                 $page_title = 'Select a Year: Budget Request';
        if($From == 7)
                 $page_title = 'Select a Year: Diversity Action Plan';


	require($root."header.php");

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
		        <?PHP if($From == 2) echo '<form action="GrandTotal.php" method="post">'; 
                           if($From == 3) echo '<form action="EstBudgetTotals.php" method="post">';
                           
                           if($From == 4) echo '<form action="AllBODReport.php" method="post">';
                           if($From == 5) echo '<form action="AllEstBud.php" method="post">';
                           if($From == 6) echo '<form action="AllBudReq.php" method="post">';
                           if($From == 7) echo '<form action="AllDAP.php" method="post">';
                        ?>
                                <p>Select Year:  <select name="year" id="year">
                                                  <?PHP
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
                                                             if($From == 3)
							          $year = date("Y") + 1;
							     else
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
                          </form>
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


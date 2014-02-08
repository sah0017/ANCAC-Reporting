<?
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/ulogin.php");
	require("/home/cluster1/data/a/p/a1224426/data/dbconn.php");

	//set the fiscalYear
        switch (date("m")){
                case 10:
                        $EOYAvailable = 1;
                        $fiscalYear = date("Y") + 1;
                        break;
                case 11:
                case 12:
                        $fiscalYear = date("Y") + 1;
                        $EOYAvailable = 0;
                        break;
                case 1:
                case 2:
                case 3:
                        $fiscalYear = date("Y") ;
                        $EOYAvailable = 0;
                        break;
                case 4:
                case 5:
                case 6:
                        $fiscalYear = date("Y");
                        $EOYAvailable = 0;
                        break;
                case 7:
                case 8:
                case 9:
                        $fiscalYear = date("Y");
                        $EOYAvailable = 0;
                        break;
        }
        $CY = 0;
        $LastYear = $fiscalYear - 1;
	if($_SESSION['admin'] > 0){
                $center = $_GET['center'];
                $EOYAvailable = 1;
        }
        else{
                $center = $_SESSION['center'];
        }

	$sqlCenter = "SELECT CenterName FROM centers ".
             "WHERE center = '".$center."'";
        $resultCenter = @mysql_query($sqlCenter) or mysql_error();
        $rowCenter = mysql_fetch_object($resultCenter);
        $CenterName = $rowCenter->CenterName;

	$page_title = 'Board of Directors List for '.$CenterName;
	require("/home/cluster1/data/a/p/a1224426/html/ANCAC-Online/header.php");

?>

<body>
<table class='OutlineTable' align=center width="75%">
<tr>
	<td class='login-header' colspan='2' align=center>Board of Directors List - FY <? echo $fiscalYear; ?><br></td>
</tr>
<tr>
	<td class='login' align=left><br>
	<div align="center">
		<table border="0" width="100%" id="table1">
<?
        //DATA MANIPULATION START HERE
        if (isset($_POST['submitted'])){
          if ($_GET['A'] == 'H'){ //START OF THE HEADER MANIPULATION
             //Initialize the error array
             $errors = array();
             //Validate that they did enter when the board meets
             if (empty($_POST['board_Meet'])){
                $errors[] = 'You did not enter how often the board meets.';
                }
             else{
                $board_Meet = $_POST['board_Meet'];
             }
             //Validate that they did enter the length of a term
             if (empty($_POST['term_Length'])){
                $errors[] = 'You did not enter the length of each term.';
                }
             else{
                $term_Length = $_POST['term_Length'];
             }
             //Validate that they did enter when new officers are elected
             if (empty($_POST['when_Elected'])){
                $errors[] = 'You did not enter when new officers are elected.';
                }
             else{
                $when_Elected = $_POST['when_Elected'];
             }

             if (empty($errors)){
                $sqlInsert = "INSERT INTO `boardOfDirHeader` ( `center` , `fiscalyear` , `boardMeet` , `termLength` , `whenElected` , `username` , `datemod` ) ".
                      "VALUES ('".$center."', '".$fiscalYear."', '".$board_Meet."', '".$term_Length."', '".$when_Elected."', '".$_SESSION['user']."', NOW())";
                $resultInsert = @mysql_query($sqlInsert);
              }
              else{//report the errors
                  echo '<tr><td>';
                  echo '<p class="Error"> The following error(s) occurred:<br />';

                  foreach ($errors as $msg){
                     echo " - $msg<br />\n";
                  }
                  echo '<br />Please try again.</p><br /></td></tr>';
               }

           }//END OF THE HEADER MANIPULATION
           
          if ($_GET['A'] == 'I'){ //START OF THE Item MANIPULATION
             //Initialize the error array
             $errors = array();
             //Validate that they did enter Board Member
             if (empty($_POST['item_Name'])){
                $errors[] = 'You did not enter the Name of the Board Member.';
                }
             else{
                $item_Name = $_POST['item_Name'];
             }
             //Validate that they did enter the Board Position
             if (empty($_POST['item_Position'])){
                $errors[] = 'You did not enter the Board Position.';
                }
             else{
                $item_Position = $_POST['item_Position'];
             }
             //Validate that they did enter the Occupation
             if (empty($_POST['item_Occupation'])){
                $errors[] = 'You did not enter an Occupation.';
                }
             else{
                $item_Occupation = $_POST['item_Occupation'];
             }
             //Validate that they did enter the Address
             if (empty($_POST['item_Address'])){
                $errors[] = 'You did not enter an Address.';
                }
             else{
                $item_Address = $_POST['item_Address'];
             }
             //Validate that they did enter the Phone Number
             if (empty($_POST['item_Phone'])){
                $errors[] = 'You did not enter a Phone Number.';
                }
             else{
                $item_Phone = $_POST['item_Phone'];
             }
             //Validate that they did enter the Year on Board
             if (empty($_POST['item_Years'])){
                if ($_POST['item_Years'] == 0)
                        $item_Years = $_POST['item_Years'];
                else
                        $errors[] = 'You did not enter the # Years on Board.';
                }
             else{
                $item_Years = $_POST['item_Years'];
             }

             if (empty($errors)){
                $sqlInsert = "INSERT INTO `boardOfDirItem` ( `center` , `fiscalyear` , `name` , `boardPosition` , `occupation` , `address` , `phone` , `yearsOnBoard` , `username` , `datemod` ) ".
                      "VALUES ('".$center."', '".$fiscalYear."', '".$item_Name."', '".$item_Position."', '".$item_Occupation."', '".$item_Address."', '".$item_Phone."', '".$item_Years."', '".$_SESSION['user']."', NOW())";
                $resultInsert = @mysql_query($sqlInsert);
              }
              else{//report the errors
                  echo '<tr><td>';
                  echo '<p class="Error"> The following error(s) occurred:<br />';

                  foreach ($errors as $msg){
                     echo " - $msg<br />\n";
                  }
                  echo '<br />Please try again.</p><br /></td></tr>';
               }

           }//END OF THE Item MANIPULATION
        }
        //if they have come from wanting to delete one of the Board of Directors for this Year
        if ($_GET['A'] == 'D'){
          $sqlDelete = "DELETE FROM boardOfDirItem WHERE center = ".$center." AND BODID = ".$_GET['OI']." AND fiscalyear = ".$fiscalYear;
          $resultDelete = @mysql_query($sqlDelete);
        }
        //DATA MANIPULATION END HERE

        $sqlBODHeader = "SELECT center, fiscalYear, boardMeet, termLength, whenElected".
                " FROM boardOfDirHeader WHERE center = '".$center."' AND fiscalyear = '".$fiscalYear."'";
        $resultBODHeader = @mysql_query($sqlBODHeader) or mysql_error();
        $rowHeader = mysql_fetch_object($resultBODHeader);

        $numRecordsHeader = mysql_num_rows($resultBODHeader);

        if ($EOYAvailable == 1){
                //They Have Not Put their Header Info in for this year
                if ($numRecordsHeader == 0){
                        echo '<tr><td><form action="boardOfDir.php?A=H&center='.$center.'" method="post">';
                        echo '<hr><div align=center><table border=0 width=636><tr>';
                        echo '<td><br><br><p><b>How often does the board meet? </b><input type="text" name="board_Meet" maxlength="50" size="50" value="';
                                if(isset($_POST['board_Meet'])) echo $_POST['board_Meet'];
                        echo '" /></p>';
                        echo '<p><b>What is the length of each term? </b><input type="text" name="term_Length" maxlength="50" size="50" value="';
                                if(isset($_POST['term_Length'])) echo $_POST['term_Length'];
                        echo '" /></p>';
                        echo '<p><b>When are new officers elected? &nbsp;&nbsp;</b><input type="text" name="when_Elected" maxlength="50" size="50" value="';
                                if(isset($_POST['when_Elected'])) echo $_POST['when_Elected'];
                        echo '" /></p>';
                        echo '<p><input type="submit" name="submit" value="Start Board of Directors List" /></p>';
                        echo '<input type="hidden" name="submitted" value="TRUE" />';
                        echo '</td></tr></table></div></form></td></tr>';
                }
                //They have entered the Header stuff; now show the items
                else {
                        //Show the Header Information
                        echo '<tr><td><b>Name of Center: </b>'.$CenterName.'</td></tr>';
                        echo '<tr><td><b>How often does the board meet?   </b>'.$rowHeader->boardMeet.'</td></tr>';
                        echo '<tr><td><b>What is the length of each term? </b>'.$rowHeader->termLength.'</td></tr>';
                        echo '<tr><td><b>When are new officers elected?   </b>'.$rowHeader->whenElected.'<hr /></td></tr>';
                        //Show Last Years Board Peeps
                        $sqlBODLY = "SELECT name, boardPosition, occupation, address, phone, yearsOnBoard".
                                " FROM boardOfDirItem WHERE center = '".$center."' AND fiscalyear = '".$LastYear."'";
                        $resultBODLY = @mysql_query($sqlBODLY) or mysql_error();

                        $numRecordsLY = mysql_num_rows($resultBODLY);
                        //If there is information for last year show it
                        if ($numRecordsLY > 0){
                                echo '<tr><td><table width="100%" class="Admin">';
                                echo '<tr><td colspan="6"><b>List of Board Members FY: '.$LastYear.'</b></td></tr>';
                                echo '<tr><td><b>Name of Board Member</b></td><td><b>Board Position</b></td><td><b>Occupation</b></td><td><b>Address</b></td><td><b>Phone</b></td><td><b># Years on Board</b></td></tr>';
                                while ($rowLY = mysql_fetch_object($resultBODLY)) {
                                        echo '<tr>';
                                        echo '<td>'.$rowLY->name.'</td><td>'.$rowLY->boardPosition.'</td><td>'.$rowLY->occupation.'</td><td>'.$rowLY->address.'</td><td>'.$rowLY->phone.'</td><td>'.$rowLY->yearsOnBoard.'</td>';
                                        echo '</tr>';
                                }
                                echo '</table><hr /></td></tr>';
                        }
                        else
                                echo '<tr><td><b>There is no Board of Director Information for Last Year</b><hr /></td></tr>';
                        
                        //Show this Years Board Peeps with ability to Delete them
                        $sqlBODCY = "SELECT name, boardPosition, occupation, address, phone, yearsOnBoard, BODID".
                                " FROM boardOfDirItem WHERE center = '".$center."' AND fiscalyear = '".$fiscalYear."'";
                        $resultBODCY = @mysql_query($sqlBODCY) or mysql_error();

                        $numRecordsCY = mysql_num_rows($resultBODCY);
                        //If there is information for current year show it
                        if ($numRecordsCY > 0){
                                echo '<tr><td><table width="100%" class="Admin">';
                                echo '<tr><td colspan="7"><b>List of Board Members FY: '.$fiscalYear.'</b></td></tr>';
                                echo '<tr><td><b>Name of Board Member</b></td><td><b>Board Position</b></td><td><b>Occupation</b></td><td><b>Address</b></td><td><b>Phone</b></td><td><b># Years on Board</b></td><td></td></tr>';
                                while ($rowCY = mysql_fetch_object($resultBODCY)) {
                                        echo '<tr>';
                                        echo '<td>'.$rowCY->name.'</td><td>'.$rowCY->boardPosition.'</td><td>'.$rowCY->occupation.'</td><td>'.$rowCY->address.'</td><td>'.$rowCY->phone.'</td><td>'.$rowCY->yearsOnBoard.'</td><td><a href="boardOfDir.php?A=D&center='.$center.'&OI='.$rowCY->BODID.'"> Delete </a></td>';
                                        echo '</tr>';
                                }
                                echo '</table><hr /></td></tr>';
                        }
                        else
                                echo '<tr><td><b>There is no Board of Director Information for the Current Year</b><hr /></td></tr>';
                        //Show Form Where they can insert Peeps for this Year
                        echo '<tr><td><form action="boardOfDir.php?A=I&center='.$center.'" method="post">';
                        echo '<p><b>Name of Board Member: </b><br /><input type="text" name="item_Name" maxlength="75" size="75" value="';
                                if(isset($_POST['item_Name'])) echo $_POST['item_Name'];
                        echo '" /></p>';
                        echo '<p><b>Board Position: </b><br /><input type="text" name="item_Position" maxlength="50" size="50" value="';
                                if(isset($_POST['item_Position'])) echo $_POST['item_Position'];
                        echo '" /></p>';
                        echo '<p><b>Occupation: </b><br /><input type="text" name="item_Occupation" maxlength="50" size="50" value="';
                                if(isset($_POST['item_Occupation'])) echo $_POST['item_Occupation'];
                        echo '" /></p>';
                        echo '<p><b>Address: </b><br /><input type="text" name="item_Address" maxlength="100" size="100" value="';
                                if(isset($_POST['item_Address'])) echo $_POST['item_Address'];
                        echo '" /></p>';
                        echo '<p><b>Phone: </b><input type="text" name="item_Phone" maxlength="20" size="20" value="';
                                if(isset($_POST['item_Phone'])) echo $_POST['item_Phone'];
                        echo '" /></p>';
                        echo '<p><b># Years on Board: </b><input type="text" name="item_Years" maxlength="3" size="5" value="';
                                if(isset($_POST['item_Years'])) echo $_POST['item_Years'];
                        echo '" onblur="extractNumber(this,0,false);" onkeyup="extractNumber(this,0,false);" onkeypress="return blockNonNumbers(this, event, false, false);" /></p>';
                        echo '<p><input type="submit" name="submit" value="Insert Board Member" /></p>';
                        echo '<input type="hidden" name="submitted" value="TRUE" />';
                        echo '</form></td></tr>';
                }
        }
        else
                echo '<tr><td><br />Entering your Board of Directors List is only available October 1 - 30.</td></tr>';
?>
                <tr>
		      <td>
		              <center><div class=nav><?php echo '<br><br><a href="eoyreports.php?center='.$center.'">Return to End of Year Reports Main Menu</a>'; ?></div></center>
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


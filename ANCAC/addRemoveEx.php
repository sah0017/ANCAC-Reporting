<?PHP

	require("ulogin.php");

	require($root."dbconn.php");



	//set the fiscalYear

        switch (date("m")){

                case 10:
                        $EOYAvailable = 1;
                        //if (date("j") < 11)
                        //
                        //        $EOYAvailable = 1;
                        //
                        //else
                        //
                        //        $EOYAvailable = 0;

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

                        $fiscalYear = date("Y") + 0;

                        $EOYAvailable = 0;

                        break;

                case 4:

                case 5:

                case 6:

                        $fiscalYear = date("Y") + 0;

                        $EOYAvailable = 0;

                        break;

                case 7:

                case 8:

                case 9:

                        $fiscalYear = date("Y") + 0;

                        $EOYAvailable = 0;

                        break;

        }



        $CY = 0;

        $LastYear = $fiscalYear - 1;

	if($_SESSION['admin'] > 0){

                $center = $_GET['center'];

                $EOYAvailable = 1;



                if (isset($_GET['Y'])){

                        if ($_GET['Y'] == 1){

                                $fiscalYear = $fiscalYear - 1;

                                $LastYear = $LastYear - 1;

                                $CY = 1;

                        }

                }



        }

        else{

                $center = $_SESSION['center'];

        }



        $sqlSubmit = "SELECT OtherExpense".

                " FROM eoyChecks".

                " WHERE center = ".$center." AND fiscalyear = ".$fiscalYear;



        $resultSubmit = @mysql_query($sqlSubmit) or mysql_error();

        $rowSubmit = mysql_fetch_object($resultSubmit);



        if($_SESSION['admin'] == 0){

                if($rowSubmit->OtherExpense == 1)

                        $EOYAvailable = 2;

        }



	$sqlCenter = "SELECT CenterName FROM centers ".

             "WHERE center = '".$center."'";

        $resultCenter = @mysql_query($sqlCenter) or mysql_error();

        $rowCenter = mysql_fetch_object($resultCenter);

        $CenterName = $rowCenter->CenterName;



	$page_title = 'Add or Remove Other Expenses for '.$CenterName;

	require($root."header.php");



?>



<body>

<table class='OutlineTable' align=center width="600px">

<tr>

	<td class='login-header' colspan='2' align=center>Add or Remove Other Expense Categories - FY <?PHP echo $fiscalYear; ?><br></td>

</tr>

<tr>

        <td class='login' align=left><br>This section is to set up new expenses outside of the list<br>of common Standard Expenses.  Please refer to your<br>End of Year instructions for the list.<br></font></td>

</tr>

<tr>

	<td class='login' align=left><br>

	<div align="center">

		<table border="0" width="600px" id="table1">

<?PHP

        $sqlOE = "SELECT OExpenseID, ExpenseName FROM otherExpenseLU WHERE center = '".$center."' AND fiscalyear = '".$fiscalYear."'";

        $resultOE = @mysql_query($sqlOE) or mysql_error();



        $numRecords = mysql_num_rows($resultOE);



        if (isset($_POST['submitted'])){

          if ($_GET['A'] == 'A'){

             //Initialize the error array

             $errors = array();

             //Validate that they did enter some info

             if (empty($_POST['other_expense'])){

                $errors[] = 'You did not enter a description for the Other Expense.';

                }

             else{

                $other_expense = $_POST['other_expense'];

             }



             if (empty($errors)){

                $sqlInsert = "INSERT INTO `otherExpenseLU` ( `center` , `ExpenseName` , `fiscalyear` , `username` , `datemod` ) ".

                      "VALUES ('".$center."', '".$other_expense."', '".$fiscalYear."','".$_SESSION['user']."', NOW())";

                $resultInsert = @mysql_query($sqlInsert);

              }

              else{//report the errors

                  echo '<tr><td colspan="2"><br>';

                  echo '<p class="Error"> The following error(s) occurred:<br>';



                  foreach ($errors as $msg){

                     echo " - $msg<br>\n";

                  }

                  echo '<br>Please try again.</p><br></td></tr>';

               }



           }

        }

        //if they have come from wanting to delete an Other Expense

        if ($_GET['A'] == 'D'){

          $sqlDelete = "DELETE FROM otherExpenseLU WHERE center = ".$center." AND OExpenseID = ".$_GET['OE']." AND fiscalyear = ".$fiscalYear;

          $resultDelete = @mysql_query($sqlDelete);



          $sqlDelete = "DELETE FROM actualOtherExpense WHERE center = ".$center." AND OExpenseID = ".$_GET['OE']." AND fiscalyear = ".$fiscalYear;

          $resultDelete = @mysql_query($sqlDelete);

          

          $sqlDelete = "DELETE FROM budgetedOtherExpense WHERE center = ".$center." AND OExpenseID = ".$_GET['OE']." AND fiscalyear = ".$fiscalYear;

          $resultDelete = @mysql_query($sqlDelete);

        }



        $sqlLYOE = "SELECT ExpenseName FROM otherExpenseLU WHERE center = '".$center."' AND fiscalyear = '".$LastYear."'";

        $resultLYOE = @mysql_query($sqlLYOE) or mysql_error();



        echo '<tr valign="top"><td width="50%">';



        $numRecordsLY = mysql_num_rows($resultLYOE);

        if ($numRecordsLY > 0){

          echo '<table width="100%" class="OutlineTable">';

          echo '<tr>';

           echo '<td colspan="2">Last FY '.$LastYear.' Other Expenses:<br><br></td></tr>';

           while ($rowLY = mysql_fetch_object($resultLYOE)) {

                 echo '<tr><td width="50%">'.$rowLY->ExpenseName.'</td>';

                }

           echo '</table>';

        }

        else{

             echo 'There were no Other Expenses input for '.$CenterName.' - Last FY '.$LastYear;

        }



        echo '</td><td>';



        $sqlOE = "SELECT OExpenseID, ExpenseName FROM otherExpenseLU WHERE center = '".$center."' AND fiscalyear = '".$fiscalYear."'";

        $resultOE = @mysql_query($sqlOE) or mysql_error();



        $numRecords = mysql_num_rows($resultOE);



        if ($numRecords > 0){

          echo '<table width="100%" class="OutlineTable">';

          echo '<tr>';

           echo '<td colspan="2">FY '.$fiscalYear.' Other Expenses:<br><br></td></tr>';

           while ($row = mysql_fetch_object($resultOE)) {

                 echo '<tr><td width="50%">'.$row->ExpenseName.'</td>';

                 if ($CY == 0){

                        if ($_SESSION['admin'] == 2)

                                echo '<td><a href="addRemoveEx.php?A=D&center='.$center.'&OE='.$row->OExpenseID.'" onclick="javascript:return confirm(\'Are you sure you want to delete this Other Expense?  If there were any budget or actual information entered, it will be deleted as well.\')"> Delete </a></td>';

                        if ($_SESSION['admin'] == 0 && $EOYAvailable == 1)

                                echo '<td><a href="addRemoveEx.php?A=D&center='.$center.'&OE='.$row->OExpenseID.'" onclick="javascript:return confirm(\'Are you sure you want to delete this Other Expense?  If there were any budget or actual information entered, it will be deleted as well.\')"> Delete </a></td>';

                 }

                 echo '</tr>';

		              // echo '<a href="centerReportAdmin.php?center='.$row->center.'">'.$row->CenterName.'</a>';



                }

           echo '</table>';

        }

        else{

             echo 'There are currently no Other Expenses input for '.$CenterName.' - FY '.$fiscalYear;;

        }



        echo '</td></tr>';



?>

		<tr>

		    <td colspan="2">

		      <?PHP if ($EOYAvailable == 1){

                          echo '<form action="addRemoveEx.php?A=A&center='.$center.'" method="post">';

                          echo '<hr>';

                          echo '<p>Input Other Expense Description: <input type="text" name="other_expense" maxlength="50" /></p>';

                          echo '<p><input type="submit" name="submit" value="Add Other Expense" /></p>';

                          echo '<input type="hidden" name="submitted" value="TRUE" />';

                          echo '</form>';

                        }

                        else{

                                if ($EOYAvailable == 2)

                                        echo '<br />You have already submitted your Other Expenses for this Fiscal Year.';

                                else

                                        echo '<br />Adding and Removing Other Expenses is only available October 1 - 10.';

                        }

                      ?>

		    </td>

		</tr>

		<tr>

		      <td colspan="2">

		              <center><div class=nav><?PHP echo '<a href="eoyreports.php?center='.$center.'">Return to End of Year Reports Main Menu</a>'; ?></div></center>

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




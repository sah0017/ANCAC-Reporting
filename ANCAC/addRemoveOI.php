<?

	require("./ulogin.php");

	require("./dbconn.php");



	//set the fiscalYear

        switch (date("m")){

                case 10:

                        if (date("j") < 11)

                                $EOYAvailable = 1;

                        else

                                $EOYAvailable = 0;

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

                        $fiscalYear = date("Y");

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



        $sqlSubmit = "SELECT OtherIncome".

                " FROM eoyChecks".

                " WHERE center = ".$center." AND fiscalyear = ".$fiscalYear;



        $resultSubmit = @mysql_query($sqlSubmit) or mysql_error();

        $rowSubmit = mysql_fetch_object($resultSubmit);



        if($_SESSION['admin'] == 0){

                if($rowSubmit->OtherIncome == 1)

                        $EOYAvailable = 2;

        }



	$sqlCenter = "SELECT CenterName FROM centers ".

             "WHERE center = '".$center."'";

        $resultCenter = @mysql_query($sqlCenter) or mysql_error();

        $rowCenter = mysql_fetch_object($resultCenter);

        $CenterName = $rowCenter->CenterName;



	$page_title = 'Add or Remove Other Incomes for '.$CenterName;

	require("./header.php");



?>



<body>

<table class='OutlineTable' align=center width="600px">

<tr>

	<td class='login-header' colspan='2' align=center>Add or Remove Other Income Categories - FY <? echo $fiscalYear; ?><br></td>

</tr>

<tr>

        <td class='login' align=left><br>This section is to set up new income sources outside of the list<br>of common Standard Income sources.  Please refer to your<br>End of Year instructions for the list.<br></font></td>

</tr>

<tr>

	<td class='login' align=left>
        <br>

	<div align="center">

		<table border="0" width="600px" id="table1">

<?

        $sqlOI = "SELECT OIncomeID, IncomeName FROM otherIncomeLU WHERE center = '".$center."' AND fiscalyear = '".$fiscalYear."'";

        $resultOI = @mysql_query($sqlOI) or mysql_error();



        $numRecords = mysql_num_rows($resultOI);



        if (isset($_POST['submitted'])){

          if ($_GET['A'] == 'A'){

             //Initialize the error array

             $errors = array();

             //Validate that they did enter some info

             if (empty($_POST['other_income'])){

                $errors[] = 'You did not enter a description for the Other Income.';

                }

             else{

                $other_income = $_POST['other_income'];

             }



             if (empty($errors)){

                $sqlInsert = "INSERT INTO `otherIncomeLU` ( `center` , `IncomeName` , `fiscalyear` , `username` , `datemod` ) ".

                      "VALUES ('".$center."', '".$other_income."', '".$fiscalYear."','".$_SESSION['user']."', NOW())";

                $resultInsert = @mysql_query($sqlInsert);



           //if ($resultInsert){

            //echo '<br>Your Other Income was inserted successfully.';

           //}

           //else {

            //echo 'Your Other Income could not be inserted';

            //echo '<p>'.mysql_error().'<br><br>Query: '.$sqlInsert.'</p>';

           //}

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

        //if they have come from wanting to delete an Other Income

        if ($_GET['A'] == 'D'){

          $sqlDelete = "DELETE FROM otherIncomeLU WHERE center = ".$center." AND OIncomeID = ".$_GET['OI']." AND fiscalyear = ".$fiscalYear;

          $resultDelete = @mysql_query($sqlDelete);

          

          $sqlDelete = "DELETE FROM actualOtherIncome WHERE center = ".$center." AND OIncomeID = ".$_GET['OI']." AND fiscalyear = ".$fiscalYear;

          $resultDelete = @mysql_query($sqlDelete);

          

          $sqlDelete = "DELETE FROM budgetedOtherIncome WHERE center = ".$center." AND OIncomeID = ".$_GET['OI']." AND fiscalyear = ".$fiscalYear;

          $resultDelete = @mysql_query($sqlDelete);

        }



        $sqlLYOI = "SELECT IncomeName FROM otherIncomeLU WHERE center = '".$center."' AND fiscalyear = '".$LastYear."'";

        $resultLYOI = @mysql_query($sqlLYOI) or mysql_error();



        echo '<tr valign="top"><td width="50%">';



        $numRecordsLY = mysql_num_rows($resultLYOI);

        if ($numRecordsLY > 0){

          echo '<table width="100%" class="OutlineTable">';

          echo '<tr>';

           echo '<td colspan="2">Last FY '.$LastYear.' Other Incomes:<br><br></td></tr>';

           while ($rowLY = mysql_fetch_object($resultLYOI)) {

                 echo '<tr><td width="50%">'.$rowLY->IncomeName.'</td>';

                }

           echo '</table>';

        }

        else{

             echo 'There were no Other Incomes input for '.$CenterName.' - Last FY '.$LastYear;

        }



        echo '</td><td>';



        $sqlOI = "SELECT OIncomeID, IncomeName FROM otherIncomeLU WHERE center = '".$center."' AND fiscalyear = '".$fiscalYear."'";

        $resultOI = @mysql_query($sqlOI) or mysql_error();



        $numRecords = mysql_num_rows($resultOI);



        if ($numRecords > 0){

          echo '<table width="100%" class="OutlineTable">';

          echo '<tr>';

           echo '<td colspan="2">FY '.$fiscalYear.' Other Incomes:<br><br></td></tr>';

           while ($row = mysql_fetch_object($resultOI)) {

                 echo '<tr><td width="50%">'.$row->IncomeName.'</td>';

                 if ($CY == 0){

                        if ($_SESSION['admin'] == 2)

                                echo '<td><a href="addRemoveOI.php?A=D&center='.$center.'&OI='.$row->OIncomeID.'" onclick="javascript:return confirm(\'Are you sure you want to delete this Other Income?  If there were any budget or actual information entered, it will be deleted as well.\')"> Delete </a></td>';

                        if ($_SESSION['admin'] == 0 && $EOYAvailable == 1)

                                echo '<td><a href="addRemoveOI.php?A=D&center='.$center.'&OI='.$row->OIncomeID.'" onclick="javascript:return confirm(\'Are you sure you want to delete this Other Income?  If there were any budget or actual information entered, it will be deleted as well.\')"> Delete </a></td>';

                 }

                 echo '</tr>';

		              // echo '<a href="centerReportAdmin.php?center='.$row->center.'">'.$row->CenterName.'</a>';



                }

           echo '</table>';

        }

        else{

             echo 'There are currently no Other Incomes input for '.$CenterName.' - FY '.$fiscalYear;;

        }



        echo '</td></tr>';



?>

		<tr>

		    <td colspan="2">

		      <? if ($EOYAvailable == 1){

                          echo '<form action="addRemoveOI.php?A=A&center='.$center.'" method="post">';

                          echo '<hr>';

                          echo '<p>Input Other Income Description: <input type="text" name="other_income" maxlength="50" /></p>';

                          echo '<p><input type="submit" name="submit" value="Add Other Income" /></p>';

                          echo '<input type="hidden" name="submitted" value="TRUE" />';

                          echo '</form>';

                        }

                        else{

                                if ($EOYAvailable == 2)

                                        echo '<br />You have already submitted your Other Incomes for this Fiscal Year.';

                                else

                                        echo '<br />Adding and Removing Other Incomes is only available October 1 - 10.';

                        }

                      ?>

		    </td>

		</tr>

		<tr>

		      <td colspan="2">

		              <center><div class=nav><?php echo '<a href="eoyreports.php?center='.$center.'">Return to End of Year Reports Main Menu</a>'; ?></div></center>

		      </td>

		</tr>

		</table>

	</div>

	</td>

</tr>

</table></div>

</body>

<?

	require("./footer.php");

?>




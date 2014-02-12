<?
	require("./ulogin.php");
	require("/home/cluster1/data/a/p/a1224426/data/dbconn.php");

	switch (date("m")){
                case 10:
                        $Available = 1;
                        $fiscalYear = date("Y") + 1;
                        break;
                case 11:
                case 12:
                        $fiscalYear = date("Y") + 1;
                        $Available = 0;
                        break;
                case 1:
                case 2:
                case 3:
                        $fiscalYear = date("Y") ;
                        $Available = 0;
                        break;
                case 4:
                case 5:
                case 6:
                        $fiscalYear = date("Y");
                        $Available = 0;
                        break;
                case 7:
                case 8:
                case 9:
                        $fiscalYear = date("Y");
                        $Available = 0;
                        break;
        }

	$centerID = $_SESSION['center'];

	$error = 0;
        //Grab all the perf Stats, Expenditures, and Funds
        $sql = "SELECT name, boardPosition, occupation, address, phone, yearsOnBoard, BODID".
                " FROM boardOfDirItem WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."'";
        $result = @mysql_query($sql) or mysql_error();

        $numRecords = mysql_num_rows($result);

        //if they have a row in the table
        if ($numRecords == 0){
                $error = 1;
        }

        if ($_SESSION['admin'] == 1)
                header('Location: http://www.alabamacacs.org/ANCAC-Online/eoyreports.php?center='.$centerID);
        else{
                if (($_SESSION['admin'] == 2) || ($Available == 1)){
                        if ($error == 1)
                                echo '"<script>alert(\'Please make sure that you have entered in the Board of Directors.\'); window.location.href = \'http://www.alabamacacs.org/ANCAC-Online/boardOfDir.php?center='.$centerID.'\';</script>"';
                        else{
                                $sqlUpdate = "UPDATE eoyChecks SET BoardOfDir = '1', ".
                                        "username = '".$_SESSION['user']."', datemod = NOW() ".
                                        "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."'";

                                $resultUpdate = @mysql_query($sqlUpdate);

                                header('Location: http://www.alabamacacs.org/ANCAC-Online/eoyreports.php?center='.$centerID);
                        }
                }
                else
                        header('Location: http://www.alabamacacs.org/ANCAC-Online/eoyreports.php?center='.$centerID);
        }
?>
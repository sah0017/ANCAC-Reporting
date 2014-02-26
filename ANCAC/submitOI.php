<?PHP
	require("/ulogin.php");
	require("/dbconn.php");

        switch (date("m")){
                case 10:
                        if (date("j") < 11)
                                $Available = 1;
                        else
                                $Available = 0;
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
                        $fiscalYear = date("Y");
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

        if ($_SESSION['admin'] == 1)
                header('Location: http://www.alabamacacs.org/ANCAC-Online/eoyreports.php?center='.$centerID);
        else{
                if (($_SESSION['admin'] == 2) || ($Available == 1)){
                        $sqlUpdate = "UPDATE eoyChecks SET OtherIncome = '1', ".
                                "username = '".$_SESSION['user']."', datemod = NOW() ".
                                "WHERE center = '".$centerID."' AND fiscalyear = '".$fiscalYear."'";

                        $resultUpdate = @mysql_query($sqlUpdate);

                        header('Location: http://www.alabamacacs.org/ANCAC-Online/eoyreports.php?center='.$centerID);
                }
                else
                        header('Location: http://www.alabamacacs.org/ANCAC-Online/eoyreports.php?center='.$centerID);
        }
?>
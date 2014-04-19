<?PHP
  if(file_exists("./Variables.php"))
	require("./Variables.php");
  else
	require("../Variables.php");
  require($root."dbconn.php");
  require($root."PasswordHash.php");

// open a session (save load time on reading in all files)
  session_start();
  header("Cache-control: private"); // IE 6 Fix.

  if (isset($_COOKIE['DVDAdmin'])) {
	$_SESSION['user'] = $_COOKIE['DVDAdmin'];
  }

//---GET SESSION DATA
  if (isset($_SESSION['user'])) {
  	$validuser = $_SESSION['user'];
  }
    
    if(!isset($validuser))
    {
//--- Make it so this works for every page by finding the current filename.
        $self = $_SERVER['PHP_SELF'];

        if($_POST['Login'] != 1)
        {
            echo "<html><head><title>ANCAC: Log-In</title><br><br><link rel='stylesheet' href='login.css' type='text/css'></head>";
            echo "<p><form method=POST action='$self'><input type=hidden name=Login value=1><div align='center' style='width=100%;'>";
            echo "<table class='loginMain' align=center><tr><td colspan='2' class='login-header' align=center>ANCAC".
                 "<div class='login-subheader'>For Centers & Admin Office</div></td></tr> <tr><br><br><td colspan='2' class='login'><br><br>Please Login</td></tr>".
                 "<tr><td class='login-left' align=right>User Name:&nbsp</td><td class='login-right'>".
                 "<input type=text NAME=username></td></tr><tr>".
                 "<td class='login-left' align=right>Password:&nbsp</td><td class='login-right'><input type=password NAME=password></td></tr>";
            echo "<tr><td colspan='2' class='login' align=center><input type=hidden value=on name=keeplog></td></tr><tr><td colspan='2' class='login' align=center><input type='SUBMIT' value='Login'><br><br></td></tr>".
            "<tr><br><br><td colspan='2' class='login'><br><br><a href=forgotpw.php>Forgot Password</a></td></tr></form></table></div><br><br>Note: This application requires cookies to be enabled.";
            exit;
        }
        else
        {

//----- Select one user's password from the database
            $sql = "SELECT RID,password,username,name,directors.center,user_level,CenterName FROM directors JOIN centers ON directors.center = centers.center ".
				   "WHERE username = '".$_POST['username']."'";
            $result = @mysql_query($sql) or mysql_error();
            $row = mysql_fetch_object($result);
            $cookie = 2;

            $hasher = new PasswordHash(8, false);
            $check = $hasher->CheckPassword($_POST['password'], $row->password);
            
            if(!$check)
            {
                echo "<p>Wrong password for ".$_POST['username'];
                exit;
            }
			elseif($cookie != 1)
            {
                $validuser = $row->username; //NR $username was undefined
                $_SESSION['user'] = $validuser;
                $_SESSION['admin'] = $row->user_level;
                $_SESSION['name'] = $row->name;
                $_SESSION['RID'] = $row->RID; //NR added RID variable
                $_SESSION['center'] = $row->center;
                $_SESSION['CenterName'] = $row->CenterName;


				if($_POST['keeplog'] == 'on')
				{
					setcookie ("DVDAdmin", $_POST['username']);
				}
				
		$sqlUpdate = "UPDATE directors SET lastlogin = NOW() WHERE username = '".$validuser."'";
		$resultUpdate = @mysql_query($sqlUpdate) or mysql_error();
            }

        }
    }
    else
    {
            $sql = "SELECT RID,name,username,email,directors.center,centerlevel,user_level,password,CenterName FROM directors JOIN centers ON directors.center = centers.center WHERE username = '$validuser'";
            $result = @mysql_query($sql) or die("could not complete the query to log you in");
            $row = mysql_fetch_object($result);
            $user = $row->username;

            if (!$user)
            {
                echo "<p>You do not have administrative access to view this page.";
                exit;
            }

                $_SESSION['user'] = $validuser;
                $_SESSION['admin'] = $row->user_level;
                $_SESSION['name'] = $row->name;
                $_SESSION['center'] = $row->center;
                $_SESSION['RID'] = $row->RID; //NR added RID variable
                $_SESSION['CenterName'] = $row->CenterName;
                $_SESSION['U1'] = $row->username;
                $_SESSION['P1'] = $row->password;

                $sqlUpdate = "UPDATE directors SET lastlogin = NOW() WHERE username = '".$validuser."'";
		$resultUpdate = @mysql_query($sqlUpdate) or mysql_error();


    }
?>

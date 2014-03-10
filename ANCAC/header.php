<?PHP
	
	//NEW WAY OF CONNECTING TO DATABASE
	
	// Include ezSQL core
	include_once "ez_sql_core.php";
	
	// Include ezSQL database specific component (in this case mySQL)
	include_once "ez_sql_mysqli.php";
	
	// Initialise database object and establish a connection
	// at the same time - db_user / db_password / db_name / db_host
	$db = new ezSQL_mysqli('ancac','','ancac','localhost');
?>
<html>
      <head>
            <title><?PHP echo $page_title; ?></title>
            <SCRIPT language="JavaScript" SRC="javaScriptFunctions.js"></SCRIPT>
      </head>
      <link rel='stylesheet' href='login.css' type='text/css' media='screen'>
      <link rel='stylesheet' href='print.css' type='text/css' media='print'>

<div class=nav><p align=right class=login-header><b>Logged in as: <?PHP echo $_SESSION['name']." (".$_SESSION['CenterName'].")"; ?></b><br>
[<a href=/ANCAC-Online/index.php>Return to Main Menu</a>] - [<a href=/ANCAC-Online/help.php>Help</a>] - [<a href=/ANCAC-Online/logout.php>Logout</a>]<br>
<br><br></p></div>
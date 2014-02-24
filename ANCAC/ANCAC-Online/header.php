<html>
      <head>
            <title><? echo $page_title; ?></title>
            <SCRIPT language="JavaScript" SRC="./javaScriptFunctions.js"></SCRIPT>
      </head>
      <link rel='stylesheet' href='./login.css' type='text/css' media='screen'>
      <link rel='stylesheet' href='./print.css' type='text/css' media='print'>

<div class=nav><p align=right class=login-header><b>Logged in as: <? echo $_SESSION['name']." (".$_SESSION['CenterName'].")"; ?></b><br>
[<a href=./index.php>Return to Main Menu</a>] - [<a href=./help.php>Help</a>] - [<a href=./logout.php>Logout</a>]<br>
<br><br></p></div>
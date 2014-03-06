<?php
	require("/home/cust1/user1224426/html/WEBPROJ/ulogin.php");
	require("/home/cust1/user1224426/data/dbconn.php");
	
	$sql = "select user_level,name,email,center from directors where username = '".$_SESSION['user']."' limit 1";
	$result = @mysql_query($sql) or die("could not complete your query");
	$row = mysql_fetch_object($result);

?>

<html>

<head>
<title></title>
<base target="main">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1252">
<!-- begin style sheets/js -->
<style TYPE="text/css">
<!--

p { font-family: verdana,arial,helvetica,sans-serif; font-size: 10pt; 
 color: #990000; font-weight:bold}

h2 { font-family: verdana,arial,helvetica,sans-serif; font-size: 10pt; 
 color: #990000; font-weight:bold}
 
.maintext { font-family: verdana,arial,helvetica,sans-serif; font-size: 9pt; 
 color: #000000}

.text { font-family: verdana,arial,helvetica,sans-serif; font-size: 9pt; 
 color: #000000}

.subtext { font-family: verdana,arial,helvetica,sans-serif; font-size: 8pt; 
 color: #000000}

A:hover {color:#687891;}

BODY {
                     scrollbar-base-color:black;
                     scrollbar-arrow-color:black;
                     scrollbar-highlight-color:800000;
                     scrollbar-3dLight-Color:800000;
                     scrollbar-shadow-color:black;
                     scrollbar-darkshadow-color:C0C0C0;
                     scrollbar-face-color:C0C0C0; }
.border
{
	color: #000000;
	font-family: verdana, arial, courier;
	font-size: 10pt; 
	background-color: transparent;
	BORDER-RIGHT: #000000 1px solid;
	BORDER-TOP: #000000 1px solid;
	BORDER-LEFT: #000000 1px solid;
	BORDER-BOTTOM: #000000 1px solid;

}

P { margin-left: 10pt; margin-right: 5pt } 

-->
</style>
</head>

<BODY BGCOLOR="white" marginheight="0" marginwidth="0" bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0" 
link="#7D0000" vlink="#7D0000" alink="#7D0000">
<table height=20 style="border-width:1; border-style:solid; border-collapse: collapse" width=774 cellpadding=0 align=left border=1 bordercolor=#000000><tr>
<TD WIDTH=100% align="right" valign="middle">
<p align=right><font color=#000000 size="1">Logged in as: <? echo $_SESSION['name']." (".$_SESSION['center'].")"; ?> - [<a href=../logout.php target=_top>Logout</a>]
</TD>

</tr></table>
</body>

</html>
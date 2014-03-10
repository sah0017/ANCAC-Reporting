<?
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

P { margin-top: 5pt; margin-bottom: 5pt; margin-left: 10pt; margin-right: 5pt } 

-->
</style>
</head>

<BODY BGCOLOR="white" marginheight="0" marginwidth="0" bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0" 
link="#7D0000" vlink="#7D0000" alink="#7D0000" background="http://www.dvdcc.com/images/slice.gif">
<table width=85% cellpadding=0 align=left><tr>
<TD WIDTH=100% align="left" valign="top">
     <p><p align=right><font color=#000000 size="2"><b><a href=main.php>Home</a></b></font><BR><BR>  

<?
	if(!$_SESSION['admin'])
	{
		echo '<p><p align=right><font color=#000000 size="2"><b>Reviews</b></font><br>';
		echo '<a href="../reviews_add_form.php">Add</a><br>';
		echo '<p><p align=right><font color=#000000 size="2"><b><a href=../account.php>Account</a></b></font><BR><BR>';
		echo '</TD></tr></table></body></html>';
		exit;
	}

?>


     <p><p align=right><font color=#000000 size="2"><b>Reviews</b></font><br>
<a href="../reviews_add_form.php">Add</a><br>
<a href="../reviews_valid_form.php">Validate</a><br>
<a href="../reviews_edit_form.php">Edit</a><br>
<a href="../reviews_del_form.php">Delete</a><br><br>

<p align=right><font color=#000000 size="2"><b>Articles</b></font><br>
<a href="../articles_add_form.php">Add</a><br>
<a href="../articles_edit_form.php">Edit</a><br>
<a href="../articles_del_form.php">Delete</a><BR><BR>   

<p align=right><font color=#000000 size="2"><b>Contests</b></font><br>
<a href="../giveaways_add_form.php">Add</a><br>
<a href="../giveaways_edit_form.php">Edit</a><br>
<a href="../giveaways_del_form.php">Delete</a><BR><BR>  

<p><p align=right><font color=#000000 size="2"><b><a href=../boxes_edit_form.php>4 Boxes</a></b></font><BR><BR>  

<p><p align=right><font color=#000000 size="2"><b><a href=../account.php>Account</a></b></font><BR><BR>  

<p><p align=right><font color=#000000 size="2"><b><a href='/cgi-bin/dada/mail.cgi?flavor=admin'>E-List</a></b></font><BR><BR>  
</TD>

</tr></table>
</body>

</html>
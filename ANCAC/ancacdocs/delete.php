<?php
require '../Variables.php';
require $root.'ulogin.php';
require $root.'header.php';

if ($_GET['d']=="1")
	$target_path = "fundingbills/";
elseif ($_GET['d']=="2")
	$target_path = "general/";
elseif ($_GET['d']=="3")
	$target_path = "minutes/";
elseif ($_GET['d']=="4")
	$target_path = "newsletters/";
else
	$target_path = "";

$path = $root ."ancacdocs/files/" . $target_path;
if(empty($_GET['f']))
	exit();
$file = str_replace(array('/', '..'), '', $_GET['f']);
$filePath = realpath($path.$file);
if($filePath !== FALSE){
	unlink($filePath);
	echo "file '".$_GET['f']."' deleted.</br><a href='".$_SERVER['HTTP_REFERER']."'>Return to previous page</a>";
}

?>
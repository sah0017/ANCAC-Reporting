<?PHP
	
	//NEW WAY OF CONNECTING TO DATABASE
	
	// Include ezSQL core
	include_once "ez_sql_core.php";
	
	// Include ezSQL database specific component (in this case mySQL)
	include_once "ez_sql_mysqli.php";
	
	// Initialise database object and establish a connection
	// at the same time - db_user / db_password / db_name / db_host
	$db = new ezSQL_mysqli('ancac','','ancac','localhost');
	// JM
?>

<html>
      <head>
            <title><?PHP echo $page_title; ?></title>
            <?php echo'<SCRIPT language="JavaScript" SRC="'.$webroot.'javaScriptFunctions.js"></SCRIPT>
             			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
						<script src="'.$webroot.'dropit.js"></script>
						<link rel="stylesheet" href="'.$webroot.'dropit.css" type="text/css" />';
           ?>
           <script>
           		$(document).ready(function() {
        	    	$('.menu').dropit({ action: 'hover' });;
        		}); 
           </script>
      		<link rel='stylesheet' href='<?php echo $webroot?>login.css' type='text/css' media='screen'>
      		<link rel='stylesheet' href='<?php echo $webroot?>print.css' type='text/css' media='print'>
      </head>

<div class=nav>
	<div class='loginInfo'> 
		<div class=login-header>
			<div class='userInfo'>Logged in as: <?PHP echo $_SESSION['name']." (".$_SESSION['CenterName'].")"; ?></div>
			<div class='userInfo'> | ANCAC | </div>
			<div class='userInfo pageTitle'><?PHP echo $page_title;?></div>
			<div class='userInfo returnToMain'><a href=<?php echo $webroot?>index.php> | Return to Main Menu</a></div>
			<div class='userInfo help'><a href=<?php echo $webroot?>help.php> | Help</a></div>
			<div class='userInfo logoutButton'><a href=<?php echo $webroot?>logout.php> | Logout</a></div>
		</div>
	</div>
	
	<div class='dropdownMenus'>
		<ul class="menu">
		    <li>
		        <a href="#">Reports</a>
		        <ul>
		            <li><a href="qreports.php">Enter/Update Quaterly Numbers</a></li>
		            <li><a href="eoyreports.php">Enter Annual Budget Numbers</a></li>
		            <li><a href="selectYear.php">Print Year To Date Reports</a></li>
		        </ul>
		    </li>
		</ul>
		
		<ul class="menu">
		    <li>
		        <a href="#">Special Functions</a>
		        <ul>
		            <li><a href="ancacdocs/">View/Update Shared Docs</a></li>
		            <li><a href="#">Update Center Info</a></li>
		        </ul>
		    </li>
		</ul>
		
		<?PHP
		if($_SESSION['admin'] > 1){
			echo '<ul class="menu">
			    <li>
			        <a href="#">Admin</a>
			        <ul>
			            <li><a href="AcctAdmin.php">Center Administration</a></li>
			            <li><a href="LastLogin.php">View Last Login for Ctrs</a></li>
			            <li><a href="email.php">E-mail Entire Network</a></li>
			            <li><a href="qreportAdmin.php?from=8">Received Snail Mail Docs</a></li>
			        </ul>
			    </li>
			</ul>
			
			<ul class="menu">
			    <li>
			        <a href="#">Reporting</a>
			        <ul>
			            <li><a href="haveSubmit.php">View Current Qtr Unsumitted Centers</a></li>
			            <li><a href="selectYearGT.php?from=2">Veiw/Print ANCAC Grant Total Report</a></li>
			            <li><a href="selectYearGT.php?from=3">Veiw/Print Estimated Budget Total Report</a></li>
			            <li><a href="qreportAdmin.php?from=9">Veiw/Print ANCAC Board of Directors</a></li>
						<li><a href="eoyProgress.php">Check End Of Year Status</a></li>
			        </ul>
			    </li>
			</ul>';
		}?>
	
	</div>
</div>

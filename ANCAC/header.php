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
            <?php echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
						<script src="dropit.js"></script>
						<link rel="stylesheet" href="dropit.css" type="text/css" />';
           ?>
           <script>
           		$(document).ready(function() {
        	    	$('.menu').dropit({ action: 'hover' });;
        		}); 
           </script>
      		<link rel='stylesheet' href='login.css' type='text/css' media='screen'>
      		<link rel='stylesheet' href='print.css' type='text/css' media='print'>
      </head>

<div class=nav>
	<div class='loginInfo'> 
		<div class=login-header>
			<div class='userInfo'>Logged in as: <?PHP echo $_SESSION['name']." (".$_SESSION['CenterName'].")"; ?></div>
			<div class='userInfo'>ANCAC</div>
			<div class='userInfo pageTitle'><?PHP echo $page_title;?></div>
			<div class='userInfo returnToMain'><a href=index.php>Return to Main Menu</a></div>
			<div class='userInfo help'><a href=help.php>Help</a></div>
			<div class='userInfo logoutButton'><a href=logout.php>Logout</a></div>
		</div>
	</div>
	
	<div class='dropdownMenus'>
		<ul class="menu">
		    <li>
		        <a href="#">Reports</a>
		        <ul>
		            <li><a href="#">Enter/Update Quaterly Numbers</a></li>
		            <li><a href="#">Enter Annual Budget Numbers</a></li>
		            <li><a href="#">Print YTD Reports</a></li>
		        </ul>
		    </li>
		</ul>
		
		<ul class="menu">
		    <li>
		        <a href="#">Dropdown2</a>
		        <ul>
		            <li><a href="#">Some Action 1</a></li>
		            <li><a href="#">Some Action 2</a></li>
		            <li><a href="#">Some Action 3</a></li>
		            <li><a href="#">Some Action 4</a></li>
		        </ul>
		    </li>
		</ul>
		
		<?PHP
		if($_SESSION['admin'] > 1){
			echo '<ul class="menu">
			    <li>
			        <a href="#">Dropdown3</a>
			        <ul>
			            <li><a href="#">Some Action 1</a></li>
			            <li><a href="#">Some Action 2</a></li>
			            <li><a href="#">Some Action 3</a></li>
			            <li><a href="#">Some Action 4</a></li>
			        </ul>
			    </li>
			</ul>
			
			<ul class="menu">
			    <li>
			        <a href="#">Dropdown4</a>
			        <ul>
			            <li><a href="#">Some Action 1</a></li>
			            <li><a href="#">Some Action 2</a></li>
			            <li><a href="#">Some Action 3</a></li>
			            <li><a href="#">Some Action 4</a></li>
			        </ul>
			    </li>
			</ul>';
		}?>
	
	</div>
</div>
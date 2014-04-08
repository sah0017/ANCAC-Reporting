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
		           
		           <?PHP 
		            //makes the links unavailable to the centers if not in the date.
		           // added webroots to the links
				        if($_SESSION['admin'] == 2)
						{
							echo '<li><a href="'.$webroot.'qreportAdmin.php">Enter/Update Quarterly Numbers</a></li>';
						}
						else
						{
							
							switch (date("m")){
								case 10:
									$fiscalYear = date("Y");
									$quarter = 3;
									if (date("j") < $Quarter4Date)
										$Available = 1;
									else
										$Available = 0;
									break;
								case 11:
								case 12:
									$fiscalYear = date("Y");
									$quarter = 4;
									$Available = 0;
									break;
								case 1:
									$fiscalYear = date("Y");
									$quarter = 4;
									if (date("j") < $Quarter1Date)
										$Available = 1;
									else
										$Available = 0;
									break;
								case 2:
									$quarter = 1;
								case 3:
									$fiscalYear = date("Y");
									$quarter = 1;
									$Available = 0;
									break;
								case 4:
									$fiscalYear = date("Y");
									$quarter = 1;
									if (date("j") < $Quarter2Date)
										$Available = 1;
									else
										$Available = 0;
									break;
								case 5:
									$quarter = 2;
								case 6:
									$fiscalYear = date("Y");
									$quarter = 2;
									$Available = 0;
									break;
								case 7:
									$fiscalYear = date("Y");
									$quarter = 2;
									if (date("j") < $Quarter3Date)
										$Available = 1;
									else
										$Available = 0;
									break;
								case 8:
									$quarter = 3;
								case 9:
									$fiscalYear = date("Y");
									$quarter = 3;
									$Available = 0;
									break;
							}
					                $center = $_SESSION['center'];
					                $sql = "SELECT completed FROM actualExpenditures WHERE center = ".$center." AND fiscalyear = ".$fiscalYear." AND quarter = ".$quarter;
					
					                $result= $db->get_row($sql);
					                
					                if (isset($result->completed)){
					                        if ($result->completed == "INC"){
					                                if ($Available == 1){
					                                      echo '<li><a href="'.$webroot.'editQuarter.php">Start Quaterly Numbers</a></li>';
					                                      echo '<li><a href="'.$webroot.'submitCQ.php">Enter/Update Quarterly Numbers</a></li>';
					                                }
					                                else{
					                                	echo '<li>Start Quarterly Numbers (Unavailable)</li>';
					                                    echo '<li>Submitt Quarterly Numbers (Unavailables)</li>';
					                                }
					                        }
					                 }//end if (isset($row->completed)){
					  }
					?>
		            <li><a href=<?php echo $webroot?>eoyreports.php>Enter Annual Budget Numbers</a></li>
		            <li><a href=<?php echo $webroot?>selectYear.php>Print Year To Date Reports</a></li>

		        </ul>
		    </li>
		</ul>
		
		<ul class="menu">
		    <li>
		        <a href="#">Special Functions</a>
		        <ul>
 <li><a href=<?php echo $webroot?>ancacdocs/index.php>View/Update Shared Docs</a></li>

		        </ul>
		    </li>
		</ul>
		
		<?PHP
		if($_SESSION['admin'] > 1){
			echo '<ul class="menu">
			    <li>
			        <a href="#">Admin</a>
			        <ul>
			            <li><a href="'.$webroot.'AcctAdmin.php">Center Administration</a></li>
			            <li><a href="' .$webroot.'LastLogin.php">View Last Login for Ctrs</a></li>
			            <li><a href="'.$webroot.'email.php">E-mail Entire Network</a></li>
			            <li><a href= "'.$webroot.'qreportAdmin.php?from=8">Received Snail Mail Docs</a></li>
      					<li><a href= "'.$webroot.'excelExportYear.php">Excel Export</a></li>
            			<li><a href= "'.$webroot.'emailForm.php">Email reminder editor</a></li>
      		
			        </ul>
			    </li>
			</ul>
			
			<ul class="menu">
			    <li>
			        <a href="#">Reporting</a>
			        <ul>
			            <li><a href="'.$webroot.'haveSubmit.php">View Current Qtr Unsubmitted Centers</a></li>
			            <li><a href="'.$webroot.'selectYearGT.php?from=2">View/Print ANCAC Grand Total Report</a></li>
			            <li><a href="'.$webroot.'selectYearGT.php?from=3">View/Print Estimated Budget Total Report</a></li>
			            <li><a href="'.$webroot.'qreportAdmin.php?from=9">View/Print ANCAC Board of Directors</a></li>
						<li><a href="'.$webroot.'eoyProgress.php">Check End Of Year Status</a></li>
			        </ul>
			    </li>
			</ul>';
		}?>
	
	</div>
</div>

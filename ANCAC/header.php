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
      
      <?php 
      if(!isset($_SESSION['year'])){
		 $_SESSION['year'] = date("Y");
	  }
      ?>

<div class=nav>
	<div class='loginInfo'> 
		<div class=login-header>
			<div class='userInfo'>Logged in as: <?PHP echo $_SESSION['name']." (".$_SESSION['CenterName'].")"; ?></div>
			<div class='userInfo'> | ANCAC | </div>
			<div class='userInfo pageTitle'> <?PHP echo $page_title;?></div>
			<div class='userInfo returnToMain'><a href=<?php echo $webroot?>index.php> | Return to Main Menu</a></div> 
			<div class='userInfo help'><a href=<?php echo $webroot?>help.php> | Help</a></div>
			<div class='userInfo logoutButton'><a href=<?php echo $webroot?>logout.php> | Logout</a></div>
			<div class='userInfo'> | Selected Fiscal Year:<?php echo $_SESSION['year']?> | </div>
			<div class='userInfo selectYear'><a href=<?php echo $webroot?>selectSessionYear.php> Select Year</a></div>
			
			
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
							echo '<li><a href="'.$webroot.'qreportAdmin.php?from=1">View/Edit Center Quarterly Numbers</a></li>';
						}
						else
						{
							
							switch (date("m")){
								case 10:
									$quarter = 4;
									if (date("j") < $Quarter4Date)
										$Available = 1;
									else
										$Available = 0;
									break;
								case 11:
								case 12:
									$quarter = 4;
									$Available = 0;
									break;
								case 1:
									$quarter = 1;
									if (date("j") < $Quarter1Date)
										$Available = 1;
									else
										$Available = 0;
									break;
								case 2:
									$quarter = 2;
								case 3:
									$quarter = 2;
									$Available = 0;
									break;
								case 4:
									$quarter = 2;
									if (date("j") < $Quarter2Date)
										$Available = 1;
									else
										$Available = 0;
									break;
								case 5:
									$quarter = 3;
								case 6:
									$quarter = 3;
									$Available = 0;
									break;
								case 7:
									$quarter = 3;
									if (date("j") < $Quarter3Date)
										$Available = 1;
									else
										$Available = 0;
									break;
								case 8:
									$quarter = 4;
								case 9:
									$quarter = 4;
									$Available = 0;
									break;
							}
							$fiscalYear = date("Y");
			                $center = $_SESSION['center'];
			                $sql = "SELECT completed FROM actualExpenditures WHERE center = ".$center." AND fiscalyear = ".$fiscalYear." AND quarter = ".$quarter;
			
			                $result= $db->get_row($sql);

	                        if (!isset($result) || $result->completed == "INC"){
	                                if ($Available == 1){
	                                      echo '<li><a href="'.$webroot.'editQuarter.php">Enter/Update Quarterly Numbers</a></li>';
	                                      echo '<li><a href="'.$webroot.'submitCQ.php">Submit Quarterly Numbers</a></li>';
	                                }
	                                else{
	                                	echo '<li><a href="#">Enter/Update Quarterly Numbers (Unavailable)</a></li>';
	                                    echo '<li><a href="#">Submit Quarterly Numbers (Unavailables)</a></li>';
	                                }
	                        }
	                        elseif($result->completed == "COM"){
	                        	echo '<li><a href="#">Quarterly Numbers Already Submitted</a></li>';
	                        }
					  }
					if($quarter == 4 && $Available == 1)
						echo "<li><a href=".$webroot."eoyreports.php>Enter Annual Budget Numbers</a></li>"
		            ?>
		            <li><a href=<?php echo $webroot?>centerReportAdmin.php>Print Year To Date Reports</a></li>

		        </ul>
		    </li>
		</ul>
		
		<ul class="menu">
		    <li>
		        <a href="#">Special Functions</a>
		        <ul>
 						<li><a href=<?php echo $webroot?>ancacdocs/index.php>View/Update Shared Docs</a></li>
						<?PHP
						if($_SESSION['admin'] == 0){
							echo '<li><a href="'.$webroot.'editAccount.php?RID='.$_SESSION['RID'].'">Edit User Account</a></li>';
							echo '<li><a href="'.$webroot.'editCenter.php?action=edit&centerNumber='.$_SESSION['center'].'">Edit Center</a></li>';
							echo '<li><a href="'.$webroot.'boardOfDirAdmin.php">Edit Board of Directors</a></li>';
							echo '<li><a href="'.$webroot.'countryForm.php">Add to "Country of Origin" list</a></li>';
						}?>
		        </ul>
		    </li>
		</ul>
		
		<?PHP
		if($_SESSION['admin'] > 1){
			echo '<ul class="menu">
			    <li>
			        <a href="#">Admin</a>
			        <ul>
			            <li><a href="'.$webroot.'centerAdmin.php">Center Administration</a></li>
            			<li><a href="'.$webroot.'AcctAdmin.php">User Administration</a></li>
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
			            <li><a href="'.$webroot.'GrandTotal.php">View/Print ANCAC Grand Total Report</a></li>
			            <li><a href="'.$webroot.'EstBudgetTotals.php">View/Print Estimated Budget Total Report</a></li>
			            <li><a href="'.$webroot.'qreportAdmin.php?from=9">View/Print ANCAC Board of Directors</a></li>
						<li><a href="'.$webroot.'eoyProgress.php">Check End Of Year Status</a></li>
			        </ul>
			    </li>
			</ul>';
		}?>
	
	</div>
</div>

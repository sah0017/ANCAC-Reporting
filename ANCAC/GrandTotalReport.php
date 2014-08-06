<?php
    require("ulogin.php");
    require($root."dbconn.php");
    require("header.php");
    require_once('reportico/reportico.php'); 
    
    
    echo '<br><br><table align="center" width="85%" border="black" class="legendTable"><tr align="center" class="legendHeader"><td>FI</td><td>EFA</td><td>ICS</td><td>EXAM</td><td>PROS</td><td>MDT</td><td>TCS</td><td>TRAF</td></tr>'. //4/8/14
		 '<tr align="center" class="legendRow"><td>Forensic Investigation</td><td>Extended Forensic Assessment</td><td>Initial Counselling Sessions</td><td>Cases with a Medical Exam</td><td>Cases referred for Prosecution</td><td>Cases Reviewed by the Multidisciplinary Team Meeting</td><td>Total Counselling Sessions</td><td>Trafficking cases</td></tr></table>'; //4/8/14
	
    
    if ($db->get_results('SELECT centers.center FROM centers JOIN actualExpenditures ON centers.center=actualExpenditures.center WHERE CenterLevel = "Full Member" AND completed = "COM" LIMIT 1')) {
        echo "<h1>Full Members</h1>";

        $q = new reportico();
        $q->clear_reportico_session = true;
        $q->initial_project = "ANCAC";
        $q->initial_report = "centerTotals.xml";
        $q->initial_execution_parameters["fiscalYear"] = intval($_SESSION['year']);
        $q->initial_execution_parameters["CenterLevel"] = "Full Member";
        $q->initial_execute_mode = "EXECUTE";
        $q->initial_output_format = "HTML";
        $q->initial_show_criteria = "hide";
        $q->output_template_parameters["show_hide_report_output_title"] = "hide";
        $q->access_mode = "REPORTOUTPUT";
        $q->session_namespace = "pilotList";
        $q->embedded_report = true;
        $q->execute();

        echo "<h2>Full Member Totals</h2>";

        $q = new reportico();
        //$q->clear_reportico_session = true;
        $q->initial_project = "ANCAC";
        $q->initial_report = "grandTotal.xml";
        $q->initial_execution_parameters["fiscalYear"] = intval($_SESSION['year']);
        $q->initial_execution_parameters["CenterLevel"] = "Full Member";
        $q->initial_execute_mode = "EXECUTE";
        $q->initial_output_format = "HTML";
        $q->initial_show_criteria = "hide";
        $q->output_template_parameters["show_hide_report_output_title"] = "hide";
        $q->access_mode = "REPORTOUTPUT";
        $q->session_namespace = "pilotTotal";
        $q->embedded_report = true;
        $q->execute();
    } else {
        echo "<h1>No Full Member Totals</h1><hr>";
    }
    if ($db->get_results('SELECT centers.center FROM centers JOIN actualExpenditures ON centers.center=actualExpenditures.center WHERE CenterLevel = "Associate" AND completed = "COM" LIMIT 1')) {
        echo "<h1>Associates</h1>";

        $q = new reportico();
        $q->clear_reportico_session = true;
        $q->initial_project = "ANCAC";
        $q->initial_report = "centerTotals.xml";
        $q->initial_execution_parameters["fiscalYear"] = intval($_SESSION['year']);
        $q->initial_execution_parameters["CenterLevel"] = "Associate";
        $q->initial_execute_mode = "EXECUTE";
        $q->initial_output_format = "HTML";
        $q->initial_show_criteria = "hide";
        $q->output_template_parameters["show_hide_report_output_title"] = "hide";
        $q->access_mode = "REPORTOUTPUT";
        $q->session_namespace = "pilotList";
        $q->embedded_report = true;
        $q->execute();

        echo "<h2>Associate Totals</h2>";

        $q = new reportico();
        //$q->clear_reportico_session = true;
        $q->initial_project = "ANCAC";
        $q->initial_report = "grandTotal.xml";
        $q->initial_execution_parameters["fiscalYear"] = intval($_SESSION['year']);
        $q->initial_execution_parameters["CenterLevel"] = "Associate";
        $q->initial_execute_mode = "EXECUTE";
        $q->initial_output_format = "HTML";
        $q->initial_show_criteria = "hide";
        $q->output_template_parameters["show_hide_report_output_title"] = "hide";
        $q->access_mode = "REPORTOUTPUT";
        $q->session_namespace = "pilotTotal";
        $q->embedded_report = true;
        $q->execute();
    } else {
        echo "<h1>No Associate Totals</h1><hr>";
    }
    if ($db->get_results('SELECT centers.center FROM centers JOIN actualExpenditures ON centers.center=actualExpenditures.center WHERE CenterLevel = "Pilot Project" AND completed = "COM" LIMIT 1')) {
        echo "<h1>Pilot Projects</h1>";

        $q = new reportico();
        $q->clear_reportico_session = true;
        $q->initial_project = "ANCAC";
        $q->initial_report = "centerTotals.xml";
        $q->initial_execution_parameters["fiscalYear"] = intval($_SESSION['year']);
        $q->initial_execution_parameters["CenterLevel"] = "Pilot Project";
        $q->initial_execute_mode = "EXECUTE";
        $q->initial_output_format = "HTML";
        $q->initial_show_criteria = "hide";
        $q->output_template_parameters["show_hide_report_output_title"] = "hide";
        $q->access_mode = "REPORTOUTPUT";
        $q->session_namespace = "pilotList";
        $q->embedded_report = true;
        $q->execute();

        echo "<h2>Pilot Project Totals</h2>";

        $q = new reportico();
        //$q->clear_reportico_session = true;
        $q->initial_project = "ANCAC";
        $q->initial_report = "grandTotal.xml";
        $q->initial_execution_parameters["fiscalYear"] = intval($_SESSION['year']);
        $q->initial_execution_parameters["CenterLevel"] = "Pilot Project";
        $q->initial_execute_mode = "EXECUTE";
        $q->initial_output_format = "HTML";
        $q->initial_show_criteria = "hide";
        $q->output_template_parameters["show_hide_report_output_title"] = "hide";
        $q->access_mode = "REPORTOUTPUT";
        $q->session_namespace = "pilotTotal";
        $q->embedded_report = true;
        $q->execute();
    } else {
        echo "<h1>No Pilot Project Totals</h1><hr>";
    }
    
    echo "<h1>Grand Totals</h1>";

        $q = new reportico();
        //$q->clear_reportico_session = true;
        $q->initial_project = "ANCAC";
        $q->initial_report = "grandTotal.xml";
        $q->initial_execution_parameters["fiscalYear"] = intval($_SESSION['year']);
        //$q->initial_execution_parameters["CenterLevel"] = "";
        $q->initial_execute_mode = "EXECUTE";
        $q->initial_output_format = "HTML";
        $q->initial_show_criteria = "hide";
        $q->output_template_parameters["show_hide_report_output_title"] = "hide";
        $q->access_mode = "REPORTOUTPUT";
        $q->session_namespace = "pilotTotal";
        $q->embedded_report = true;
        $q->execute();


require($root."footer.php");
?> 

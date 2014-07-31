<?php
    require("ulogin.php");
    require($root."dbconn.php");
    require("header.php");
    require_once('reportico/reportico.php'); 
    $q = new reportico();
    $q->clear_reportico_session = true;
    $q->initial_project = "ANCAC";
    $q->initial_report = "total.xml";
    $q->initial_execution_parameters["fiscalYear"] = intval($_SESSION['year']);
    $q->initial_execute_mode = "EXECUTE";
    $q->initial_output_format = "HTML";
    $q->access_mode = "REPORTOUTPUT";
    $q->embedded_report = true;
    $q->execute();
    
    require($root."footer.php");
?> 

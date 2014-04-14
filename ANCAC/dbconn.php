<?php
    $connect = mysql_connect('localhost', 'ancac', '') or die("could not connect to server");
    $db_select = @mysql_select_db('ancac') or die("could not select the database");
    
    //NR 04/11/14 moved all db connections to dbconn
    //NEW WAY OF CONNECTING TO DATABASE
    // Include ezSQL core
    include_once "ez_sql_core.php";
    
    // Include ezSQL database specific component (in this case mySQL)
    include_once "ez_sql_mysqli.php";
    
    // Initialise database object and establish a connection
    // at the same time - db_user / db_password / db_name / db_host
    //CHANGE THIS ONE WE GO LIVE
    $db = new ezSQL_mysqli('ancac','','ancac','localhost');
?>
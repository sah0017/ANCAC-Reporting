<?php
    $connect = mysql_connect('localhost', 'ancac', '') or die("could not connect to server");
    $db_select = @mysql_select_db('ancac') or die("could not select the database");
?>
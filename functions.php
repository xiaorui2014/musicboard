<?php
/*
***************** IMPRESSUM *******************
Studiengang:	MultiMediaTechnology
fhs-nummer:		fhs34789
Zweck:			Basisquaifikation 1 (QPT1)
Autor:			Ludwig Schamböck
*/
    include "config.php";

    if( ! $DB_NAME ) die('please create config.php, define $DB_NAME, $DB_USER, $DB_PASS there');

    try {
        $dbh = new PDO("mysql:dbname=$DB_NAME", $DB_USER, $DB_PASS);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->exec('SET CHARACTER SET utf8') ;
    } catch (Exception $e) {
        die("Problem connecting to database $DB_NAME as $DB_USER: " . $e->getMessage() );
    }
	
	session_start();
?>

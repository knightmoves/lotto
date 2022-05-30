<?php
	#this is the info for your database connection
    ####################################################################################
    ##
	$MYSQL_HOST = "127.0.0.1";
//	$MYSQL_HOST = "10.47.25.146:3306";
	$MYSQL_LOGIN = "root";
	$MYSQL_PASS = "";
	$MYSQL_DB = "lotto";
	$dbtype = "mysqli";
    ##
    ####################################################################################

	$result = mysqli_connect($MYSQL_HOST,$MYSQL_LOGIN,$MYSQL_PASS,$MYSQL_DB);
	
	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
?>
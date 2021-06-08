<!DOCTYPE html>
<html>
<head>
	<title>test</title>
</head>
<body>
	<?php
$serverName = "DESKTOP-9L996I3\SQLEXPRESS"; //serverName\instanceName

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
$connectionInfo = array( "Database"=>"Project_Library");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( !$conn ) {
    
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

?>
</body>
</html>
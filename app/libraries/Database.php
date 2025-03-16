<?php
$host = "192.168.100.42"; //Cambiar segun sus IPs
$port = "1521";
$service_name = "orcl"; 
$username = "HR";
$password = "12345";

$connection_string = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$host)(PORT=$port))(CONNECT_DATA=(SERVICE_NAME=$service_name)))";

$conn = oci_connect($username, $password, $connection_string);

if (!$conn) {
    $e = oci_error();
    die("Connection error: " . $e['message']);
}

// Return the connection for use in other files
return $conn;
?>
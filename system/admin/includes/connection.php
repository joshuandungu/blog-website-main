<?php
$servername = 'localhost'; // Hostname for the local server
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password
$database = 'blog'; // Name of the MySQL database you want to connect to

// Create a connection to the MySQL server
$con = mysqli_connect($servername, $username, $password, $database);

// Check if the connection was successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Close the connection when you're done

?>


<?php
// Database connection parameters
$servername = "localhost";
$username = "photo";
$password = "photo";
$database = "photo";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check if the database connection is successful
if (!$conn) {
  die("Connection Error". mysqli_error($conn));
}

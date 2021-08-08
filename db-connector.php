<?php
    //database properties
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vietnambuy_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    //This allows us to print Vietnamese out without font error. Combine w/ utf8_general_ci on the table, database
    mysqli_set_charset($conn, 'UTF8');

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
?>
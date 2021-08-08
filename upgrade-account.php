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

<?php
    session_start();
    if(!isset($_SESSION['userName']) or $_SESSION['userRole'] == 1 or $_SESSION['userRole'] == 2 or !isset($_SESSION['userRole'])) {
        header("location: index.php");
        exit();
    }
?>

<?php
    $userId = $_GET['user-id'];
    $sql_upgradeAccount = " UPDATE users
                            SET user_role = '2'
                            WHERE user_id = '$userId';";
    $result_upgradeAccount = $conn->query($sql_upgradeAccount);
                                
    if ($result_upgradeAccount) {
        header("location: profile.php");
        exit();
    } 
    else echo "Error: ". $conn->error;
                            
    $conn->close();
?>
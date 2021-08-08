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
    if(!isset($_SESSION['userName'])) {
        header("location: index.php");
        exit();
    }
?>

<?php
    $itemID = $_GET['item-id'];
    $uid = $_SESSION['userid'];
    $sql_delItemFromCart = "DELETE 
                            FROM shopping_cart 
                            WHERE item_id = '$itemID'
                            AND user_id = '$uid';";
    $result_delItemFromCart = $conn->query($sql_delItemFromCart);
                                
    if ($result_delItemFromCart) {
        header("location: cart.php");
        exit();
    } 
    else echo "Error: ". $conn->error;
                            
    $conn->close();
?>
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
    if(!isset($_SESSION['userName']) or $_SESSION['userRole'] == 0 or !isset($_SESSION['userRole'])) {
        header("location: index.php");
        exit();
    }
?>

<?php
    $itemID = $_GET['item-id'];
    
    $sql_delItemInBridgeTable = "   DELETE 
                                    FROM items_categories_bridge
                                    WHERE item_id = '$itemID';";
    $result_delItemInBridgeTable = $conn->query($sql_delItemInBridgeTable);
    
    $sql_delItemInCart = "  DELETE 
                            FROM shopping_cart
                            WHERE item_id = '$itemID';";
    $result_delItemInCart = $conn->query($sql_delItemInCart);
    
    $sql_delItem = "DELETE 
                    FROM items 
                    WHERE item_id = '$itemID';";
    $result_delItem = $conn->query($sql_delItem);
                                
    if ($result_delItem) {
        header("location: manage-item.php");
        exit();
    } 
    else echo "Error: ". $conn->error;
                            
    $conn->close();
?>
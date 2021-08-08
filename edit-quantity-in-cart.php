<?php
    include 'db-connector.php';
?>

<?php
    session_start();
    if(!isset($_SESSION['userName'])) {
        header("location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Category Edit</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="style/edit-quantity-in-cart.css">
    </head>
    <body>
        <?php
            include 'menu.php';
        ?>
        
        <?php
            $userID = $_SESSION['userid'];
            $itemID = $_GET['item-id'];
        
            
        ?>
        <main>
            <div class="edit-quantity-in-cart-page-container">
                <div class="edit-quantity-in-cart-form-container">
                    <a href='cart.php'>
                        <i class="glyphicon glyphicon-arrow-left"></i>
                    </a>
                    <button class='refreshbtn' onClick='window.location.href=window.location.href'>
                        <i class='fa fa-refresh'></i>
                    </button>
                    
                    <?php
                        // data update process
                                if(isset($_POST['update'])){
                                    $newQuantity = $_POST['new-quantity'];

                                    $sql_quantityUpdate = " UPDATE shopping_cart 
                                                            SET quantity='$newQuantity' 
                                                            WHERE user_id ='$userID'
                                                            AND item_id = '$itemID'";
                                    if ($conn->query($sql_quantityUpdate) === TRUE) {
                                        echo "<div class='green-alert-message'>Edit successfully</div>";
                                    } 
                                    else echo "Error: ". $conn->error;
                                }
                    ?>
                    
                    <head>
                        <h1>Quantity Edit</h1>
                    </head>
                    <form method="POST">
                            <?php
                                $sql_getItemFromCart = "SELECT sc.item_id, sc.quantity, i.item_name, i.item_img
                                        FROM shopping_cart sc
                                        JOIN items i
                                        ON i.item_id = sc.item_id
                                        WHERE sc.user_id = '$userID'
                                        AND sc.item_id = '$itemID'";
                                $result_getItemFromCart = $conn->query($sql_getItemFromCart);
                                $row = $result_getItemFromCart->fetch_assoc();

                        // show data
                                echo "<div class='card-item-container-in-shopping-cart'>";
                                    echo "<div class='img-in-shopping-cart'>";
                                        echo "<a href='item-detail.php?item-id=".$row['item_id']."'>";
                                            echo "<img alt='item-img' src='imgs/".$row['item_img']."'>";
                                        echo "</a>";
                                    echo "</div>";
                                    echo "<div class='details-in-shopping-cart'>";
                                        echo "<a class='item-name' href='item-detail.php?item-id=".$row['item_id']."'>";
                                            echo "<p>".$row['item_name']."</p>";
                                        echo "</a>";
                                        echo "<label>Số lượng: </label>";
                                        echo "<input class='input-field' type='number' min='1' name='new-quantity' value='".$row['quantity']."'>";
                                        echo "<input class='updatebtn' type='submit' name='update' value='Update'>";

                                    echo "</div>";
                                echo "</div>";
                            ?>
                    </form>
                </div>
            </div>
            <?php include 'scroll-top-button.php'; ?>
        </main>
            
        

        <!-- Footer -->
        <?php
            include 'footer.php';
        ?>
    </body>
    
    <?php
        //close the database connection
        $conn->close();
    ?>
    
</html>
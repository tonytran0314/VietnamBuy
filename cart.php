<?php
    include 'db-connector.php';
    session_start();
    if(!isset($_SESSION['userName'])) {
        header("location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/cart.css">
    </head>
    <body>
        <?php
            include 'menu.php';
        ?>
        
        <main>
            <div class="my-cart-container">
<!-- show all items -->
                <?php
// get items in cart sql
                    $sql_getCart = "SELECT sc.*, i.*
                                    FROM shopping_cart sc
                                    JOIN items i
                                    ON i.item_id = sc.item_id
                                    WHERE user_id = $userID;";
                    $result_getCart = $conn->query($sql_getCart);
                ?>
                <head>
                    <h1>Shopping Cart</h1>
                </head>
<!-- How many items in cart and total price of all items -->
                    <?php
                        if ($numItemInCart == 0) 
                            echo "Your shopping cart is empty. <a href='index.php'>Shopping</a>";
                        else
                            echo "<p><b>".$numItemInCart."</b> item(s) in shopping cart</p>";
                    ?>
                    
                    <?php
                        $totalPriceOfAllItemsInCart = 0;
                        $sql_getTotalPriceAllItems = "SELECT sc.*, i.*
                                    FROM shopping_cart sc
                                    JOIN items i
                                    ON i.item_id = sc.item_id
                                    WHERE user_id = $userID;";
                        $result_getTotalPriceAllItems = $conn->query($sql_getTotalPriceAllItems);
                        while($row_getTotalPriceAllItems = $result_getTotalPriceAllItems->fetch_assoc()) {
                            $totalPriceOfItem = $row_getTotalPriceAllItems['quantity'] * $row_getTotalPriceAllItems['item_price'];
                            $totalPriceOfAllItemsInCart = $totalPriceOfAllItemsInCart + $totalPriceOfItem;
                        }
                        
                        if ($totalPriceOfAllItemsInCart != 0) 
                            echo "<p>Total price: <b>$".$totalPriceOfAllItemsInCart."</b></p>";
                    ?>
                    
                    
                        
                    <br>
                    <br>
                        <?php
                            
                            if ($result_getCart->num_rows > 0) {
                                while($row = $result_getCart->fetch_assoc()) {
                                    
                                    $numItemInCart = $numItemInCart + $row['quantity'];
                                    
                                    
                                    echo "<div class='card-item-container-in-shopping-cart'>";
                                        echo "<div class='img-in-shopping-cart'>";
                                            echo "<a href='item-detail.php?item-id=".$row['item_id']."'>";
                                                echo "<img alt='item-img' src='imgs/".$row['item_img']."'>";
                                            echo "</a>";
                                        echo "</div>";
                                        echo "<div class='details-in-shopping-cart'>";
                                            echo "<a href='item-detail.php?item-id=".$row['item_id']."'>";
                                                echo "<p>".$row['item_name']."</p>";
                                            echo "</a>";
                                    
                                            echo "Giá: $".$row['item_price'];
                                    
                                            echo "<p>Số lượng: ".$row['quantity']."</p>";
                                    
                                            echo "<a href='edit-quantity-in-cart.php?item-id=".$row['item_id']."'><i class='glyphicon glyphicon-edit'></i></a>";
                                            echo "&nbsp&nbsp";
                                            echo "<a href='delete-item-in-cart.php?item-id=".$row['item_id']."'><i class='glyphicon glyphicon-trash'></i></a>";
                                        echo "</div>";
                                    echo "</div>";
                                }
                            } 
                        ?>
                <div class='clear'></div>
            </div>
            <?php include 'scroll-top-button.php'; ?>
        </main>
        <?php include 'footer.php'; ?>
    </body>
    <?php $conn->close(); ?>
</html>
<?php
    include 'db-connector.php';
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Vietnam Buy</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/item-detail.css">
        <link rel="stylesheet" href="style/related-items.css">
        <link rel="stylesheet" href="style/comments.css">
        <link rel="stylesheet" href="style/demo-multi-img-slide.css">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>       
    </head>
    <body>
        <?php include 'menu.php'; ?>
        
        <main>
            <!-- Item details -->
            <div class="my-item-detail-container">
                <?php
                    $itemID = $_GET['item-id'];
                    $catesIdOfItems = array(); 
                
                    $sql_getItems = "SELECT * FROM items WHERE item_id = '$itemID'";
                    $result_getItems = $conn->query($sql_getItems);
                    $sql_getCate = "SELECT c.* FROM categories c 
                                    JOIN items_categories_bridge b ON c.category_id = b.category_id 
                                    JOIN items i ON b.item_id = i.item_id 
                                    WHERE i.item_id = '$itemID'";
                    $result_getCate = $conn->query($sql_getCate);
                    
                    if ($result_getItems->num_rows == 1) {
                        $row_getItems = $result_getItems->fetch_assoc();
                        echo "<div>";
                            echo "<img src='imgs/".$row_getItems['item_img']."' class='my-img-item-detail'>";
                        echo "</div>";
                        echo "<div class='my-des-item-detail'>";
                            echo "<h1>";
                                echo $row_getItems['item_name'];
                            echo "</h1>";
                            echo "<p>";
                                echo "$".$row_getItems['item_price'];
                            echo "</p>";
                        echo "<br>";
                            $numOfId = $result_getCate->num_rows;
                            for ($count = 0; $count < $numOfId; $count++) {
                                $row_getCate = $result_getCate->fetch_assoc();
                                echo "<a class='category' href='items-by-type.php?category-id=".$row_getCate['category_id']."'>";
                                    echo "<span>".$row_getCate['category_name']."</span>";
                                echo "</a>";
                                $catesIdOfItems[$count] = $row_getCate['category_id'];
                            }
                            echo "<br>";
                        
                        // item quantity need to add to cart
                            echo "<form method='POST'>";
                                echo '<label>Quantity:</label>';
                                echo '<input class="input-field" type="number" name="quantity" value="1" min="1"><br><br>';
                        // add to cart button
                                echo "<button type='submit' name='addToCart'><i class='fa fa-shopping-cart'></i></button>";
                            echo "</form>";
                        
                        // add to cart process    
                            if(isset($_POST['addToCart'])){
                                if(isset($_SESSION['userid'])){
                                    $userID = $_SESSION['userid'];
                                    $itemID = $_GET['item-id'];
                                    $quantity = $_POST['quantity'];
                                    
                                    // check if both user_id and item_id exists ? (Kiểm tra xem khách hàng có đặt hàng này chưa, nếu rồi chỉ cần tăng số lượng, nếu chưa thì thêm mới dữ liệu vào bảng)
                                    $sql_shoppingCartCheck = "  SELECT user_id, item_id, quantity FROM shopping_cart
                                                                WHERE user_id = '$userID' AND item_id = '$itemID';";
                                    $result_shoppingCartCheck = $conn->query($sql_shoppingCartCheck);
                                    $row = $result_shoppingCartCheck->fetch_assoc();
                                    
                                    if($result_shoppingCartCheck->num_rows > 0) {
                                        $quantityInTable = $row['quantity'];
                                        $quantityUpdate = $quantityInTable + $quantity;
                                        $sql_addToCart = "  UPDATE shopping_cart SET quantity = $quantityUpdate  
                                                            WHERE user_id = '$userID' AND item_id = '$itemID';";
                                        $result_addToCart = $conn->query($sql_addToCart);
                                    
                                        header("location: cart.php");
                                        exit();
                                    } else {
                                        $sql_addToCart = "  INSERT INTO shopping_cart (user_id, item_id, quantity)
                                                            VALUES ($userID, $itemID, $quantity);";
                                        $result_addToCart = $conn->query($sql_addToCart);
                                    
                                        header("location: cart.php");
                                        exit();
                                    }
                                } else {
                                    header("location: login.php");
                                    
                                    // exit();
                                }
                            }
                        echo "</div>";
                    } 
                
                    else {
                        header("location: index.php");
                        exit();
                    }
                ?>
                
                
            </div>
            <div class="my-clearfix"></div>
            
            <!-- Related items -->
            <div class="related-items-container">
                <h2>Sản phẩm cùng loại</h2>
                <?php include 'demo-multi-img-slide.php'; ?>
                <?php
                    $currentItemId = $_GET['item-id'];
                    for ($count = 0; $count < count($catesIdOfItems); $count++) {

                        $categoryID = $catesIdOfItems[$count];
                        
                        $sql_getCateName = "SELECT category_name FROM categories WHERE category_id = '$categoryID'";
                        $result_getCateName = $conn->query($sql_getCateName);
                        $row_getCateName = $result_getCateName->fetch_assoc();
                        
                        $sql_getItemsInCate = " SELECT i.* FROM items i 
                                                JOIN items_categories_bridge b ON i.item_id = b.item_id
                                                WHERE b.category_id = '$categoryID'
                                                AND i.item_id != '$currentItemId' 
                                                ORDER BY i.item_id DESC LIMIT 5";
                        $result_getItemsInCate = $conn->query($sql_getItemsInCate);
                        if ($result_getItemsInCate->num_rows > 0) {
                            echo "<h3>".$row_getCateName['category_name']."</h3>";

                        
                            echo '<button id="prevBtn"><i class="fas fa-angle-left"></i></button>';
                            echo '<button id="nextBtn"><i class="fas fa-angle-right"></i></button>';
                        }
                        echo '<div class="related-items-row">';
                        if ($result_getItemsInCate->num_rows > 0) {
                            while($row_getItemsInCate = $result_getItemsInCate->fetch_assoc()) {
                                
                                // echo "<div class='card'>";
                                //     echo "<a href='item-detail.php?item-id=".$row_getItemsInCate['item_id']."'>";
                                //         echo "<div class='my-itemImg'>";
                                //             echo "<img src='imgs/".$row_getItemsInCate['item_img']."'>";
                                //         echo "</div>";
                                //     echo "</a>";
                                // echo "</div>";
                                
                                echo "<div class='card'>";
                                    echo "<a href='item-detail.php?item-id=".$row_getItemsInCate['item_id']."'>";
                                        echo '<div class="carousel-slide">';
                                            echo "<img src='imgs/".$row_getItemsInCate['item_img']."'>";
                                        echo '</div>';
                                    echo "</a>";
                                echo "</div>";

                            }
                        }
                        echo '</div>';
                    }
                ?>
            </div>
            <div class="my-clearfix"></div>

            <!-- Comments -->
            <div class="comments-container">
                <div class="add-comment-container">
                    <form method="POST">
                        <div class="rating">1 2 3 4 5</div>
                        <div class="subject">
                            <textarea placeholder="Subject..."></textarea>
                        </div>
                        <div class="clear-float"></div>
                        <div class="comment-content">
                        <textarea placeholder="Comment..."></textarea>
                        </div>
                        <button type="submit" name="comment">Comment</button>
                        <?php
                            if(isset($_POST['comment'])) {
                                echo "Hi";
                            }
                        ?>
                    </form>
                </div>
                <?php
                    $sql_getComments = "SELECT u.*, i.*, c.* FROM users u
                                        JOIN comments c USING (user_id)
                                        JOIN items i USING (item_id)
                                        WHERE item_id = $itemID";
                    $result_getComments = $conn->query($sql_getComments);
                    if($result_getComments->num_rows > 0) {
                        while($row_getComments = $result_getComments->fetch_assoc()) {
                            echo '<div class="comment-card">';
                                echo '<div class="comment-header">';
                                    echo '<div class="user-name">';
                                        echo '<img src="imgs/'.$row_getComments['user_img'].'">';
                                        echo '<p>'.$row_getComments['user_first_name'].' '.$row_getComments['user_last_name'].'</p>';
                                        echo '<div class="clear-float"></div>';
                                    echo '</div>';
                                    echo '<div class="rating-subject">';
                                        echo '<img src="imgs/five-stars-rating.jpg">';
                                        echo '<p>Very good</p>';
                                        echo '<div class="clear-float"></div>';
                                    echo ' </div>';
                                    echo '<div class="date-time">';
                                        echo '<p>'.$row_getComments['comment_datetime'].'</p>';
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="comment-body">';
                                    echo '<span>'.$row_getComments['comment_content'].'</span>';
                                echo '</div>';
                                echo '<div class="comment-footer">';
                                    echo '<p>'.$row_getComments['comment_helpful'].' people see this comment helpful</p>';
                                    echo '<button>Helpful</button>';
                                echo '</div>';
                                echo '</div>';
                        }
                    } else echo "No comments";
                ?>
            </div>
            <div class="my-clearfix"></div>
            <?php include 'scroll-top-button.php'; ?>
        </main>
            
        <?php include 'footer.php'; ?>
    </body>
    <?php $conn->close(); ?>
</html>
<?php
    include 'db-connector.php';
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Items by types</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/item-by-type.css">
    </head>
    <body>
        <?php include 'menu.php'; ?>
        
        <main>
            <div class="my-container">
                <!-- show items by types -->
                <div class="category-container">
                        <?php
                            
                            if (!isset($_GET['category-id'])) {
                                $categoryId = 1;
                            }
                            $categoryId = $_GET['category-id'];
                            
                            // get item name
                            $sql_getItemsByTypes = "SELECT i.* 
                                                    FROM items i 
                                                    JOIN items_categories_bridge b 
                                                        ON i.item_id = b.item_id 
                                                    JOIN categories c 
                                                        ON b.category_id = c.category_id 
                                                    WHERE c.category_id = '$categoryId'
                                                    ORDER BY i.item_id DESC";
                            $result_getItemsByTypes = $conn->query($sql_getItemsByTypes);
                            
                            // get category name if item > 0
                            $sql_getCateName = "SELECT c.category_name 
                                                FROM items i 
                                                JOIN items_categories_bridge b 
                                                    ON i.item_id = b.item_id 
                                                JOIN categories c 
                                                    ON b.category_id = c.category_id 
                                                WHERE c.category_id = '$categoryId'";
                            $result_getCateName = $conn->query($sql_getCateName );
                            $row_getCateName = $result_getCateName->fetch_assoc();
                    
                            // get category name if item = 0
                            $sql_getCateNameNoneItem = "SELECT category_name 
                                                FROM categories 
                                                WHERE category_id = '$categoryId'";
                            $result_getCateNameNoneItem = $conn->query($sql_getCateNameNoneItem );
                            $row_getCateNameNoneItem = $result_getCateNameNoneItem->fetch_assoc();
                            
                            if($result_getItemsByTypes->num_rows > 0) {
                                echo "<head>";
                                    echo "<h1>CATEGORY: ".$row_getCateName['category_name']."</h1>";
                                echo "</head>";
                            }
                            else {
                                echo "<head>";
                                    echo "<h1>CATEGORY: ".$row_getCateNameNoneItem['category_name']."</h1>";
                                echo "</head>";
                            }
                    
                            //display table loop
                            if ($result_getItemsByTypes->num_rows > 0) {
                                while($row = $result_getItemsByTypes->fetch_assoc()) {
//                                    echo "<a href='item-detail.php?item-id=".$row['item_id']."'>".$row['item_name']."</a>";
//                                    echo "<br>";
                                    echo "<div class='my-card'>";
                                        echo "<a href='item-detail.php?item-id=".$row['item_id']."'>";
                                            echo "<div class='my-itemImg'>";
                                                echo "<img src='imgs/".$row['item_img']."'>";
                                            echo "</div>";
                                            echo "<br>";
                                            echo "<div>";
                                                echo "<p>".$row['item_name']."</p>";
                                                echo "<p>Giá: $".$row['item_price']."</p>"; 
                                            echo "</div>"; 
                                        echo "</a>";
                                    echo "</div>";
                                }
                            } 
                            else {
                              echo "Chưa có sản phẩm nào trong loại này";
                            }

                            //close the database connection
                            $conn->close();
                        ?>
                </div>
                <!-- show items by types -->
            </div>
            <div class="my-clearfix"></div>
            <?php include 'scroll-top-button.php'; ?>
        </main>
            
        <?php include 'footer.php'; ?>
    </body>
</html>
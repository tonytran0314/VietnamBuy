<?php
    include 'db-connector.php';
    session_start();
    if(!isset($_SESSION['userName']) or $_SESSION['userRole'] == 0 or !isset($_SESSION['userRole'])) {
        header("location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Item</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/edit-item.css">
    </head>
    <body>
        <?php
            include 'menu.php';
        ?>
        
        <main>
            <div class="edit-item-page-container">
                <div class="edit-item-form-container">
                    <a href='manage-item.php'><i class="glyphicon glyphicon-arrow-left"></i></a>
                    <h1>Item edit</h1>
                    <?php
                        $itemid = $_GET['item-id'];
                        $sql_getItemDetail = "  SELECT *
                                                FROM items
                                                WHERE item_id = $itemid;";
                        $result_getItemDetail = $conn->query($sql_getItemDetail);
                        $row_getItemDetail = $result_getItemDetail->fetch_assoc();
                    ?>
                    <form method="POST">
                        <label>Tên sản phẩm:</label>
                        <input class="input-field" type="text" name="item-name" value="<?php echo $row_getItemDetail['item_name']; ?>">
                        
                        <label>Giá sản phẩm ($):</label>
                        <input class="input-field" type="text" name="item-price" value="<?php echo $row_getItemDetail['item_price']; ?>">
                        
        <!-- use loop if more than 1 category  -->
                        <label>Sản phẩm thuộc những loại:</label>
                        <input class="input-field" list="categories" name="item-categories" id="item-categories">
                        <datalist id="categories">
                            <?php
                                $sql_getAllCategories = "SELECT * FROM categories;";
                                $result_getAllCategories = $conn->query($sql_getAllCategories);

                                if ($result_getAllCategories->num_rows > 0) {
                                    while($row = $result_getAllCategories->fetch_assoc()) {
                                        echo "<option value='".$row['category_name']."'>";
                                    }
                                }
                                else echo "0 results";
                            ?>
                        </datalist>
        <!-- use loop if more than 1 category  -->
                        <br>
                        <br>
                        <label>Hình ảnh sản phẩm: </label>
                        <img src="imgs/<?php echo $row_getItemDetail['item_img']; ?>" width="100px" height="100px">
                        <input type="file" name="item-img" accept="image/*">
                        <br>
                        <br>
                        <input type="submit" name="add-item" class="editbtn" value="edit">
                    </form>
        <!-- Add item process -->
                    <?php
                        if(isset($_POST['add-item'])){
                            $itemName = $_POST['item-name'];
                            $itemPrice = $_POST['item-price'];
        // use loop if more than 1 category 
                            $itemCates = $_POST['item-categories'];
        // use loop if more than 1 category 

                            $itemImg = $_POST['item-img'];

                            $sql_addItem = "INSERT 
                                            INTO items (item_name, item_price, item_img)
                                            VALUES ('$itemName', '$itemPrice', '$itemImg');";
                            $result_addItem = $conn->query($sql_addItem);


                            $sql_getItemID = "  SELECT item_id
                                                FROM items
                                                WHERE item_name = '$itemName'";
                            $result_getItemID = $conn->query($sql_getItemID);
                            $row_getItemID = $result_getItemID->fetch_assoc();
                            $itemID = $row_getItemID['item_id'];

        // use loop if more than 1 category             
                            $sql_getCateIDs = "   SELECT category_id
                                                    FROM categories
                                                    WHERE category_name = '$itemCates'";
                            $result_getCateIDs = $conn->query($sql_getCateIDs);
                            $row_getCateIDs = $result_getCateIDs->fetch_assoc();
                            $cateIDs = $row_getCateIDs['category_id'];
        // use loop if more than 1 category 

        // use loop if more than 1 category 
                            $sql_setCatesForItem = "INSERT 
                                                    INTO items_categories_bridge (item_id, category_id)
                                                    VALUES ('$itemID', '$cateIDs');";
                            $result_setCatesForItem = $conn->query($sql_setCatesForItem);
        // use loop if more than 1 category 


                            if ($result_setCatesForItem) {
                                header("location: manage-item.php");
                                exit();
                            } 
                            else echo "Error: ". $conn->error;

                            $conn->close();
                        }
                    ?>
                </div>
            </div>
            <?php include 'scroll-top-button.php'; ?>
        </main>
            
        

        <!-- Footer -->
        <?php
            include 'footer.php';
        ?>
    </body>
</html>
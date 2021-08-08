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
        <title>Items Management</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/add-item.css">
    </head>
    <body>
        <?php
            include 'menu.php';
        ?>
        
        <main>
            <div class="add-item-page-container">
                <div class="add-item-form-container">
                    <a href='manage-item.php'><i class="glyphicon glyphicon-arrow-left"></i></a>
                    <h1>Add item</h1>
                    <form method="POST">
                        <input type="text" name="item-name" placeholder="Tên sản phẩm" class="input-field">

                        <input type="text" name="item-price" placeholder="Giá sản phẩm" class="input-field">

                        <label>Sản phẩm thuộc những loại: </label>

                        <input list="categories" name="item-categories" id="item-categories" class="input-field">
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
                        <label>Hình ảnh sản phẩm: </label>
                        <input type="file" name="item-img" accept="image/*">
                        <input type="submit" name="add-item" class="addbtn" value="add">
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
        <?php include 'footer.php'; ?>
    </body>
</html>
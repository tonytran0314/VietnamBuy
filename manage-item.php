<?php
    include 'db-connector.php';
?>

<?php
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
        <link rel="stylesheet" href="style/manage-item.css">
        <link rel="stylesheet" href="style/page-list.css">
        <link rel="stylesheet" href="style/admin.css">
    </head>
    <body>
        <?php
            include 'menu.php';
        ?>
        
        <main>
            <div>
                <head>
                    <h1>Items management</h1>
                </head>
                <ul class="manage-menu-of-admin-ul">
                    <li><a href="manage-item.php">Quản lý hàng hóa</a></li>
                    <li><a href="manage-category.php">Quản lý loại</a></li>
                </ul>
            </div>
            
            <div class="my-item-management-container">
                <p><a href="add-item.php" class="add-item"><i class='glyphicon glyphicon-plus'></i></a></p>
                <div>
                    <?php
                    // Pagination
                        
                        // Get all items
                        $sql_countItems = " SELECT * 
                                            FROM items;";
                        $result_countItems = $conn->query($sql_countItems);
                    
                        $totalItems = $result_countItems->num_rows;
                        // Get all items
                    
                        $itemsPerPage = 15;
                        
                        $numOfPage = ceil($totalItems / $itemsPerPage);
                    
                        if (isset($_GET['pageno']) and $_GET['pageno'] <= $numOfPage) {
                            $pageno = $_GET['pageno'];
                        } 
                        else if (!isset($_GET['pageno']) or $_GET['pageno'] > $numOfPage) {
                            header("location: manage-item.php?pageno=1");
                        }
                    
                        $excludeRecords = ($pageno-1) * $itemsPerPage;
                        
                        
                        // Pagination query
                        $sql_getAllItems = " SELECT * 
                                            FROM items 
                                            ORDER BY item_id DESC
                                            LIMIT $excludeRecords, $itemsPerPage;";
                        $result_getAllItems = $conn->query($sql_getAllItems);
                        // Pagination query
                        
                    
                        if ($result_getAllItems->num_rows > 0) {
                            while($row = $result_getAllItems->fetch_assoc()) {
                                echo "<div class='my-card'>";
                                    echo "<a href='item-detail.php?item-id=".$row['item_id']."'>";
                                        echo "<div class='my-itemImg'>";
                                            echo "<img src='imgs/".$row['item_img']."'>";
                                        echo "</div>";
                                        echo "<div>";
                                            echo "<p>".$row['item_name']."</p>";
                                             
                                        echo "</div>";
                                    echo "</a>";
                                    echo "Giá: $".$row['item_price'];
                                echo "<br>";
                                echo "<a href='edit-item.php?item-id=".$row['item_id']."'><i class='glyphicon glyphicon-edit'></i></a>";
                                echo "&nbsp&nbsp&nbsp";
                                echo "<a href='delete-item.php?item-id=".$row['item_id']."'><i class='glyphicon glyphicon-trash'></i></a>";
                                echo "</div>";
                            }
                        } 
                        else {
                          echo "0 results";
                        }
                    ?>
                    
                </div>
                <div class="my-clearfix"></div>
                <!-- show all items -->
                
                    <div class="page-list-container">
                        <ul class="page-list-ul">
                            <?php
                                for ($count = 1; $count <= $numOfPage; $count++) {
                                    echo "<li class='page-list-li'><a href='manage-item.php?pageno=".$count."' class='page-list-a'>".$count."</a></li>";
                                }
                            ?>

                        </ul>
                    </div>
            </div>
            <div class="my-clearfix"></div>
            <?php include 'scroll-top-button.php'; ?>
        </main>
            
        

        <!-- Footer -->
        <?php
            include 'footer.php';
        ?>
    </body>
</html>
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
        <title>Categories Management</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/manage-category.css">
        <link rel="stylesheet" href="style/admin.css">
        
    </head>
    <body>
        <?php
            include 'menu.php';
        ?>
        
        
        <main>
            <head>
                <h1>Categories management</h1>
            </head>
            <ul class="manage-menu-of-admin-ul">
                <li class="admin-li"><a href="manage-item.php" class="admin-a">Quản lý hàng hóa</a></li>
                <li class="admin-li"><a href="manage-category.php" class="admin-a">Quản lý loại</a></li>
            </ul>
            <div class="manage-category-container">
                    
                
                    
                <table border="1px solid">
                    <tr>
                        <th>Tên loại sản phẩm</th>
                        <th colspan="2">Thao tác</th>
                    </tr>
                    <?php
                        //select item_name columns
                        $sql_getAllCates = "SELECT * FROM categories;";
                        $result_getAllCates = $conn->query($sql_getAllCates);

                        //show table loop
                        if ($result_getAllCates->num_rows > 0) {
                            while($row = $result_getAllCates->fetch_assoc()) {
                                echo "<tr>";
                                    echo "<td>".$row['category_name']."</td>";
                                    echo "<td class='function'><a href='edit-category.php?category-id=".$row['category_id']."'><i class='glyphicon glyphicon-edit'></i></td></a>";
                                    echo "<td class='function'><a href='delete-category.php?category-id=".$row['category_id']."' name='del'><i class='glyphicon glyphicon-trash'></i></a></td>";
                                echo "</tr>";
                            }
                            echo "<td colspan='3' class='function'><a href='add-category.php'><i class='glyphicon glyphicon-plus'></i></a></td>";
                        } 
                        else {
                          echo "0 results";
                        }
                    ?>
                </table>
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
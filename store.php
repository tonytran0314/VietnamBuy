<?php
    include 'db-connector.php';
?>

<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Your Store</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/getItem-index.css">
        <link rel="stylesheet" href="style/category.css">
        <link rel="stylesheet" href="style/page-list.css">
    </head>
    <body>
        
        <?php
            // menu
            include 'menu.php';
        ?>
        
        <main>
            <div class="content-container">
                <?php
                    $user_id = $_SESSION['userid'];
                    $sql_getItemFromStore = "   SELECT item_name, user_name FROM items 
                                                JOIN store USING (item_id) 
                                                JOIN users USING (user_id)
                                                WHERE user_id = $user_id;";
                    $result_getItemNum = $conn->query($sql_getItemFromStore);
                    
                    if ($result_getItemNum->num_rows > 0) {
                        while($row_getItemNum = $result_getItemNum->fetch_assoc()) {
                            echo $row_getItemNum['item_name'] ;
                        }
                    }
                    else echo "No records";
                ?>
            </div>
            <div class="my-clearfix"></div>
            <?php include 'scroll-top-button.php'; ?>
        </main>
        
        <?php
            // footer
            include 'footer.php';
        ?>
    </body>
    <?php
        //close the database connection
        $conn->close();
    ?>
</html>
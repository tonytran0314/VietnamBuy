<?php
    include 'db-connector.php';
    session_start();
    if(!isset($_SESSION['userName']) or $_SESSION['userRole'] == 0 or $_SESSION['userRole'] == 2 or !isset($_SESSION['userRole'])) {
        header("location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Category</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/add-category.css">
    </head>
    <body>
        <?php
            include 'menu.php';
        ?>
        
        <main>
            <div class="add-category-page-container">
                <div class="add-category-form-container">
                    <a href='manage-category.php'>
                        <i class="glyphicon glyphicon-arrow-left"></i>
                    </a>
                    <h1>Add Category</h1>
                    <form method="POST">
                        <input class="input-field" type='text' name='category-name' placeholder='Nhập tên loại mới' required>
                        <input class="addbtn" type='submit' name='add' value='add'>
                            <?php
                                if(isset($_POST['add'])){
                                    $categoryName = $_POST['category-name'];
                                    $sql_addCate = "INSERT 
                                                    INTO categories (category_name) 
                                                    VALUES ('$categoryName');";
                                    $result_addCate = $conn->query($sql_addCate);

                                    if ($result_addCate) {
                                        echo "<div class='green-alert-message'>Add successfully</div>";
                                        echo "<div class='clear-float'></div>";
                                    } 
                                    else echo "Error: ". $conn->error;
                                }
                            ?>
                    </form>
                </div>
            </div>
            <?php include 'scroll-top-button.php'; ?>
        </main>
        <?php include 'footer.php'; ?>
    </body>
    <?php $conn->close(); ?>
</html>
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
        <title>Category Edit</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/edit-category.css">
    </head>
    <body>
        <?php
            include 'menu.php';
        ?>
        
        <main>
            <div class="edit-category-page-container">
                <div class="edit-category-form-container">
                    <a href='manage-category.php'>
                        <i class="glyphicon glyphicon-arrow-left"></i>
                    </a>
                    <button class='refreshbtn' onClick='window.location.href=window.location.href'><i class='fa fa-refresh'></i></button>
                    <head>
                        <h1>Category Edit</h1>
                    </head>
                    <form method="POST">
                        <?php
                                //select item_name columns
                            $cateId = $_GET['category-id'];
                            $sql_getAllCates = "SELECT * 
                                                FROM categories 
                                                WHERE category_id = '$cateId';";
                            $result_getAllCates = $conn->query($sql_getAllCates);
                            $row = $result_getAllCates->fetch_assoc();

                            echo "<input class='input-field' type='text' name='category-name' value='".$row['category_name']."'>";
                            echo "<input class='editbtn' type='submit' name='submit' value='edit'>";
                                        

                            if(isset($_POST['submit'])){
                                $categoryName = $_POST['category-name'];
                                $sql_addCate = "UPDATE categories 
                                                SET category_name='$categoryName' 
                                                WHERE category_id='$cateId'";
                                if ($conn->query($sql_addCate) === TRUE) {
                                    echo "<div class='green-alert-message'>Edit successfully</div>";
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
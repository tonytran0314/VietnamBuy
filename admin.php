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
        <title>ADMIN</title>
        <link rel="stylesheet" href="style/admin.css">
    </head>
    <body>
        <?php
            include 'menu.php';
        ?>
        <head>
            <h1>admin dashboard</h1>
        </head>
        <main>
            <div class="manage-menu-of-admin-container">
                <ul class="manage-menu-of-admin-ul">
                    <li><a href="manage-item.php">Quản lý hàng hóa</a></li>
                    <li><a href="manage-category.php">Quản lý loại</a></li>
                </ul>
            </div>
            <?php include 'scroll-top-button.php'; ?>
        </main>
        <?php include 'footer.php'; ?>
    </body>
</html>
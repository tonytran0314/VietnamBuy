<?php
    include 'db-connector.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Grid</title>
        <link rel="stylesheet" href="style/grid.css">
    </head>
    <body>

        <div class="grid">
            <div class="title">Title</div>
            <div class="header">Header</div>
            <div class="sidebar">Sidebar</div>
            <div class="content">
                <p>A</p>
                <p>B</p>
            </div>
            <div class="footer">Footer</div>
        </div>

        <?php include 'footer.php'; ?>
    </body>
</html> 
<?php
    include 'db-connector.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Test 2</title>
        <link rel="stylesheet" href="style/test2.css">
    </head>
    <body>

        <nav class="nav-main">
            <div class="btn-toggle-nav" onClick="toggleNav()"></div>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Portfolio</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Gallery</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>

        <aside class="nav-sidebar">
            <ul>
                <li><span>Projectors</span></li>
                <li><a href="#">Portfolio</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Gallery</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </aside>

        <?php include 'footer.php'; ?>
    </body>
    <script src="js/test2.js"></script>
</html> 
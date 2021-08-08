<?php
    include 'db-connector.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Modal from Youtube</title>
        <link rel="stylesheet" href="style/nom.css">
        <script defer src="js/nom.js"></script>
    </head>
    <body>
        
        <button data-modal-target="#modal" class="btn-open-modal">Open</button>
        <div class="modal" id="modal">
            <div class="modal-header">
                <div class="title">Title</div>
                <button data-close-button class="close-button">&times;</button>
            </div>
            <div class="modal-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
            </div>
        </div>
        <div id='overlay'></div>

        <?php include 'footer.php'; ?>

    </body>
</html>
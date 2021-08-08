<?php
    include 'db-connector.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My modal</title>
        <link rel="stylesheet" href="style/my-modal.css">
    </head>
    <body>

        <button type="button" onclick="openModal()" class="btn-open-modal">Open modal</button>
        <div class="modal">
            <div class="modal-title">
                <h1>Modal title</h1>
                <button type="button" onclick="closeModal()">&times;</button>
                <div class="clear-float"></div>
            </div>
            <div class="modal-content">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus itaque facilis aperiam molestias libero? Corrupti reiciendis fugit qui, vel, dolorem aut quasi nostrum sunt repellendus voluptas sit, dolor excepturi ipsum.
                </p>
            </div>
        </div>
        <div class="overlay" onclick="closeModal()"></div>

        <?php include 'footer.php'; ?>

    </body>
    <script src="js/my-modal.js"></script>
</html> 
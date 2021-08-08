<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/rating.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Rating</title>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="rating-container">
        <i class="fa fa-star" data-index="0"></i>
        <i class="fa fa-star" data-index="1"></i>
        <i class="fa fa-star" data-index="2"></i>
        <i class="fa fa-star" data-index="3"></i>
        <i class="fa fa-star" data-index="4"></i>
    </div>
    <?php include 'footer.php'; ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/rating.js"></script>
</html>
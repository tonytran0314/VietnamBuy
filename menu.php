<?php
    include 'db-connector.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="style/menu.css">
        <link rel="stylesheet" href="style/dropdown-menu.css">
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="index.php">Vietnam Buy</a></li>
                <li>
                    <a href="#">Categories</a>
                    <ul>
                        <?php
                            $sql_getAllCates = "SELECT * FROM categories LIMIT 10";
                            $result_getAllCates = $conn->query($sql_getAllCates);
                            while($row_getAllCates = $result_getAllCates->fetch_assoc()) {
                                echo "<li><a href='items-by-type.php?category-id=".$row_getAllCates['category_id']."'>".$row_getAllCates['category_name']."</a></li>";
                            }
                        ?>
                    </ul>   
                </li>
                <?php
                    $numItemInCart = 0;
                    if(isset($_SESSION['userid'])) {
                        $userID = $_SESSION['userid'];
                    
// get total num of items in cart    
                        $sql_getItemNum = "SELECT quantity
                                    FROM shopping_cart
                                    WHERE user_id = $userID;";
                        $result_getItemNum = $conn->query($sql_getItemNum);
                    
                        while($row_getItemNum = $result_getItemNum->fetch_assoc()) {
                            $numItemInCart = $numItemInCart + $row_getItemNum['quantity'];
                        }
                    }

// menu for normal users 
                    if(isset($_SESSION['userName']) and $_SESSION['userRole'] == 0){
                        echo "<li><a href='profile.php'>Profile</a></li>";
                        if($numItemInCart > 0)
                            echo "<li><a href='cart.php'>Shopping cart <span>(".$numItemInCart.")</span></a></li>";
                        else echo "<li><a href='cart.php'>Shopping Cart</a></li>";
                        echo "<li class='logout'><a onclick='openConfirm()' href='#' class='logout-link'><i class='fa fa-sign-out'></i></a></li>";
                    }
                    
// menu for seller users 
                    else if(isset($_SESSION['userName']) and $_SESSION['userRole'] == 2) {
                        echo "<li><a href='store.php''>Store</a></li>";
                        echo "<li><a href='profile.php''>Profile</a></li>";
                        if($numItemInCart > 0)
                            echo "<li><a href='cart.php''>Shopping Cart <span>(".$numItemInCart.")</span></a></li>";
                        else echo "<li><a href='cart.php''>Shopping Cart</a></li>";
                        echo "<li class='logout'><a onclick='openConfirm()' href='#' class='logout-link'><i class='fa fa-sign-out'></i></a></li>";
                    }
                    
// menu for admin
                    else if(isset($_SESSION['userName']) and $_SESSION['userRole'] == 1) {
                        echo "<li><a href='profile.php'>Profile</a></li>";
                        if($numItemInCart > 0)
                            echo "<li><a href='cart.php'>Shopping cart <span>(".$numItemInCart.")</span></a></li>";
                        else echo "<li><a href='cart.php'>Shopping cart</a></li>";
                        echo "<li><a href='admin.php''>Admin</a></li>";
                        echo "<li class='logout'><a onclick='openConfirm()' href='#' class='logout-link'><i class='fa fa-sign-out'></i></a></li>";
                    }

// Not login already
                    else {
                        echo "<li><a href='login.php''>Log in</a></li>";
                        echo "<li><a href='signup.php''>Sign up</a></li>";
                    }
                ?>
                <div class="my-clearfix"></div>
                <div class="search-container">
                    <form action="search-results.php">
                        <input type="text" placeholder="Search..." >
                        <button type="submit">Search<span class="glyphicon glyphicon-name"></span></button>
                    </form>
                </div>
                
            </ul>
            <div class="my-clearfix"></div>
            <div class="confirm-logout">
                <p class="logout-header">Log out confirmation</p>
                <p class="logout-content">Are you sure you want to logout?</p>
                <button class="btn-cancel" onclick="closeConfirm()">Cancel</button>
                <button class="btn-logout" onclick="directToLogout()">Log out</button>
                <div class="clear-float"></div>
            </div>
            <div class="overlay-background" onclick="closeConfirm()"></div>
        </nav>
        <script src="js/menu.js"></script>
    </body>
    
</html>
<?php
    include 'db-connector.php';
?>

<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Log in</title>
        <link rel="stylesheet" href="style/login.css">
    </head>
    <body>
        <!-- menu -->
        <?php
            include 'menu.php';
        ?>
        <!-- menu -->
        
        <!-- LOG IN FORM -->
        <div class="login-page-container">
            <form method="POST">
                <div class="login-form-container">
                    <h1>Log In</h1>

                    <input class="input-field" type="text" placeholder="Username" name="username" required>

                    <input class="input-field" type="password" placeholder="Password" name="psw" required>

                    <!-- Log in button -->
                    <button type="submit" name="submit" class="loginbtn">Login</button>
                    <!-- Log in button -->
                    
                    <!-- LOG IN PROCESS -->
                    <?php
                        if(isset($_POST['submit'])) {
                            $userName = $_POST['username'];
                            $psw = $_POST['psw'];

                            $sql_checkUser = "SELECT * FROM users WHERE user_name = '$userName' AND password = '$psw';";
                            $result_checkUser = $conn->query($sql_checkUser);
                            if($result_checkUser->num_rows == 1) {
                                $row = $result_checkUser->fetch_assoc(); 

                                $userRole = $row["user_role"];
                                $userID   = $row["user_id"];

                                $_SESSION["userName"] = $userName;
                                $_SESSION["userRole"] = $userRole;
                                $_SESSION["userid"]   = $userID;

                                header("location: index.php");
                            }
                            else    echo "<div class='red-alert-message'>Your user name or password is not correct. Please try again!</div>";
                        }

                        $conn->close();
                    ?>
                    <!-- LOG IN PROCESS -->
                    
                    <p>Don't have an account ? <a href='signup.php' class='signup-link'>Sign up here</a></p>
<!--

                    <label><input type="checkbox" checked="checked" name="remember"> Remember me </label>


                    <a href="#">Forgot password?</a>
-->
                </div>
            </form>
        </div>
        <!-- LOG IN FORM -->
        <?php include 'scroll-top-button.php'; ?>
        <!-- Footer -->
        <?php
            include 'footer.php';
        ?>
        <!-- FOOTER -->
    </body>
</html>
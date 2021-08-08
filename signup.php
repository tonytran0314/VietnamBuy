<?php
    include 'db-connector.php';
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sign up</title>
        <link rel="stylesheet" href="style/signup.css">
    </head>
    <body>
        <?php include 'menu.php'; ?>
        
        <!-- SIGN UP FORM -->
        <div class="signup-page-container">
            <div class="signup-form-container">
                <form method="POST" enctype="multipart/form-data">
<!--             enctype="multipart/form-data" : SOMEHOW REALLY IMPORTANT FOR FILE UPLOAD-->

                    <h1>Create account</h1>
                    <input class="input-field" type="text" placeholder="First name" name="fname" required>
                    <input class="input-field" type="text" placeholder="Middle name (Optional)" name="mname">
                    <input class="input-field" type="text" placeholder="Last name" name="lname" required>
                    <hr>
                    <input class="input-field" type="text" placeholder="User name" name="username" required>
                    <input class="input-field" type="password" placeholder="Password" name="psw" required>
                    <input class="input-field" type="password" placeholder="Repeat your password" name="psw-repeat" required>
<!--
            <label>
              <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
           <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
-->
                    <div class="clearfix"></div>
                    <button type="submit" name="submit" class="signupbtn">Sign up</button>
                    
            <!-- SIGN UP PROCESS -->
            <?php
                if(isset($_POST['submit'])) {
                    $fName = $_POST['fname'];
                    $mName = $_POST['mname'];
                    $lName = $_POST['lname'];
                    $userName = $_POST['username'];
                    $psw = $_POST['psw'];
                    $pswRepeat = $_POST['psw-repeat'];
                    
                    // check repeat password    
                    if ($psw == $pswRepeat) {
                        
                        // check if user existed
                        $sql_checkUser = "SELECT * FROM users WHERE user_name = '$userName';";
                        $result_checkUser = $conn->query($sql_checkUser);
                        if ($result_checkUser->num_rows != 1) {
                            $userImg = 'useravatar.jpg';
                            // add new account
                            $sql_addUser = "INSERT INTO users (user_name, password, user_img, user_first_name, user_middle_name, user_last_name) 
                                            VALUES ('$userName', '$psw','$userImg', '$fName', '$mName', '$lName');";
                            if ($conn->query($sql_addUser)) 
                                echo "<div class='green-alert-message'>Your new account has been created successfully! You can log in with your new account now<a href='login.php' class='login-link-in-green-alert'>Login here</a></div>";
                        }
                        else echo "<div class='red-alert-message'>Account existed!</div>";
                    }
                    else echo "<div class='red-alert-message'>Your Password is not match with the Repeat Password! Please try again</div>";
                }
                $conn->close();
            ?>
            <!-- SIGN UP PROCESS -->
                    <p>Have already an account ? <a href='login.php' class="login-link">Login here</a></p>
                </form>
            </div>
        </div>
        <?php include 'scroll-top-button.php'; ?>
        <?php include 'footer.php'; ?>
    </body>
</html>
<?php
    include 'db-connector.php';
    session_start();    
    if(!isset($_SESSION["userName"])) {
        header("location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="style/profile.css">
    </head>
    <body>
        <?php include 'menu.php'; ?>
        
        <?php
            $name = $_SESSION["userName"];
            $sql_getUserDetails = "SELECT * FROM users WHERE user_name = '$name';";
            $result_getUserDetails = $conn->query($sql_getUserDetails);
            $row = $result_getUserDetails->fetch_assoc();
        ?>
        
        <div class="profile-page-container">
            <div class="left-col-container">
                <div class="user-img-container">
                    <img alt="avatar" src="imgs/<?php echo $row['user_img']; ?>">
                </div>
                <p class="user-name">
                    <?php 
                        echo $row['user_first_name']." ".$row['user_last_name']; 
                    ?>
                </p>
                <button class="btn-open-form">Edit name</button>
                <div class="edit-name-form">
                    <div class="form-header">
                        <p>Edit name</p>
                        <button class="btn-close-form">&times;</button>
                    </div>
                    <div class="form-body">
                        <?php
                            $sql_getFullName = "SELECT user_first_name, user_middle_name, user_last_name
                                                FROM users WHERE user_id = $userID";
                            $result_getFullName = $conn->query($sql_getFullName);
                            $row_getFullName = $result_getFullName->fetch_assoc();
                        ?>
                        <form method="POST">
                            <input type="text" value="<?php echo $row_getFullName['user_first_name']; ?>" placeholder="First name" name="fname" required>
                            <input type="text" value="<?php echo $row_getFullName['user_middle_name']; ?>" placeholder="Middle name (optional)" name="mname">
                            <input type="text" value="<?php echo $row_getFullName['user_last_name']; ?>" placeholder="Last name" name="lname" required>
                            <button type="submit" name="edit-name">Edit</button>
                        </form>
                    </div>
                    <?php 
                        if(isset($_POST['edit-name'])) {
                            $fName = $_POST['fname'];
                            $mName = $_POST['mname'];
                            $lName = $_POST['lname'];

                            $sql_editName = "   UPDATE users 
                                                SET user_first_name = '$fName', 
                                                    user_middle_name = '$mName', 
                                                    user_last_name = '$lName'   
                                                WHERE user_id = $userID";
                            $result_editName = $conn->query($sql_editName);
                        }
                    ?>
                </div>
                <div class="overlay-edit-name"></div>
                <?php
                    if($row["user_role"] == 0) {
                        echo "<form method='POST' action='upgrade-account.php?user-id=".$row['user_id']."'>";
                            echo "<input type='submit' name='upgrade' value='Upgrade account' class='upgradebtn'>";
                        echo "</form>";
                    } else if ($row["user_role"] == 2) echo "<p class='user-role'>Seller</p>";
                    else echo "<p class='user-role'>Admin</p>";
                ?>
            </div>
            <div class="right-col-container">
                <div class="contract-info">
                    <h4>contact info</h4>
                    <ul>
                        <li class="email">jason.james@gmail.com</li>
                        <li>(312)878-3173</li>
                        <li>(815)901-1152</li>
                    </ul>
                </div>
                <div class="links">
                    <h4>links</h4>
                    <ul>
                        <li>Youtube</li>
                        <li>Rdio</li>
                        <li>Website</li>
                    </ul>
                </div>
                <div class="clear-float"></div>
                <div class="about-user">
                    <h4>A little bit about <?php echo $row["user_first_name"]; ?></h4>
                    <p>Corgis are nosey. I grew up with dogs all my life so I know most dogs are nosey but OMG I swear Amelia is the nosiest dog I've ever met/owned.
                        <br>Corgis bark. A LOT! 
                        <br>Corgis shed. 
                        <br>Corgis are affectionate/needy. 
                        <br>Corgis are bossy. 
                        <br>Corgis have hind legs that look like rabbits. 
                        <br>Corgis can hold conversations. 
                        <br>Corgis need jobs.
                    </p>
                </div>
            </div>
            <div class="clear-float"></div>
        </div>
        <?php include 'scroll-top-button.php'; ?>
        <?php include 'footer.php'; ?>
        <script src="js/profile.js"></script>
    </body>
    
</html>